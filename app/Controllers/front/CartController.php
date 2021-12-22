<?php

namespace App\Controllers\Front;

use App\Controllers\BaseController;
use PayPalCheckoutSdk\Core\PayPalHttpClient;
use PayPalCheckoutSdk\Core\SandboxEnvironment;
use PayPalCheckoutSdk\Orders\OrdersCreateRequest;
use PayPalCheckoutSdk\Orders\OrdersCaptureRequest;

class CartController extends BaseController
{
    
    public function addToCart()
    {
        // var_dump($this->request->getVar());
        // exit;
        $data = $this->common_data();

        
        $joinLoggedIn = isset(session('user_data')['profile']['professione']) ? 'AND (prezz.id_professione = '.(session('user_data')['profile']['professione']).')' : '';
        if ($this->request->getVar('type') == 'corsi') {
            $corsi = $this->CorsiModel  ->where('corsi.id_ente', $data['selected_ente']['id'])
                                        ->where('corsi.id', $this->request->getVar('id'))
                                        ->join('users u', 'find_in_set(u.id, corsi.ids_doctors) > 0', 'left')
                                        ->join('corsi_prezzo_prof prezz', '(prezz.id_corsi = corsi.id)'. $joinLoggedIn, 'left')
                                        ->join('corsi_modulo cm', 'cm.id_corsi = corsi.id', 'left')
                                        ->select("corsi.*, MAX(prezz.prezzo) as max_price, MIN(prezz.prezzo) as min_price, GROUP_CONCAT(distinct cm.id) as modules")
                                        ->groupBy('corsi.id')
                                        ->first();
        } elseif($this->request->getVar('type') == 'modulo'){
            $corsi = $this->CorsiModuloModel    ->where('corsi.id_ente', $data['selected_ente']['id'])
                                                ->where('corsi_modulo.id', $this->request->getVar('id'))
                                                ->join('corsi_modulo_prezzo_prof prezz', '(prezz.id_modulo = corsi_modulo.id)'. $joinLoggedIn, 'left')
                                                ->join('corsi', 'corsi.id = corsi_modulo.id_corsi')
                                                ->select("corsi_modulo.*, MAX(prezz.prezzo) as max_price, MIN(prezz.prezzo) as min_price, corsi.vat")
                                                ->groupBy('corsi_modulo.id')
                                                ->first();
        }
        
        if ($corsi['have_def_price'] == 'yes') {
            $price = $corsi['prezzo'];
        }
        if (isset(session('user_data')['profile']['professione'])) {
            $price = strlen($corsi['min_price']) > 0 ? $corsi['min_price'] : (strlen($corsi['have_def_price']) ? $corsi['prezzo'] : 'null');
        }
        if ($corsi['have_def_price'] == 'no') {
            $price = $corsi['min_price'] ?? '';
        }
        if ($corsi['free'] == 'yes') {
            $price = 0;
        }

        $exist = false;
        foreach ($this->cart->contents() as $key=>$c) {
            if ($c['id'] == $this->request->getVar('type').$this->request->getVar('id')) {
                $exist = true;
            }
            if (($this->request->getVar('type') == 'corsi') && (in_array(str_replace('modulo', '', $c['id']), explode(',', $corsi['modules'])))) {
                $this->cart->remove($key);
            }
        }
        
        if ($exist == false) {
            $this->cart->insert([
                'id' => $this->request->getVar('type').$this->request->getVar('id'),
                'type' => $this->request->getVar('type'),
                'qty' => 1,
                'tax' => $corsi['vat'],
                'price' => $price,
                'originalPrice' => $price,
                'coupon' => [],
                'name' => $corsi['sotto_titolo'],
                'options' => ['date' => $this->request->getVar('date') ?? null, 'image' => base_url('uploads/corsi/'.$corsi['foto'])]
            ]);
        }

        $tax = 0;
        foreach ($this->cart->contents() as $item) {
            if ($item['price'] != 'ND') {
                $tax += round($item['price']*0.22, 2);
            }
        }

        echo(json_encode([  'cart' => $this->cart->contents(), 
                            'total' =>$this->cart->totalItems(), 
                            'totalPrice' => $this->cart->total(), 
                            'tax' => $tax,
                            'coupons' => array_values(array_map(function($el){return $el['coupon'];},$this->cart->contents()))
                        ]));
    }

