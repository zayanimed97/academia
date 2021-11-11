<?php namespace App\Controllers;

class Superadmin extends BaseController
{
	public function index()
	{ 	
		$settings=$this->SettingModel->getByMetaKey();
		$user_data=$this->session->get('user_data');
		if(empty($user_data)) return redirect()->to( base_url('/superadmin/login') );
		if($user_data['role']=='A') return redirect()->to( base_url('/superadmin/dashboard') );
		return view('superadmin/login.php',array('settings'=>$settings));
	}
	
	public function dashboard()
	{ 	
		$common_data=$this->common_data();
		$data=$common_data;
		//var_dump($common_data);
		
		return view('superadmin/dashboard.php',$data);
	/*	$user_data=$this->session->get('user_data');
		if($user_data['role']=='A') return redirect()->to( base_url('/admin/dashboard') );
		return view('login.php',array('settings'=>$settings));
		*/
	}
	
	public function profile()
	{		$common_data=$this->common_data();
		$data=$common_data;
			$user_data=$this->session->get('user_data');
			 $action=$this->request->getVar('action');
			 $id_user=$user_data['id'];
			
			 $common_data=$this->common_data();
			$data=$common_data;
			if($action=='edit'){
				$val = $this->validate([				
					
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
						
						$email=$this->request->getVar('email');
						$repassword=$this->request->getVar('repassword');
						$password=$this->request->getVar('password');
						
							  $tab = [
					 
							
								'email'  => $email,
								];
					 if($this->request->getVar('password')!=""){  $tab['password']=md5($password);}
								$save = $this->UserModel->edit($user_data['id'],$tab);
								 $data['success']=lang('app.success_update');
					}
			}
			$profile_data = $this->UserModel->find($user_data['id']);
			
			
			$data['profile_data']=$profile_data;
			echo view('superadmin/profile.php',$data);
	}
}