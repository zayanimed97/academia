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

        return view('default/register', $data);
    }

    public function create_user()
    {
        $request = $this->request->getVar();
		$verif=$this->UserModel->where('id_ente',$this->common_data()['selected_ente']['id'])->where('email',$request['email'])->find();
	//	var_dump($verif); exit;
		if(!empty($verif)){
			return redirect()->back()->withInput()->with('error',lang('front.error_mail_exist'));
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
        $data = $this->common_data();
         if($this->session->get('success_register')!==null){
			$data['success_register']=$this->session->get('success_register');
			$this->session->remove('success_register');
		}
        return view('default/login', $data);
    }

    public function login()
    {
        $data = $this->common_data();
        
        // $settings=$this->SettingModel->getByMetaKey();
		$email=$this->request->getVar('email');
		$password=$this->request->getVar('password');
		$url='/default/login';
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
						->where('password', md5($password))
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
				$this->session->set(array('user_data'=>$users[0]));
				$this->updateCart();
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
				/*return view('default/forgot.php', [
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
					/* return view('default/forgot.php', [
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
		
		
	
		return view('default/forgot.php',$common_data);
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
			return view('default/reset_password.php',$common_data);
		}
		return view('default/reset_password.php',$common_data);
	}
}
