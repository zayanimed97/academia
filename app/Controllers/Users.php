<?php namespace App\Controllers;

class Users extends BaseController
{

	
	
	public function index()
	{ 	
		$settings=$this->SettingModel->getByMetaKey();
		$user_data=$this->session->get('user_data');
		// if($user_data['role'] ?? ''=='A') return redirect()->to( base_url('/admin/dashboard') );
		return view('admin/login.php',array('settings'=>$settings));
	}
	
	public function logout()
	{	$redirect=base_url();
		$user_data=$this->session->get('user_data');
		switch($user_data['role'] ?? ''){
			case 'admin': $redirect=base_url('superadmin/login');break;
			case 'ente': $redirect=base_url('admin/login');break;
			default:$redirect=base_url();
		}
		
		$this->session->destroy();
		return redirect()->to( $redirect );
	}
	
	
	public function loginas_back($role){ 
		$common_data=$this->common_data();
		$data=$common_data;
		//var_dump($this->session->get('user_loginas'));
		$this->session->set(array('user_data'=>$this->session->get('user_loginas')));
	//	var_dump($this->session->get('user_data'));
		$this->session->remove('user_loginas');
		switch($role){
			case 'admin': $redirect=base_url('admin/dashboard'); break;
			case 'vendor': $redirect=base_url('vendor/dashboard'); break;
			default:$redirect=base_url('login'); 
		}
		return redirect()->to( $redirect );
	}
	
