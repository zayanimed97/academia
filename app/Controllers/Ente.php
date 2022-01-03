<?php namespace App\Controllers;

class Ente extends BaseController
{
	public function index()
	{ 	
		$common_data=$this->common_data();
		$data=$common_data;
		if($this->request->getVar('action')!==null){
				
				switch($this->request->getVar('action')){
					case 'delete':
						$id=$this->request->getVar('id_to_delete');
						if($id!=""){
							$this->UserModel->edit($id,array('deleted_at'=>date('Y-m-d H:i:s')));
							$success=lang('app.success_delete');
						}
					break;
				}
			}
		$list=$this->UserModel->where('role','ente')->find();
		$res=array();
		foreach($list as $kk=>$vv){
			$inf_profile=$this->UserProfileModel->where('user_id',$vv['id'])->first();
			$inf_package=$this->EntePackageModel->where('id_ente',$vv['id'])->orderBy('expired_date','DESC')->first();
			if($inf_profile['type']=='company'){
				$vv['type']=lang('app.field_type_company');
				$vv['ente']=$inf_profile['ragione_sociale'];
			}
			else{
				$vv['type']=lang('app.field_type_private');
				ob_start();
				if($inf_profile['ragione_sociale']!=""){?><li><?php echo $inf_profile['ragione_sociale']?></li><?php }?>
					<li><?php echo $inf_profile['nome'].' '.$inf_profile['cognome']?></li>
				<?php 
				$vv['ente']=ob_get_clean();
			}
			$vv['expired_date']=$inf_package['expired_date'];
			$pack=json_decode($inf_package['package'],true);
			ob_start();?>
			<ul>
				<li><?php echo lang('app.field_type_cours')?>: <?php echo implode(",",$pack['type_cours']);?></li>
				<li><?php echo lang('app.field_package_extra')?>: <?php if(!empty($pack['extra']))  echo implode(",",$pack['extra']);?></li>
			</ul>
			<?php 
			$vv['package']=ob_get_clean();
			$vv['mobile']=$inf_profile['mobile'];
			$res[]=$vv;
		}
		$data['list']=$res;
		return view('superadmin/ente_list.php',$data);
	}
	
	public function add()
	{ 	
		$common_data=$this->common_data();
		$data=$common_data;
		$list_nazioni=$this->NazioniModel->where('status','enable')->orderby("nazione",'asc')->findAll();
		$data['list_nazioni']=$list_nazioni;
		return view('superadmin/ente_add.php',$data);
	}
	
