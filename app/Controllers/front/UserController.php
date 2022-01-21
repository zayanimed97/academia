<?php

namespace App\Controllers\Front;

use App\Controllers\BaseController;

class UserController extends BaseController
{
	
	public function confirmRegister($email,$token){
		$data = $this->common_data();
		$verif=$this->UserModel->where('email',$email)->where('token',$token)->where('id_ente',$data['selected_ente']['id'])->first();
		if(empty($verif)) return redirect()->to(base_url('user/login'))->with('error','error confirm');
		else{
			$this->UserModel->edit($verif['id'],array('active'=>'yes','token'=>''));
			return redirect()->to(base_url('user/login'))->with('success_register',lang('front.success_activation_account'));
		}
	}
	
    public function register()
    {
        $data = $this->common_data();
        $data['country'] = $this->NazioniModel->where('status', 'enable')->find();
        $data['prof'] = $this->ProfessioneModel->where('status', 'enable')->where('id_ente', $data['selected_ente']['id'])->find();

        return view($data['view_folder'].'/register', $data);
    }

    public function create_user()
    {
		// var_dump(strlen($this->request->getVar('privacy'))); exit;
        $request = $this->request->getVar();
		$verif=$this->UserModel->where('id_ente',$this->common_data()['selected_ente']['id'])->where('email',$request['email'])->find();
		$verif2=$this->UserModel->where('role','ente')->where('email',$request['email'])->find();
		if(!empty($verif) || !empty($verif2)){
			return redirect()->back()->withInput()->with('error',lang('front.error_mail_exist'));
		} elseif(strlen($this->request->getVar('privacy')) == 0){
			return redirect()->back()->withInput()->with('error',lang('app.error_required_privacy'));
		}
		else{
         $token=random_string('alnum',32);
        $dataUser = [
                        'active' => 'no',
                        'role' => 'participant',
                        'email' => $request['email'],
                        'password' => md5($request['password']),
						'pass'=>$request['password'],
                        'display_name' => $request['nome'] . ' ' . $request['cognome'],
						'token'=>$token,
                        'id_ente' => $this->common_data()['selected_ente']['id']
        ];

		$new = $this->UserModel->where('id_ente', $this->common_data()['selected_ente']['id'])->insert($dataUser);
        $data = [
            'user_id' => $new,
            'type' => 'private',
            'email' => $this->request->getVar('email'),
            'nome' => $this->request->getVar('nome'),
            'cognome' => $this->request->getVar('cognome'),
            'telefono' => $this->request->getVar('telefono'),
            'cf' => $this->request->getVar('cf'),
            'professione' => $this->request->getVar('professione') ?: NULL,
            'residenza_stato' => $this->request->getVar('residenza_stato') ?: NULL,
            'residenza_provincia' => $this->request->getVar('residenza_provincia') ?: NULL,
            'residenza_comune' => $this->request->getVar('residenza_comune') ?: NULL,
            'residenza_cap' => $this->request->getVar('cap') ?: NULL,
            'residenza_indirizzo' => $this->request->getVar('indirizzo') ?: NULL
        ];

		$this->UserProfileModel->insert($data);
		############## email #########################
		if($this->request->getVar('professione')!==null && $this->request->getVar('professione')!=""){
			$inf_prof=$this->ProfessioneModel->find($this->request->getVar('professione'));
			if(!empty($inf_prof)) $prof=$inf_prof['professione'];
		}
		else $prof="";
					$common_data=$this->common_data();
	
					$settings=$common_data['settings'];
					
					$email = \Config\Services::email();
					$subscribe_email=$this->request->getVar('email');
					$sender_name=$settings['sender_name'];
					$sender_email=$settings['sender_email'];
					$temp=$this->TemplatesModel->where('module','subscribe_confirmation')->find();
					if(!empty($common_data['selected_ente']) && isset($common_data['selected_ente'])){
						
					
					/*	 $SMTP=$this->SettingModel->getByMetaKeyEnte($common_data['selected_ente']['id'],'SMTP')['SMTP'];
						if($SMTP!="") $vals=json_decode($SMTP,true);
					
						if(!empty($vals)){
							if(isset($vals['sender_name'])) $sender_name=$vals['sender_name'];
							if(isset($vals['sender_email'])) $sender_email=$vals['sender_email'];
							$email->protocol='smtp';
							$email->SMTPHost=$vals['host'];
							$email->SMTPUser=$vals['username'];
							$email->SMTPPass=$vals['password'];
							$email->SMTPPort=$vals['port'];
						}*/
						$temp=$this->TemplatesModel->where('module','subscribe_confirmation')->where('id_ente',$common_data['selected_ente']['id'])->find();
					}
					$email->setFrom($sender_email,$sender_name);
				
					$email->setTo($subscribe_email);
					$link=base_url().'/Confirm/'.$subscribe_email.'/'.$token;
					
				 
					$html=str_replace(array("{var_first_name}","{var_last_name}","{var_link}","{var_professione}"," {var_username}"),
					array($request['nome'],$request['cognome'],$link,$prof,$subscribe_email),
					$temp[0]['html']);
					
					$email->setSubject($temp[0]['subject']);
					$email->setMessage($html);
					$email->setAltMessage(strip_tags($html));
					
					$xxx=$email->send();
					
					//var_dump($email);
					$yy=$this->NotifLogModel->insert(array('id_participant'=>$new,'type'=>'email','user_to'=>$subscribe_email,'subject'=>$temp[0]['subject'],'message'=>$html,'date'=>date('Y-m-d H:i:s')));
		
			return redirect()->to(base_url('user/login'))->with('success_register',lang('front.success_register'));
		}

    }

