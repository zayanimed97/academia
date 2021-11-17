<?php namespace App\Controllers;

class Corsi extends BaseController
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
						$this->CorsiModel->update($id,array('banned'=>'yes'));
						$success=lang('app.success_delete');
					}
				break;
			}
		}
		$res=array();
		$ll=$this->CorsiModel->where('id_ente',$common_data['user_data']['id'])->where('banned','no')->find();
		foreach($ll as $kk=>$vv){
			$res[]=$vv;
		}
		
		$data['list']=$res;
		return view('admin/corsi.php',$data);
	}
	
	public function corsi_add(){
		$common_data=$this->common_data();
		$data=$common_data;
		$data['list_categorie']=$this->CategorieModel->where('id_ente',$common_data['user_data']['id'])->where('banned','no')->find();
		$data['list_argomenti']=$this->ArgomentiModel->where('id_ente',$common_data['user_data']['id'])->where('banned','no')->find();
		$data['list_prof']=$this->ProfessioneModel->where('id_ente',$common_data['user_data']['id'])->find();
		$data['list_doctors']=$this->UserModel->search('doctor',null,null,'yes',null,$common_data['user_data']['id']);
		$data['list_pdf']=$this->CorsiPDFLibModel->where('banned','no')->where('id_ente',$common_data['user_data']['id'])->findAll();
		return view('admin/corsi_add.php',$data);
	}
	
	public function add_form_submit(){
		//var_dump($_FILES);		
		$common_data=$this->common_data();
		$val = $this->validate([
				
				'titolo' => ['label' => lang('app.field_title'), 'rules' => 'trim|required'],	
				'sotto_titolo' => ['label' => lang('app.field_subtitle'), 'rules' => 'trim|required'],
				'tipologia_corsi' => ['label' => lang('app.field_type_cours'), 'rules' => 'trim|required'],	
				'tipologia_formazione' => ['label' => lang('app.field_type_formation'), 'rules' => 'trim|required'],	
				'ids_doctors' => ['label' => lang('app.field_doctors'), 'rules' => 'required'],
				//'id_categorie' => ['label' => lang('app.field_category'), 'rules' => 'required'],	
				//'id_argomenti' => ['label' => lang('app.field_argomenti'), 'rules' => 'trim|required'],	
				
				
		]);
		
		if (!$val)
		{
			
				$validation=$this->validator;
				$error_msg=$validation->listErrors();
				$res=array("error"=>true,"validation"=>$error_msg,"tabs_error"=>"tab_info");
		}
		
		else{
			if(!is_null($this->request->getVar('have_def_price'))){
				$val = $this->validate([
					'prezzo' => ['label' => lang('app.field_price'), 'rules' => 'trim|required|is_numeric|greater_than[0]'],	
				]);
			}
			if (!$val)
			{
				
					$validation=$this->validator;
					$error_msg=$validation->listErrors();
					$res=array("error"=>true,"validation"=>$error_msg,"tabs_error"=>"tab_price");
			}
			
			else{
				
			
					
			
				
				
				
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
							
							$avatar_logo->move(ROOTPATH.'public/uploads/corsi/',$logo_name);
						
						
						}
						else {$logo_name=null;
						$validation=$this->validator;
				 $error_msg=$validation->listErrors();
						}
					
			
				if(!is_null($this->request->getVar('active'))) $active="si"; else $active="no";
				if(!is_null($this->request->getVar('catalogo'))) $catalogo='si'; else $catalogo='no';
				if(!is_null($this->request->getVar('aggiornamento'))) $aggiornamento='si'; else $aggiornamento='no';
				if(!is_null($this->request->getVar('allegati_sbloccati'))) $allegati_sbloccati='si'; else $allegati_sbloccati='no';
				
				if(!empty($this->request->getVar('ids_doctors'))) $ids_doctors=implode(",",$this->request->getVar('ids_doctors')); else $ids_doctors=null;
				if(!empty($this->request->getVar('id_categorie'))) $id_categorie=implode(",",$this->request->getVar('id_categorie')); else $id_categorie=null;
				if(!empty($this->request->getVar('sottoargomenti'))) $sottoargomenti=implode(",",$this->request->getVar('sottoargomenti')); else $sottoargomenti=null;
				if(!empty($this->request->getVar('ids_professione'))) $ids_professione=implode(",",$this->request->getVar('ids_professione')); else $ids_professione=null;
				if(!empty($this->request->getVar('ids_disciplina'))) $ids_disciplina=implode(",",$this->request->getVar('ids_disciplina')); else $ids_disciplina=null;
				if(!empty($this->request->getVar('ids_pdf'))) $ids_pdf=implode(",",$this->request->getVar('ids_pdf')); else $ids_pdf=null;
				if(!is_null($this->request->getVar('have_def_price'))) $have_def_price='yes'; else $have_def_price='no';
				if(!is_null($this->request->getVar('slide'))) $slide='yes'; else $slide='no';
				if(!is_null($this->request->getVar('featured'))) $featured='yes'; else $featured='no';
				if(!is_null($this->request->getVar('attestato'))) $attestato="si"; else $attestato="no";
				//if(!is_null($this->request->getVar('buy_type'))) $active="si"; else $active="no";
				$buy_type=$this->request->getVar('buy_type');
				$url=url_title($this->request->getVar('sotto_titolo'));
				
				$x=true;
				while($x){
					$exist_url=$this->CorsiModel->where('url',$url)->find();
					if(!empty($exist_url)) $url=url_title($this->request->getVar('sotto_titolo'))."-".rand(0,99);
					else $x=false;
				}
				
				$data=array(				
				'url'=>strtolower($url),
				'titolo'=>$this->request->getVar('titolo'),
				'sotto_titolo'=>$this->request->getVar('sotto_titolo'),
				'id_ente' =>$common_data['user_data']['id'],		
				'ids_doctors' =>$ids_doctors ,		
				'id_categorie' =>$id_categorie,			
				'id_argomenti' => $this->request->getVar('id_argomenti'),
				'sottoargomenti' =>$sottoargomenti,			
				'tipologia_corsi' =>$this->request->getVar('tipologia_corsi'),
				'inscrizione_aula' => $this->request->getVar('inscrizione_aula'),
				'nb_person_aula' =>$this->request->getVar('nb_person_aula'),
				'tipologia_formazione' => $this->request->getVar('tipologia_formazione'),
				'prezzo' =>$this->request->getVar('prezzo'),
				'ids_professione' =>$ids_professione,
				'ids_disciplina' =>$ids_disciplina,						
				'id_obiettivo' =>$this->request->getVar('id_obiettivo'),
				'seo_title' =>$this->request->getVar('seo_title'),
				'seo_description' =>$this->request->getVar('seo_description'),
				'descizione' =>$this->request->getVar('descizione'),
				'programa' =>$this->request->getVar('programa'),
				'note' =>$this->request->getVar('note'),
				'riferimenti' =>$this->request->getVar('riferimenti'),
				'indrizzato_a' =>$this->request->getVar('indrizzato_a'),
				'obiettivi' =>$this->request->getVar('obiettivi'),
				'avvisi' =>$this->request->getVar('avvisi'),
				'foto' => $logo_name,
				'ids_pdf' => $ids_pdf,						
				'status'=>$active,
				'have_def_price' =>$have_def_price,
				'edition'=>$this->request->getVar('edition'),
				'slide'=>$slide,
				'featured'=>$featured,
				'video_promo'=>$this->request->getVar('video_promo'),	
				'test_required'=>$this->request->getVar('test_required'),
				'attestato' =>$attestato,//$this->request->getVar('attestato'),
				'buy_type'=>$buy_type,
				'banned'=>'no',
				'updated_at'=>date('Y-m-d H:i:s')
				);
				
				
					$id_corsi=$this->CorsiModel->insert($data);	
			//var_dump($_FILES["corsigallery"]);
		
			if(null !==$this->request->getVar('prezzo_prof')){
						foreach($this->request->getVar('prezzo_prof') as $kk=>$vv){
							if($vv['prezzo_prof']!=""){ 
								
								$this->CorsiPrezzoProfModel->insert(array(
									'id_corsi'=>$id_corsi,
									'prezzo'=>$vv['prezzo_prof'],
									'id_professione'=>$vv['prezzo_prof_id'],
								));
							}
						}
					}
							
			if ($this->request->getFileMultiple('gallery')) {
 
					 foreach($this->request->getFileMultiple('gallery') as $file)
					 {   
						$type = $file->getMimeType();
						 if(in_array($type,array('image/jpg','image/jpeg','image/gif','image/png'))){
							$logo_name = $file->getRandomName();
							$file->move(ROOTPATH.'public/uploads/corsi/'.$id_corsi.'/',$logo_name);
							  $data = [
								'foto' =>  $logo_name,
								'id_corsi'  => $id_corsi
							  ];
				 
							  $save = $this->CorsiGalleriaModel->insert($data);
						 }
					 }
				}
			
				
				
				
				$res=array("error"=>false,'redirect_url'=>base_url('admin/corsi/'.$id_corsi.'/modulo/add'));
			}
		}
		
		echo json_encode($res,true);
	}
}