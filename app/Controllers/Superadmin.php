<?php namespace App\Controllers;

class Superadmin extends BaseController
{
	public function index()
	{ 	
		$settings=$this->SettingModel->getByMetaKey();
		$user_data=$this->session->get('user_data');
		if($user_data['role']=='A') return redirect()->to( base_url('/admin/dashboard') );
		return view('login.php',array('settings'=>$settings));
	}
	
	public function dashboard()
	{ 	
		$common_data=$this->common_data();
		var_dump($common_data);
	/*	$user_data=$this->session->get('user_data');
		if($user_data['role']=='A') return redirect()->to( base_url('/admin/dashboard') );
		return view('login.php',array('settings'=>$settings));
		*/
	}
	
	
}