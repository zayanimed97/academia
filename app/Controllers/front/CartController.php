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
        $corsi = $this->CorsiModel  ->where('corsi.id_ente', $data['selected_ente']['id'])
                                            ->where('corsi.id', $this->request->getVar('id'))
                                            ->join('users u', 'find_in_set(u.id, corsi.ids_doctors) > 0', 'left')
                                            ->join('corsi_prezzo_prof prezz', '(prezz.id_corsi = corsi.id)'. $joinLoggedIn, 'left')
                                            ->select("corsi.*, MAX(prezz.prezzo) as max_price, MIN(prezz.prezzo) as min_price")
                                            ->groupBy('corsi.id')
                                            ->first();
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
                'price' => $price,
                'name' => $corsi['sotto_titolo'],
                'options' => ['date' => $this->request->getVar('date') ?? null, 'image' => base_url('uploads/corsi/'.$corsi['foto'])]
            ]);
        }

        echo(json_encode(['cart' => $this->cart->contents(), 'total' =>$this->cart->totalItems(), 'totalPrice' => $this->cart->total()]));
    }

    public function remove($row)
    {
        $this->cart->remove($row);
        
        echo(json_encode(['cart' => $this->cart->contents(), 'total' =>$this->cart->totalItems(), 'totalPrice' => $this->cart->total()]));
    }
    
}