	public function add_form_submit(){
		$val = $this->validate([
				
				'email' => ['label' => 'Email' ,'rules' => 'trim|required|valid_email|is_unique[users.email]'],	
				'domain_ente' => ['label' => lang('app.field_server_name'), 'rules' => 'trim|required|is_unique[users.domain_ente]'],
				'expired_date' => ['label' =>  lang('app.field_expired_date') ,'rules' => 'trim|required'],	
				
		]);
		if (!$val)
		{
			
				$validation=$this->validator;
				$error_msg=$validation->listErrors();
				$res=array("error"=>true,"validation"=>$error_msg);
		}
		elseif(empty($this->request->getVar('type_cours'))){
			$res=array("error"=>true,"validation"=>lang('app.error_at_least_type_cours'));
		}
		elseif(($this->request->getVar('type')=='private' || $this->request->getVar('type')=='professional') && $this->request->getVar('fattura_cf')!="" && strlen($this->request->getVar('fattura_cf'))>16){
			$res=array("error"=>true,"validation"=>lang('app.error_cf_format'));
		}
		elseif(($this->request->getVar('type')=='company' || $this->request->getVar('type')=='professional') && $this->request->getVar('fattura_sdi')!="" && strlen($this->request->getVar('fattura_sdi'))>6){
			$res=array("error"=>true,"validation"=>lang('app.error_sdi_format'));
		}
		else{ 
				$password=random_string();
				if($this->request->getVar('type')=='company') $subscribe_name=$this->request->getVar('ragione_sociale');
				else $subscribe_name=$this->request->getVar('nome').' '.$this->request->getVar('cognome');
				$id_user =$this->UserModel->add('ente',$this->request->getVar('email'),$password,$subscribe_name,'yes','','',$this->request->getVar('domain_ente'));
				$tab=array( 		
				'user_id'=>$id_user,
				'type' => $this->request->getVar('type'),
				'piva' => $this->request->getVar('piva'),				
				'nome'=>$this->request->getVar('nome'),
				'cognome'=>$this->request->getVar('cognome'),
				'telefono' =>$this->request->getVar('telefono'),	
				'mobile' =>$this->request->getVar('mobile'),							
				'email' => $this->request->getVar('email'),	
				'email_private' => $this->request->getVar('email_private'),						
				'residenza_stato' =>$this->request->getVar('residenza_stato'),			
				'residenza_provincia' => $this->request->getVar('residenza_provincia'),
				'residenza_comune' =>$this->request->getVar('residenza_comune'),
				'residenza_indirizzo' =>$this->request->getVar('residenza_indirizzo'),			
				'residenza_cap' =>$this->request->getVar('residenza_cap'),	
				'nascita_data' => $this->request->getVar('nascita_data'),
				'nascita_stato' =>$this->request->getVar('nascita_stato'),				
				'nascita_provincia' =>$this->request->getVar('nascita_provincia'),
				'cf' => $this->request->getVar('cf'),
				'professione' =>$this->request->getVar('professione'),
				'disciplina' => $this->request->getVar('discipline'),
				'professione_citta' =>$this->request->getVar('professione_citta'),
				'abo' =>$this->request->getVar('abo'),
				'prof_albo' =>$this->request->getVar('prof_albo'),
				'posizione' => $this->request->getVar('posizione'),
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
				'dettagli' => $this->request->getVar('dettagli'),
				'description' => $this->request->getVar('description'),
				'del' =>$this->request->getVar('del'),
				'logo' => '',
				'fattura_nome'=>$this->request->getVar('fattura_nome'),
				'fattura_cognome'=>$this->request->getVar('fattura_cognome'),
				'site_web'=>$this->request->getVar('site_web'),
				'note'=>$this->request->getVar('note'),
				);

				$this->UserProfileModel->save($tab);
				 
				$tt=json_encode(array('type_cours'=>$this->request->getVar('type_cours'),'extra'=>$this->request->getVar('extra')),true);
				$expired_date=$this->request->getVar('expired_date');
				$this->EntePackageModel->insert(array("id_ente"=>$id_user,"package"=>$tt,"expired_date"=>$expired_date));
				
				$list_pages=$this->PagesModel->where('id_ente IS NULL')->find();
				foreach($list_pages as $k=>$v){
					$tab=$v;
					unset($tab['id']);
					$tab['id_ente']=$id_user;
					$this->PagesModel->insert($tab);
				}
				
				$list_pages=$this->TemplatesModel->where('id_ente IS NULL')->find();
				foreach($list_pages as $k=>$v){
					$tab=$v;
					unset($tab['id']);
					$tab['id_ente']=$id_user;
					$this->TemplatesModel->insert($tab);
				}
				############# send Email ################
				$common_data=$this->common_data();			
				$email = \Config\Services::email();
				$z=$email->setFrom($common_data['settings']['sender_email'],$common_data['settings']['sender_name']);		
				$email->setTo($this->request->getVar('email'));
				if(isset($common_data['settings']['bcc']) && $common_data['settings']['bcc']!="") $email->setBCC($common_data['settings']['bcc']);
				$link='https://'.$this->request->getVar('domain_ente').'/admin';
				$temp=$this->TemplatesModel->where('module','send_credential')->where('id_ente IS NULL')->find();
				$html=str_replace(array("{var_link}","{var_password}","{var_email}","{var_name}"),
				array($link,$password,$this->request->getVar('email'),$subscribe_name),
				$temp[0]['html']);
				$email->setSubject($temp[0]['subject']);
				$email->setMessage($html);
				$email->setAltMessage(strip_tags($html));
				$xxx=$email->send();
				$yy=$this->NotifLogModel->insert(array('id_participant'=>$id_user,'type'=>'email','user_to'=>$this->request->getVar('email'),'subject'=>$temp[0]['subject'],'message'=>$html,'date'=>date('Y-m-d H:i:s')));
					
				
				$res=array("error"=>false);
		}
		
		echo json_encode($res,true);
	}
	
	public function edit($id)
	{ 	
		$common_data=$this->common_data();
		$data=$common_data;
		if(is_null($id)) return redirect()->to(base_url('superadmin/ente'));
		
		$inf=$this->UserModel->find($id);
		$inf_profile=$this->UserProfileModel->where('user_id',$id)->first();
		$inf_package=$this->EntePackageModel->where('id_ente',$id)->orderBy('expired_date','DESC')->first();
		$list_nazioni=$this->NazioniModel->where('status','enable')->orderby("nazione",'asc')->findAll();
		if($inf_profile['residenza_stato']==106){
			$data['list_provincia']=$this->ProvinceModel->findAll();
			if($inf_profile['residenza_provincia']>0) $data['list_comuni']=$this->ComuniModel->where('id_prov',$inf_profile['residenza_provincia'])->findAll();
		}
		$data['inf']=$inf;
		$data['inf_profile']=$inf_profile;
		$data['inf_package']=$inf_package;
		$data['list_nazioni']=$list_nazioni;
		return view('superadmin/ente_edit.php',$data);
	}
	