    public function remove($row)
    {
        $this->cart->remove($row);

        $tax = 0;
        foreach ($this->cart->contents() as $item) {
            if ($item['price'] != 'ND') {
                $tax += round($item['price']*0.22, 2);
            }
        }
        
        echo(json_encode([  'cart' => $this->cart->contents(), 
                            'total' =>$this->cart->totalItems(), 
                            'totalPrice' => $this->cart->total(), 
                            'tax' => $tax,
                            'coupons' => array_values(array_map(function($el){return $el['coupon'];},$this->cart->contents()))
                        ]));
    }

    public function getCheckout()
    {
        $data = $this->common_data();
        $data['country'] = $this->NazioniModel->where('status', 'enable')->find();
        $data['user'] = $this->UserProfileModel->where('user_id', $data['user_data']['id'])->first();
        $data['tax'] = 0;
        foreach ($data['cart']->contents() as $item) {
            if ($item['price'] != 'ND') {
                $data['tax'] += round($item['price']*0.22, 2);
            }
        }
        $data['methods'] = $this->EnteMethodPaymentModel->where('id_ente', $data['selected_ente']['id'])->where('enable', 'yes')->where('banned', 'no')->find();
        // echo '<pre>';
        // print_r($data['user']);
        // echo '</pre>';
        // exit;
        return view($data['view_folder'].'/checkout', $data);
    }
    
