<?php

namespace App\Controllers\Front;

use App\Controllers\BaseController;

class UserController extends BaseController
{
    public function register()
    {
        $data = $this->common_data();
        $data['country'] = $this->NazioniModel->where('status', 'enable')->find();
        $data['prof'] = $this->ProfessioneModel->where('status', 'enable')->find();

        return view('default/register', $data);
    }

    public function create_user()
    {
        $request = $this->request->getVar();
        
        $dataUser = [
                        'active' => 'yes',
                        'role' => 'participant',
                        'email' => $request['email'],
                        'password' => md5($request['password']),
                        'display_name' => $request['nome'] . ' ' . $request['cognome'],
                        'id_ente' => $this->common_data()['selected_ente']['id']
        ];

		$new = $this->UserModel->where('id_ente', $this->session->get('user_data')['id'])->insert($dataUser);
        $data = [
            'user_id' => $new,
            'type' => 'private',
            'email' => $this->request->getVar('email'),
            'nome' => $this->request->getVar('nome'),
            'cognome' => $this->request->getVar('cognome'),
            'telefono' => $this->request->getVar('telefono'),
            'cf' => $this->request->getVar('cf'),
            'professione' => $this->request->getVar('professione'),
            'residenza_stato' => $this->request->getVar('residenza_stato') ?: NULL,
            'residenza_provincia' => $this->request->getVar('residenza_provincia') ?: NULL,
            'residenza_comune' => $this->request->getVar('residenza_comune') ?: NULL,
            'residenza_cap' => $this->request->getVar('cap') ?: NULL,
            'residenza_indirizzo' => $this->request->getVar('indirizzo') ?: NULL
        ];

		$this->UserProfileModel->insert($data);

		return redirect()->to(base_url());

    }
}
