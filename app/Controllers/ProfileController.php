<?php namespace App\Controllers;
use App\Libraries\Fattureincloud;
class ProfileController extends BaseController
{
	
	public function show($profile_menu='data')
	{ 	
		$user_data=$this->session->get('user_data');
	
		$common_data=$this->common_data();
		$data=$common_data;
	
		$user = $this->UserModel->join('user_profile up', 'up.user_id = users.id', 'left')->where('users.id', $user_data['id'])->select('users.*, up.*, users.email as user_email')->first();
		$nazioni = $this->NazioniModel->where('status', 'enable')->find();
		unset($user['password']);

		$data['user'] = $user;
		$data['nazioni'] = $nazioni;
		switch($profile_menu){
			case 'account':	
				$p='profile_account.php';
			break;
			case 'contact':	
				$data['contact_email']=$this->SettingModel->getByMetaKeyEnte($user_data['id'],'contact_email')['contact_email'] ?? '';
				$data['contact_telephone']=$this->SettingModel->getByMetaKeyEnte($user_data['id'],'contact_telephone')['contact_telephone'] ?? '';
				$p='profile_contact.php';
			break;
			case 'fattura':	
				$data['list_nazioni']=$this->NazioniModel->where('status','enable')->orderby("nazione",'asc')->findAll();
				if($user['residenza_stato']==106){
					$data['list_provincia']=$this->ProvinceModel->findAll();
					if($user['residenza_provincia']>0) $data['list_comuni']=$this->ComuniModel->where('id_prov',$user['residenza_provincia'])->findAll();
				}
				$data['fattura_incloud']=$this->SettingModel->getByMetaKeyEnte($user_data['id'],'fattura_incloud')['fattura_incloud'] ?? "";
				$p='profile_fattura.php';
			break;
			case 'payments':	
				$p='profile_payments.php';
				$data['list_method_payment']=$this->MethodPaymentModel->where('banned','no')->where('enable','yes')->find();
				$ll=$this->EnteMethodPaymentModel->where('banned','no')->where('enable','yes')->where('id_ente',$user_data['id'])->find();
				$res=array();
				foreach($ll as $kk=>$vv){
					$res[$vv['id_method']]=$vv;
				}
				$data['ente_payment']=$res;
				
			break;
			case 'contract':
				$p='profile_contract.php';
				$data['inf_package']=$this->EntePackageModel->where('id_ente',$user_data['id'])->orderBy('expired_date','DESC')->first();
			break;
			case 'mailing':
			$data['SMTP']=$this->SettingModel->getByMetaKeyEnte($user_data['id'],'SMTP')['SMTP'] ?? "";
			$data['email']=$this->SettingModel->getByMetaKeyEnte($user_data['id'],'email')['email'] ?? "";
			$p='profile_mailing.php';
			break;
			case 'settings':
			$data['facebook_id']=$this->SettingModel->getByMetaKeyEnte($user_data['id'],'facebook_id')['facebook_id'] ?? "";
			$data['facebook_discount']=$this->SettingModel->getByMetaKeyEnte($user_data['id'],'facebook_discount')['facebook_discount'] ?? "";
			$data['facebook_pixel']=$this->SettingModel->getByMetaKeyEnte($user_data['id'],'facebook_pixel')['facebook_pixel'] ?? "";
			$data['google_analytic']=$this->SettingModel->getByMetaKeyEnte($user_data['id'],'google_analytic')['google_analytic'] ?? "";
			$data['google_manager_ID']=$this->SettingModel->getByMetaKeyEnte($user_data['id'],'google_manager_ID')['google_manager_ID'] ?? "";
			$p='settings_general.php';
			break;
			default:$p='profile.php';
		}
		$data['profile_menu']=$profile_menu;
		return view('admin/'.$p,$data);
	}