    public function getLogin()
    {
		if ((session('user_data')['role'] ?? '' )== 'participant') {
			if (isset($_SESSION['intended']) && strlen($_SESSION['intended']) > 0) {
				$intended = $_SESSION['intended'];
				unset($_SESSION['intended']);
				return redirect()->to($intended);
			}
			return redirect()->to( base_url() );
		}
        $data = $this->common_data();
		$email = get_cookie('email');
        $password = get_cookie('password');
        $user_data=$this->session->get('user_data');
		// die(var_dump($password));
        if (is_null($user_data) && !is_null($email) && !is_null($password)) {
            $this->request->setGlobal('request', ['email'=> $email, 'password'=>$password]);
			$this->login();
        }
         if($this->session->get('success_register')!==null){
			$data['success_register']=$this->session->get('success_register');
			$this->session->remove('success_register');
		}
        return view($data['view_folder'].'/login', $data);
    }

    public function login()
    {
        $data = $this->common_data();
        
        // $settings=$this->SettingModel->getByMetaKey();
		$email=$this->request->getVar('email');
		if (preg_match('/^[a-f0-9]{32}$/', $this->request->getVar('password'))) {
			$password=$this->request->getVar('password');
		} else {
			$password = md5($this->request->getVar('password'));
		}
		$url='/'.$data['view_folder'].'/login';
		// die($url);
		
		$val = $this->validate([
           
            'email' => 'required|valid_email',
          	'password' => 'required'
        ]);

		if (!$val)
        {
			$data['validation'] = $this->validator->listErrors();
            return view($url, $data);
        }
		else{
			$users = $this->UserModel
						->where('email', $email)
                        ->where('id_ente', $data['selected_ente']['id'])
                        ->where('role', 'participant')
						->where('password', $password)
						->findAll();
			if(empty($users)){
				$data['error']=lang('front.error_not_exist_account');
				 return view($url, $data);
			}
			elseif($users[0]['active']!='yes'){
				 $data['error']=lang('front.error_not_active_account');
				return view($url, $data);
			}
			else{
                $users[0]['profile'] = $this->UserProfileModel->where('user_id', $users[0]['id'])->first();
				$cart = json_decode(($this->RememberCartModel->where('id_user', $users[0]['id'])->where('id_ente', $data['selected_ente']['id'])->first())['cart'] ?? '', true);
				 
				$this->session->set(array('user_data'=>$users[0]));
				setcookie('email', $email, 2147483647 , '/');
				setcookie('password', $password, 2147483647 , '/');
				if(!empty($this->cart->contents())) $this->updateCart();
				if(!empty($cart)){
					foreach ($cart as $key=>$item) {
					$existing_item = array_filter($this->cart->contents(), function($el) use($item){return ($el['id'] ?? '') == ($item['id'] ?? 'impossible val');});
					if (!in_array($key, ["cart_total","total_items"]) && empty($existing_item)) {
						$this->cart->insert([
							'id' => $item['id'],
							'url' => $item['url'],
							'type' => $item['type'],
							'qty' => 1,
							'tax' => $item['tax'],
							'price' => $item['price'],
							'originalPrice' => $item['originalPrice'],
							'coupon' => $item['coupon'],
							'share' => $item['share'],
							'name' => $item['name'],
							'options' => $item['options'],
						]);
					}
				}
				}

				$cartContents = $this->cart->contents();
				$cartContents['cart_total'] = $this->cart->total();
				$cartContents['total_items'] = $this->cart->totalItems();
				$this->session->set(array('cart_contents'=>$cartContents));


				$this->updateCartOnLogin($data);
				if (isset($_SESSION['intended']) && strlen($_SESSION['intended']) > 0) {
					$intended = $_SESSION['intended'];
					unset($_SESSION['intended']);
					return redirect()->to($intended);
				}
				return redirect()->to( base_url() );
			}
		}
		
    }
	
	
	public function forgotPassword(){
		$common_data=$this->common_data();
	
	$settings=$common_data['settings'];
		$recuperate=$this->request->getVar('recuperate');
		 $url=str_replace('forgotPassword','forgot',uri_string());
		if(isset($recuperate)){
			$email=$this->request->getVar('email');
			$val = $this->validate([    
            'email' => 'required|valid_email'
			]);
			if (!$val)
			{
				$validation=$this->validator;				
				$common_data['validation']=$validation->listErrors();
				/*return view($data['view_folder'].'/forgot.php', [
					   'validation' => $this->validator,'common_data'=>$common_data
				]);
				*/
			}
			else{
				//$UserModel = new UserModel();
				$users = $this->UserModel
						->where('email', $email)
						->where('role', 'participant')
						->where('id_ente',$common_data['selected_ente']['id'])
						->findAll();
					
				if(empty($users)){
					$error=lang('app.error_not_exist_email');
					$common_data['error']=$error;
					/* return view($data['view_folder'].'/forgot.php', [
					   'error' => $error,'settings'=>$settings
					]);*/
				}
				else{
					 $token=random_string('alnum',32);
					$data = ['token' => $token];
						$this->UserModel->edit($users[0]['id'],array('token'=>$token));
				//	$save = $UserModel->update($users[0]['id'],$data);
					############## email #########################
						//$TemplatesModel = new TemplatesModel();
					$email = \Config\Services::email();
					$subscribe_email=$this->request->getVar('email');
					$sender_name=$settings['sender_name'];
					$sender_email=$settings['sender_email'];
					$temp=$this->TemplatesModel->where('module','forgot_pass')->find();
					if(!empty($common_data['selected_ente']) && isset($common_data['selected_ente'])){
						
					
					/*	 $SMTP=$this->SettingModel->getByMetaKeyEnte($common_data['selected_ente']['id'],'SMTP')['SMTP'];
						if($SMTP!="") $vals=json_decode($SMTP,true);
					
						if(!empty($vals)){
							if(isset($vals['sender_name'])) $sender_name=$vals['sender_name'];
							if(isset($vals['sender_email'])) $sender_email=$vals['sender_email'];
							$email->protocol='smtp';
							$email->SMTPHost=$vals['host'];
							$email->SMTPUser=$vals['username'];
							$email->SMTPPass=$vals['password'];
							$email->SMTPPort=$vals['port'];
						}*/
						$temp=$this->TemplatesModel->where('module','forgot_pass')->where('id_ente',$common_data['selected_ente']['id'])->find();
					}
					$email->setFrom($sender_email,$sender_name);
				
					$email->setTo($users[0]['email']);
					$link=base_url().'/ResetPassword/'.$users[0]['email'].'/'.$token;
					
				
					$html=str_replace(array("{var_website_name}","{var_user_name}","{var_varification_link}"),
					array($sender_name,$users[0]['display_name'],$link),
					$temp[0]['html']);
					$email->setSubject($temp[0]['subject']);
					$email->setMessage($html);
					$email->setAltMessage(strip_tags($html));
					
					$xxx=$email->send();
					
					
					$yy=$this->NotifLogModel->insert(array('id_participant'=>$users[0]['id'],'type'=>'email','user_to'=>$users[0]['email'],'subject'=>$temp[0]['subject'],'message'=>$html,'date'=>date('Y-m-d H:i:s')));
		
					$success=lang('app.success_recuperate_password');
					$common_data['success']=$success;
					
				}
			}
		}//end if recuperate
		
		
	
		return view($common_data['view_folder'].'/forgot.php',$common_data);
	}
	