    public function pay()
	{
        $data = $this->common_data();

        $tab=array( 		
				
            'type' => $this->request->getVar('type'),
            'ragione_sociale' => $this->request->getVar('ragione_sociale') ?? null,
            'fattura_stato' => $this->request->getVar('residenza_stato'),			
            'fattura_provincia' => $this->request->getVar('residenza_provincia'),
            'fattura_comune' => $this->request->getVar('residenza_comune'),
            'fattura_indirizzo' => $this->request->getVar('indirizzo'),				
            'fattura_cap' => $this->request->getVar('cap'),
            'fattura_pec' =>$this->request->getVar('pec'),
            'fattura_sdi' => $this->request->getVar('sdi') ?? null,
            'fattura_cf' =>$this->request->getVar('cf') ?? null,
            'fattura_piva' => $this->request->getVar('piva') ?? null,
            'fattura_phone' => $this->request->getVar('telefono') ?? null,
        
            'fattura_nome'=>$this->request->getVar('name'),
            'fattura_cognome'=>$this->request->getVar('cognome'),
            
        );
        $this->UserProfileModel->update(session('user_data')['profile']['id'],$tab);

        

        // adding cart to db 
        $items = [];
        $cartItems = [];
        $total_vat = 0;
        $cart = $this->cart->contents();
        foreach ($cart as $item) {
            if (is_numeric($item['price'])) {
                $total_vat += $item['price'] * ($item['tax']/100);
                array_push  ($items, [
                        "reference_id" => $item['id'],
                        "amount" => [
                            "value" => round($item['price'] * (($item['tax']/100)+1), 2),
                            "currency_code" => "EUR"
                        ]
                    ]
                );
            }
            
            
            array_push($cartItems, ['item_type' => $item['type'], 
                                    'item_id' => str_replace(['corsi', 'modulo'], ['', ''], $item['id']), 
                                    'price_ht' => $item['price'],
                                    'vat' => $item['tax'],
                                    'details' => json_encode($item)
                                    ]);

        }
        $cartId = $this->CartModel->insert  ([  'id_ente' => $data['selected_ente']['id'],
                                                'id_user' => session('user_data')['id'],
                                                'date' => date('Y-m-d H:i:s'),
                                                'total_ht' => $this->cart->total(),
                                                'total_vat'=> $total_vat,
                                                'id_professione' => session('user_data')['profile']['professione'],
                                                'status' => 'pending',
                                            ]);
        foreach ($cartItems as &$item) {
            $item['id_cart'] = $cartId;
        }

        $this->CartItemsModel->insertBatch($cartItems);
        // echo '<pre>';
        // print_r($cartItems);
        // echo '</pre>';
        // exit;
        // if (!empty($this->cart->contents())) {
        //     foreach ($this->cart->contents(); as $item) {
                    
        //     }
        // }

		// Creating an environment
        switch ($this->request->getVar('paymethod')) {
            case 'paypal':
                // $this->CartPaymentModel->insert([   'id_cart'=>$cartId,
                //                                     'id_method' => 2,
                //                                     'amount' => $this->cart->total() + $total_vat,
                //                                     'date' => date('Y-m-d H:i:s'),
                //                                     'status' => 'pending',
                //                                     'details' => json_encode($items)
                                                // ]);
                $payment = $this->EnteMethodPaymentModel->where('id_method', 2)
                                                        ->where('id_ente', $data['selected_ente']['id'])
                                                        ->where('banned', 'no')
                                                        ->where('enable', 'yes')
                                                        ->first();
                $clientId = json_decode($payment['details'])->clientId;
                $clientSecret = json_decode($payment['details'])->clientSecret;

                $environment = new SandboxEnvironment($clientId, $clientSecret);
                $client = new PayPalHttpClient($environment);

                $request = new OrdersCreateRequest();
                $request->prefer('return=representation');
                
                $request->body = [
                                    "intent" => "CAPTURE",
                                    "purchase_units" => $items,
                                    "application_context" => [
                                        "cancel_url" => base_url("/order/cancel"),
                                        "return_url" => base_url("/order/confirm"),
                                    ] 
                                ];

                try {
                    // Call API with your client and get a response for your call
                    $response = $client->execute($request);
                    $this->CartPaymentModel->insert([   'id_cart'=>$cartId,
                                                        'id_method' => 2,
                                                        'amount' => $this->cart->total() + $total_vat,
                                                        'date' => date('Y-m-d H:i:s'),
                                                        'status' => 'pending',
                                                        'details' => $response->result->id
                                                    ]);
                    // echo '<pre>';
                    // print_r($response);
                    // echo '</pre>';
                    // exit;
                    $res = array_filter($response->result->links, function ($el)
                    {
                        return $el->rel == "approve";
                    });
                    // print_r("Location: ". reset($res)->href);
                    header("Location: ". reset($res)->href);
                    exit();
                    // If call returns body in response, you can get the deserialized version from the result attribute of the response
                    // return $this->response->setJSON($response);
                }catch (HttpException $ex) {
                    echo $ex->statusCode;
                    print_r($ex->getMessage());
                }
                break;
                case 'iban':
                    $this->CartPaymentModel->insert([   'id_cart'=>$cartId,
                                                        'id_method' => 1,
                                                        'amount' => $this->cart->total() + $total_vat,
                                                        'date' => date('Y-m-d H:i:s'),
                                                        'status' => 'pending',
                                                    ]);
                    $usedCoupons = $this->usedCoupons();
                    foreach ($usedCoupons as $used) {
                        $this->CouponModel->where('code', $used)->where('id_ente', $data['selected_ente']['id'])->set('used', 'used+1', FALSE)->update();
                    }
                    $this->cart->destroy();
                    session()->setFlashdata('success', 'Order Placed Please Pay To Confirm');
                    return redirect()->to(base_url());
                break;
            default:
                return;
                break;
        }
		
    }

