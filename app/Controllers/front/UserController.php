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
			return redirect()->to(base_url('user/login'))->with('success_register','success confirm');
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
			return redirect()->back()->withInput()->with('error','mail is exist');
		}
		else{
         $token=random_string('alnum',32);
        $dataUser = [
                        'active' => 'no',
                        'role' => 'participant',
                        'email' => $request['email'],
                        'password' => md5($request['password']),
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
		
			return redirect()->to(base_url('user/login'))->with('success_register','success register');
		}

    }

    public function getLogin()
    {
        $data = $this->common_data();
         if($this->session->get('success_register')!==null){
		echo	$data['success_register']=$this->session->get('success_register');
			//$this->session->remove('success_register');
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
				$data['error']=lang('app.error_not_exist_account');
				 return view($url, $data);
			}
			elseif($users[0]['active']!='yes'){
				 $data['error']=lang('app.error_not_active_account');
				return view($url, $data);
			}
			else{
                $users[0]['profile'] = $this->UserProfileModel->where('user_id', $users[0]['id'])->first();
				$this->session->set(array('user_data'=>$users[0]));
				return redirect()->to( base_url() );
			}
		}
		
    }
}
