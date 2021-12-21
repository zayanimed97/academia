<?php namespace App\Controllers;

class Luoghi extends BaseController
{

	
	
	
	public function index()
	{		
		
			$common_data=$this->common_data();
		$array=$common_data;
			if($this->request->getVar('action')!==null){
				
				switch($this->request->getVar('action')){
					case 'add':
						if(!is_null($this->request->getVar('enable'))) $status="yes"; else $status="no";
						$val = $this->validate([
							'nome' => ['label' => lang('app.field_title'), 'rules' => 'trim|required']	

						]);
					if (!$val)
					{
						$error=lang('app.error_required');
					}else{
						$data=array(
							'nome'=>$this->request->getVar('nome'),
							'id_ente'=>$array['user_data']['id'],
							'enable'=>$status,
							
						);
						$this->LuoghiModel->insert($data);
							$success=lang('app.success_add');
					}
					break;
					case 'edit': 
					if(!is_null($this->request->getVar('enable'))) $status="yes"; else $status="no";
						$val = $this->validate([
							'nome' => ['label' => lang('app.field_title'), 'rules' => 'trim|required']	

						]);
					if (!$val)
					{
						$error=lang('app.error_required');
					}else{ 
						$data=array(
							'nome'=>$this->request->getVar('nome'),
							'id_ente'=>$array['user_data']['id'],
							'enable'=>$status,
						);
						 
					
						
						 $id=$this->request->getVar('id');
						$this->LuoghiModel->update($id,$data);
							$success=lang('app.success_update');
					}
					break;
					case 'delete':
						$id=$this->request->getVar('id');
						if($id!=""){
							$this->LuoghiModel->update($id,array("banned"=>'yes'));
						
							$success=lang('app.success_delete');
						}
					break;
				}
			}
			
			
			$data=array();
			$data=$this->LuoghiModel->where('banned','no')->where('id_ente',$array['user_data']['id']);
			if($this->request->getVar('search')!==null){
				if($this->request->getVar('search_title')!="") $this->LuoghiModel->like('titolo', $this->request->getVar('search_title'));		
				if($this->request->getVar('search_active')!="") $this->LuoghiModel->where('status',$this->request->getVar('search_active'));
			
			}
			
			$data=$this->LuoghiModel->findAll();//search('D',$display_name,$email,$active,$is_expired,$cf);
		
			
			$array['list']=$data;
			if(isset($success)) $array['success']=$success;
			if(isset($error)) $array['error']=$error;
			return view('admin/luoghi.php',$array);
		
	}
	
	
}