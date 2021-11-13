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
				$vv['ente']=$inf_profile['nome'].' '.$inf_profile['cognome'];
			}
			$vv['expired_date']=$inf_package['expired_date'];
			$pack=json_decode($inf_package['package'],true);
			ob_start();?>
			<ul>
				<li><?php echo lang('app.field_type_cours')?>: <?php echo implode(",",$pack['type_cours']);?></li>
				<li><?php echo lang('app.field_package_extra')?>: <?php echo implode(",",$pack['extra']);?></li>
			</ul>
			<?php 
			$vv['package']=ob_get_clean();
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
				//'type_cours' => ['label' =>  lang('app.field_type_cours') ,'rules' => 'trim|require'],
		]);
		if (!$val)
		{
				//var_dump($this->validator);
				$validation=$this->validator;
				$error_msg=$validation->listErrors();
				$res=array("error"=>true,"validation"=>$error_msg);
		}
		elseif(empty($this->request->getVar('type_cours'))){
			$res=array("error"=>true,"validation"=>lang('app.error_at_least_type_cours'));
		}
		else{ 
				$password=random_string();
				$subscribe_name=$this->request->getVar('nome').' '.$this->request->getVar('cognome');
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
				//'argomenti' => $argo,
				'del' =>$this->request->getVar('del'),
				'logo' => ''
				);

				$this->UserProfileModel->save($tab);
				
				//if(!is_null($this->request->getVar('type_cours'))) 
					$tt=json_encode(array('type_cours'=>$this->request->getVar('type_cours'),'extra'=>$this->request->getVar('extra')),true);
				$expired_date=$this->request->getVar('expired_date');
				$this->EntePackageModel->insert(array("id_ente"=>$id_user,"package"=>$tt,"expired_date"=>$expired_date));
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
				//var_dump($this->validator);
				$validation=$this->validator;
				$error_msg=$validation->listErrors();
				$res=array("error"=>true,"validation"=>$error_msg);
		}
		elseif(empty($this->request->getVar('type_cours'))){
			$res=array("error"=>true,"validation"=>lang('app.error_at_least_type_cours'));
		}
		else{ 
				
				$subscribe_name=$this->request->getVar('nome').' '.$this->request->getVar('cognome');
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
				//'argomenti' => $argo,
				'del' =>$this->request->getVar('del'),
				'logo' => ''
				);

				$this->UserProfileModel->update($this->request->getVar('id_profile'),$tab);
				
				//if(!is_null($this->request->getVar('type_cours'))) 
					$tt=json_encode(array('type_cours'=>$this->request->getVar('type_cours'),'extra'=>$this->request->getVar('extra')),true);
				$expired_date=$this->request->getVar('expired_date');
				$this->EntePackageModel->update($this->request->getVar('id_package'),array("package"=>$tt,"expired_date"=>$expired_date));
					$res=array("error"=>false);
		}
		
		echo json_encode($res,true);
	}
}