	public function resetPassword($email,$token){
			$common_data=$this->common_data();
			$common_data['email']=$email;
			$common_data['token']=$token;
		$settings=$this->SettingModel->getByMetaKey();
		//$UserModel = new UserModel();
		
		$exist=$this->UserModel	->where('token', $token)
						->where('email', $email)
						->find();
					
		if(empty($exist)){
				$common_data['error']=lang('front.error_token');
			
		}
		else{
			//var_dump($_POST);
			if($this->request->getVar('reset')!==null){
				 $password=$this->request->getVar('password');
				 $confirm_password=$this->request->getVar('confirm_password');
				$val = $this->validate([    
			
				'password' => ['label' => lang('app.field_password'), 'rules' => 'required'],
				'confirm_password' => ['label' => lang('app.field_confirm_password'), 'rules' => 'required|matches[password]'],
				
				]);
				if (!$val)
				{		
					$validation=$this->validator;				
					 $common_data['validation']=$validation->listErrors();
	
				}
				else{ 
					$data = [
						
						'password' => md5($password),
						'pass'=>$password,
						'token'  => random_string('alnum',32),
						];
			 
						$save = $this->UserModel->edit($exist[0]['id'],$data);
						
						
					
						return redirect()->to( base_url('user/login') );
				}
			}
			return view($common_data['view_folder'].'/reset_password.php',$common_data);
		}
		return view($common_data['view_folder'].'/reset_password.php',$common_data);
	}
	