	public function login(){
		$settings=$this->SettingModel->getByMetaKey();
		$email=$this->request->getVar('email');
		$password=$this->request->getVar('password');
		$url=uri_string();
		
		if($this->request->getVar('email')!==null){
		$val = $this->validate([
           
            'email' => 'required|valid_email',
          	'password' => 'required'
        ]);
		//var_dump($this->validator->listErrors());
		if (!$val)
        {
			
            return view($url, [
                   'validation' => $this->validator,'settings'=>$settings
            ]);
		
        }
		else{
		//	$UserModel = new UserModel();
			$users = $this->UserModel
						->where('email', $email)
						->where('password', md5($password))
						->findAll();
			 $url=uri_string();
			if(empty($users)){
				$error=lang('app.error_not_exist_account');
				 return view($url, [
                   'error' => $error,'settings'=>$settings
				]);
			}
			elseif($users[0]['active']!='yes'){
				 $error=lang('app.error_not_active_account');
				/*switch($users[0]['role']){
					case 'admin':$redirect_url='admin/login'; break;
					default:$redirect_url='login';
				}*/
				return view($url, ['error' => $error,'settings'=>$settings]);
			/*	if($redirect_url==$url){
					return view($url, ['error' => $error]);
				}
				else return redirect()->to( base_url($redirect_url) );
			*/
			}
			// elseif($users[0]['first_log']!='yes' && $users[0]['role']!='ente'){
			// 	$error=lang('app.error_not_reset_password_first_time');
			// 	return view($url, ['error' => $error,'settings'=>$settings]);
			// }
			else{


				if($users[0]['role']=='ente'){
					$inf_package=$this->EntePackageModel->where('id_ente',$users[0]['id'])->orderBy('expired_date','DESC')->first();
					$det=json_decode($inf_package['package'] ?? '[]',true);
					$users[0]['ente_package']=array("expired_date"=>$inf_package['expired_date'],"type_cours"=>$det['type_cours'] ?? '',"extra"=>$det['extra'] ?? '');
				}


				$this->session->set(array('user_data'=>$users[0]));
				switch($users[0]['role']){
					case 'ente':$redirect_url='admin/dashboard'; break;				
					case 'admin':$redirect_url='superadmin/dashboard'; break;									
					default:$redirect_url='user/dashboard';
				}
				//var_dump($users[0]);
				return redirect()->to( base_url($redirect_url) );
			}
		//	var_dump($users);
		}
		}
		return view($url, ['settings'=>$settings]);
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
				
				return view($url, [
					   'validation' => $this->validator,'settings'=>$settings
				]);
			
			}
			else{
				//$UserModel = new UserModel();
				$users = $this->UserModel
						->where('email', $email)
						->findAll();
						
				if(empty($users)){
					$error=lang('app.error_not_exist_email');
					 return view($url, [
					   'error' => $error,'settings'=>$settings
					]);
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
						
					
						 $SMTP=$this->SettingModel->getByMetaKeyEnte($common_data['selected_ente']['id'],'SMTP')['SMTP'];
						if($SMTP!="") $vals=json_decode($SMTP,true);
					
						if(!empty($vals)){
							if(isset($vals['sender_name'])) $sender_name=$vals['sender_name']; else  $sender_name=$common_data['settings']['sender_name'];
					if(isset($vals['sender_email'])) $sender_email=$vals['sender_email']; else  $sender_email=$common_data['settings']['sender_email'];
							$email->protocol='smtp';
							$email->SMTPHost=$vals['host'];
							$email->SMTPUser=$vals['username'];
							$email->SMTPPass=$vals['password'];
							$email->SMTPPort=$vals['port'];
						}
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
					
					//var_dump($email);
					$yy=$this->NotifLogModel->insert(array('id_participant'=>$users[0]['id'],'type'=>'email','user_to'=>$users[0]['email'],'subject'=>$temp[0]['subject'],'message'=>$html,'date'=>date('Y-m-d H:i:s')));
		
					$success=lang('app.success_recuperate_password');
					
					
				}
			}
		}//end if recuperate
		
		
	
		return view('admin/forgot.php',$common_data);
	}
	
	public function resetPassword($email,$token){
		$settings=$this->SettingModel->getByMetaKey();
		//$UserModel = new UserModel();
		
		$exist=$this->UserModel	->where('token', $token)
						->where('email', $email)
						->find();
		if(empty($exist)){
			return view('admin/reset_error.php',array("settings"=>$settings));
		}
		else{
			
			if($this->request->getVar('reset')){
				 $password=$this->request->getVar('password');
				 $confirm_password=$this->request->getVar('confirm_password');
				$val = $this->validate([    
				'password' => 'required',
				'confirm_password' => 'required|matches[password]'
				]);
				if (!$val)
				{				
					return view('admin/reset_password.php', [
						   'validation' => $this->validator,'settings'=>$settings,"email"=>$email,"token"=>$token
					]);
				
				}
				else{ 
					$data = [
						'first_log'=>'yes',
						'password' => md5($password),
						'token'  => random_string('alnum',32),
						];
			 
						$save = $this->UserModel->edit($exist[0]['id'],$data);
						
						switch($exist[0]['role']){
							case 'A':$redirect_url='login'; break;
							
							default:$redirect_url='login';
						}
					
						return redirect()->to( base_url($redirect_url) );
				}
			}
			return view('admin/reset_password.php',array("settings"=>$settings,"email"=>$email,"token"=>$token));
		}
		
	}
	
	
		public function newpassword($email,$token){
		$common_data=$this->common_data();
		$data=$common_data;
		$settings=$this->SettingModel->getByMetaKey();
		//$UserModel = new UserModel();
		
		$exist=$this->UserModel	->where('token', $token)
						->where('email', $email)
						->find();
		if(empty($exist)){
			$data['error']=lang('app.error_access');
			return view('admin/reset_error.php',$data);
		}
		else{
			
			if($this->request->getVar('reset')){
				 $password=$this->request->getVar('password');
				 $confirm_password=$this->request->getVar('confirm_password');
				$val = $this->validate([    
				'password' => 'required',
				'confirm_password' => 'required|matches[password]'
				]);
				if (!$val)
				{				
					return view('admin/new_password.php', [
						   'validation' => $this->validator,'settings'=>$settings,"email"=>$email,"token"=>$token
					]);
				
				}
				else{ 
					$tab = [
						'first_log'=>'yes',
						'password' => md5($password),
						'token'  => random_string('alnum',32),
						];
			 
						$save = $this->UserModel->edit($exist[0]['id'],$tab);
						
						switch($exist[0]['role']){
							case 'A':$redirect_url='login'; break;
							
							default:$redirect_url='login';
						}
					
						return redirect()->to( base_url($redirect_url) );
				}
			}
			$data['token']=$token;
			$data['email']=$email;
			return view('admin/new_password.php',$data);
		}
		
	}
	
	
	public function verif_mail(){
		$email=$this->request->getVar('email');
		//$UserModel = new UserModel();
		$exist= $this->UserModel->where('email',$email)->find();
		if(empty($exist)){
			$output = array(
			   'success' => true
			  );

			  echo json_encode($output);
		} 
		else 	echo json_encode(array(
			   'success' => false
			  ));	
	}
	
	################## admin panel ##########################
	public function dashboard(){
		$common_data=$this->common_data();
		$data=$common_data;
		$user_data=$this->session->get('user_data');
		 if($user_data['role']!='A') { return redirect()->to( base_url() );}
		 
		 $data['nb_clients']=$this->UserModel->where('role','U')->countAllResults();
		  $data['nb_items_cars']=$this->ItemsModel->where('type','1')->where('banned','no')->countAllResults();
		   $data['nb_items_instrument']=$this->ItemsModel->where('type','2')->where('banned','no')->countAllResults();
		   $list=$this->UserModel->search('U',null,null,'yes');
			foreach($list as $kk=>$vv){
				$inf_profile=$this->UserProfileModel->where('user_id',$vv['id'])->first();
				
				$res[]=array("id"=>$vv['id'],"name"=>$inf_profile['nome'].' '.$inf_profile['cognome']);
			}
			$data['list_users']=$res;
			$res=array();
		$ll=$this->ItemsModel->where('enable','yes')->where('banned','no')->findAll();
		foreach($ll as $k=>$v){
			//for($i=1;$i<=$v['qty'];$i++)
				$res[$v['type']][]=array('id'=>$v['id'],'name'=>$v['name']);
		}
		$data['items']=$res;
	
		$res=array();
		$list=$this->BookingModel->where('banned','no')->findAll();
	//	var_dump($this->BookingStatus);
		foreach($list as $k=>$v){
			$inf_user=$this->UserModel->find($v['user_id']);
			$title=$inf_user['display_name'];
			$start=date('c',$v['checkin']);//*1000;
			$end=date('c',$v['checkout']);//*1000;
				
			$className=$this->BookingStatus[$v['status']]['bg'];
			//$res[$k]=$v;
			ob_start();
			$tt=array();
			foreach(explode(",",$v['items']) as $kk=>$vv){
				$tt[$vv]++;
			}
			foreach($tt as $kk=>$vv){?>
				 <div data-repeater-item class="row">
					<div  class="mb-3 col-lg-6">
						<label class="form-label" for="name"><?php echo lang('app.field_select_item')?></label>
					   <select  class="form-control" id="item" name="item">
					<?php foreach($data['items'] as $kkk=>$vvv){
								$nn=$this->ItemType[$kkk];
								if(!empty($data['items'][$kkk])){?>
							<optgroup label="<?php echo $nn?>">
							<?php foreach($vvv as $kkkk=>$vvvv){
								?>
								<option value="<?php echo $vvvv['id']?>" <?php if($vvvv['id']==$kk) echo 'selected'?>><?php echo $vvvv['name']?></option>
							<?php } ?>
							 </optgroup>
							<?php } 
					} ?>
				</select>
					</div>

					<div  class="mb-3 col-lg-2">
						<label class="form-label" for="email"><?php echo lang('app.field_qty')?></label>
						<input type="number" min="1" step="1" id="qty" name="qty" class="form-control" value="<?php echo $vv?>"/>
					</div>

				   
					
					<div class="col-lg-2 align-self-center d-grid">
						<input data-repeater-delete type="button" class="btn btn-danger btn-block" value="<?php echo lang('app.btn_delete')?>"/>
					</div>
				</div>
			<?php }
			$items_repeater=ob_get_clean();
			
			$res[]=array_merge($v,array('title'=>$title,'start'=>$start,'end'=>$end,'className'=>$className,'items_repeater'=>$items_repeater));
			
		}
		 $data['list_booking']=json_encode($res);
		 
		  $res=array();
		 $list_note=$this->BookingNoteModel->where('banned','no')->where('archived','no')->orderBy('created_at','DESC')->find();
		 foreach($list_note as $kk=>$vv){
			 $inf_user=$this->UserModel->find($vv['user_id']);
			 $done=0; 
			 if(!is_null($vv['opened'])) $done=1;
			
			if(date('d/m/Y',strtotime($vv['created_at']))==date('d/m/Y')) $date=lang('app.field_calendar_today').' '.date('H:i',strtotime($vv['created_at']));
			else $date=date('d/m/Y H:i',strtotime($vv['created_at']));
			 $res[]=array('id'=>$vv['id'],'text'=>$vv['note'],'done'=>$done,'id_booking'=>$vv['id_booking'],'date'=>$date);
		 }
		  $data['list_note']=json_encode($res);
		return view('admin/dashboard.php',$data);
	}
	public function profile(){
		
			$user_data=$this->session->get('user_data');
			 $action=$this->request->getVar('action');
			 $id_user=$user_data['id'];
			 if($user_data['role']!='A') { return redirect()->to( base_url() );}
			 $common_data=$this->common_data();
			$data=$common_data;
			if($action=='edit'){
				$val = $this->validate([				
				'display_name' => ['label' => lang('app.field_display_name'), 'rules' => 'trim|required'],	
				'email' => ['label' => lang('app.field_email'), 'rules' => 'trim|required|valid_email|is_unique[users.email,id,'.$id_user.']'],		
				]);
				
				if($this->request->getVar('password')!=""){
					$val = $this->validate([
						'repassword' => 'required|matches[password]'
					]);
				}
					if (!$val)
					{
							
							$validation=$this->validator;
							$data['error']=$validation->listErrors();
							
					}
					else{
						$display_name=$this->request->getVar('display_name');
						$email=$this->request->getVar('email');
						$repassword=$this->request->getVar('repassword');
						$password=$this->request->getVar('password');
						
							  $data = [
					 
								'display_name' => $display_name,
								'email'  => $email,
								];
					  if($this->request->getVar('password')!=""){  $data['password']=md5($password);}
								$save = $this->UserModel->edit($user_data['id'],$data);
								 $data['success']=lang('app.success_update');
					}
			}
			$profile_data = $this->UserModel->find($user_data['id']);
			
			
			$data['profile_data']=$profile_data;
			echo view('admin/profile.php',$data);
		
	}
	public function list_users(){
		$common_data=$this->common_data();
		$data=$common_data;
		$user_data=$this->session->get('user_data');
		if($user_data['role']!='A') return redirect()->to( base_url() );
		else { 
			$settings=$this->SettingModel->getByMetaKey();
			//$UserModel = new UserModel();
			
			if($this->request->getVar('action')!==null){
				
				switch($this->request->getVar('action')){
					case 'delete':
						$id=$this->request->getVar('id_to_delete');
						if($id!=""){
							$this->UserModel->edit($id,array('deleted_at'=>date('Y-m-d H:i:s')));
							$success=lang('app.success_delete');
						}
					break;
				}
			}
			
			$email=null;
			$display_name=null;
			$active=null;			
			$is_expired=null;
			if($this->request->getVar('search')!==null){
				if($this->request->getVar('search_email')!="") $email=$this->request->getVar('search_email');
				if($this->request->getVar('search_display_name')!="") $display_name=$this->request->getVar('search_display_name');
				if($this->request->getVar('search_active')!="") $active=$this->request->getVar('search_active');
				if($this->request->getVar('search_expiration')!="") $is_expired=$this->request->getVar('search_expiration');
			}
			$list=$this->UserModel->search('U',$display_name,$email,$active,$is_expired);
			foreach($list as $kk=>$vv){
				$inf_profile=$this->UserProfileModel->where('user_id',$vv['id'])->first();
				unset($inf_profile['id']);
				unset($inf_profile['email']);
				$res[]=array_merge($vv,$inf_profile);
			}
			$data['list']=$res;
			echo view('admin/clients_list.php',$data);

		}
	}	
	
	public function new_user(){
		$common_data=$this->common_data();
		$data=$common_data;
		$user_data=$this->session->get('user_data');
		if($user_data['role']!='A') return redirect()->to( base_url() );
		else { 
		if($this->request->getVar('submit')!=null){
			$val = $this->validate([				
				'nome' => ['label' => lang('app.field_first_name'), 'rules' => 'trim|required'],
				'cognome' => ['label' => lang('app.field_last_name'), 'rules' => 'trim|required'],	
				'mobile' => ['label' => lang('app.field_mobile'), 'rules' => 'trim|required'],					
				'email' => ['label' => lang('app.field_email'), 'rules' => 'trim|required|valid_email|is_unique[users.email]'],		
				]);
			$type=$this->request->getVar('type');
		/*	if($type=='private'){
				$val = $this->validate([				
				'cf' => ['label' => lang('app.field_cf'), 'rules' => 'trim|required'],
				
				]);
			}
			else{
				$val = $this->validate([				
				'company_name' => ['label' => lang('app.field_company_name'), 'rules' => 'trim|required'],
				'piva' => ['label' => lang('app.field_iva'), 'rules' => 'trim|required'],
				]);
			}*/
			if (!$val)
			{
					
					$validation=$this->validator;
					$data['error']=$validation->listErrors();
					return redirect()->back()->withInput()->with('error',$validation->listErrors());
			}
			else{
				$password=random_string('md5',10);
				if($type=='private')
					$display_name=$this->request->getVar('nome').' '.$this->request->getVar('cognome');
				else $display_name=$this->request->getVar('company_name');
				if($this->request->getVar('enable')!==null) $active='yes'; else $active='no';
				$token=random_string('alnum',32);
				$id=$this->UserModel->add('U',$this->request->getVar('email'),$password,$display_name,$active,$token,$user_data['id'],'no');
				$this->UserProfileModel->insert(array('user_id'=>$id,
				'nome'=>$this->request->getVar('nome'),
				'cognome'=>$this->request->getVar('cognome'),
				'mobile'=>$this->request->getVar('mobile'),
				'cf'=>$this->request->getVar('cf'),
				'residenza_stato'=>$this->request->getVar('residenza_stato'),
				'residenza_provincia'=>$this->request->getVar('residenza_provincia'),
				'residenza_comune'=>$this->request->getVar('residenza_comune'),
				'residenza_cap'=>$this->request->getVar('residenza_cap'),
				'residenza_indirizzo'=>$this->request->getVar('residenza_indirizzo'),
				'company_name'=>$this->request->getVar('company_name'),
				'piva'=>$this->request->getVar('piva'),
				'type'=>$this->request->getVar('type'),
				));
				
				$email = \Config\Services::email();
				$sender_name=$common_data['settings']['sender_name'];
				$sender_email=$common_data['settings']['sender_email'];
				$SMTP=$this->SettingModel->getByMetaKeyEnte($common_data['selected_ente']['id'],'SMTP')['SMTP'];
				if($SMTP!="") $vals=json_decode($SMTP,true);
			
				if(!empty($vals)){
					if(isset($vals['sender_name'])) $sender_name=$vals['sender_name']; else  $sender_name=$common_data['settings']['sender_name'];
					if(isset($vals['sender_email'])) $sender_email=$vals['sender_email']; else  $sender_email=$common_data['settings']['sender_email'];
					$email->setFrom($sender_email,$sender_name);
					$email->SMTPHost=$vals['host'];
					$email->SMTPUser=$vals['username'];
					$email->SMTPPass=$vals['password'];
					$email->SMTPPort=$vals['port'];
				}
				$email->setFrom($sender_email,$sender_name);
				
				$email->setTo($this->request->getVar('email'));
				$temp=$this->TemplatesModel->where('module','new_pass')->find();
				$link=base_url('newpassword/'.$this->request->getVar('email').'/'.$token);
				$html=str_replace(array("{var_user_name}","{link}"),
				array($display_name,$link),
				$temp[0]['html']);
				$email->setSubject($temp[0]['subject']);
				$email->setMessage($html);
				$email->setAltMessage(strip_tags($html));
				$email->send();
				
				$yy=$this->NotifLogModel->insert(array('id_participant'=>$id,'type'=>'email','user_to'=>$this->request->getVar('email'),'subject'=>$temp[0]['subject'],'message'=>$html,'date'=>date('Y-m-d H:i:s')));
		
				
				
				$data['success']=lang('app.success_add');
				
			}
			
			

		}
			$data['list_nazioni']=$this->NazioniModel->where('status','enable')->findAll();
			echo view('admin/clients_new.php',$data);
		}
	}
	
	public function edit_user($id){
		$common_data=$this->common_data();
		$data=$common_data;
		$user_data=$this->session->get('user_data');
		if($user_data['role']!='A') return redirect()->to( base_url() );
		else { 
		if($this->request->getVar('submit')!=null){
			$val = $this->validate([				
				'nome' => ['label' => lang('app.field_first_name'), 'rules' => 'trim|required'],
				'cognome' => ['label' => lang('app.field_last_name'), 'rules' => 'trim|required'],	
				'mobile' => ['label' => lang('app.field_mobile'), 'rules' => 'trim|required'],					
				'email' => ['label' => lang('app.field_email'), 'rules' => 'trim|required|valid_email|is_unique[users.email,id,'.$id.']'],		
				]);
			$type=$this->request->getVar('type');
			/*if($type=='private'){
				$val = $this->validate([				
				'cf' => ['label' => lang('app.field_cf'), 'rules' => 'trim|required'],
				
				]);
			}
			else{
				$val = $this->validate([				
				'company_name' => ['label' => lang('app.field_company_name'), 'rules' => 'trim|required'],
				'piva' => ['label' => lang('app.field_iva'), 'rules' => 'trim|required'],
				]);
			}*/
			if (!$val)
			{
					
					$validation=$this->validator;
					$data['error']=$validation->listErrors();
					return redirect()->back()->withInput()->with('error',$validation->listErrors());
			}
			else{
				
				if($type=='private')
					$display_name=$this->request->getVar('nome').' '.$this->request->getVar('cognome');
				else $display_name=$this->request->getVar('company_name');
				if($this->request->getVar('enable')!==null) $active='yes'; else $active='no';
				$idprofile=$this->UserProfileModel->where('user_id',$id)->first();
				$this->UserModel->edit($id,array('email'=>$this->request->getVar('email'),'display_name'=>$display_name,'active'=>$active));
				$this->UserProfileModel->update($idprofile['id'],array(
				'nome'=>$this->request->getVar('nome'),
				'cognome'=>$this->request->getVar('cognome'),
				'mobile'=>$this->request->getVar('mobile'),
				'cf'=>$this->request->getVar('cf'),
				'residenza_stato'=>$this->request->getVar('residenza_stato'),
				'residenza_provincia'=>$this->request->getVar('residenza_provincia'),
				'residenza_comune'=>$this->request->getVar('residenza_comune'),
				'residenza_cap'=>$this->request->getVar('residenza_cap'),
				'residenza_indirizzo'=>$this->request->getVar('residenza_indirizzo'),
				'company_name'=>$this->request->getVar('company_name'),
				'piva'=>$this->request->getVar('piva'),
				'type'=>$this->request->getVar('type'),
				));
				
			
				$data['success']=lang('app.success_add');
				
			}
			
			

		}
			$data['list_nazioni']=$this->NazioniModel->where('status','enable')->findAll();
			$data['inf_user']=$this->UserModel->find($id);
			$data['inf_profile']=$this->UserProfileModel->where('user_id',$id)->first();
			if($data['inf_profile']['residenza_stato']==106){
				$data['list_provincia']=$this->ProvinceModel->where('id_nazione',$data['inf_profile']['residenza_stato'])->findAll();
				$data['list_comuni']=$this->ComuniModel->where('id_prov',$data['inf_profile']['residenza_provincia'])->findAll();
			}
			else{
				$data['list_provincia']=array();
				$data['list_comuni']=array();
			}
			echo view('admin/clients_edit.php',$data);
		}
		
	}
	
	
	public function loginAs($id){
		$common_data=$this->common_data();
	
		$user_data=$this->session->get('user_data');
		
		  $url=previous_url(); 
			$id_admin=$user_data['id'];
			$this->session->set(array('login_as'=>$id_admin,'redirect_admin'=>$url));
			
			$users = $this->UserModel
						->where('id', $id)
						
						->findAll();
			
			if($users[0]['role']=='ente'){
					$inf_package=$this->EntePackageModel->where('id_ente',$users[0]['id'])->orderBy('expired_date','DESC')->first();
					$det=json_decode($inf_package['package'] ?? '[]',true);
					$users[0]['ente_package']=array("expired_date"=>$inf_package['expired_date'],"type_cours"=>$det['type_cours'] ?? '',"extra"=>$det['extra'] ?? '');
				}
				$users[0]['profile'] = $this->UserProfileModel->where('user_id', $users[0]['id'])->first();
				$this->session->set(array('user_data'=>$users[0]));
				switch($users[0]['role']){
					case 'ente':$redirect_url='admin/dashboard'; break;
					case 'participant':
					$inf_ente=$this->UserModel->find($user_data['id']);
					
					$redirect_url='https://'.$inf_ente['domain_ente'].'/user'; 
					$url='https://'.$inf_ente['domain_ente'].'/admin/dashboard'; 
					$this->session->set(array('redirect_admin'=>$url));
					break;
					default:$redirect_url='';
						
				}
				//var_dump($users[0]);
				return redirect()->to( base_url($redirect_url) );
			
		
	
	}
	
	
public function loginBack(){
		$common_data=$this->common_data();
		$id_admin=$this->session->get('login_as');
		$redirect_admin=$this->session->get('redirect_admin');
		if($redirect_admin=='') $redirect_admin=base_url('superadmin/');
		$this->session->remove('user_data');
	
			$users = $this->UserModel
						->where('id', $id_admin)
						
						->findAll();
	if($users[0]['role']=='ente'){
					$inf_package=$this->EntePackageModel->where('id_ente',$users[0]['id'])->orderBy('expired_date','DESC')->first();
					$det=json_decode($inf_package['package'] ?? '[]',true);
					$users[0]['ente_package']=array("expired_date"=>$inf_package['expired_date'],"type_cours"=>$det['type_cours'] ?? '',"extra"=>$det['extra'] ?? '');
				}
				$this->session->set(array('user_data'=>$users[0]));
				$this->session->remove('login_as');
				$this->session->remove('redirect_admin');
		if(	$users[0]['role']=='ente') 	return redirect()->to('https://'.$users[0]['domain_ente'].'/admin/dashboard');
		else return redirect()->to($redirect_admin );
	}
	
	//--------------------------------------------------------------------

}
?>