	public function edit_form_submit(){
		$val = $this->validate([
				
				'email' => ['label' => 'Email' ,'rules' => 'trim|required|valid_email|is_unique[users.email,id,'.$this->request->getVar('id').']'],	
				'domain_ente' => ['label' => lang('app.field_server_name'), 'rules' => 'trim|required|is_unique[users.domain_ente,id,'.$this->request->getVar('id').']'],
				'expired_date' => ['label' =>  lang('app.field_expired_date') ,'rules' => 'trim|required'],	
				
		]);
		if (!$val)
		{
				
				$validation=$this->validator;
				$error_msg=$validation->listErrors();
				$res=array("error"=>true,"validation"=>$error_msg);
		}
		elseif(empty($this->request->getVar('type_cours'))){
			$res=array("error"=>true,"validation"=>lang('app.error_at_least_type_cours'));
		}
		elseif(($this->request->getVar('type')=='private' || $this->request->getVar('type')=='professional') && $this->request->getVar('fattura_cf')!="" && strlen($this->request->getVar('fattura_cf'))>16){
			$res=array("error"=>true,"validation"=>lang('app.error_cf_format'));
		}
		elseif(($this->request->getVar('type')=='company' || $this->request->getVar('type')=='professional') && $this->request->getVar('fattura_sdi')!="" && strlen($this->request->getVar('fattura_sdi'))>6){
			$res=array("error"=>true,"validation"=>lang('app.error_sdi_format'));
		}
		else{ 
				
				if($this->request->getVar('type')=='company') $subscribe_name=$this->request->getVar('ragione_sociale');
				else $subscribe_name=$this->request->getVar('nome').' '.$this->request->getVar('cognome');
				$id_user =$this->UserModel->edit($this->request->getVar('id'),array('email'=>$this->request->getVar('email'),'display_name'=>$subscribe_name,'domain_ente'=>$this->request->getVar('domain_ente')));
				$tab=array( 		
				
				'type' => $this->request->getVar('type'),
				'piva' => $this->request->getVar('piva'),				
				'nome'=>$this->request->getVar('nome'),
				'cognome'=>$this->request->getVar('cognome'),
				'telefono' =>$this->request->getVar('telefono'),	
				'mobile' =>$this->request->getVar('mobile'),							
				'email' => $this->request->getVar('email'),	
				'email_private' => $this->request->getVar('email_private'),						
				'residenza_stato' =>$this->request->getVar('residenza_stato'),			
				'residenza_provincia' => $this->request->getVar('residenza_provincia'),
				'residenza_comune' =>$this->request->getVar('residenza_comune'),
				'residenza_indirizzo' =>$this->request->getVar('residenza_indirizzo'),			
				'residenza_cap' =>$this->request->getVar('residenza_cap'),	
				'nascita_data' => $this->request->getVar('nascita_data'),
				'nascita_stato' =>$this->request->getVar('nascita_stato'),				
				'nascita_provincia' =>$this->request->getVar('nascita_provincia'),
				'cf' => $this->request->getVar('cf'),
				'professione' =>$this->request->getVar('professione'),
				'disciplina' => $this->request->getVar('discipline'),
				'professione_citta' =>$this->request->getVar('professione_citta'),
				'abo' =>$this->request->getVar('abo'),
				'prof_albo' =>$this->request->getVar('prof_albo'),
				'posizione' => $this->request->getVar('posizione'),
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
				'dettagli' => $this->request->getVar('dettagli'),
				'description' => $this->request->getVar('description'),
				'del' =>$this->request->getVar('del'),
				'logo' => '',
				'fattura_nome'=>$this->request->getVar('fattura_nome'),
				'fattura_cognome'=>$this->request->getVar('fattura_cognome'),
				'site_web'=>$this->request->getVar('site_web'),
				'note'=>$this->request->getVar('note'),
				);

				$this->UserProfileModel->update($this->request->getVar('id_profile'),$tab);
				
				$tt=json_encode(array('type_cours'=>$this->request->getVar('type_cours'),'extra'=>$this->request->getVar('extra')),true);
				$expired_date=$this->request->getVar('expired_date');
				$this->EntePackageModel->update($this->request->getVar('id_package'),array("package"=>$tt,"expired_date"=>$expired_date));
				$res=array("error"=>false);
		}
		
		echo json_encode($res,true);
	}
}