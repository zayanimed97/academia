<?php namespace App\Controllers;

class userListController extends BaseController
{
	
	public function show()
	{ 	
		$user_data=$this->session->get('user_data');
		// die(var_dump($user_data));

		$common_data=$this->common_data();
		$data=$common_data;

		 $users = $this->UserModel->where('id_ente', $user_data['id'])	->join('user_profile up', 'up.user_id = users.id', 'left')
																				->join('comuni cr', 'cr.id = up.residenza_comune', 'left')
																				->join('nazioni sr', 'sr.id = up.residenza_stato', 'left')
																				->join('nazioni sn', 'sn.id = up.nascita_stato', 'left')
																				->join('province pr', 'pr.id = up.residenza_provincia', 'left')
																				->join('province pn', 'pr.id = up.nascita_provincia', 'left')
																				->select('users.*, up.*, users.email as user_email, users.id as idu, cr.comune as residenza_comune_name, pr.provincia as residenza_provincia_name, sr.nazione as residenza_stato_name, pn.provincia as nascita_provincia_name, sn.nazione as nascita_stato_name');
        if ($this->request->getVar('role')) {
            $users->where('role', $this->request->getVar('role'));
        }
        $users = $users->find();
		
		$data['users'] = $users;
		$data['role']=$this->request->getVar('role');
		return view('admin/list_user.php',$data);
	}

	public function edit($id)
	{

		$common_data=$this->common_data();
		$data=$common_data;


		$nazioni = $this->NazioniModel->where('status', 'enable')->find();

		$user = $this->UserModel->join('user_profile up', 'up.user_id = users.id', 'left')->where('users.id', $id)->where('users.id_ente', $this->session->get('user_data')['id'])->select('users.*, up.*, users.email as user_email')->first();

		$data['user'] = $user;
		$data['nazioni'] = $nazioni;
		$data['id'] = $id;
			$data['role']=$this->request->getVar('role');
		return view('admin/edit_user', $data);
	}

	public function new()
	{

		$common_data=$this->common_data();
		$data=$common_data;


		$nazioni = $this->NazioniModel->where('status', 'enable')->find();

		$data['nazioni'] = $nazioni;
	$data['role']=$this->request->getVar('role');
		// $user = $this->UserModel->join('user_profile up', 'up.user_id = users.id', 'left')->where('users.id', $id)->where('users.id_ente', $this->session->get('user_data')['id'])->select('users.*, up.*, users.email as user_email')->first();

		return view('admin/new_user', $data);
	}





