<?php namespace App\Controllers;

class ProfileController extends BaseController
{
	
	public function show()
	{ 	
		$user_data=$this->session->get('user_data');
		// die(var_dump($user_data));
		$common_data=$this->common_data();
		$data=$common_data;
		// die(var_dump($settings));
		$user = $this->UserModel->join('user_profile up', 'up.user_id = users.id', 'left')->where('users.id', $user_data['id'])->select('users.*, up.*, users.email as user_email')->first();
		$nazioni = $this->NazioniModel->where('status', 'enable')->find();
		unset($user['password']);

		$data['user'] = $user;
		$data['nazioni'] = $nazioni;
		// echo('<pre>');
		// print_r();
		// echo('</pre>');exit;
		return view('admin/profile.php',$data);
	}

	public function update()
	{
		// echo('<pre>');
		// print_r($this->request->getVar());
		// echo('</pre>');exit;

		$user = $this->UserProfileModel->where('user_id', $this->session->get('user_data')['id'])->first();
		$data = [
					'user_id' => $this->session->get('user_data')['id'],
					'type' => $this->request->getVar('private'),
					'email' => $this->request->getVar('email_profile'),
					'nome' => $this->request->getVar('nome'),
					'cognome' => $this->request->getVar('cognome'),
					'telefono' => $this->request->getVar('telefono'),
					'cf' => $this->request->getVar('cf'),
					'piva' => $this->request->getVar('piva'),
					'ragione_sociale' => $this->request->getVar('regione_sociale'),
					'residenza_stato' => $this->request->getVar('residenza_stato'),
					'residenza_provincia' => $this->request->getVar('residenza_provincia'),
					'residenza_comune' => $this->request->getVar('residenza_comune'),
					'residenza_cap' => $this->request->getVar('residenza_cap'),
					'residenza_indirizzo' => $this->request->getVar('residenza_indirizzo'),
					'fattura_piva' => $this->request->getVar('fattura_piva'),
					'fattura_cf' => $this->request->getVar('fattura_cf'),
					'fattura_stato' => $this->request->getVar('fattura_stato'),
					'fattura_provincia' => $this->request->getVar('fattura_provincia'),
					'fattura_comune' => $this->request->getVar('fattura_comune'),
					'fattura_indirizzo' => $this->request->getVar('fattura_indirizzo'),
					'fattura_cap' => $this->request->getVar('fattura_cap'),
					'fattura_pec' => $this->request->getVar('fattura_pec'),
					'fattura_sdi' => $this->request->getVar('fattura_sdi'),
					'fattura_phone' => $this->request->getVar('fattura_phone')	
		];

		if (isset($user['id'])) {
			$data['id'] = $user['id'];
		}

		$settings_emails = [
								"meta_value" => implode(',,,',array_map( function ($el){return $el['email_contact'];}, $this->request->getVar('mail')))
							];
		$settings_phones = [
								"meta_value" => implode(',,,',array_map( function ($el){return $el['phone_contact'];}, $this->request->getVar('phone'))) 
							];
		$this->SettingModel->where('id_ente', $this->session->get('user_data')['id'])->where('meta_key', 'contact_email')->set($settings_emails)->update();
		$this->SettingModel->where('id_ente', $this->session->get('user_data')['id'])->where('meta_key', 'contact_telephone')->set($settings_phones)->update();

		$this->UserProfileModel->save($data);

		
		$this->UserProfileModel->save($data);


		$user_data = [
			"email" => $this->request->getVar('email'),
			'display_name' => $this->request->getVar('nome'). ' '. $this->request->getVar('cognome'),
		];
		$session = $this->session->get('user_data');

		$session['display_name'] = $this->request->getVar('nome'). ' '. $this->request->getVar('cognome');
		$user_data["display_name"] = $this->request->getVar('nome'). ' '. $this->request->getVar('cognome');
		if ($this->request->getVar('confirm')) {
			if (md5($this->request->getVar('Old_Password')) == $this->session->get('user_data')['password']) {
				$session['password'] = md5($this->request->getVar('confirm'));
				$user_data["password"] = md5($this->request->getVar('confirm'));
			} else {
				$this->session->setFlashdata('error', 'wrong password');
			}
		}

		$this->session->set('user_data', $session);

		$this->UserModel->update($this->session->get('user_data')['id'], $user_data);

		return redirect()->to($_SERVER['HTTP_REFERER']);
	}
}
?>