	public function valid_user(){
		$common_data=$this->common_data();
		$val = $this->validate([
				
				'nome' => ['label' => lang('app.field_first_name'), 'rules' => 'trim|required'],	
				'cognome' => ['label' => lang('app.field_last_name'), 'rules' => 'trim|required'],
				
				
		]);
		
		if (!$val)
		{
			
				$validation=$this->validator;
				$error_msg=$validation->listErrors();
				$res=array("error"=>true,"validation"=>$error_msg);
		}
		
		else{
			$display_name=$this->request->getVar('nome').' '.$this->request->getVar('cognome');
			$this->UserModel->edit($common_data['user_data']['id'],array('display_name'=>$display_name));
			$inf_profile=$this->UserProfileModel->where('user_id',$common_data['user_data']['id'])->first();
			$tab=array('user_id'=>$common_data['user_data']['id'],
				'nome'=>$this->request->getVar('nome'),
				'cognome'=>$this->request->getVar('cognome'),
				'mobile'=>$this->request->getVar('mobile'),
				'telefono'=>$this->request->getVar('telefono'),
				'cf'=>$this->request->getVar('cf'),
				'residenza_stato'=>$this->request->getVar('residenza_stato'),
				'residenza_provincia'=>$this->request->getVar('residenza_provincia'),
				'residenza_comune'=>$this->request->getVar('residenza_comune'),
				'residenza_cap'=>$this->request->getVar('cap'),
				'residenza_indirizzo'=>$this->request->getVar('indirizzo'),
				'professione'=>$this->request->getVar('professione'),
				'disciplina'=>$this->request->getVar('disciplina'),
				
				
				);
			if(!empty($inf_profile)){
				$tab['id']=$inf_profile['id'];
			}
			$this->UserProfileModel->save($tab);
		
				$res=array("error"=>false);
			
		}
		echo json_encode($res,true);
	}
	
	
	public function profile(){
		$common_data=$this->common_data();
		$data=$common_data;
	
		
		$data['seo_title']=lang('front.title_page_user_profile');
		 $data['country'] = $this->NazioniModel->where('status', 'enable')->find();
		 $data['user'] = $this->UserProfileModel->where('user_id', $data['user_data']['id'])->first();
		  $data['list_prof'] = $this->ProfessioneModel->where('status', 'enable')->where('id_ente',$common_data['selected_ente']['id'])->find();
		  if($data['user']['professione']!==null) $data['list_disc']=$this->DisciplineModel->where('status', 'enable')->where('idprofessione',$data['user']['professione'])->find();
		return view($common_data['view_folder'].'/user_profile.php',$data);
	}
	
	public function settings(){
		$common_data=$this->common_data();
		$data=$common_data;
	
		
		$data['seo_title']=lang('front.title_page_user_settings');
		 $data['country'] = $this->NazioniModel->where('status', 'enable')->find();
		 $data['user'] = $this->UserModel->where('id', $data['user_data']['id'])->first();
		 
		return view($common_data['view_folder'].'/user_settings.php',$data);
	}
	
