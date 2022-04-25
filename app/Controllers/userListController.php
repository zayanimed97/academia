<?php namespace App\Controllers;

class userListController extends BaseController
{
	
	public function show()
	{ 	
		$user_data=$this->session->get('user_data');
		// die(var_dump($user_data));

		$common_data=$this->common_data();
		$data=$common_data;

	if(!is_null($this->request->getVar('action'))){
				switch($this->request->getVar('action')){
					case 'send_notification_multiple':
						$list_p=$this->request->getVar('id');
					
						
						if(!empty($list_p)){
							foreach($list_p as $kk=>$vv){
								if($vv!=""){
									$inf=$this->UserModel->find($vv);
									$inf_profile=$this->UserProfileModel->where('user_id',$vv)->first();
			$name=$inf_profile['nome'].' '.$inf_profile['cognome'];
			
			$email = \Config\Services::email();
			
			$SMTP=$this->SettingModel->getByMetaKeyEnte($common_data['user_data']['id'],'SMTP')['SMTP'];
				if($SMTP!="") $vals=json_decode($SMTP,true);
			 $sender_name=$common_data['settings']['sender_name'];
			 $sender_email=$common_data['settings']['sender_email'];
				if(!empty($vals)){
					if(isset($vals['sender_name'])  && $vals['sender_name']!="") $sender_name=$vals['sender_name']; else $sender_name=$common_data['settings']['sender_name'];
					if(isset($vals['sender_email']) && $vals['sender_email']!="") $sender_email=$vals['sender_email']; else $sender_email=$common_data['settings']['sender_email'];
					
					$email->SMTPHost=$vals['host'];
					$email->SMTPUser=$vals['username'];
					$email->SMTPPass=$vals['password'];
					$email->SMTPPort=$vals['port'];
				}
		
			
				$email->setFrom($sender_email,$sender_name);
			$email->setTo($inf['email']);
			//$email->setBCC('segreteria@dentalcampus.it');
			$link=base_url('user/login');
			
		
			 $html=$this->request->getVar('notification_message');
			 $html=str_replace(array("{var_user_name}","{var_email}","{var_password}"),array($name,$inf['email'],$inf['pass']),$html);
				$subject=$this->request->getVar('notification_subject');
			$email->setSubject($subject);
			$email->setMessage($html);
			$email->setAltMessage(strip_tags($html));
			$xxx=$email->send();
			$email->clear();
			$yy=$this->NotifLogModel->insert(array('id_participant'=>$vv,'type'=>'email','user_to'=>$inf['email'],'subject'=>$subject,'message'=>$html,'date'=>date('Y-m-d H:i:s')));
								}
							}
						}
						
						$data['success']=lang('app.success_send_notification');
					break;
				}
	}

		 $users = $this->UserModel->where('users.id_ente', $user_data['id'])	->join('user_profile up', 'up.user_id = users.id', 'left')
																				->join('comuni cr', 'cr.id = up.residenza_comune', 'left')
																				->join('nazioni sr', 'sr.id = up.residenza_stato', 'left')
																				->join('nazioni sn', 'sn.id = up.nascita_stato', 'left')
																				->join('province pr', 'pr.id = up.residenza_provincia', 'left')
																				->join('province pn', 'pr.id = up.nascita_provincia', 'left')
																				->join('cart c', 'c.id_user = users.id', 'left')
																				->groupBy('users.id')
																				->select('	users.*, 
																							up.*, 
																							users.email as user_email, 
																							users.id as idu, 
																							cr.comune as residenza_comune_name, 
																							pr.provincia as residenza_provincia_name, 
																							sr.nazione as residenza_stato_name, 
																							pn.provincia as nascita_provincia_name, 
																							sn.nazione as nascita_stato_name, 
																							sum(CASE WHEN c.status = "COMPLETED" THEN 1 ELSE 0 END) as countBuys
																						');
        if ($this->request->getVar('role')) {
            $users->where('role', $this->request->getVar('role'));
        }
        $users = $users->find();
		// echo '<pre>';
        // print_r($users);
        // echo '</pre>';
        // exit;
		$data['users'] = $users;
		$data['role']=$this->request->getVar('role');
		
		/*$temp=$this->TemplatesModel->where('module','notification')->where('id_ente',$common_data['user_data']['id'])->first();
		if(empty($temp)) $temp=$this->TemplatesModel->where('module','notification')->first();
		$data['temp']=$temp ?? array();*/
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
		$user_cv=$this->UserCvModel->where('user_id',$id)->where('banned','no')->first();
		$data['user_cv'] =$user_cv ?? array('titolo'=>'','cv'=>'');
		$list_achat=array();
		$ll=$this->ParticipationModel->where('banned','no')->where('id_ente',$common_data['user_data']['id'])->where('id_user',$id)->find();
		foreach($ll as $k=>$v){
			if($v['id_cart']!=""){
					$inf_cart=$this->CartModel->find($v['id_cart']);
					$inf_payment=$this->CartPaymentModel->where('id_cart',$v['id_cart'])->where('status','COMPLETED')->where('banned','no')->find();
					$total_paid=$inf_cart['total_ht']+$inf_cart['total_vat'];
					if(!empty($inf_payment)) $inf_method=$this->MethodPaymentModel->find($inf_payment[0]['id_method']);
					else $inf_method['title']="--";
					$quota=number_format($total_paid,2,',','.').'€ <br/>'.date('d/m/Y',strtotime($inf_cart['date'])).'<br/>'.$inf_method['title'];/*.'<br/>'.' <a  data-toggle="modal" data-target="#payment-modal" onclick="get_payments('.$v['id_cart'].')" class="btn p-1 mr-2" style="font-size: 1rem">
                                                                <i class="fe-dollar-sign"></i>
                                                            </a>';*/
					
				}
			$inf_modulo=$this->CorsiModuloModel->find($v['id_modulo']);
			$list_achat[$k]['corsi']=$inf_modulo['sotto_titolo'];
			$list_achat[$k]['date']=date('d/m/Y',strtotime($v['date']));
			$list_achat[$k]['quota']=$quota;
		}
		$data['list_achat']=$list_achat;
		
		$data['list_nazioni']=$this->NazioniModel->where('status','enable')->orderby("nazione",'asc')->findAll();
				if($user['residenza_stato']==106){
					$data['list_provincia']=$this->ProvinceModel->findAll();
					if($user['residenza_provincia']>0) $data['list_comuni']=$this->ComuniModel->where('id_prov',$user['residenza_provincia'])->findAll();
				}
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
	{if($this->request->getVar('active')!==null) $active="yes"; else $active="no";
		$dataUser = [
			'email' => strtolower(trim($this->request->getVar('email'))),
			// 'password' => $this->request->getVar('Password'),
			'display_name' => $this->request->getVar('nome') . ' ' . $this->request->getVar('cognome'),
			'id_ente' => $this->session->get('user_data')['id'],
			'role' => $this->request->getVar('role'),
			'active' => $active,
		];
		
		if ($this->request->getVar('Password') && ($this->request->getVar('Password') == $this->request->getVar('confirm'))) {
			$dataUser['password'] = md5($this->request->getVar('Password'));
			$dataUser['pass']=$this->request->getVar('Password');
		} else { 
			$dataUser['password'] = md5('1234');
			$dataUser['pass']='1234';
		}

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
					'mobile' => $this->request->getVar('mobile'),
					'cf' => $this->request->getVar('cf'),
					'residenza_stato' => $this->request->getVar('residenza_stato'),
					'residenza_provincia' => $this->request->getVar('residenza_provincia'),
					'residenza_comune' => $this->request->getVar('residenza_comune'),
					'residenza_cap' => $this->request->getVar('residenza_cap'),
					'residenza_indirizzo' => $this->request->getVar('residenza_indirizzo'),
					'nascita_data' => $this->request->getVar('nascita_data'),
					'nascita_stato' => $this->request->getVar('nascita_stato'),
					'nascita_provincia' => $this->request->getVar('nascita_provincia'),
					'ruolo' => $this->request->getVar('ruolo'),
					'posizione' => $this->request->getVar('posizione'),
					'del' => $this->request->getVar('del'),
					'abo' => $this->request->getVar('abo'),
					'professione_citta' => $this->request->getVar('professione_citta'),
					
					'description' => $this->request->getVar('description'),
					'prof_albo' => $this->request->getVar('prof_albo'),
					'qualifica' => $this->request->getVar('qualifica'),
					
					'logo' => $logo_name,
					'prima' => $prima_name,
		];

		$this->UserProfileModel->insert($data);
		if($this->request->getVar('cv')!==null){
			$this->UserCvModel->insert(array('user_id'=>$new,'cv'=>$this->request->getVar('cv'),'titolo'=>$this->request->getVar('cv_titolo'),'created_at'=>date('Y-m-d H:i:s')));
		}
		return redirect()->to(base_url().'/admin/user_list?role='.$this->request->getVar('role'));
	}






	public function update()
	{if($this->request->getVar('active')!==null) $active="yes"; else $active="no";
		$user = $this->UserModel->where('id', $this->request->getVar('id'))->first();
		if ($user['id_ente'] == $this->session->get('user_data')['id']) {
			$dataUser = [
				'email' => strtolower(trim($this->request->getVar('email'))),
				// 'password' => $this->request->getVar('Password'),
				'display_name' => $this->request->getVar('nome') . ' ' . $this->request->getVar('cognome'),
				'id_ente' => $this->session->get('user_data')['id'],
				'active' => $active,
			];

			if ($this->request->getVar('Password') && ($this->request->getVar('Password') == $this->request->getVar('confirm'))) {
				$dataUser['password'] = md5($this->request->getVar('Password'));
				$dataUser['pass']=$this->request->getVar('Password');
			}

			$data = [
						
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
						'ruolo' => $this->request->getVar('ruolo'),
					'posizione' => $this->request->getVar('posizione'),
					'del' => $this->request->getVar('del'),
					'abo' => $this->request->getVar('abo'),
					'professione_citta' => $this->request->getVar('professione_citta'),
							'mobile' => $this->request->getVar('mobile'),
					'description' => $this->request->getVar('description'),
					'prof_albo' => $this->request->getVar('prof_albo'),
					'qualifica' => $this->request->getVar('qualifica'),
					'type' => $this->request->getVar('type'),
				'ragione_sociale' => $this->request->getVar('ragione_sociale'),
				'fattura_stato' => $this->request->getVar('fattura_stato'),			
				'fattura_provincia' => $this->request->getVar('fattura_provincia'),
				'fattura_comune' => $this->request->getVar('fattura_comune'),
				'fattura_indirizzo' => $this->request->getVar('fattura_indirizzo'),				
				'fattura_cap' => $this->request->getVar('fattura_cap'),
				'fattura_pec' =>$this->request->getVar('fattura_pec'),
				'fattura_sdi' => $this->request->getVar('fattura_sdi'),
				'fattura_cf' =>$this->request->getVar('fattura_cf'),
				'fattura_piva' => $this->request->getVar('fattura_piva'),
			
				'fattura_nome'=>$this->request->getVar('fattura_nome'),
				'fattura_cognome'=>$this->request->getVar('fattura_cognome'),
			];
		if($this->request->getVar('delete_foto')=='yes'){
					$data['logo']="";
				}
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
						$data['logo']=$logo_name;
						
						}
				$validation=$this->validator;
							$data['warning']=$validation->listErrors();
							 $validation->reset();	
		if($this->request->getVar('delete_prima')=='yes'){
					$data['prima']="";
				}			
		$validated2 = $this->validate([
							'prima' => [
								'uploaded[prima]',
								'mime_in[prima,image/jpg,image/jpeg,image/gif,image/png]',
								'max_size[prima,4096]',
							],
						]);
				
						if ($validated2) { 
							$avatar_logo = $this->request->getFile('prima');
							 $prima_name = $avatar_logo->getRandomName();
							
							$avatar_logo->move(ROOTPATH.'public/uploads/users/',$prima_name);
						 $data['prima']=$prima_name;
						
						}
						else{
							$validation=$this->validator;
				 $error_msg=$validation->listErrors();
							}
						
		
			$this->UserProfileModel->where('user_id', $this->request->getVar('id'))->set($data)->update();
			$this->UserModel->where('id_ente', $this->session->get('user_data')['id'])->update($this->request->getVar('id'), $dataUser);
			if($this->request->getVar('cv')!==null){
				$this->UserCvModel->where('user_id',$this->request->getVar('id'))->delete();
			$this->UserCvModel->insert(array('user_id'=>$this->request->getVar('id'),'cv'=>$this->request->getVar('cv'),'titolo'=>$this->request->getVar('cv_titolo'),'created_at'=>date('Y-m-d H:i:s')));
		}
			return redirect()->to(base_url().'/admin/user_list?role='.$this->request->getVar('role'));
		}
		return redirect()->to($_SERVER['HTTP_REFERER']);
	}





	
	public function delete($id)
	{
		$this->UserProfileModel->where('user_id', $id)->join('users u', 'u.id = user_profile.user_id')->delete();
		$this->UserModel->where('id_ente', $this->session->get('user_data')['id'])->where('id', $id)->delete();
		$mm=$this->ParticipationModel->where('id_ente', $this->session->get('user_data')['id'])->where('id_user', $id)->find();
		if(!empty($mm)){
			foreach($mm as $kk=>$vv){
			$this->ParticipationModel->update($vv['id'],array('banned'=>'yes'));
			}
		}
		$ll=$this->CartModel->where('id_ente', $this->session->get('user_data')['id'])->where('id_user', $id)->find();
		if(!empty($ll)){
			foreach($ll as $kk=>$vv){
			$this->CartModel->update($vv['id'],array('banned'=>'yes'));
			}
		}
		return redirect()->to($_SERVER['HTTP_REFERER']);
	}

	public function listBuys($id)
	{
		$participation = $this->CartItemsModel	
												->join('corsi', 'corsi.id = cart_items.item_id','left')
												->join('corsi_modulo cm', 'cm.id = cart_items.item_id','left')
												->join('cart', 'cart.id = cart_items.id_cart', 'left')
												->where('cart.status', 'COMPLETED')
												->where('cart.id_user', $id)
												->orderBy('cart.date','desc')
												->select('cart_items.*, (CASE WHEN cart_items.item_type = "corsi" THEN corsi.sotto_titolo ELSE cm.sotto_titolo END) AS st, cart.date')
												->find();

		return json_encode($participation);
	}

	public function listEmails($id)
	{
		$emails = $this->NotifLogModel	
												->where('id_participant', $id)
												->find();

		return json_encode($emails);
	}
}
?>
