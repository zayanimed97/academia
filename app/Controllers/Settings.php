<?php namespace App\Controllers;

class Settings extends BaseController
{

	
	
	public function index()
	{		
		/*$settings=$this->SettingModel->getByMetaKey();
		$user_data=$this->session->get('user_data');
		if($user_data['role']!='A') return redirect()->to( base_url() );
		else {
			
			if(!is_null($this->request->getVar('action'))){
				
			
				$this->SettingModel->updateByMetaKey('sender_email',$this->request->getVar('sender_email'));
				$this->SettingModel->updateByMetaKey('sender_name',$this->request->getVar('sender_name'));
				
			}
			$data=$this->common_data();
			return view('admin/settings.php',$data);
		}*/
	}
	
	public function emails(){
		$data=$this->common_data();
	
		$user_data=$this->session->get('user_data');
	
			$list=$this->TemplatesModel->where('id_ente',$user_data['id'])->find();
			$data['list']=$list;
			return view('admin/settings_emails.php',$data);
		
		
	}
	
	public function emails_edit($id){
		$data=$this->common_data();	
		$user_data=$this->session->get('user_data');

			if(!is_null($this->request->getVar('action'))){
				$res=array('subject'=>$this->request->getVar('subject'),
				'html'=>$this->request->getVar('html')
				);
				$this->TemplatesModel->update($id,$res);
				
			}
		
			$list=$this->TemplatesModel->find($id);
			$data['list']=$list;
			
			return view('admin/settings_emails_edit.php',$data);
		
		
	}
	
	
	/*
	public function notif_log($user_id=null){
		$NotifLogModel = new NotifLogModel();
		$settings=$this->SettingModel->getByMetaKey();
		$UserProfileModel=new UserProfileModel();
		$user_data=$this->session->get('user_data');
		if($user_data['role']!='A') return redirect()->to( base_url() );
		else {
			
			
			$data=$this->common_data();
			$list=$NotifLogModel->findAll();
			if($user_id!=null) $list=$NotifLogModel->where('id_participant',$user_id)->findAll();
			$res=array();
			foreach($list as $k=>$v){
				$inf_profile=$UserProfileModel->where('user_id',$v['id_participant'])->first();
				$v['participant']=$inf_profile['nome'].' '.$inf_profile['cognome'];
				$res[]=$v;
			}
			$data['list']=$res;
			return view('admin/notif_log.php',$data);
		}
		
	}
	
	public function notif_log_view($id){
		$NotifLogModel = new NotifLogModel();
		$settings=$this->SettingModel->getByMetaKey();
		$UserProfileModel=new UserProfileModel();
		$user_data=$this->session->get('user_data');
		if(empty($user_data)) return redirect()->to( base_url() );
		else {
			$data=$this->common_data();
			$list=$NotifLogModel->find($id);
			$data['message']=$list['message'];
			return view('notif_log_view.php',$data);
		}
	}
	*/
}