    public function confirm()
	{ 
        $data = $this->common_data();

		$token=$this->request->getVar('token');
        $payment = $this->EnteMethodPaymentModel    ->where('id_method', 2)
                                                    ->where('id_ente', $data['selected_ente']['id'])
                                                    ->where('banned', 'no')
                                                    ->where('enable', 'yes')
                                                    ->first();
        $clientId = json_decode($payment['details'])->clientId;
        $clientSecret = json_decode($payment['details'])->clientSecret;

		$environment = new SandboxEnvironment($clientId, $clientSecret);
		$client = new PayPalHttpClient($environment);

		$request = new OrdersCaptureRequest($token);
		$request->prefer('return=representation');
		try {
			// Call API with your client and get a response for your call
			$response = $client->execute($request);
			
            $payment = $this->CartPaymentModel->where('details', $token)->first();
            $this->CartModel->update($payment['id_cart'], ['status' => $response->result->status]);
            $this->CartPaymentModel->update($payment['id'], ['status' => $response->result->status]);
            $items = $this->CartItemsModel->where('id_cart', $payment['id_cart'])->find();
            $modules = [];
            foreach ($items as $item) {
                if ($item['item_type'] == 'modulo') {
                    array_push($modules, ['id'=>$item['item_id'], 'date'=>json_decode($item['details'])->options->date]);
                }
                if ($item['item_type'] == 'corsi') {
                    $modulo = $this->CorsiModuloModel->where('id_corsi', $item['item_id'])->where('banned', 'no')->select('id')->find();
                    foreach ($modulo as $mod) {
                        array_push($modules, $mod['id']);
                    }
                }
            }
            $participation = [];
            foreach ($modules as $module) {
                array_push($participation,  [   'id_ente'=> $data['selected_ente']['id'],
                                                'id_user' => session('user_data')['id'],
                                                'id_modulo' => $module['id'] ?? $module ?? null,
                                                'id_date' => $module['date'] ?? null,
                                                'id_cart' => $payment['id_cart'],
                                                'date' => date('Y-m-d H:i:s')
                                            ]);
            }
            $this->ParticipationModel->insertBatch($participation);
			// If call returns body in response, you can get the deserialized version from the result attribute of the response
			// return $this->response->setJSON($response);
            
            $usedCoupons = $this->usedCoupons();
            foreach ($usedCoupons as $used) {
                $this->CouponModel->where('code', $used)->where('id_ente', $data['selected_ente']['id'])->set('used', 'used+1', FALSE)->update();
            }
            $this->cart->destroy();
            session()->setFlashdata('success', 'cart payed successfully');
			 $xxx = $this->OrderMail($payment['id_cart']);
            return redirect()->to(base_url());
		}catch (HttpException $ex) {
			echo $ex->statusCode;
			print_r($ex->getMessage());
		}
	}

    public function cancel()
    {
		$token=$this->request->getVar('token');

        $payment = $this->CartPaymentModel->where('details', $token)->first();
        $this->CartModel->update($payment['id_cart'], ['status' => 'CANCELLED']);
        $this->CartPaymentModel->update($payment['id'], ['status' => 'CANCELLED']);

        session()->setFlashdata('cancelled', 'Payment Cancelled');
        return redirect()->to(base_url());
    }

