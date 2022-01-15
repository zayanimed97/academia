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
					$id=$this->request->getVar('id');
					if($id!=""){
						$this->CorsiModel->update($id,array('banned'=>'yes'));
						$list_module=$this->CorsiModuloModel->where('id_corsi',$id)->findAll();
						foreach($list_module as $k=>$v){
							$this->CorsiModuloModel->update($v['id'],array('banned'=>'yes'));
						}
						$success=lang('app.success_delete');
					}
				break;
			}
		}
		$res=array();
		$ll=$this->CorsiModel->where('id_ente',$common_data['user_data']['id'])->where('banned','no')->find();
		foreach($ll as $kk=>$vv){
			if($vv['free']=='yes') $vv['price']=lang('app.field_free_cours_2');
			elseif($vv['have_def_price']=='no'){
				$vv['price']=lang('app.have_def_price_2');
			}
			else $vv['price']=$vv['prezzo'];
			$vv['nb_module']=$this->CorsiModuloModel->where('banned','no')->where('id_corsi',$vv['id'])->countAllResults();
			$tt=explode(",",$vv['ids_doctors']);
			$str_docente="";
			foreach($tt as $d){
				$inf_profile=$this->UserProfileModel->where('user_id',$d)->first();
				$str_docente.= ($inf_profile['nome'] ?? '') .' '.($inf_profile['cognome'] ?? '').'<br/>';
			}
			$vv['docente']=$str_docente;
			$luoghi_label="";
			if($vv['tipologia_corsi']=="aula" && $vv['id_luoghi']!==null){
				$inf_luoghi=$this->LuoghiModel->find($vv['id_luoghi']);
				$luoghi_label=$inf_luoghi['nome'];
			}
			$vv['luoghi_label']=$luoghi_label;
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
		$data['list_test']=$this->CorsiModuloTestModel->where('banned','no')->where('id_ente',$common_data['user_data']['id'])->findAll();
		$list_luoghi=$this->LuoghiModel->where('banned','no')->where('id_ente',$common_data['user_data']['id'])->orderby("nome",'asc')->findAll();
		$data['list_luoghi']=$list_luoghi;
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
			if(!is_null($this->request->getVar('have_def_price')) && $this->request->getVar('free')=='no'){
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
			elseif($this->request->getVar('test_required')!==null && $this->request->getVar('test_required')=='per_corsi' &&( empty($this->request->getVar('ids_test')) || $this->request->getVar('min_points')=="")){
				$error_msg=lang('app.error_corsi_test');
				$res=array("error"=>true,"validation"=>$error_msg,"tabs_error"=>"tab_test");
			}
			elseif($this->request->getVar('test_required')!==null && $this->request->getVar('test_required')=='per_modulo' && $this->request->getVar('min_modulo')==""){
				$error_msg=lang('app.error_required');
				$res=array("error"=>true,"validation"=>$error_msg,"tabs_error"=>"tab_test");
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
					
			
				if(!is_null($this->request->getVar('enable'))) $active="si"; else $active="no";
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
				//if(!is_null($this->request->getVar('test_required'))) $test_required="si"; else $test_required="no";
				$test_required=$this->request->getVar('test_required');
				if(!is_null($this->request->getVar('stop_next_modulo')) && $this->request->getVar('buy_type')=='cours') $stop_next_modulo="yes"; else $stop_next_modulo="no";
				if($test_required=='cours') $min_points=$this->request->getVar('min_points'); else $min_points=$this->request->getVar('min_modulo');
				
				//if(!is_null($this->request->getVar('buy_type'))) $active="si"; else $active="no";
				$buy_type=$this->request->getVar('buy_type');
				if($this->request->getVar('free')=='yes') $buy_type="cours";
				$url=url_title($this->request->getVar('sotto_titolo'));
				
				$x=true;
				while($x){
					$exist_url=$this->CorsiModel->where('url',$url)->where('id_ente',$common_data['user_data']['id'])->find();
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
				'vat'=>$this->request->getVar('vat'),
				'slide'=>$slide,
				'featured'=>$featured,
				'video_promo'=>$this->request->getVar('video_promo'),	
				'test_required'=>$test_required,
				'min_points'=>$min_points,
				'attestato' =>$attestato,//$this->request->getVar('attestato'),
				'buy_type'=>$buy_type,
				'stop_next_modulo'=>$stop_next_modulo,
				'free'=>$this->request->getVar('free'),
				'codice'=>$this->request->getVar('codice'),
				'duration'=>$this->request->getVar('duration'),
				'difficulte'=>$this->request->getVar('difficulte'),
				'banned'=>'no',
				'id_luoghi' =>$this->request->getVar('id_luoghi'),
				'id_alberghi' =>$this->request->getVar('id_alberghi'),
				'updated_at'=>date('Y-m-d H:i:s')
				);
				
				
					$id_corsi=$this->CorsiModel->insert($data);	
			//var_dump($_FILES["corsigallery"]);
		
			if(null !==$this->request->getVar('prezzo_prof') && $this->request->getVar('free')=='no'){
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
			
				if($this->request->getVar('test_required')=='per_corsi'){
						foreach($this->request->getVar('ids_test') as $kk=>$vv){
							if($vv!=""){ 
								
								$this->TestModuloModel->insert(array(
									'id_corsi'=>$id_corsi,
									'id_test'=>$vv,
									'id_modulo'=>null,
									'banned'=>'no'
								));
							}
						}
					}
				
				
				$res=array("error"=>false,'redirect_url'=>base_url('admin/corsi/'.$id_corsi.'/modulo/add'));
			}
		}
		
		echo json_encode($res,true);
	}
	
	
	public function corsi_modulo($id_corsi)
	{ 	
		$common_data=$this->common_data();
		$data=$common_data;
		$verify=$this->CorsiModel->where('id_ente',$common_data['user_data']['id'])->where('id',$id_corsi)->find();
		if(empty($verify)) return redirect()->to(base_url('admin/corsi'));
		if($this->request->getVar('action')!==null){			
			switch($this->request->getVar('action')){
				case 'delete':
					$id=$this->request->getVar('id');
					if($id!=""){
						$this->CorsiModuloModel->update($id,array('banned'=>'yes'));
						$success=lang('app.success_delete');
					}
				break;
			}
		}
		$str_doctors="";
	$inf_corsi=$this->CorsiModel->find($id_corsi);
		$tt=explode(",",$inf_corsi['ids_doctors']);
		if(!empty($tt)){
			foreach($tt as $one){
				$inf_doctor=$this->UserProfileModel->where('user_id',$one)->first();
				if(!empty($inf_doctor)) $str_doctors.=$inf_doctor['nome'].' '.$inf_doctor['cognome'].", ";
				else $str_doctors="";
			}
		}else $str_doctors="";
			$inf_corsi['list_doctors']=$str_doctors;
			$data['inf_corsi']=$inf_corsi;
			
			
			$luoghi_label="";
			if($inf_corsi['tipologia_corsi']=="aula" && $inf_corsi['id_luoghi']!==null){
				$inf_luoghi=$this->LuoghiModel->find($inf_corsi['id_luoghi']);
				$luoghi_label=$inf_luoghi['nome'];
				if( $inf_corsi['id_alberghi']!==null){
					$inf_luoghi=$this->AlberghiModel->find($inf_corsi['id_alberghi']);
					$luoghi_label.=" - ".$inf_luoghi['nome'];
				}
			}
			$data['luoghi_label']=$luoghi_label;
			
			
		$res=array();
		
		$ll=$this->CorsiModuloModel->where('id_corsi',$id_corsi)->where('banned','no')->find();
		foreach($ll as $kk=>$vv){
			$inf_doctor=$this->UserProfileModel->where('user_id',$vv['instructor'])->first();
				if(!empty($inf_doctor)) $vv['instructor']=$inf_doctor['nome'].' '.$inf_doctor['cognome'];
			else $vv['instructor']='';
			if($vv['free']=='yes') $vv['price']=lang('app.field_free_modulo');
			elseif($vv['have_def_price']=='no'){
				$vv['price']=lang('app.have_def_price');
			}
			else $vv['price']=$vv['prezzo'];
			
			$achat=$this->ParticipationModel->where('banned','no')->where('id_modulo',$vv['id'])->countAllResults();
			$vv['achat']=$achat;
			$res[]=$vv;
		}
		
		$data['list']=$res;
		return view('admin/corsi_modulo.php',$data);
	}
	
	public function corsi_modulo_all(){		
		$common_data=$this->common_data();
		$data=$common_data;
		if($this->request->getVar('action')!==null){			
			switch($this->request->getVar('action')){
				case 'delete':
					$id=$this->request->getVar('id');
					if($id!=""){
						$this->CorsiModuloModel->update($id,array('banned'=>'yes'));
						$success=lang('app.success_delete');
					}
				break;
			}
		}
		if($this->request->getVar('search')!==null) $data['search_form']=$_REQUEST;
		if($this->request->getVar('id_corsi')!=null) $id_corsi=$this->request->getVar('id_corsi'); else $id_corsi=null;
		if($this->request->getVar('instructor')!=null) $instructor=$this->request->getVar('instructor'); else $instructor=null;
		if($this->request->getVar('tipologia_corsi')!=null) $tipologia_corsi=$this->request->getVar('tipologia_corsi'); else $tipologia_corsi=null;
		if($this->request->getVar('buy_type')!=null) $buy_type=$this->request->getVar('buy_type'); else $buy_type=null;
		if($this->request->getVar('free_modulo')!=null) $free_modulo=$this->request->getVar('free_modulo'); else $free_modulo=null;
		$ll=$this->CorsiModuloModel->search($common_data['user_data']['id'],$id_corsi,$instructor,$tipologia_corsi,$buy_type,$free_modulo);//where('banned','no')->whereIN("FIND_IN_SET(id_corsi,)>0")
		$res=array();
		foreach($ll as $kk=>$vv){
			$inf_corsi=$this->CorsiModel->find($vv['id_corsi']);
			$vv['cour']=$inf_corsi['sotto_titolo'];
			$vv['tipologia_corsi']=$inf_corsi['tipologia_corsi'];
			$luoghi_label="";
			if($inf_corsi['tipologia_corsi']=="aula" && $inf_corsi['id_luoghi']!==null){
				$inf_luoghi=$this->LuoghiModel->find($inf_corsi['id_luoghi']);
				$luoghi_label=$inf_luoghi['nome'];
			}
			$vv['luoghi_label']=$luoghi_label;
			$inf_doctor=$this->UserProfileModel->where('user_id',$vv['instructor'])->first();
			if(!empty($inf_doctor)) $vv['instructor']=$inf_doctor['nome'].' '.$inf_doctor['cognome'];
			else $vv['instructor']="";
			if($vv['free']=='yes') $vv['price']=lang('app.field_free_modulo');
			elseif($vv['have_def_price']=='no'){
				$vv['price']=lang('app.have_def_price');
			}
			else $vv['price']=$vv['prezzo'];
			
			$achat=$this->ParticipationModel->where('banned','no')->where('id_modulo',$vv['id'])->countAllResults();
			$vv['achat']=$achat;
			
			$res[]=$vv;
		}
		
		$data['list']=$res;
		$data['list_doctors']=$this->UserModel->search('doctor',null,null,'yes',null,$common_data['user_data']['id']);
		$data['list_cours']=$this->CorsiModel->where('id_ente',$common_data['user_data']['id'])->where('banned','no')->find();
		return view('admin/corsi_modulo_all.php',$data);
	}
	
	public function corsi_modulo_add($id_corsi){
		$common_data=$this->common_data();
		$data=$common_data;
		$data['inf_corsi']=$this->CorsiModel->find($id_corsi);
		$data['list_categorie']=$this->CategorieModel->where('id_ente',$common_data['user_data']['id'])->where('banned','no')->find();
		$data['list_argomenti']=$this->ArgomentiModel->where('id_ente',$common_data['user_data']['id'])->where('banned','no')->find();
		$data['list_prof']=$this->ProfessioneModel->where('id_ente',$common_data['user_data']['id'])->find();
		$data['list_doctors']=$this->UserModel->search('doctor',null,null,'yes',null,$common_data['user_data']['id']);
		$data['list_pdf']=$this->CorsiPDFLibModel->where('banned','no')->where('id_ente',$common_data['user_data']['id'])->findAll();
		return view('admin/corsi_modulo_add.php',$data);
	}
	
	public function modulo_add_form_submit(){
		$inf_corsi=$this->CorsiModel->find($this->request->getVar('id_corsi'));
		$free=$inf_corsi['free'];
		if(!is_null($this->request->getVar('free'))) $free=$this->request->getVar('free');
		$common_data=$this->common_data();
		$val = $this->validate([
				
				'titolo' => ['label' => lang('app.field_title'), 'rules' => 'trim|required'],	
				'sotto_titolo' => ['label' => lang('app.field_subtitle'), 'rules' => 'trim|required'],					
				'instructor' => ['label' => lang('app.field_doctors'), 'rules' => 'required'],
				'ord' => ['label' => lang('app.field_sort'), 'rules' => 'required|integer|greater_than[0]'],	
				//'id_argomenti' => ['label' => lang('app.field_argomenti'), 'rules' => 'trim|required'],	
				
				
		]);
		
		if (!$val)
		{
			
				$validation=$this->validator;
				$error_msg=$validation->listErrors();
				$res=array("error"=>true,"validation"=>$error_msg,"tabs_error"=>"tab_info");
		}
		
		else{
			if(!is_null($this->request->getVar('have_def_price')) && $free=='no'){
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
			elseif($inf_corsi['test_required']=='per_modulo' && ($this->request->getVar('min_points')=="" || empty($this->request->getVar('ids_test')))){
				$error_msg=lang('app.error_corsi_test');
				$res=array("error"=>true,"validation"=>$error_msg,"tabs_error"=>"tab_test");
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
					
			
				if(!is_null($this->request->getVar('enable'))) $active="si"; else $active="no";
				
				
				if(!empty($this->request->getVar('instructor'))) $ids_doctors=$this->request->getVar('instructor'); else $ids_doctors=null;
				
				if(!empty($this->request->getVar('ids_pdf'))) $ids_pdf=implode(",",$this->request->getVar('ids_pdf')); else $ids_pdf=null;
				if(!is_null($this->request->getVar('have_def_price'))) $have_def_price='yes'; else $have_def_price='no';
			//	if(!is_null($this->request->getVar('slide'))) $slide='yes'; else $slide='no';
				//if(!is_null($this->request->getVar('featured'))) $featured='yes'; else $featured='no';
				if(!is_null($this->request->getVar('attestato'))) $attestato="si"; else $attestato="no";
				if(!is_null($this->request->getVar('test_required'))) $test_required="si"; else $test_required="no";
				if(!is_null($this->request->getVar('cuepoint_block'))) $cuepoint_block='yes'; else $cuepoint_block='no';
				$url=url_title($this->request->getVar('sotto_titolo'));
				
				$x=true;
				while($x){
					$exist_url=$this->CorsiModuloModel->where('url',$url)->find();
					if(!empty($exist_url)) $url=url_title($this->request->getVar('sotto_titolo'))."-".rand(0,99);
					else $x=false;
				}
				
				$data=array(				
				'url'=>strtolower($url),
				'ord'=>$this->request->getVar('ord'),
				'titolo'=>$this->request->getVar('titolo'),
				'sotto_titolo'=>$this->request->getVar('sotto_titolo'),
				'id_corsi' =>$this->request->getVar('id_corsi'),
				'instructor' =>$ids_doctors ,		
				'tipologia' =>'',
				'prezzo' =>$this->request->getVar('prezzo'),
				
				'seo_title' =>$this->request->getVar('seo_title'),
				'seo_description' =>$this->request->getVar('seo_description'),
				'description' =>$this->request->getVar('descizione'),
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
				'codice'=>$this->request->getVar('codice'),
				'crediti'=>$this->request->getVar('crediti'),
				'video_promo'=>$this->request->getVar('video_promo'),	
				'test_required'=>$test_required,
				'attestato' =>$attestato,//$this->request->getVar('attestato'),
				'edition'=>$this->request->getVar('edition'),	
				'min_points'=>$this->request->getVar('min_points'),	
				'banned'=>'no',
				'inscrizione_aula' => $this->request->getVar('inscrizione_aula') ?? 'no',
				'nb_person_aula' =>$this->request->getVar('nb_person_aula') ?? '0',
				'duration' =>$this->request->getVar('duration'),
				'difficulte' =>$this->request->getVar('difficulte'),
				'free'=>$free,
				'cuepoint_block'=>$cuepoint_block
			
				);
				
				
					$id_modulo=$this->CorsiModuloModel->insert($data);	
			//var_dump($_FILES["corsigallery"]);
		
			if(null !==$this->request->getVar('prezzo_prof') && $free=='no'){
						foreach($this->request->getVar('prezzo_prof') as $kk=>$vv){
							if($vv['prezzo_prof']!=""){ 
								
								$this->CorsiModuloPrezzoProfModel->insert(array(
									'id_modulo'=>$id_modulo,
									'prezzo'=>$vv['prezzo_prof'],
									'id_professione'=>$vv['prezzo_prof_id'],
								));
							}
						}
					}
					
					if(null !==$this->request->getVar('corsidate')){
						foreach($this->request->getVar('corsidate') as $kk=>$vv){
							
							if($vv['date']!=""){ 
								/*$dt=explode("/",$vv['date']);
								$date=$dt[2]."-".$dt[1]."-".$dt[0];*/
								$date=$vv['date'];
								$this->CorsiModuloDateModel->insert(array(
									'id_modulo'=>$id_modulo,
									'date'=>$date,
									'incontro'=>$vv['incontro'],
									'start_time'=>$vv['start_time'],
									'end_time'=>$vv['end_time'],
									'zoom_url'=>$vv['zoom_url'] ?? null,
								));
							}
						}
					}			
				if(null !==$this->request->getVar('corsivimeo')){
						foreach($this->request->getVar('corsivimeo') as $kk=>$vv){
							
							if($vv['vimeo']!=""){ 
								if(isset($vv['vimeo_enable'])) $vimeo_enable='yes'; else $vimeo_enable='no';
								$this->CorsiModuloVimeoModel->insert(array(
									'id_modulo'=>$id_modulo,
									'vimeo'=>$vv['vimeo'],
									'ord'=>$vv['ord'],
									'enable'=>$vimeo_enable,
									'banned'=>'no'	
								));
							}
						}
					}							
				
				if(!empty($this->request->getVar('ids_test'))){
						foreach($this->request->getVar('ids_test') as $kk=>$vv){
							if($vv!=""){ 
								
								$this->TestModuloModel->insert(array(
									'id_modulo'=>$id_modulo,
									'id_test'=>$vv,
									'id_corsi'=>$this->request->getVar('id_corsi'),
									'banned'=>'no'
								));
							}
						}
					}
					
				$res=array("error"=>false);
			}
		}
		
		echo json_encode($res,true);
	}
	
	 public function corsi_edit($id_corsi){
		$common_data=$this->common_data();
		$data=$common_data;
		$data['list_categorie']=$this->CategorieModel->where('id_ente',$common_data['user_data']['id'])->where('banned','no')->find();
		$data['list_argomenti']=$this->ArgomentiModel->where('id_ente',$common_data['user_data']['id'])->where('banned','no')->find();
		$data['list_prof']=$this->ProfessioneModel->where('id_ente',$common_data['user_data']['id'])->find();
		$data['list_doctors']=$this->UserModel->search('doctor',null,null,'yes',null,$common_data['user_data']['id']);
		$data['list_pdf']=$this->CorsiPDFLibModel->where('banned','no')->where('id_ente',$common_data['user_data']['id'])->findAll();
		$data['list_test']=$this->CorsiModuloTestModel->where('banned','no')->where('id_ente',$common_data['user_data']['id'])->findAll();
		$data['inf_corsi']=$this->CorsiModel->where('id_ente',$common_data['user_data']['id'])->where('id',$id_corsi)->first();
		
		if(empty($data['inf_corsi'])) return redirect()->to(base_url('admin/corsi'));
		if($data['inf_corsi']['id_argomenti']!="")
			$data['list_sottoargomenti']=$this->SottoargomentiModel->where('banned','no')->where('id_argomenti',$data['inf_corsi']['id_argomenti'])->findAll();
		
		
		$data['list_prezzo_prof']=$this->CorsiPrezzoProfModel->where('id_corsi',$id_corsi)->find();
		$data['gal']=$this->CorsiGalleriaModel->where('banned','no')->where('id_corsi',$id_corsi)->find();
		if($data['inf_corsi']['ids_pdf']!=""){
			$tt=explode(",",$data['inf_corsi']['ids_pdf']);
			foreach($tt as $vv){
				$data['corsi_pdf'][]=$this->CorsiPDFLibModel->find($vv);
			}
		}
		$ll=$this->TestModuloModel->where('banned','no')->where('id_corsi',$id_corsi)->where('id_modulo IS NULL')->find();
		if(!empty($ll)){
			foreach($ll as $kk=>$vv){
				$inf_test=$this->CorsiModuloTestModel->find($vv['id_test']);
				$data['corsi_test'][]=$inf_test;
			}
		}
		
		$list_luoghi=$this->LuoghiModel->where('banned','no')->where('id_ente',$common_data['user_data']['id'])->orderby("nome",'asc')->findAll();
		$data['list_luoghi']=$list_luoghi;
		$list_alberghi=$this->AlberghiModel->where('banned','no')->where('id_ente',$common_data['user_data']['id'])->where('idluogo',$data['inf_corsi']['id_luoghi'])->orderby('nome','ASC')->findAll();
		$data['list_alberghi']=$list_alberghi;
		return view('admin/corsi_edit.php',$data);
	}
	
	public function edit_form_submit(){
		//var_dump($_FILES);		
		$common_data=$this->common_data();
		$id_corsi=$this->request->getVar('id_corsi');
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
			if(!is_null($this->request->getVar('have_def_price')) && $this->request->getVar('free')=='no'){
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
			elseif($this->request->getVar('test_required')!==null && $this->request->getVar('test_required')=='per_corsi' &&( empty($this->request->getVar('ids_test')) || $this->request->getVar('min_points')=="")){
				$error_msg=lang('app.error_corsi_test');
				$res=array("error"=>true,"validation"=>$error_msg,"tabs_error"=>"tab_test");
			}
			elseif($this->request->getVar('test_required')!==null && $this->request->getVar('test_required')=='per_modulo' && $this->request->getVar('min_modulo')==""){
				$error_msg=lang('app.error_required');
				$res=array("error"=>true,"validation"=>$error_msg,"tabs_error"=>"tab_test");
			}
			else{
				
			
					
			
				
				
				
				 
					
			
				if(!is_null($this->request->getVar('enable'))) $active="si"; else $active="no";
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
				
				//if(!is_null($this->request->getVar('test_required'))) $test_required="si"; else $test_required="no";
				$test_required=$this->request->getVar('test_required');
				if(!is_null($this->request->getVar('stop_next_modulo')) && $this->request->getVar('buy_type')=='cours') $stop_next_modulo="yes"; else $stop_next_modulo="no";
				if($test_required=='cours') $min_points=$this->request->getVar('min_points'); else $min_points=$this->request->getVar('min_modulo');
				
				//if(!is_null($this->request->getVar('buy_type'))) $active="si"; else $active="no";
				$buy_type=$this->request->getVar('buy_type');
				if($this->request->getVar('free')=='yes') $buy_type="cours";
				$url=url_title($this->request->getVar('sotto_titolo'));
				
				$x=true;
				while($x){
					$exist_url=$this->CorsiModel->where('url',$url)->where('id_ente',$common_data['user_data']['id'])->find();
					if(!empty($exist_url) && $exist_url[0]['id']!=$id_corsi) $url=url_title($this->request->getVar('sotto_titolo'))."-".rand(0,99);
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
				
				'ids_pdf' => $ids_pdf,						
				'status'=>$active,
				'have_def_price' =>$have_def_price,
				'vat'=>$this->request->getVar('vat'),
				'slide'=>$slide,
				'featured'=>$featured,
				'video_promo'=>$this->request->getVar('video_promo'),	
				'test_required'=>$test_required,
				'min_points'=>$min_points,
				'attestato' =>$attestato,//$this->request->getVar('attestato'),
				'buy_type'=>$buy_type,
				'stop_next_modulo'=>$stop_next_modulo,
				'free'=>$this->request->getVar('free'),
				'codice'=>$this->request->getVar('codice'),
				'duration'=>$this->request->getVar('duration'),
				'difficulte'=>$this->request->getVar('difficulte'),
				//'banned'=>'no',
				'id_luoghi' =>$this->request->getVar('id_luoghi'),
				'id_alberghi' =>$this->request->getVar('id_alberghi'),
				'updated_at'=>date('Y-m-d H:i:s')
				);
				
				if($this->request->getVar('delete_foto')=='yes'){
					$data['foto']="";
				}
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
							$data['foto']=$logo_name;
						
						}
						
				
					$this->CorsiModel->update($id_corsi,$data);	
			//var_dump($_FILES["corsigallery"]);
			$this->CorsiPrezzoProfModel->where('id_corsi',$id_corsi)->delete();
			if(null !==$this->request->getVar('prezzo_prof') && $this->request->getVar('free')=='no'){
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
			
			
			if(!empty($this->request->getVar('delete_gal'))){
					foreach($this->request->getVar('delete_gal') as $k=>$v){
						$this->CorsiGalleriaModel->delete($v);
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
			
				$this->TestModuloModel->where('id_corsi',$id_corsi)->where('id_modulo IS NULL')->delete();
				if($this->request->getVar('test_required')=='per_corsi'){
						foreach($this->request->getVar('ids_test') as $kk=>$vv){
							if($vv!=""){ 
								
								$this->TestModuloModel->insert(array(
									'id_corsi'=>$id_corsi,
									'id_test'=>$vv,
									'id_modulo'=>null,
									'banned'=>'no'
								));
							}
						}
					}
				
				
				$res=array("error"=>false,'redirect_url'=>base_url('admin/corsi/'.$id_corsi.'/modulo/add'));
			}
		}
		
		echo json_encode($res,true);
	}
	
	public function corsi_modulo_edit($id_corsi,$id_modulo){
		$common_data=$this->common_data();
		$data=$common_data;
		$data['inf_corsi']=$this->CorsiModel->find($id_corsi);
		$data['list_categorie']=$this->CategorieModel->where('id_ente',$common_data['user_data']['id'])->where('banned','no')->find();
		$data['list_argomenti']=$this->ArgomentiModel->where('id_ente',$common_data['user_data']['id'])->where('banned','no')->find();
		$data['list_prof']=$this->ProfessioneModel->where('id_ente',$common_data['user_data']['id'])->find();
		$data['list_doctors']=$this->UserModel->search('doctor',null,null,'yes',null,$common_data['user_data']['id']);
		$data['list_pdf']=$this->CorsiPDFLibModel->where('banned','no')->where('id_ente',$common_data['user_data']['id'])->findAll();
		$data['inf_modulo']=$this->CorsiModuloModel->where('id_corsi',$id_corsi)->where('id',$id_modulo)->first();
		$data['list_prezzo_prof']=$this->CorsiModuloPrezzoProfModel->where('id_modulo',$id_modulo)->find();
	
		if($data['inf_modulo']['ids_pdf']!=""){
			$tt=explode(",",$data['inf_modulo']['ids_pdf']);
			foreach($tt as $vv){
				$data['corsi_pdf'][]=$this->CorsiPDFLibModel->find($vv);
			}
		}
		$ll=$this->TestModuloModel->where('banned','no')->where('id_modulo',$id_modulo)->find();
		if(!empty($ll)){
			foreach($ll as $kk=>$vv){
				$inf_test=$this->CorsiModuloTestModel->find($vv['id_test']);
				$data['corsi_test'][]=$inf_test;
			}
		}
		if($data['inf_corsi']['tipologia_corsi']=='online')
			$data['corsi_vimeo']=$this->CorsiModuloVimeoModel->where('banned','no')->where('id_modulo',$id_modulo)->orderBy('ord','ASC')->find();
		else 
			$data['corsi_date']=$this->CorsiModuloDateModel->where('banned','no')->where('id_modulo',$id_modulo)->orderBy('incontro','ASC')->find();
		return view('admin/corsi_modulo_edit.php',$data);
	}
	
	public function modulo_edit_form_submit(){
		$id_modulo=$this->request->getVar('id_modulo');
		$inf_corsi=$this->CorsiModel->find($this->request->getVar('id_corsi'));
		$free=$inf_corsi['free'];
		if(!is_null($this->request->getVar('free'))) $free=$this->request->getVar('free');
		$common_data=$this->common_data();
		$val = $this->validate([
				
				'titolo' => ['label' => lang('app.field_title'), 'rules' => 'trim|required'],	
				'sotto_titolo' => ['label' => lang('app.field_subtitle'), 'rules' => 'trim|required'],					
				'instructor' => ['label' => lang('app.field_doctors'), 'rules' => 'required'],
				'ord' => ['label' => lang('app.field_sort'), 'rules' => 'required|integer|greater_than[0]'],	
				//'id_argomenti' => ['label' => lang('app.field_argomenti'), 'rules' => 'trim|required'],	
				
				
		]);
		
		if (!$val)
		{
			
				$validation=$this->validator;
				$error_msg=$validation->listErrors();
				$res=array("error"=>true,"validation"=>$error_msg,"tabs_error"=>"tab_info");
		}
		
		else{
			if(!is_null($this->request->getVar('have_def_price')) && $free=='no'){
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
			elseif($inf_corsi['test_required']=='per_modulo' && ($this->request->getVar('min_points')=="" || empty($this->request->getVar('ids_test')))){
				$error_msg=lang('app.error_corsi_test');
				$res=array("error"=>true,"validation"=>$error_msg,"tabs_error"=>"tab_test");
			}
			else{
				

				 $validated = $this->validate([
							'logo' => [
								'uploaded[logo]',
								'mime_in[logo,image/jpg,image/jpeg,image/gif,image/png]',
								'max_size[logo,4096]',
							],
						]);
				
						
					
			
				if(!is_null($this->request->getVar('enable'))) $active="si"; else $active="no";
				
				
				if(!empty($this->request->getVar('instructor'))) $ids_doctors=$this->request->getVar('instructor'); else $ids_doctors=null;
				
				if(!empty($this->request->getVar('ids_pdf'))) $ids_pdf=implode(",",$this->request->getVar('ids_pdf')); else $ids_pdf=null;
				if(!is_null($this->request->getVar('have_def_price'))) $have_def_price='yes'; else $have_def_price='no';
			//	if(!is_null($this->request->getVar('slide'))) $slide='yes'; else $slide='no';
				//if(!is_null($this->request->getVar('featured'))) $featured='yes'; else $featured='no';
				if(!is_null($this->request->getVar('attestato'))) $attestato="si"; else $attestato="no";
				if(!is_null($this->request->getVar('test_required'))) $test_required="si"; else $test_required="no";
				if(!is_null($this->request->getVar('cuepoint_block'))) $cuepoint_block="yes"; else $cuepoint_block="no";
				$url=url_title($this->request->getVar('sotto_titolo'));
				
				$x=true;
				while($x){
					$exist_url=$this->CorsiModel->where('url',$url)->where('id_ente',$common_data['user_data']['id'])->find();
					if(!empty($exist_url) && $exist_url[0]['id']!=$id_modulo) $url=url_title($this->request->getVar('sotto_titolo'))."-".rand(0,99);
					else $x=false;
				}
				
				$data=array(				
				'url'=>strtolower($url),
				'ord'=>$this->request->getVar('ord'),
				'titolo'=>$this->request->getVar('titolo'),
				'sotto_titolo'=>$this->request->getVar('sotto_titolo'),
				'id_corsi' =>$this->request->getVar('id_corsi'),
				'instructor' =>$ids_doctors ,		
				'tipologia' =>'',
				'prezzo' =>$this->request->getVar('prezzo'),
				
				'seo_title' =>$this->request->getVar('seo_title'),
				'seo_description' =>$this->request->getVar('seo_description'),
				'description' =>$this->request->getVar('descizione'),
				'programa' =>$this->request->getVar('programa'),
				'note' =>$this->request->getVar('note'),
				'riferimenti' =>$this->request->getVar('riferimenti'),
				'indrizzato_a' =>$this->request->getVar('indrizzato_a'),
				'obiettivi' =>$this->request->getVar('obiettivi'),
				'avvisi' =>$this->request->getVar('avvisi'),
				
				'ids_pdf' => $ids_pdf,						
				'status'=>$active,
				'have_def_price' =>$have_def_price,
				'codice'=>$this->request->getVar('codice'),
				'crediti'=>$this->request->getVar('crediti'),
				'video_promo'=>$this->request->getVar('video_promo'),	
				'test_required'=>$test_required,
				'attestato' =>$attestato,//$this->request->getVar('attestato'),
				'edition'=>$this->request->getVar('edition'),	
				'min_points'=>$this->request->getVar('min_points'),	
				'banned'=>'no',
				'inscrizione_aula' => $this->request->getVar('inscrizione_aula') ?? 'no',
				'nb_person_aula' =>$this->request->getVar('nb_person_aula') ?? '0',
				'duration' =>$this->request->getVar('duration'),
				'difficulte' =>$this->request->getVar('difficulte'),
				'free'=>$free,
				'cuepoint_block'=>$cuepoint_block
			
				);
				if($this->request->getVar('delete_foto')=='yes'){
					$data['foto']="";
				}
				if ($validated) { 
							$avatar_logo = $this->request->getFile('logo');
							 $logo_name = $avatar_logo->getRandomName();
							$data['foto']=$logo_name;
							$avatar_logo->move(ROOTPATH.'public/uploads/corsi/',$logo_name);

						}
						
						
					$this->CorsiModuloModel->update($id_modulo,$data);	
			//var_dump($_FILES["corsigallery"]);
			
		$this->CorsiModuloPrezzoProfModel->where('id_modulo',$id_modulo)->delete();
		
			if(null !==$this->request->getVar('prezzo_prof') && $free=='no'){
						foreach($this->request->getVar('prezzo_prof') as $kk=>$vv){
							if($vv['prezzo_prof']!=""){ 
								
								$this->CorsiModuloPrezzoProfModel->insert(array(
									'id_modulo'=>$id_modulo,
									'prezzo'=>$vv['prezzo_prof'],
									'id_professione'=>$vv['prezzo_prof_id'],
								));
							}
						}
					}
					
				//	$this->CorsiModuloDateModel->where('id_modulo',$id_modulo)->delete();
				if(null !==$this->request->getVar('ids_delete_date')){
					foreach($this->request->getVar('ids_delete_date') as $kk=>$vv){
						if($vv!='') $this->CorsiModuloDateModel->update($vv,array('banned'=>'yes'));
					}
				}
					if(null !==$this->request->getVar('corsidate')){
						foreach($this->request->getVar('corsidate') as $kk=>$vv){
							
							if($vv['date']!=""){ 
								/*$dt=explode("/",$vv['date']);
								$date=$dt[2]."-".$dt[1]."-".$dt[0];*/
								$date=$vv['date'];
								if(isset($vv['ids_update']) && $vv['ids_update']!=""){
									$this->CorsiModuloDateModel->update($vv['ids_update'],array(
										'id_modulo'=>$id_modulo,
										'date'=>$date,
										'incontro'=>$vv['incontro'],
										'start_time'=>$vv['start_time'],
										'end_time'=>$vv['end_time'],
										'zoom_url'=>$vv['zoom_url'] ?? null,
									));
								}
								else{
									$this->CorsiModuloDateModel->insert(array(
										'id_modulo'=>$id_modulo,
										'date'=>$date,
										'incontro'=>$vv['incontro'],
										'start_time'=>$vv['start_time'],
										'end_time'=>$vv['end_time'],
										'zoom_url'=>$vv['zoom_url'] ?? null,
									));
								}
							}
						}
					}

					$this->CorsiModuloVimeoModel->where('id_modulo',$id_modulo)->delete();					
				if(null !==$this->request->getVar('corsivimeo')){
						foreach($this->request->getVar('corsivimeo') as $kk=>$vv){
							
							if($vv['vimeo']!=""){ 
								if(isset($vv['vimeo_enable'])) $vimeo_enable='yes'; else $vimeo_enable='no';
								$this->CorsiModuloVimeoModel->insert(array(
									'id_modulo'=>$id_modulo,
									'vimeo'=>$vv['vimeo'],
									'ord'=>$vv['ord'],
									'enable'=>$vimeo_enable,
									'banned'=>'no'	
								));
							}
						}
					}							
					$this->TestModuloModel->where('id_modulo',$id_modulo)->delete();
				if(!empty($this->request->getVar('ids_test'))){
						foreach($this->request->getVar('ids_test') as $kk=>$vv){
							if($vv!=""){ 
								
								$this->TestModuloModel->insert(array(
									'id_modulo'=>$id_modulo,
									'id_test'=>$vv,
									'id_corsi'=>$this->request->getVar('id_corsi'),
									'banned'=>'no'
								));
							}
						}
					}
					
				$res=array("error"=>false);
			}
		}
		
		echo json_encode($res,true);
	}
}