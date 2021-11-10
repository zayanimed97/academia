<?php namespace App\Controllers;

class Ente extends BaseController
{
	public function index()
	{ 	
		$common_data=$this->common_data();
		$data=$common_data;
		return view('superadmin/ente_list.php',$data);
	}
	
	public function add()
	{ 	
		$common_data=$this->common_data();
		$data=$common_data;
		return view('superadmin/ente_add.php',$data);
	}
}