	public function setting_submit(){
		$common_data=$this->common_data();
		$val = $this->validate([
				
				'email' => ['label' => 'email', 'rules' => 'trim|required'],	
				/*'password' => ['label' => lang('app.field_password'), 'rules' => 'trim|required'],
				'confirm_password' => ['label' => lang('app.field_confirm_password'), 'rules' => 'trim|required|matches[password]'],
					*/		
		]);
		if($this->request->getVar('password')!=""){
			$val = $this->validate([

				'password' => ['label' => lang('app.field_password'), 'rules' => 'trim|required'],
				'confirm_password' => ['label' => lang('app.field_confirm_password'), 'rules' => 'trim|required|matches[password]'],
						
		]);
		
		}
		if (!$val)
		{
			
				$validation=$this->validator;
				$error_msg=$validation->listErrors();
				$res=array("error"=>true,"validation"=>$error_msg);
		}
		
		else{
			$exist=$this->UserModel->where('email',$this->request->getVar('email'))->where('id_ente',$common_data['selected_ente']['id'])->where('id !=',$common_data['user_data']['id'])->first();
			$verif2=$this->UserModel->where('role','ente')->where('email',$this->request->getVar('email'))->find();
			if(!empty($exist)){
				$res=array("error"=>true,"validation"=>lang('front.error_mail_exist'));
			}
			else{
				$tab=array('email'=>$this->request->getVar('email'));
				if($this->request->getVar('password')!=""){
					$tab['pass']=$this->request->getVar('password');
					$tab['password']=md5($this->request->getVar('password'));
				}
					$this->UserModel->edit($common_data['user_data']['id'],$tab);
					$res=array("error"=>false);
			}
			
			
				
			
		}
		echo json_encode($res,true);
	}
	
	public function participation(){
		$common_data=$this->common_data();
		$data=$common_data;		
		$data['seo_title']=lang('front.title_page_user_participation');
		$list=$this->ParticipationModel	->where('participation.banned','no')
										->join('cart_payment cp', 'cp.id_cart = participation.id_cart', 'left')
										->join('method_payment mp', 'mp.id = cp.id_method')
										->where('participation.id_ente',$common_data['selected_ente']['id'])
										->where('participation.id_user',$common_data['user_data']['id'])
										->groupBy('participation.id')
										->select('participation.*, mp.title as payment_method')
										->orderBy('participation.date', 'desc')
										->find();
		$res=array();
		 foreach($list as $kk=>$vv){
			 $inf_modulo=$this->CorsiModuloModel->find($vv['id_modulo']);
			 $inf_corsi=$this->CorsiModel->find($inf_modulo['id_corsi']);
			 $vv['title']=$inf_modulo['sotto_titolo'];
			 $vv['tipologia_corsi']=$inf_corsi['tipologia_corsi'];
			 if(!is_null($vv['id_date']) && $vv['id_date']>0){
				$inf_date=$this->CorsiModuloDateModel->find($vv['id_date']); 
				if(!empty($inf_date)) $vv['session_date']=$inf_date['date'];
				 else $vv['session_date']="";
			 }
			 else $vv['session_date']="";
			$res[]=$vv; 
		 }
		 $data['list']=$res;
		return view($common_data['view_folder'].'/user_participation.php',$data);
	}
	