	public function create()
	{
		$dataUser = [
			'email' => $this->request->getVar('email'),
			// 'password' => $this->request->getVar('Password'),
			'display_name' => $this->request->getVar('nome') . ' ' . $this->request->getVar('cognome'),
			'id_ente' => $this->session->get('user_data')['id'],
			'role' => $this->request->getVar('role'),
			'active' => 'yes',
		];
		
		if ($this->request->getVar('Password') && ($this->request->getVar('Password') == $this->request->getVar('confirm'))) {
			$dataUser['password'] = md5($this->request->getVar('Password'));
		} else { $dataUser['password'] = md5('1234');}

		$new = $this->UserModel->where('id_ente', $this->session->get('user_data')['id'])->insert($dataUser);
		
		
		$validated = $this->validate([
							'logo' => [
								'uploaded[logo]',
								'mime_in[logo,image/jpg,image/jpeg,image/gif,image/png]',
								'max_size[logo,4096]',
							],
						]);
				
						if ($validated) { 
							$avatar_logo = $this->request->getFile('logo');
							 $logo_name = $avatar_logo->getRandomName();
							
							$avatar_logo->move(ROOTPATH.'public/uploads/users/',$logo_name);
						
						
						}
						else {$logo_name=null;
						
						}
					
		$validated = $this->validate([
							'prima' => [
								'uploaded[prima]',
								'mime_in[prima,image/jpg,image/jpeg,image/gif,image/png]',
								'max_size[prima,4096]',
							],
						]);
				
						if ($validated) { 
							$avatar_logo = $this->request->getFile('prima');
							 $prima_name = $avatar_logo->getRandomName();
							
							$avatar_logo->move(ROOTPATH.'public/uploads/users/',$prima_name);
						
						
						}
						else {$prima_name=null;
					
						}
					
		$data = [
					'user_id' => $new,
					'type' => 'private',
					'email' => $this->request->getVar('email_profile'),
					'nome' => $this->request->getVar('nome'),
					'cognome' => $this->request->getVar('cognome'),
					'telefono' => $this->request->getVar('telefono'),
					'cf' => $this->request->getVar('cf'),
					'residenza_stato' => $this->request->getVar('residenza_stato'),
					'residenza_provincia' => $this->request->getVar('residenza_provincia'),
					'residenza_comune' => $this->request->getVar('residenza_comune'),
					'residenza_cap' => $this->request->getVar('residenza_cap'),
					'residenza_indirizzo' => $this->request->getVar('residenza_indirizzo'),
					'nascita_data' => $this->request->getVar('nascita_data'),
					'nascita_stato' => $this->request->getVar('nascita_stato'),
					'nascita_provincia' => $this->request->getVar('nascita_provincia'),
					'posizione' => $this->request->getVar('posizione'),
					'description' => $this->request->getVar('description'),
					'prof_albo' => $this->request->getVar('prof_albo'),
					'qualifica' => $this->request->getVar('qualifica'),
					
					'logo' => $logo_name,
					'prima' => $prima_name,
		];

		$this->UserProfileModel->insert($data);
		if($this->request->getVar('cv')!==null){
			$this->UserCvModel->insert(array('user_id',$new,'cv'=>$this->request->getVar('cv')));
		}
		return redirect()->to(base_url().'/admin/user_list?role='.$this->request->getVar('role'));
	}






	public function update()
	{
		$user = $this->UserModel->where('id', $this->request->getVar('id'))->first();
		if ($user['id_ente'] == $this->session->get('user_data')['id']) {
			$dataUser = [
				'email' => $this->request->getVar('email'),
				// 'password' => $this->request->getVar('Password'),
				'display_name' => $this->request->getVar('nome') . ' ' . $this->request->getVar('cognome'),
				'id_ente' => $this->session->get('user_data')['id']
			];

			if ($this->request->getVar('Password') && ($this->request->getVar('Password') == $this->request->getVar('confirm'))) {
				$dataUser['password'] = md5($this->request->getVar('Password'));
			}

			$data = [
						'type' => $this->request->getVar('private'),
						'email' => $this->request->getVar('email_profile'),
						'nome' => $this->request->getVar('nome'),
						'cognome' => $this->request->getVar('cognome'),
						'telefono' => $this->request->getVar('telefono'),
						'cf' => $this->request->getVar('cf'),
						'residenza_stato' => $this->request->getVar('residenza_stato'),
						'residenza_provincia' => $this->request->getVar('residenza_provincia'),
						'residenza_comune' => $this->request->getVar('residenza_comune'),
						'residenza_cap' => $this->request->getVar('residenza_cap'),
						'residenza_indirizzo' => $this->request->getVar('residenza_indirizzo'),
						'nascita_data' => $this->request->getVar('nascita_data'),
						'nascita_stato' => $this->request->getVar('nascita_stato'),
						'nascita_provincia' => $this->request->getVar('nascita_provincia')
			];

			$this->UserProfileModel->where('user_id', $this->request->getVar('id'))->set($data)->update();
			$this->UserModel->where('id_ente', $this->session->get('user_data')['id'])->update($this->request->getVar('id'), $dataUser);

			return redirect()->to(base_url().'/admin/user_list?role='.$this->request->getVar('role'));
		}
		return redirect()->to($_SERVER['HTTP_REFERER']);
	}





	
	public function delete($id)
	{
		$this->ArgomentiModel->where('id_ente', $this->session->get('user_data')['id'])->where('idargomenti', $id)->delete();
		return redirect()->to($_SERVER['HTTP_REFERER']);
	}
}
?>
