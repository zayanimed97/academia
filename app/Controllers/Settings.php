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
	
	public function media(){
		$data=$this->common_data();
		$user_data=$this->session->get('user_data');
		
		if($this->request->getVar('action')!==null){
			switch($this->request->getVar('action')){
				case 'logo':
					 $validated = $this->validate([
							'logo' => [
								'uploaded[logo]',
								'mime_in[logo,image/jpg,image/jpeg,image/gif,image/png]',
								'max_size[logo,4096]',
							],
						]);
				
						if ($validated) { 
							$avatar_logo = $this->request->getFile('logo');
							 $logo_name = $avatar_logo->getRandomName();
							
							$avatar_logo->move(ROOTPATH.'public/uploads/',$logo_name);
						
							$id=$this->SettingModel->where('id_ente', $this->session->get('user_data')['id'])->where('meta_key', 'logo_website')->first();
							if($id==null) $this->SettingModel->insert(array('id_ente'=>$this->session->get('user_data')['id'],'meta_key'=>'logo_website','meta_value'=>$logo_name));
							else{
								
								$this->SettingModel->where('id_ente', $this->session->get('user_data')['id'])->where('meta_key', 'logo_website')->update($id['id'],array('meta_value'=>$logo_name));
							}
						}
						else{
							$validation=$this->validator;
							$data['warning']=$validation->listErrors();
							 $validation->reset();
						
						}
						
						$validated2 = $this->validate([
							'faveicon' => [
								'uploaded[faveicon]',
								'mime_in[faveicon,image/jpg,image/jpeg,image/gif,image/png,image/ico]',
								'max_size[faveicon,4096]',
							],
						]);
						if ($validated2) { 
							$avatar_logo = $this->request->getFile('faveicon');
							 $logo_name = $avatar_logo->getRandomName();
							
							$avatar_logo->move(ROOTPATH.'public/uploads/',$logo_name);
						
							$id=$this->SettingModel->where('id_ente', $this->session->get('user_data')['id'])->where('meta_key', 'faveicon_website')->first();
							if($id==null) $this->SettingModel->insert(array('id_ente'=>$this->session->get('user_data')['id'],'meta_key'=>'faveicon_website','meta_value'=>$logo_name));
							else{
								
								$this->SettingModel->where('id_ente', $this->session->get('user_data')['id'])->where('meta_key', 'faveicon_website')->update($id['id'],array('meta_value'=>$logo_name));
							}
						}
						else{
							$validation=$this->validator;
							if(isset($data['warning']))
								$data['warning'].=$validation->listErrors();
							else $data['warning']=$validation->listErrors();
						
						}
				break;
				case 'corso':
					 $validated = $this->validate([
							'aula' => [
								'uploaded[aula]',
								'mime_in[aula,image/jpg,image/jpeg,image/gif,image/png]',
								'max_size[aula,4096]',
							],
						]);
				
						if ($validated) { 
							$avatar_logo = $this->request->getFile('aula');
							 $logo_name = $avatar_logo->getRandomName();
							
							$avatar_logo->move(ROOTPATH.'public/uploads/',$logo_name);
						
							$id=$this->SettingModel->where('id_ente', $this->session->get('user_data')['id'])->where('meta_key', 'default_img_aula')->first();
							if($id==null) $this->SettingModel->insert(array('id_ente'=>$this->session->get('user_data')['id'],'meta_key'=>'default_img_aula','meta_value'=>$logo_name));
							else{
								
								$this->SettingModel->where('id_ente', $this->session->get('user_data')['id'])->where('meta_key', 'default_img_aula')->update($id['id'],array('meta_value'=>$logo_name));
							}
						}
						else{
							$validation=$this->validator;
							$data['warning']=$validation->listErrors();
							 $validation->reset();
						
						}
						
						$validated2 = $this->validate([
							'webinar' => [
								'uploaded[webinar]',
								'mime_in[webinar,image/jpg,image/jpeg,image/gif,image/png,image/ico]',
								'max_size[webinar,4096]',
							],
						]);
						if ($validated2) { 
							$avatar_logo = $this->request->getFile('webinar');
							 $logo_name = $avatar_logo->getRandomName();
							
							$avatar_logo->move(ROOTPATH.'public/uploads/',$logo_name);
						
							$id=$this->SettingModel->where('id_ente', $this->session->get('user_data')['id'])->where('meta_key', 'default_img_webinar')->first();
							if($id==null) $this->SettingModel->insert(array('id_ente'=>$this->session->get('user_data')['id'],'meta_key'=>'default_img_webinar','meta_value'=>$logo_name));
							else{
								
								$this->SettingModel->where('id_ente', $this->session->get('user_data')['id'])->where('meta_key', 'default_img_webinar')->update($id['id'],array('meta_value'=>$logo_name));
							}
						}
						else{
							$validation=$this->validator;
							if(isset($data['warning']))
								$data['warning'].=$validation->listErrors();
							else $data['warning']=$validation->listErrors();
						 $validation->reset();
						}
						
						$validated2 = $this->validate([
							'online' => [
								'uploaded[online]',
								'mime_in[online,image/jpg,image/jpeg,image/gif,image/png,image/ico]',
								'max_size[online,4096]',
							],
						]);
						if ($validated2) { 
							$avatar_logo = $this->request->getFile('online');
							 $logo_name = $avatar_logo->getRandomName();
							
							$avatar_logo->move(ROOTPATH.'public/uploads/',$logo_name);
						
							$id=$this->SettingModel->where('id_ente', $this->session->get('user_data')['id'])->where('meta_key', 'default_img_online')->first();
							if($id==null) $this->SettingModel->insert(array('id_ente'=>$this->session->get('user_data')['id'],'meta_key'=>'default_img_online','meta_value'=>$logo_name));
							else{
								
								$this->SettingModel->where('id_ente', $this->session->get('user_data')['id'])->where('meta_key', 'default_img_online')->update($id['id'],array('meta_value'=>$logo_name));
							}
						}
						else{
							$validation=$this->validator;
							if(isset($data['warning']))
								$data['warning'].=$validation->listErrors();
							else $data['warning']=$validation->listErrors();
						
						}
				break;
				case 'banner':
				$validated2 = $this->validate([
							'image' => [
								'uploaded[image]',
								'mime_in[image,image/jpg,image/jpeg,image/gif,image/png,image/ico]',
								'max_size[image,4096]',
							],
						]);
						if ($validated2) { 
							$avatar_logo = $this->request->getFile('image');
							 $logo_name = $avatar_logo->getRandomName();
							
							$avatar_logo->move(ROOTPATH.'public/uploads/banner/',$logo_name);
						
							$banner_home=json_encode(array("title"=>$this->request->getVar('title'),"subtitle"=>$this->request->getVar('subtitle'),"image"=>$logo_name,"url"=>$this->request->getVar('url'),"btn_label"=>$this->request->getVar('btn_label')),true);
							$id=$this->SettingModel->where('id_ente', $this->session->get('user_data')['id'])->where('meta_key', 'banner_home')->first();
							if($id==null) $this->SettingModel->insert(array('id_ente'=>$this->session->get('user_data')['id'],'meta_key'=>'banner_home','meta_value'=>$banner_home));
							else{
								
								$this->SettingModel->where('id_ente', $this->session->get('user_data')['id'])->where('meta_key', 'banner_home')->update($id['id'],array('meta_value'=>$banner_home));
							}
						}
						else{
							$validation=$this->validator;
							$data['error']=$validation->listErrors();
						}
				break;
			}
		}
		$logo=$this->SettingModel->getByMetaKey($user_data['id'],'logo_website')['logo_website'] ?? '';
		$faveicon=$this->SettingModel->getByMetaKey($user_data['id'],'faveicon_website')['faveicon_website'] ?? '';
		$data['logo']=$logo ;
		$data['faveicon']=$faveicon  ;
		$data['inf_package']=$this->EntePackageModel->where('id_ente',$user_data['id'])->orderBy('expired_date','DESC')->first();
		$aula=$this->SettingModel->getByMetaKey($user_data['id'],'default_img_aula')['default_img_aula'] ?? '';
		$data['aula']=$aula ;
		$webinar=$this->SettingModel->getByMetaKey($user_data['id'],'default_img_webinar')['default_img_webinar'] ?? '';
		$data['webinar']=$webinar ;
		$online=$this->SettingModel->getByMetaKey($user_data['id'],'default_img_online')['default_img_online'] ?? '';
		$data['online']=$online ;
		
		$banner_home=$this->SettingModel->getByMetaKey($user_data['id'],'banner_home')['banner_home'] ?? '';
		$data['banner_home']=$banner_home ;
		return view('admin/settings_media.php',$data);
		
		
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