	public function update()
	{
		$user_data=$this->session->get('user_data');
		
		switch($this->request->getVar('profile_menu')){
			case 'account':
				$val = $this->validate([
				//'email' => ['label' => lang('app.field_email'), 'rules' => 'trim|required|valid_email|is_unique[users.email,id,'.$user_data['id'].']'],	
				'password' => ['label' => lang('app.field_password'), 'rules' => 'trim|required'],	
				]);
				
				if (!$val)
				{
					
						$validation=$this->validator;
						$error_msg=$validation->listErrors();
						$res=array("error"=>true,"validation"=>$error_msg);
				}
				
				else{
				/*	$dataUser = [
						'email' => $this->request->getVar('email'),
					];
*/
					if ($this->request->getVar('password')) {
						$dataUser['password'] = md5($this->request->getVar('password'));
						$dataUser['pass']=$this->request->getVar('password');
					}		
					$this->UserModel->update( $this->session->get('user_data')['id'], $dataUser);
					$res=array("error"=>false);
				}
			break;
			case 'settings':
			if($this->request->getVar('profile_menu2')!==null){
				$id = $this->SettingModel->where('id_ente',$this->session->get('user_data')['id'])->where('meta_key', 'facebook_pixel')->find();
				
					if ($id) {
						$this->SettingModel->where('id_ente',$this->session->get('user_data')['id'])->where('meta_key', 'facebook_pixel')->set('meta_value', $this->request->getVar('facebook_pixel'))->update();
					} else {
						$this->SettingModel->insert(['meta_key'=>'facebook_pixel', 'meta_value'=>$this->request->getVar('facebook_pixel'), 'id_ente'=>$this->session->get('user_data')['id']]);
					}
					
				
					$id = $this->SettingModel->where('id_ente',$this->session->get('user_data')['id'])->where('meta_key', 'google_analytic')->find();
					if ($id) {
						$this->SettingModel->where('id_ente',$this->session->get('user_data')['id'])->where('meta_key', 'google_analytic')->set('meta_value', $this->request->getVar('google_analytic'))->update();
					} else {
						$this->SettingModel->insert(['meta_key'=>'google_analytic', 'meta_value'=>$this->request->getVar('google_analytic'), 'id_ente'=>$this->session->get('user_data')['id']]);
					}
					
					$id = $this->SettingModel->where('id_ente',$this->session->get('user_data')['id'])->where('meta_key', 'google_manager_ID')->find();
					if ($id) {
						$this->SettingModel->where('id_ente',$this->session->get('user_data')['id'])->where('meta_key', 'google_manager_ID')->set('meta_value', $this->request->getVar('google_manager_ID'))->update();
					} else {
						$this->SettingModel->insert(['meta_key'=>'google_manager_ID', 'meta_value'=>$this->request->getVar('google_manager_ID'), 'id_ente'=>$this->session->get('user_data')['id']]);
					}
						$res=array("error"=>false);
			}
			else{
				$val = $this->validate([
					'id' => ['label' => 'APP ID', 'rules' => 'trim|required'],	
					'discount' => ['label' => 'APP ID', 'rules' => 'numeric|greater_than[0]|required'],	
				]);
				
				if (!$val)
				{
					
						$validation=$this->validator;
						$error_msg=$validation->listErrors();
						$res=array("error"=>true,"validation"=>$error_msg);
				}
				
				else{
					$dataUser = [
						'id' => $this->request->getVar('id'),
						'discount' => $this->request->getVar('discount'),
					];	
					$discount = $this->SettingModel->where('id_ente',$this->session->get('user_data')['id'])->where('meta_key', 'facebook_discount')->find();
					$id = $this->SettingModel->where('id_ente',$this->session->get('user_data')['id'])->where('meta_key', 'facebook_id')->find();
					if ($discount) {
						$this->SettingModel->where('id_ente',$this->session->get('user_data')['id'])->where('meta_key', 'facebook_discount')->set('meta_value', $this->request->getVar('discount'))->update();
					} else {
						$this->SettingModel->insert(['meta_key'=>'facebook_discount', 'meta_value'=>$this->request->getVar('discount'), 'id_ente'=>$this->session->get('user_data')['id']]);
					}
					if ($id) {
						$this->SettingModel->where('id_ente',$this->session->get('user_data')['id'])->where('meta_key', 'facebook_id')->set('meta_value', $this->request->getVar('id'))->update();
					} else {
						$this->SettingModel->insert(['meta_key'=>'facebook_id', 'meta_value'=>$this->request->getVar('id'), 'id_ente'=>$this->session->get('user_data')['id']]);
					}
					$res=array("error"=>false);
				}
			}
			break;
			case 'contact':	
				$p='profile_contact.php';
				$settings_emails=array();
				$settings_phones=array();
				//var_dump($_POST);
				if($this->request->getVar('mail')!==null){
					$tab=array();
					foreach($this->request->getVar('mail') as $kk=>$vv){
						
							$tab[]=$vv;
						
					}
					
					//var_dump($tab);
					$id=$this->SettingModel->where('id_ente', $this->session->get('user_data')['id'])->where('meta_key', 'contact_email')->first();
					if($id==null) $this->SettingModel->insert(array('id_ente'=>$this->session->get('user_data')['id'],'meta_key'=>'contact_email','meta_value'=>json_encode($tab,true)));
					else{
						$settings_emails = [
								"meta_value" => json_encode($tab,true)
							];
						$this->SettingModel->where('id_ente', $this->session->get('user_data')['id'])->where('meta_key', 'contact_email')->set($settings_emails)->update();
					}
				/*	$id=$this->SettingModel->where('id_ente', $this->session->get('user_data')['id'])->where('meta_key', 'contact_email')->first();
					if($id==null) $this->SettingModel->insert(array('id_ente'=>$this->session->get('user_data')['id'],'meta_key'=>'contact_email','meta_value'=>implode(',,,',array_map( function ($el){return $el['email_contact'];}, $this->request->getVar('mail')))));
					else{
						$settings_emails = [
								"meta_value" => implode(',,,',array_map( function ($el){return $el['email_contact'];}, $this->request->getVar('mail')))
							];
						$this->SettingModel->where('id_ente', $this->session->get('user_data')['id'])->where('meta_key', 'contact_email')->set($settings_emails)->update();
					}*/
				}

				else $this->SettingModel->updateByMetaKey('contact_email','',$this->session->get('user_data')['id']);
				if($this->request->getVar('phone')!==null){
					
					$tab=array();
					foreach($this->request->getVar('phone') as $kk=>$vv){
						
							$tab[]=$vv;
						
					}
					
					
						$id=$this->SettingModel->where('id_ente', $this->session->get('user_data')['id'])->where('meta_key', 'contact_telephone')->first();
				if($id==null) $this->SettingModel->insert(array('id_ente'=>$this->session->get('user_data')['id'],'meta_key'=>'contact_telephone','meta_value'=>json_encode($tab,true)));
					else{
						$settings_emails = [
								"meta_value" => json_encode($tab,true)
							];
						$this->SettingModel->where('id_ente', $this->session->get('user_data')['id'])->where('meta_key', 'contact_telephone')->set($settings_emails)->update();
					}
				/*	if($id==null) $this->SettingModel->insert(array('id_ente'=>$this->session->get('user_data')['id'],'meta_key'=>'contact_telephone','meta_value'=>implode(',,,',array_map( function ($el){return $el['phone_contact'];}, $this->request->getVar('phone')))));
					else{
					$settings_phones = [
								"meta_value" => implode(',,,',array_map( function ($el){return $el['phone_contact'];}, $this->request->getVar('phone'))) 
							];
						$this->SettingModel->where('id_ente', $this->session->get('user_data')['id'])->where('meta_key', 'contact_telephone')->set($settings_phones)->update();
					}*/
				}
				else $this->SettingModel->updateByMetaKey('contact_telephone','',$this->session->get('user_data')['id']);
				
				$res=array("error"=>false,"data"=>$this->request->getVar('phone'),"data2"=>$this->request->getVar('mail'));
			break;
			case 'fattura':
if($this->request->getVar('fatturacloud_menu')!==null){
		$val = $this->validate([
				
				'fattura_id' => ['label' =>  lang('app.field_fattura_id') ,'rules' => 'trim|required'],	
				'fattura_key' => ['label' =>  lang('app.field_fattura_key') ,'rules' => 'trim|required'],	
				
		]);
		if (!$val)
		{
				
				$validation=$this->validator;
				$error_msg=$validation->listErrors();
				$res=array("error"=>true,"validation"=>$error_msg);
		}
		else{
			$meta_value=json_encode(array("id"=>$this->request->getVar('fattura_id'),"key"=>$this->request->getVar('fattura_key'),"num_prefix"=>$this->request->getVar('num_prefix')),true);
			$id=$this->SettingModel->where('id_ente', $this->session->get('user_data')['id'])->where('meta_key', 'fattura_incloud')->first();
			if($id==null) $this->SettingModel->insert(array('id_ente'=>$this->session->get('user_data')['id'],'meta_key'=>'fattura_incloud','meta_value'=>$meta_value));
			else{
				
				$this->SettingModel->where('id_ente', $this->session->get('user_data')['id'])->where('meta_key', 'fattura_incloud')->update($id['id'],array('meta_value'=>$meta_value));
			}
			
			
			$Fattureincloud=new Fattureincloud($this->request->getVar('fattura_id'),$this->request->getVar('fattura_key'));
			$verify_params=json_decode($Fattureincloud->verify($this->request->getVar('fattura_id'),$this->request->getVar('fattura_key')),true);
			if(isset($verify_params['error_code'])){
				$res=array("error"=>true,'validation'=>$verify_params['error']);
			}
			else
				$res=array("error"=>false);
		}
}
else{	
			$val = $this->validate([
				
				'fattura_nome' => ['label' =>  lang('app.field_first_name') ,'rules' => 'trim|required'],	
				'fattura_cognome' => ['label' =>  lang('app.field_last_name') ,'rules' => 'trim|required'],	
				
		]);
		if (!$val)
		{
				
				$validation=$this->validator;
				$error_msg=$validation->listErrors();
				$res=array("error"=>true,"validation"=>$error_msg);
		}
		
		elseif(($this->request->getVar('type')=='private' || $this->request->getVar('type')=='professional') && $this->request->getVar('fattura_cf')!="" && strlen($this->request->getVar('fattura_cf'))>16){
			$res=array("error"=>true,"validation"=>lang('app.error_cf_format'));
		}
		elseif(($this->request->getVar('type')=='company' || $this->request->getVar('type')=='professional') && $this->request->getVar('fattura_sdi')!="" && strlen($this->request->getVar('fattura_sdi'))>6){
			$res=array("error"=>true,"validation"=>lang('app.error_sdi_format'));
		}
		else{ 
				
				if($this->request->getVar('type')=='company') $subscribe_name=$this->request->getVar('ragione_sociale');
				else $subscribe_name=null;
				
				$inf_profile=$this->UserProfileModel->where('user_id',$this->session->get('user_data')['id'])->first();
				
				if(!is_null($subscribe_name)) $this->UserModel->edit($this->session->get('user_data')['id'],array('display_name'=>$subscribe_name));
				$tab=array( 		
				
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
				
				);

				$this->UserProfileModel->update($inf_profile['id'],$tab);
				
				
				$res=array("error"=>false);
		}
		$default_iva=$this->request->getVar('default_iva');
			$id=$this->SettingModel->where('id_ente', $this->session->get('user_data')['id'])->where('meta_key', 'default_iva')->first();
							if($id==null) $this->SettingModel->insert(array('id_ente'=>$this->session->get('user_data')['id'],'meta_key'=>'default_iva','meta_value'=>$default_iva));
							else{
								
								$this->SettingModel->where('id_ente', $this->session->get('user_data')['id'])->where('meta_key', 'default_iva')->update($id['id'],array('meta_value'=>$default_iva));
							}
}
	
			break;
			case 'data':
				$val = $this->validate([
				
				'nome' => ['label' =>  lang('app.field_first_name') ,'rules' => 'trim|required'],	
				'cognome' => ['label' =>  lang('app.field_last_name') ,'rules' => 'trim|required'],	
				
		]);
		if (!$val)
		{
				
				$validation=$this->validator;
				$error_msg=$validation->listErrors();
				$res=array("error"=>true,"validation"=>$error_msg);
		}
		
		
		else{ 
				$inf_profile=$this->UserProfileModel->where('user_id',$this->session->get('user_data')['id'])->first();
				if($inf_profile['type']=='company') $subscribe_name=null;
				else $subscribe_name=$this->request->getVar('nome').' '.$this->request->getVar('cognome');
				
				
				
				if(!is_null($subscribe_name)) $this->UserModel->edit($this->session->get('user_data')['id'],array('display_name'=>$subscribe_name));
				$tab=array( 		
				
					'mobile' => $this->request->getVar('mobile'),
					'nome' => $this->request->getVar('nome'),
					'cognome' => $this->request->getVar('cognome'),
					'telefono' => $this->request->getVar('telefono'),
					'cf' => $this->request->getVar('cf'),
					'piva' => $this->request->getVar('piva'),
					'residenza_stato' => $this->request->getVar('residenza_stato'),
					'residenza_provincia' => $this->request->getVar('residenza_provincia'),
					'residenza_comune' => $this->request->getVar('residenza_comune'),
					'residenza_cap' => $this->request->getVar('residenza_cap'),
					'residenza_indirizzo' => $this->request->getVar('residenza_indirizzo'),
				);

				$this->UserProfileModel->update($inf_profile['id'],$tab);
				$res=array("error"=>false);
			}
			break;
			case 'payments':	
				$p='profile_payments.php';
				$data['list_method_payment']=$this->MethodPaymentModel->where('banned','no')->where('enable','yes')->find();
				$this->EnteMethodPaymentModel->where('id_ente',$user_data['id'])->delete();
				if(!empty($this->request->getVar('ente_payment'))){
					$error_msg="";
					foreach($this->request->getVar('ente_payment') as $kk=>$vv){
						switch($vv){
							case 1:
								$val = $this->validate([
				
										'bank_name' => ['label' =>  lang('app.field_bank_name') ,'rules' => 'trim|required'],	
										'iban' => ['label' =>  lang('app.field_iban') ,'rules' => 'trim|required'],	
										'property' => ['label' =>  lang('app.field_bank_property') ,'rules' => 'trim|required'],	
								]);
								if (!$val)
								{
										
										$validation=$this->validator;
										$error_msg.=$validation->listErrors();
										//$res=array("error"=>true,"validation"=>$error_msg);
								}
								else{
									$details=json_encode(array("bank_name"=>$this->request->getVar('bank_name'),"iban"=>$this->request->getVar('iban'),"property"=>$this->request->getVar('property')),true);
									$this->EnteMethodPaymentModel->insert(array('id_ente'=>$user_data['id'],'id_method'=>$vv,'details'=>$details,'enable'=>'yes'));
								}
							break;
							case 2:
								$val = $this->validate([
				
										'clientID' => ['label' =>  lang('app.field_paypal_clientID') ,'rules' => 'trim|required'],	
										'clientSecret' => ['label' =>  lang('app.field_paypal_clientSecret') ,'rules' => 'trim|required'],	
										
								]);
								if (!$val)
								{
										
										$validation=$this->validator;
										$error_msg.=$validation->listErrors();
										//$res=array("error"=>true,"validation"=>$error_msg);
								}
								else{
									$details=json_encode(array("clientSecret"=>$this->request->getVar('clientSecret'),"clientID"=>$this->request->getVar('clientID')),true);
									$this->EnteMethodPaymentModel->insert(array('id_ente'=>$user_data['id'],'id_method'=>$vv,'details'=>$details,'enable'=>'yes'));
								}
							break;
							case 3:
								$val = $this->validate([
				
										'stripeSecret' => ['label' =>  lang('app.field_paypal_clientSecret') ,'rules' => 'trim|required'],	
										
								]);
								if (!$val)
								{
										
										$validation=$this->validator;
										$error_msg.=$validation->listErrors();
										//$res=array("error"=>true,"validation"=>$error_msg);
								}
								else{
									$details=json_encode(array("stripeSecret"=>$this->request->getVar('stripeSecret')),true);
									$this->EnteMethodPaymentModel->insert(array('id_ente'=>$user_data['id'],'id_method'=>$vv,'details'=>$details,'enable'=>'yes'));
								}
							break;
						}
					}
					if($error_msg!=""){
						$res=array("error"=>true,"validation"=>$error_msg);
					}
					else {
						$res=array("error"=>false);
					}
				}
			else $res=array("error"=>true,"validation"=>lang('app.error_select_method_payment'));
				
			break;
			case 'mailing':
			$val=true;
			if($this->request->getVar('host')!=""){
				$val = $this->validate([
				
						'host' => ['label' =>  lang('app.field_smtp_host') ,'rules' => 'trim|required'],	
						'username' => ['label' =>  lang('app.field_smtp_username') ,'rules' => 'trim|required'],	
						'password' => ['label' =>  lang('app.field_smtp_password') ,'rules' => 'trim|required'],	
						'port' => ['label' =>  lang('app.field_smtp_port') ,'rules' => 'trim|required'],	
						'sender_email' => ['label' =>  lang('app.field_sender_email') ,'rules' => 'trim|required'],
						'sender_name' => ['label' =>  lang('app.field_sender_name') ,'rules' => 'trim|required'],
				]);
			}
			/*else{
				$_POST['host']="";
				$_POST['username']="";
				$_POST['password']="";
				$_POST['sender_email']="";
				$_POST['sender_name']="";
				$_POST['port']="";
			}*/
				if (!$val)
				{
						
						$validation=$this->validator;
						$error_msg=$validation->listErrors();
						$res=array("error"=>true,"validation"=>$error_msg);
				}
				else{
					$meta_value=json_encode(array("host"=>$this->request->getVar('host'),"username"=>$this->request->getVar('username'),"password"=>$this->request->getVar('password'),"port"=>$this->request->getVar('port'),"sender_email"=>$this->request->getVar('sender_email'),"sender_name"=>$this->request->getVar('sender_name')),true);
					
						$id=$this->SettingModel->where('id_ente', $this->session->get('user_data')['id'])->where('meta_key', 'SMTP')->first();
						if($id==null) $this->SettingModel->insert(array('id_ente'=>$this->session->get('user_data')['id'],'meta_key'=>'SMTP','meta_value'=>$meta_value));
						else{
							
							$this->SettingModel->where('id_ente', $this->session->get('user_data')['id'])->where('meta_key', 'SMTP')->update($id['id'],array('meta_value'=>$meta_value));
						}
						
						
						$email=$this->request->getVar('email');
			$id=$this->SettingModel->where('id_ente', $this->session->get('user_data')['id'])->where('meta_key', 'email')->first();
							if($id==null) $this->SettingModel->insert(array('id_ente'=>$this->session->get('user_data')['id'],'meta_key'=>'email','meta_value'=>$email));
							else{
								
								$this->SettingModel->where('id_ente', $this->session->get('user_data')['id'])->where('meta_key', 'email')->update($id['id'],array('meta_value'=>$email));
							}
						
				$res=array("error"=>false);
				}
			break;
		}
		echo json_encode($res,true);
		/*$user = $this->UserProfileModel->where('user_id', $this->session->get('user_data')['id'])->first();
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
		*/
	}
	
	public function send_test_smtp(){
		$host=$this->request->getVar('host');
		$username=$this->request->getVar('username');
		$password=$this->request->getVar('password');
		$port=$this->request->getVar('port');
		$sender_email=$this->request->getVar('sender_email');
		$sender_name=$this->request->getVar('sender_name');
		$smtp_test_email=$this->request->getVar('smtp_test_email');
		
		$email = \Config\Services::email();
		$email->SMTPHost=$host;
		$email->SMTPUser=$username;
		$email->SMTPPass=$password;
		$email->SMTPPort=$port;
		$email->setFrom($sender_email,$sender_name);
		
		$email->setTo($smtp_test_email);
		$html="test smtp config";
		$email->setSubject("test smtp config");
		$email->setMessage($html);
		$email->setAltMessage(strip_tags($html));
		$xxx=$email->send();
		print_r($email);
		//echo json_encode($email);
	}
}
?>
