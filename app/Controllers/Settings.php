<?php namespace App\Controllers;

use stdClass;

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
		if($user_data['role']=="ente"){
			$list=$this->TemplatesModel->where('id_ente',$user_data['id'])->find();
			$data['list']=$list;
			return view('admin/settings_emails.php',$data);
		}
		elseif($user_data['role']=="admin"){
			$list=$this->TemplatesModel->where('id_ente IS NULL')->find();
			$data['list']=$list;
			return view('superadmin/settings_emails.php',$data);
		}
		
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
			if($user_data['role']=="ente")
				return view('admin/settings_emails_edit.php',$data);
			else 
				return view('superadmin/settings_emails_edit.php',$data);
	}
	
	public function media(){
		$data=$this->common_data();
		$user_data=$this->session->get('user_data');
		
		if($this->request->getVar('action')!==null){
			switch($this->request->getVar('action')){
				case 'logo':
				if($_FILES['logo']['name']!=""){
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
				}	
				if($_FILES['logo']['faveicon']!=""){
						$validated2 = $this->validate([
							'faveicon' => [
								'uploaded[faveicon]',
								'mime_in[faveicon,image/ico,image/jpg,image/jpeg,image/gif,image/png]',
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
				$id=$this->SettingModel->where('id_ente', $this->session->get('user_data')['id'])->where('meta_key', 'banner_home')->first();
				//$validated2=false;
				
				$det=json_decode($id['meta_value'] ?? '',true) ?? array();
			
				if(!empty($id) && $det['image']!=""){
					$banner_home=json_encode(array("title"=>$this->request->getVar('title'),"subtitle"=>$this->request->getVar('subtitle'),"image"=>$det['image'],"url"=>$this->request->getVar('url'),"btn_label"=>$this->request->getVar('btn_label')),true);
					if($_FILES['image']!==null){
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
							}
					}						
							
							$id=$this->SettingModel->where('id_ente', $this->session->get('user_data')['id'])->where('meta_key', 'banner_home')->first();
							if($id==null) $this->SettingModel->insert(array('id_ente'=>$this->session->get('user_data')['id'],'meta_key'=>'banner_home','meta_value'=>$banner_home));
							else{
								
								$this->SettingModel->where('id_ente', $this->session->get('user_data')['id'])->where('meta_key', 'banner_home')->update($id['id'],array('meta_value'=>$banner_home));
							}
				
				}
				else{
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
				}
				
				//var_dump($banner_home);
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
	
	public function cms(){
		$data=$this->common_data();
	
		$user_data=$this->session->get('user_data');
		if($this->request->getVar('action')!==null){
			switch($this->request->getVar('action')){
				case 'delete':
						$id=$this->request->getVar('id_to_delete');
						$this->PagesModel->update($id,array('banned'=>'yes'));
						$data['success']=lang('app.success_delete');
				break;
				case 'add':
					$val = $this->validate([
				
							'title' => ['label' => lang('app.field_title'), 'rules' => 'trim|required'],	
							'menu_title' => ['label' => lang('app.field_menu'), 'rules' => 'trim|required'],
							'ord' => ['label' => lang('app.field_sort'), 'rules' => 'trim|required'],	
							
							
							
					]);
					if($this->request->getVar('is_externel')!==null){
						$val = $this->validate([
				
							'url' => ['label' => lang('app.field_url'), 'rules' => 'trim|required|valid_url'],	
							
					]);
					}
					if (!$val)
					{
						
							$validation=$this->validator;
							 $error_msg=$validation->listErrors();
							$data['error']=$error_msg;
					}
					
					else{
						
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
							
							$avatar_logo->move(ROOTPATH.'public/uploads/pages/',$logo_name);

							$header_image = $this->request->getFile('headerImage');
							$header_image_name = $avatar_logo->getRandomName();
							
							$header_image->move(ROOTPATH.'public/uploads/pages/',$header_image_name);
						}
						else $logo_name =null;

						$this->validator->reset();
						$validate_header = $this->validate([
							'headerImage' => [
								'uploaded[headerImage]',
								'mime_in[headerImage,image/jpg,image/jpeg,image/gif,image/png,image/ico]',
								'max_size[headerImage,4096]',
							],
						]);
						if ($validate_header) { 
						$header_image = $this->request->getFile('headerImage');
							$header_image_name = $header_image->getRandomName();
							
							$header_image->move(ROOTPATH.'public/uploads/pages/',$header_image_name);
						}
						else $header_image_name =null;

						if($this->request->getVar('enable')!==null) $enable="yes"; else $enable="no";
						if($this->request->getVar('is_externel')!==null){
							$url=$this->request->getVar('url');
							$is_externel="yes";
						}
						else{
							
							$url=strtolower(url_title($this->request->getVar('title')));
							$is_externel="no";
						}
						$tab=array("title"=>$this->request->getVar('title'),
						"menu_title"=>$this->request->getVar('menu_title'),
						"menu_position"=>$this->request->getVar('menu_position'),
						'is_externel'=>$is_externel,
						"content"=>$this->request->getVar('html'),
						"seo_title"=>$this->request->getVar('seo_title'),
						"seo_description"=>$this->request->getVar('seo_description'),
						"ord"=>$this->request->getVar('ord'),
						'url'=>$url,
						"type"=>'dynamic',
						"enable"=>$enable,
						"id_ente"=>$user_data['id'],
						'image'=>$logo_name,
						'header_image'=>$header_image_name,
						);
						
						$this->PagesModel->insert($tab);
						$data['success']=lang('app.success_add');
					}
				break;
				case 'edit':
				$id=$this->request->getVar('id');
				if($user_data['role']=="ente"){
					$inf_page=$this->PagesModel->where('banned','no')->where('id_ente',$user_data['id'])->where('id',$id)->first();
				}
				else $inf_page=$this->PagesModel->where('banned','no')->where('id',$id)->first();
				if(empty($inf_page)) return redirect()->back();
					$val = $this->validate([
				
							'title' => ['label' => lang('app.field_title'), 'rules' => 'trim|required'],
					]);
				if($inf_page['type']=='dynamic'){
					$val = $this->validate([
								'menu_title' => ['label' => lang('app.field_menu'), 'rules' => 'trim|required'],
								'ord' => ['label' => lang('app.field_sort'), 'rules' => 'trim|required'],										
					]);
				}	
					if (!$val)
					{
						
							$validation=$this->validator;
							 $error_msg=$validation->listErrors();
							$data['error']=$error_msg;
					}
					
					else{
						$tab=array("title"=>$this->request->getVar('title'),
						"seo_title"=>$this->request->getVar('seo_title'),
						"seo_description"=>$this->request->getVar('seo_description'),
						"menu_position"=>$this->request->getVar('menu_position'));
						if($inf_page['type']=='static'){
							$tab['menu_position']=$inf_page['menu_position'];
						}
						
						if($inf_page['type']=='dynamic'){
							
					
						if($this->request->getVar('enable')!==null ) $enable="yes"; else $enable="no";
						
						$tab=array_merge($tab,array(
							"menu_title"=>$this->request->getVar('menu_title'),
							"content"=>$this->request->getVar('html'),
							"ord"=>$this->request->getVar('ord'),
						
							"enable"=>$enable
						));
							}
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
							$tab['image']=$logo_name;
							$avatar_logo->move(ROOTPATH.'public/uploads/pages/',$logo_name);
						}
						$this->validator->reset();
						$validate_header = $this->validate([
							'headerImage' => [
								'uploaded[headerImage]',
								'mime_in[headerImage,image/jpg,image/jpeg,image/gif,image/png,image/ico]',
								'max_size[headerImage,4096]',
							],
						]);
						if ($validate_header) { 
						$header_image = $this->request->getFile('headerImage');
							$header_image_name = $header_image->getRandomName();
							$tab['header_image']=$header_image_name;
							
							$header_image->move(ROOTPATH.'public/uploads/pages/',$header_image_name);
						}


						if($this->request->getVar('is_externel')!==null){
							$url=$this->request->getVar('url');
							$is_externel="yes";
						}
						else{
							if($inf_page['type']=='dynamic'){
								$url=strtolower(url_title($this->request->getVar('title')));
							}
							else $url=$inf_page['url'];
							$is_externel="no";
						}
						$tab['url']=$url;
						$tab['is_externel']=$is_externel;
						$this->PagesModel->update($id,$tab);
						$data['success']=lang('app.success_update');
					}
				break;
				case 'copyright':
					$copyright=$this->request->getVar('copyright');
					$id=$this->SettingModel->where('id_ente', $this->session->get('user_data')['id'])->where('meta_key', 'copyright')->first();
							if($id==null) $this->SettingModel->insert(array('id_ente'=>$this->session->get('user_data')['id'],'meta_key'=>'copyright','meta_value'=>$copyright));
							else{
								
								$this->SettingModel->where('id_ente', $this->session->get('user_data')['id'])->where('meta_key', 'copyright')->update($id['id'],array('meta_value'=>$copyright));
							}
					$data=$this->common_data();
					$data['success']=lang('app.success_update');
				break;
				case 'textTitle':
					$textTitle=$this->request->getVar('textTitle');
					// $textTitle = str_replace(['<p>', '</p>'], ['<h2>', '</h2>'], $textTitle);
					$home=$this->PagesModel->where('id_ente', $this->session->get('user_data')['id'])->where('url', 'home')->first();
					$text = json_decode($home['text']) ?? new stdClass();
					$text->textTitle = $textTitle;
					// die(var_dump($home));
					$text = json_encode($text);			
								$this->PagesModel->where('id_ente', $this->session->get('user_data')['id'])->where('url', 'home')->update($home['id'],array('text'=>$text));

					$data=$this->common_data();
					$data['success']=lang('app.success_update');
				break;
				case 'privacy':
					$privacy=$this->request->getVar('privacy');
					$id=$this->SettingModel->where('id_ente', $this->session->get('user_data')['id'])->where('meta_key', 'privacy')->first();
							if($id==null) $this->SettingModel->insert(array('id_ente'=>$this->session->get('user_data')['id'],'meta_key'=>'privacy','meta_value'=>$privacy));
							else{
								$this->SettingModel->where('id_ente', $this->session->get('user_data')['id'])->where('meta_key', 'privacy')->update($id['id'],array('meta_value'=>$privacy));
							}
					$data=$this->common_data();
					$data['success']=lang('app.success_update');
				break;
				case 'css':
					$styles=$this->SettingModel->where('id_ente', $this->session->get('user_data')['id'])->where('meta_key', 'css')->first();
					$css = json_decode($styles['meta_value'] ?? "", true) ?? [];
					
					if(strlen($this->request->getVar("headerBackground"))> 0) $css['headerBackground'] = $this->request->getVar("headerBackground");
					if(strlen($this->request->getVar("headerText"))> 0) $css['headerText'] = $this->request->getVar("headerText");
					if(strlen($this->request->getVar("buttonBackground"))> 0) $css['buttonBackground'] = $this->request->getVar("buttonBackground");
					if(strlen($this->request->getVar("buttonText"))> 0) $css['buttonText'] = $this->request->getVar("buttonText");
					// die(var_dump($home));1
					$css = json_encode($css);
					$array = ['meta_value'=>$css, 'meta_key'=> 'css', 'id_ente'=> $this->session->get('user_data')['id']];
					if(!empty($styles)) $array['id'] = $styles['id'];			
					$this->SettingModel->where('id_ente', $this->session->get('user_data')['id'])->save($array);

					$data=$this->common_data();
					$data['success']=lang('app.success_update');
				break;
				case 'credit':
					$credit=$this->SettingModel->where('id_ente', $this->session->get('user_data')['id'])->where('meta_key', 'credits')->first();
					$array = ['meta_value'=>$this->request->getVar('credit'), 'meta_key'=> 'credits', 'id_ente'=> $this->session->get('user_data')['id']];
					if(!empty($credit)) $array['id'] = $credit['id'];			
					$this->SettingModel->where('id_ente', $this->session->get('user_data')['id'])->save($array);

					$data=$this->common_data();
					$data['success']=lang('app.success_update');
				break;
				case 'GDPR':
					$credit=$this->SettingModel->where('id_ente', $this->session->get('user_data')['id'])->where('meta_key', 'GDPR')->first();
					$array = ['meta_value'=>$this->request->getVar('GDPR'), 'meta_key'=> 'GDPR', 'id_ente'=> $this->session->get('user_data')['id']];
					if(!empty($credit)) $array['id'] = $credit['id'];			
					$this->SettingModel->where('id_ente', $this->session->get('user_data')['id'])->save($array);

					$data=$this->common_data();
					$data['success']=lang('app.success_update');
				break;
				case 'cours_type':
					$type_cours=json_encode(array('aula'=>$this->request->getVar('aula'),
					'webinar'=>$this->request->getVar('webinar'),
					'online'=>$this->request->getVar('online')),true);
					$id=$this->SettingModel->where('id_ente', $this->session->get('user_data')['id'])->where('meta_key', 'type_cours')->first();
							if($id==null) $this->SettingModel->insert(array('id_ente'=>$this->session->get('user_data')['id'],'meta_key'=>'type_cours','meta_value'=>$type_cours));
							else{
								
								$this->SettingModel->where('id_ente', $this->session->get('user_data')['id'])->where('meta_key', 'type_cours')->update($id['id'],array('meta_value'=>$type_cours));
							}
					$data=$this->common_data();
					$data['success']=lang('app.success_update');
				break;
			}
		}
		
		if($user_data['role']=="ente"){
			$list=$this->PagesModel->where('id_ente',$user_data['id'])->where('banned','no')->find();
			$data['list']=$list;
			$data['settings']=$settings=$this->SettingModel->getByMetaKey($user_data['id']);
			return view('admin/settings_cms.php',$data);
		}
		else{
			$list=$this->PagesModel->where('id_ente IS NULL')->where('banned','no')->find();
			$data['list']=$list;
			
			return view('superadmin/settings_cms.php',$data);
		}
		
	}
	
	public function cms_add(){
		$data=$this->common_data();
	
		$user_data=$this->session->get('user_data');
	
		
			return view('admin/settings_cms_add.php',$data);
		
		
	}
	public function cms_edit($id){
		$data=$this->common_data();
	
		$user_data=$this->session->get('user_data');
		if($user_data['role']=="ente"){
			$data['inf_page']=$this->PagesModel->where('banned','no')->where('id_ente',$user_data['id'])->where('id',$id)->first();
			if(empty($data['inf_page'])) return redirect()->back();
			return view('admin/settings_cms_edit.php',$data);
		}
		else{
			$data['inf_page']=$this->PagesModel->where('banned','no')->where('id',$id)->first();
			if(empty($data['inf_page'])) return redirect()->back();
			return view('superadmin/settings_cms_edit.php',$data);
		}
		
	}
	
	
	public function remember_emails(){
		$data=$this->common_data();
		if($this->request->getVar('action')!==null){
			$this->RememberEmailsModel->update($this->request->getVar('id'),array('banned'=>'yes'));
		}
		$list=$this->RememberEmailsModel->where('banned','no')->where('id_ente',$data['user_data']['id'])->findAll();
		$data['list']=$list;
		return view('admin/settings_remember_emails.php',$data);
	
	}
	
	public function remember_emails_add(){
			$data=$this->common_data();
			
			if(!is_null($this->request->getVar('submit'))){
				if(!is_null($this->request->getVar('enable'))) $enable='yes'; else $enable='no';
				$res=array(
				'id_ente'=>$data['user_data']['id'],
				'nb_days'=>$this->request->getVar('nb_days'),
				'type_days'=>$this->request->getVar('type_days'),
				'tipologia_corsi'=>$this->request->getVar('tipologia_corsi'),
				'subject'=>$this->request->getVar('subject'),
				'text'=>$this->request->getVar('html'),
				'enable'=>$enable,
				);
			
				$this->RememberEmailsModel->insert($res);
				
			}

			
			return view('admin/settings_remember_emails_add.php',$data);
		
		
	}
	public function remember_emails_edit($id){
			$data=$this->common_data();
			
			if(!is_null($this->request->getVar('submit'))){
				if(!is_null($this->request->getVar('enable'))) $enable='yes'; else $enable='no';
				$res=array(
				'id_ente'=>$data['user_data']['id'],
				'nb_days'=>$this->request->getVar('nb_days'),
				'type_days'=>$this->request->getVar('type_days'),
				'tipologia_corsi'=>$this->request->getVar('tipologia_corsi'),
				'subject'=>$this->request->getVar('subject'),
				'text'=>$this->request->getVar('html'),
				'enable'=>$enable,
				);
			
				$this->RememberEmailsModel->update($this->request->getVar('id'),$res);
				
			}
			$data['inf']=$this->RememberEmailsModel->find($id);
			
			return view('admin/settings_remember_emails_edit.php',$data);
		
		
	}
	
	public function remember_emails_send_test(){
		$data=$this->common_data();
		$settings=$data['settings'];
	
		$subject=$this->request->getVar('subject');
		$html=$this->request->getVar('html');
		$email = \Config\Services::email();					
		//$email->setFrom($settings['sender_email'],$settings['sender_name']);
		$sender_email=$settings['sender_email'];
		$sender_name=$settings['sender_name'];
		$SMTP=$this->SettingModel->getByMetaKeyEnte($data['user_data']['id'],'SMTP')['SMTP'] ?? "";
							if($SMTP!="") $vals=json_decode($SMTP,true);
						
							if(!empty($vals)){
									if(isset($vals['sender_name'])  && $vals['sender_name']!="") $sender_name=$vals['sender_name']; else $sender_name=$common_data['settings']['sender_name'];
									if(isset($vals['sender_email']) && $vals['sender_email']!="") $sender_email=$vals['sender_email']; else $sender_email=$common_data['settings']['sender_email'];
					
								$email->SMTPHost=$vals['host'];
								$email->SMTPUser=$vals['username'];
								$email->SMTPPass=$vals['password'];
								$email->SMTPPort=$vals['port'];
							}
							
						
		
		$email->setFrom($sender_email,$sender_name);
		 $to=$data['user_data']['email'];
		$email->setTo($to);
	//$email->setTo('s.benia@gmail.com');
		$email->setSubject('(TEST) '.$subject);
		$email->setMessage($html);
		$email->setAltMessage(strip_tags($html));
		//var_dump($email);
		$xxx=$email->send();
		
	}
	
	public function social(){
		$data=$this->common_data();
		$user_data=$this->session->get('user_data');
		if(!is_null($this->request->getVar('save'))){
			$social=array("site_web"=>$this->request->getVar('site_web'),
			"twitter"=>$this->request->getVar('twitter'),
			"facebook"=>$this->request->getVar('facebook'),
			"linkedin"=>$this->request->getVar('linkedin'),
			"youtube"=>$this->request->getVar('youtube'),
			"instagram"=>$this->request->getVar('instagram'),
			"blog"=>$this->request->getVar('blog'),
			);
		
			$credit=$this->SettingModel->where('id_ente', $this->session->get('user_data')['id'])->where('meta_key', 'social')->first();
					$array = ['meta_value'=>json_encode($social,true), 'meta_key'=> 'social', 'id_ente'=> $this->session->get('user_data')['id']];
					if(!empty($credit)) $array['id'] = $credit['id'];			
					$this->SettingModel->where('id_ente', $this->session->get('user_data')['id'])->save($array);

					$data=$this->common_data();
					$data['success']=lang('app.success_update');
		}
		$data['social']=json_decode($data['settings']['social'] ?? '',true);
		return view('admin/settings_social.php',$data);
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