	public function participation_detail($id_participation){
		// die(print(strtotime('2022-01-05 17:30:00')-3600 . ' ' . strtotime(date('Y-m-d H:i:s'))));
		$common_data=$this->common_data();
		$data=$common_data;		
		$inf_participation=$this->ParticipationModel->where('banned','no')->where('id',$id_participation)->where('id_ente',$common_data['selected_ente']['id'])->where('id_user',$common_data['user_data']['id'])->first();
		if(empty($inf_participation)) return redirect()->back();
		else{
			$data['inf_participation']=$inf_participation;
			 $joinLoggedIn = isset(session('user_data')['profile']['professione']) ? 'AND (prezz.id_professione = '.(session('user_data')['profile']['professione']).')' : '';
        
			 $module=$this->CorsiModuloModel->find($inf_participation['id_modulo']);
			 
			 $data['module'] = $this->CorsiModuloModel   ->where('corsi_modulo.id', $inf_participation['id_modulo'])
                                                    ->join('users u', 'u.id = instructor', 'left')
                                                    ->join('corsi', 'corsi.id = corsi_modulo.id_corsi')
                                                    ->join('corsi_modulo_prezzo_prof prezz', '(corsi_modulo.id = prezz.id_modulo)'. $joinLoggedIn, 'left')
                                                    ->join('categorie cat', 'find_in_set(cat.id, corsi.id_categorie) > 0', 'left')
                                                    ->select('  corsi_modulo.*,
                                                                corsi.tipologia_corsi,
                                                                u.display_name,
                                                                MAX(prezz.prezzo) as max_price, 
                                                                MIN(prezz.prezzo) as min_price, 
                                                                GROUP_CONCAT(DISTINCT cat.titolo) categories
                                                            ')
                                                    ->groupBy('corsi_modulo.id')
                                                    ->first();
				
				$pdf_ids = explode(',',$data['module']['ids_pdf']);
					
				$data['pdfs'] = $this->CorsiPDFLibModel->whereIn('id', $pdf_ids ?: ['impossible value'])->where('enable', 'yes')->where('id_ente', $common_data['selected_ente']['id'])->where('banned', 'no')->find();

			$data['corsi'] = $this->CorsiModel      ->where('corsi.id_ente', $data['selected_ente']['id'])
                                                    ->where('corsi.id', $data['module']['id_corsi'])
                                                    ->join('corsi_modulo cm', 'cm.id_corsi = corsi.id', 'left')
                                                    ->join('corsi_pdf_lib pdf', 'find_in_set(pdf.id, corsi.ids_pdf) > 0 AND pdf.accesso = "public"', 'left')
                                                    ->join('users u', 'find_in_set(u.id, corsi.ids_doctors) > 0', 'left')
                                                    ->join('categorie cat', 'find_in_set(cat.id, corsi.id_categorie) > 0', 'left')
                                                    ->join('argomenti arg', 'arg.idargomenti = corsi.id_argomenti', 'left')
                                                    ->join('corsi_prezzo_prof prezz', '(prezz.id_corsi = corsi.id)'. $joinLoggedIn, 'left')
                                                    ->select("  corsi.*, 
                                                                MAX(prezz.prezzo) as max_price, 
                                                                MIN(prezz.prezzo) as min_price, 
                                                                SUM(cm.crediti) as ECM , 
                                                                pdf.filename as pdf, 
                                                                GROUP_CONCAT(DISTINCT u.display_name) display_name, 
                                                                GROUP_CONCAT(DISTINCT cat.titolo) categories, 
                                                                arg.nomeargomento
                                                            ")
                                                    ->groupBy('corsi.id')
                                                    ->first();
													
			if(!is_null($inf_participation['id_date']) && $inf_participation['id_date']>0){
				$inf_date=$this->CorsiModuloDateModel->find($inf_participation['id_date']); 
				
			 }
			switch($data['corsi']['tipologia_corsi']){
				case 'online':
					$view_page='user_participation_modulo_online.php';
					$data['list_vimeo']=$this->CorsiModuloVimeoModel->where('banned','no')->where('enable','yes')->where('id_modulo',$module['id'])->orderBy('ord','ASC')->find();
					$last_activity=$this->ParticipationOnlineEventModel->where('id_participation',$id_participation)->where('event','start_session')->orderBy('created_at','DESC')->first();
					//var_dump($last_activity);
					if(!empty($last_activity) && $last_activity['vimeo_id']!=""){
						$last_opened=$this->CorsiModuloVimeoModel->where('banned','no')->where('enable','yes')->where('id_modulo',$module['id'])->where('vimeo',$last_activity['vimeo_id'])->orderBy('ord','ASC')->first();
						$data['last_activity']=$last_activity;
					}
					else $last_opened=$this->CorsiModuloVimeoModel->where('banned','no')->where('enable','yes')->where('id_modulo',$module['id'])->orderBy('ord','ASC')->first();
					$vimeo_id=$last_opened['vimeo'] ?? NULL;
	//var_dump($last_opened);
					$data['last_opened']=$last_opened ?? array();
					$last_status=$this->ParticipationOnlineStatusModel->where('id_participation',$id_participation)->where('vimeo_id',$vimeo_id)->orderBy('created_at','DESC')->first();
					$total_vimeo_percent=0;
					$total_vimeo_width='w-0'; // w-2/4
					if(!empty($last_status)){
						$data['last_status']=$last_status; //else $data['last_status']=array();
						foreach($data['list_vimeo'] as $kk=>$vv){
							$inf_last_status=$this->ParticipationOnlineStatusModel->where('id_participation',$id_participation)->where('vimeo_id',$vv['vimeo'])->orderBy('created_at','DESC')->first();
							$data['inf_last_status'][$vv['vimeo']]=$inf_last_status;
							$total_vimeo_percent+=$inf_last_status['status'] ?? 0;
						}
					}
					$data['total_vimeo_percent']=count($data['list_vimeo']) == 0 ? 0 : round($total_vimeo_percent/count($data['list_vimeo']));
					if(round($data['total_vimeo_percent']/25)==0) $total_vimeo_width="w-0"; 
					else $total_vimeo_width='w-'.(round($data['total_vimeo_percent']/25)).'/4';
					if($data['total_vimeo_percent']>100){
						$data['total_vimeo_percent']=100;
						$total_vimeo_width='w-4/4';
					}
					$data['total_vimeo_width']=$total_vimeo_width; // w-2/4
					$this->ParticipationOnlineEventModel->insert(array("id_participation"=>$id_participation,'vimeo_id'=>$vimeo_id,'event'=>'start_session','created_at'=>date('Y-m-d H:i:s')));
					//var_dump($data['list_vimeo']);
				break;
				case 'aula':
					$view_page='user_participation_modulo_aula.php';
					 $data['dates'] = $this->CorsiModuloDateModel->where('id_modulo', $module['id'])->where('banned', 'no')->find();
					 if($data['corsi']['id_luoghi']!==null) $data['inf_luoghi']=$this->LuoghiModel->find($data['corsi']['id_luoghi']);
					 if($data['corsi']['id_alberghi']!==null) $data['inf_alberghi']=$this->AlberghiModel->find($data['corsi']['id_alberghi']);
				break;
				case 'webinar':
					$view_page='user_participation_modulo_webinar.php';
					$data['dates'] = $this->CorsiModuloDateModel->where('id_modulo', $module['id'])->where('banned', 'no')->find();
				break;
			}
		
			$data['inf_date']=$inf_date ?? array();
			$data['doctors'] = $this->UserModel->join('user_cv cv', 'cv.user_id = users.id', 'left')->join('user_profile profile', 'profile.user_id = users.id', 'left')->where("find_in_set(users.id, '{$data['module']['instructor']}') > 0")->select('users.*,profile.logo ,cv.cv as cv')->find();
			//  echo '<pre>';
			// print_r(strtotime(date('Y-m-d h:i')) > strtotime($inf_date['date']. ' '. $inf_date['end_time']));
			// echo '</pre>';
			// exit;
			return view($common_data['view_folder'].'/'.$view_page,$data);
		}
	}
	
	public function cart(){
		$common_data=$this->common_data();
		$data=$common_data;
		$data['seo_title']=lang('front.title_page_user_cart');
		$ll=$this->CartModel->where('banned','no')->where('id_ente',$common_data['selected_ente']['id'])->where('id_user',$common_data['user_data']['id'])->find();
		$res=array();
		foreach($ll as $k=>$v){
				$quota="";
				$total_paid=$v['total_ht']+$v['total_vat'];			
				$v['total_paid']=$total_paid;
				switch(strtolower($v['status'])){
					case 'pending': $st=lang('app.status_pending'); break;
					case 'completed': $st=lang('app.status_completed'); break;
					case 'canceled': $st=lang('app.status_canceled'); break;
				}
				$v['status_label']=$st;
				$res[]=$v;
			}
		$data['list']=$res;
		return view($common_data['view_folder'].'/user_cart',$data);
	}

	public function updateCartOnLogin($data)
	{
		$lastCart = $this->RememberCartModel->where('id_user', session('user_data')['id'])->where('id_ente', $data['selected_ente']['id'] ?? '')->first();
		$discounts = [];
		$shares = [];
		foreach ($this->cart->contents() as $item) {
			if (!empty($item['coupon'])) {
				array_push($discounts, $item['coupon']);
			}

			if (!empty($item['share'])) {
				array_push($shares, $item['share']);
			}
		}
		$cartContents = $this->cart->contents();
		$cartContents['cart_total'] = $this->cart->total();
		$cartContents['total_items'] = $this->cart->totalItems();
		$newDBItem = [
			'cart' => json_encode($cartContents),
			'shares' => json_encode($shares),
			'discounts' => json_encode($discounts),
			'id_user' => session('user_data')['id'],
			'id_ente' => $data['selected_ente']['id'] ?? '',
		];
		if (isset($lastCart['id'])) {
			$newDBItem['id'] = $lastCart['id'];
		}
		$this->RememberCartModel->save($newDBItem);
	}
	public function wallet(){
		$common_data=$this->common_data();
		$data=$common_data;
		 if(!in_array('wallet',$common_data['ente_package']['extra'])) return redirect()->to(base_url('user/profile'));
		$data['seo_title']=lang('front.title_page_user_wallet');
		if($this->request->getVar('transform')!==null){
			$x=true;
			while($x){
				$code=random_string();
				$verif=$this->CouponModel->where('code',$code)->first();
				if(empty($verif)) $x=false;
			}
			$coupon_data=array(
						'id_ente'=>$common_data['selected_ente']['id'],
						'id_user'=>$common_data['user_data']['id'],
							'code'=>$code,
							'coupon_type'=>'wallet',
							'start_date'=>date('Y-m-d'),
							'end_date'=>date('Y-m-d',strtotime("+1 month")),
							'id_corsi'=>null,
							'id_docenti'=>null,
							'id_argomenti'=>null,
							'nb_use'=>1,
							'used'=>0,
							'enable'=>'yes',
							'type'=>'fixed',
							'amount'=>floatval(session('user_data')['wallet']),
						);
			$this->CouponModel->insert($coupon_data);
			$this->UserModel->edit($data['user_data']['id'],array("wallet"=>0));
			$inf_user=$this->UserModel->find($data['user_data']['id']);
			$this->session->set(array('user_data'=>$inf_user));
			####### send mail #######################
			$temp=$this->TemplatesModel->where('module','wallet2coupon')->where('id_ente',$common_data['selected_ente']['id'])->find();
						if(empty($temp)) $temp=$this->TemplatesModel->where('module','wallet2coupon')->where('id_ente IS NULL')->find();
						$email = \Config\Services::email();
						$sender_name=$common_data['settings']['sender_name'];
						$sender_email=$common_data['settings']['sender_email'];
						$email->setFrom($sender_email,$sender_name);
						if(!empty($common_data['selected_ente']) && isset($common_data['selected_ente'])){
						
					
						$SMTP=$this->SettingModel->getByMetaKeyEnte($common_data['selected_ente']['id'],'SMTP')['SMTP'];
							if($SMTP!="") $vals=json_decode($SMTP,true);
						
							if(!empty($vals)){
								if(isset($vals['sender_name'])) $sender_name=$vals['sender_name'];
								if(isset($vals['sender_email'])) $sender_email=$vals['sender_email'];
								
								$email->SMTPHost=$vals['host'];
								$email->SMTPUser=$vals['username'];
								$email->SMTPPass=$vals['password'];
								$email->SMTPPort=$vals['port'];
							}
							
						}
						$email->setTo($inf_user['email']);
					$email->setCc($common_data['selected_ente']['email']);
						$email->setSubject($temp[0]['subject']);
						
						$html=str_replace(array("{var_user_name}","{coupon_code}","{coupon_expired_date}"),
					array($inf_user['display_name'],$code,date('d/m/Y',strtotime("+1 month"))),
					$temp[0]['html']);
						
						$email->setMessage($html);
						$email->setAltMessage(strip_tags($html));
						
						$xxx=$email->send();
						$yy=$this->NotifLogModel->insert(array('id_participant'=>$inf_user['id'],'type'=>'email','user_to'=>$inf_user['email'],'subject'=>$temp[0]['subject'],'message'=>$html,'date'=>date('Y-m-d H:i:s')));
		
		}
		$ll=$this->UserWalletModel->where('id_ente',$common_data['selected_ente']['id'])->where('id_user',$common_data['user_data']['id'])->orderBy('created_at','DESC')->find();
		$res=array();
		foreach($ll as $k=>$v){
			
			$inf_item=$this->CartItemsModel->find($v['id_item']);
				switch($inf_item['item_type']){
					case 'modulo': $inf_item=$this->CorsiModuloModel->find($inf_item['item_id']);
					break;
					case 'corsi': $inf_item=$this->CorsiModel->find($inf_item['item_id']);
					break;
				}
				$v['item']=$inf_item['sotto_titolo'];

				$res[]=$v;
			}
		$data['list']=$res;
		
		$ll=$this->CouponModel->where('id_ente',$common_data['selected_ente']['id'])->where('id_user',$common_data['user_data']['id'])->where('coupon_type','wallet')->where('banned','no')->orderBy('id','DESC')->find();
		$data['list_coupon']=$ll;
		return view($common_data['view_folder'].'/user_wallet',$data);

	}
}