    public function coupon()
    {
        $data = $this->common_data();
        
        

        $code = $this->request->getVar('coupon');
        $coupon = $this->CouponModel->where('code', $code)
                                    ->where('enable', 'yes')
                                    ->where('banned', 'no')
                                    ->where('id_ente', $data['selected_ente']['id'])
                                    ->where('curdate() BETWEEN start_date AND end_date')
                                    ->where('(used < nb_use) OR (nb_use = 0)')
                                    ->first();
        $usedCoupon = null;
        if (!empty($coupon)) {
            $corsi_in_cart = array_map(function($el){if($el['type'] == 'corsi') return ['type' => 'corsi', 'corsi' => str_replace($el['type'], '', $el['id'])];},$this->cart->contents());
            $modulo_in_cart = array_map(function($el){if($el['type'] == 'modulo') return str_replace($el['type'], '', $el['id']);},$this->cart->contents());


            $moduli = $this->CorsiModuloModel   ->whereIn('corsi_modulo.id', $modulo_in_cart ?: ['impossible value'])
                                                ->join('corsi c', 'c.id = corsi_modulo.id_corsi')
                                                ->where('c.buy_type', 'date')
                                                ->select('corsi_modulo.*')
                                                ->find();
            $corsi_in_cart = array_filter(array_merge($corsi_in_cart, array_map(function($el){return ['type'=>'modulo','corsi'=>$el['id_corsi'], 'modulo' => $el['id']];}, $moduli)));

            
            $corsi = $this->CorsiModel->whereIn('id', array_map(function($el){return $el['corsi'];},$corsi_in_cart) ?: ['impossible value'])->where('id_ente', $data['selected_ente']['id'])->find();
            
            if ($coupon['coupon_type'] != 'cart') {
                

                $usedCoupon = array_filter($corsi, function($el) use ($coupon){
                    if($coupon['coupon_type'] == 'corsi'){
                        return $el['id'] == $coupon['id_corsi'];
                    }
                    if ($coupon['coupon_type'] == 'docenti') {
                        return array_search($coupon['id_docenti'], explode(',', $el['ids_doctors'])) !== false;
                    }
                    if ($coupon['coupon_type'] == 'argomenti') {
                        return $el['id_argomenti'] == $coupon['id_argomenti'];
                    }
                });


                // foreach ($corsi_in_cart as &$value) {
                //     $value = $value['type'] == 'modulo' ? 'modulo'.$value['modulo'] : 'corsi'.$value['corsi'];
                // }

                if (!empty($usedCoupon)) {
                    $cartItemDiscounted = array_filter($this->cart->contents(), function($el) use($usedCoupon, $corsi_in_cart){
                        return !empty(array_filter($corsi_in_cart, 
                                            function($c) use ($el, $usedCoupon){
                                                return (
                                                            (($c['type'] == 'modulo' ? 'modulo'.$c['modulo'] : 'corsi'.$c['corsi']) == $el['id']) && 
                                                            !empty(array_filter($usedCoupon, 
                                                                function($uc) use ($c){
                                                                    return $uc['id'] == $c['corsi'];
                                                                })
                                                            )
                                                        );
                                            }
                                        )
                                    );
                    });

                    // echo '<pre>';
                    // print_r($cartItemDiscounted);
                    // echo '</pre>';
                    // exit;
                   
                    if (!empty($cartItemDiscounted)) {

                        foreach ($cartItemDiscounted as $key => $item) {
                            $coupons = $item['coupon'];
                            $coupons[$coupon['code']] = ($coupon['type'] == 'fixed') ? $coupon['amount'] : round($item['price']*($coupon['amount']/100), 2);
                            if (strlen($item['coupon'][$coupon['code']] ??'') == 0) {
                                    $prevPrice = $item['price'];
                                    if ($coupon['type'] == 'fixed') {
                                    $this->cart->update(['rowid'=>$key, 'price' => $prevPrice - $coupon['amount'], 'coupon'=>$coupons]);
                                } elseif ($coupon['type'] == 'percent'){
                                    // $prevPrice = $item['price'];
                                    $this->cart->update(['rowid'=>$key, 'price' => round($prevPrice*(1-($coupon['amount']/100)), 2), 'coupon'=>$coupons]);
                                }   
                            }
                        }
                        
                    }
                    $tax = 0;
                    foreach ($this->cart->contents() as $item) {
                        if ($item['price'] != 'ND') {
                            $tax += round($item['price']*0.22, 2);
                        }
                    }
                    return json_encode  ([  "status" => 'success', 
                                            "message" => 'Coupon applied to '.$coupon['coupon_type'], 
                                            'cartItems' => $this->cart->contents(), 
                                            'total' => $this->cart->total(),
                                            'coupons' => array_values(array_map(function($el){return $el['coupon'];},$this->cart->contents())),
                                            'tax' => $tax
                                        ]);
                } else {
                    $tax = 0;
                    foreach ($this->cart->contents() as $item) {
                        if ($item['price'] != 'ND') {
                            $tax += round($item['price']*0.22, 2);
                        }
                    }
                    return json_encode  ([  "status" => 'error', 
                                            "message" => 'No Items to discount', 
                                            'cartItems' => $this->cart->contents(), 
                                            'total' => $this->cart->total(),
                                            'coupons' => array_values(array_map(function($el){return $el['coupon'];},$this->cart->contents())),
                                            'tax' => $tax
                                        ]);
                }


            } else {
                if (!empty($this->cart->contents())) {
                    
                foreach ($this->cart->contents() as $key=>$item) {
                    $coupons = $item['coupon'];
                    $coupons[$coupon['code']] = ($coupon['type'] == 'fixed') ? $coupon['amount'] : round($item['originalPrice']*($coupon['amount']/100), 2);
                    if (strlen($item['coupon'][$coupon['code']] ??'') == 0) {
                        if ($coupon['type'] == 'fixed') {
                            $prevPrice = $item['price'];
                            $this->cart->update(['rowid'=>$key, 'price' => $prevPrice - $coupon['amount'], 'coupon'=>$coupons]);
                        } elseif ($coupon['type'] == 'percent'){
                            $prevPrice = $item['originalPrice'];
                            $this->cart->update(['rowid'=>$key, 'price' => round($prevPrice*(1-($coupon['amount']/100)), 2), 'coupon'=>$coupons]);
                        }
                    }
                }
                $tax = 0;
                    foreach ($this->cart->contents() as $item) {
                        if ($item['price'] != 'ND') {
                            $tax += round($item['price']*0.22, 2);
                        }
                    }
                    return json_encode  ([  "status" => 'success', 
                                            "message" => 'Coupon applied to cart', 
                                            'cartItems' => $this->cart->contents(), 
                                            'total' => $this->cart->total(),
                                            'coupons' => array_values(array_map(function($el){return $el['coupon'];},$this->cart->contents())),
                                            'tax' => $tax
                                        ]);
            } else {
                $tax = 0;
                    foreach ($this->cart->contents() as $item) {
                        if ($item['price'] != 'ND') {
                            $tax += round($item['price']*0.22, 2);
                        }
                    }
                    return json_encode  ([  "status" => 'error', 
                                            "message" => 'Cart is empty', 
                                            'cartItems' => $this->cart->contents(), 
                                            'total' => $this->cart->total(),
                                            'coupons' => array_values(array_map(function($el){return $el['coupon'];},$this->cart->contents())),
                                            'tax' => $tax
                                        ]);
            }

                
                
            }
        } 
        $tax = 0;
                    foreach ($this->cart->contents() as $item) {
                        if ($item['price'] != 'ND') {
                            $tax += round($item['price']*0.22, 2);
                        }
                    }
                    return json_encode  ([  "status" => 'error', 
                                            "message" => 'Inexisting or Expired coupon', 
                                            'cartItems' => $this->cart->contents(), 
                                            'total' => $this->cart->total(),
                                            'coupons' => array_values(array_map(function($el){return $el['coupon'];},$this->cart->contents())),
                                            'tax' => $tax
                                        ]);
        

        
        
    }

    public function usedCoupons()
    {
        $array = [];
        $x = array_values(array_map(function($el){return array_keys($el['coupon']);},$this->cart->contents()));
        array_walk($x, function($walk) use(&$array) {$array = array_merge($array, $walk);});
        return array_unique($array);
    }
}
