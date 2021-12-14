<?php

namespace App\Controllers\Front;

use App\Controllers\BaseController;

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
                                        ->select("corsi.*, MAX(prezz.prezzo) as max_price, MIN(prezz.prezzo) as min_price")
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
        foreach ($this->cart->contents() as $c) {
            if ($c['id'] == $this->request->getVar('type').$this->request->getVar('id')) {
                $exist = true;
            }
        }
        
        if ($exist == false) {
            $this->cart->insert([
                'id' => $this->request->getVar('type').$this->request->getVar('id'),
                'type' => $this->request->getVar('type'),
                'qty' => 1,
                'tax' => $corsi['vat'],
                'price' => $price,
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

        echo(json_encode(['cart' => $this->cart->contents(), 'total' =>$this->cart->totalItems(), 'totalPrice' => $this->cart->total(), 'tax' => $tax]));
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
        
        echo(json_encode(['cart' => $this->cart->contents(), 'total' =>$this->cart->totalItems(), 'totalPrice' => $this->cart->total(), 'tax' => $tax]));
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
        // echo '<pre>';
        // print_r($data['user']);
        // echo '</pre>';
        // exit;
        return view($data['view_folder'].'/checkout', $data);
    }
    
}
