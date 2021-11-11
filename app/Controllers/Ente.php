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
		$list_nazioni=$this->NazioniModel->where('status','enable')->orderby("nazione",'asc')->findAll();
		$data['list_nazioni']=$list_nazioni;
		return view('superadmin/ente_add.php',$data);
	}
	
	public function add_form_submit(){
		$val = $this->validate([
				
				'email' => ['label' => 'Email' ,'rules' => 'trim|required|valid_email|is_unique[users.email]'],	
				'domain_ente' => ['label' => lang('app.field_server_name'), 'rules' => 'trim|required'],
		]);
		if (!$val)
		{
				//var_dump($this->validator);
				$validation=$this->validator;
				$error_msg=$validation->listErrors();
				$res=array("error"=>true,"validation"=>$error_msg);
		}
		else{ 
				$password=random_string();
				$subscribe_name=$this->request->getVar('nome').' '.$this->request->getVar('cognome');
				$id_user =$this->UserModel->add('ente',$this->request->getVar('email'),$password,$subscribe_name,'yes','');
				$tab=array( 		
				'user_id'=>$id_user,
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
}