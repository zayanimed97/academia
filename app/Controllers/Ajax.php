<?php

namespace App\Controllers;

class Ajax extends BaseController
{
    public function index()
    {
       
        return view('welcome_message');
    }
	
	public function get_provincia_by_nazione(){
		$id_nazione=$this->request->getVar('id_nazione');
		$t=$this->request->getVar('t');
		$tt=explode("_",$t);
		 $nn=$tt[0]."_provincia";
		$input = [
												
					'name'  => $nn,
					'id'    => $nn,
					'placeholder' =>lang('app.field_provincia'),
					'class' => 'form-control'
			];
		if($id_nazione==106){
			$list_provincia=$this->ProvinceModel->where('id_nazione',$id_nazione)->findAll();
			$options=array();
			$options['']=lang('app.field_select');
			foreach($list_provincia as $k=>$v){
				$options[$v['id']]=$v['provincia'];
			}
			$js = ' onChange="get_comune(\''.$nn.'\',this.value);"';
			echo form_dropdown($input, $options,'',$js);
		}
		else{
			
			echo form_input($input);
		}
		
		
	}
	
	public function get_comune_by_provincia(){
		 $id_provincia=$this->request->getVar('id_provincia');
		$t=$this->request->getVar('t');
		$tt=explode("_",$t);
		 $nn=$tt[0]."_comune";
		 
		$input = [
												
					'name'  => $nn,
					'id'    => $nn,
					'placeholder' =>lang('app.field_city'),
					'class' => 'form-control'
			];
		if(is_numeric($id_provincia)){
			$list_comune=$this->ComuniModel->where('id_prov',$id_provincia)->findAll();
			
			$options=array();
			$options['']=lang('app.field_select');
			foreach($list_comune as $k=>$v){
				$options[$v['id']]=$v['comune'];
			}
			
			echo form_dropdown($input, $options,'');
		}
		else{
			
			echo form_input($input);
		}
		
		
	}
	
	public function get_sottoargomenti(){
		
		$id_argomenti=$this->request->getVar('id_argomenti');
		$list=$this->SottoargomentiModel->where('banned','no')->where('id_argomenti',$id_argomenti)->findAll();
		
		?>
			<div class="form-group required-field">
					<label for="acc-name"><?php echo lang('app.field_sottoargomenti')?></label>
					<?php $val=""; 
		
			$input = [
					
					'id'    => 'sottoargomenti',
					'placeholder' =>lang('app.field_doctors'),
					'data-allow-clear'=>'1',
					'class' => 'form-control select2-multiple',
					'data-toggle'=>"select2",
					"multiple"=>"multiple",
			];
			$options=array();
		if(!empty($list)){
			foreach($list as $k=>$v){
				$options[$v['id']]=$v['titolo'];
			}
		}
			echo form_multiselect('sottoargomenti[]', $options,array(),$input);
		
			?>
					
				</div>
		<?php
		
	}
	
	public function get_discipline_by_professioneSelect2(){
		$settings=$this->SettingModel->getByMetaKey();
		
		$id_prof=$this->request->getVar('ids_professione');
		$q=$this->request->getVar('q');
		
		//$list_discipline=$DisciplineModel->where('status','enable')->where('idprofessione',$id_prof)->findAll();
			$list_discipline=$this->DisciplineModel;
			if(!is_null($q) && $q!="") $list_discipline=$this->DisciplineModel->like('disciplina',$q);
			if(!is_null($id_prof) && $id_prof!="") $this->DisciplineModel->whereIn('idprofessione', $id_prof);
			$list_discipline=$this->DisciplineModel->findAll();
		foreach($list_discipline as $k=>$v){
			$items[]=array("id"=>$v['iddisciplina'],"text"=>$v['disciplina']);
			
		}
		echo json_encode($items);
		
	}
	
	
		
	public function pdf_add_from_list(){
	$common_data=$this->common_data();
		
		foreach($this->request->getVar('ids_pdf_list') as $pdf_id){
			
			$inf_pdf=$this->CorsiPDFLibModel->find($pdf_id);
		?>
		<tr>
			<td><div class="form-check form-check-inline">
				<?php 
				
			
				$data = [
				'name'    => "ids_pdf[]",
				'id'      => 'ids_pdf_'.$pdf_id,
				'value'   => $pdf_id,
				'checked' => true,
				'class' => 'form-check-input'
					];

					echo form_checkbox($data);
					?>
				  <label class="form-check-label" for="inlineCheckbox1"><?php echo $inf_pdf['pdfname']?></label>
		</div></td>
			
			<td class="text-center"><a target="_blank" href="<?php echo base_url('uploads/corsiPDF/'.$inf_pdf['filename'])?>" class="btn btn-default btn-xs btn-rounded p-l-10 p-r-10"><i class="fa fa-download"></i> <?php echo lang('app.action_download')?></a></td>
		</tr>
		<?php }
	}
	
		public function add_pdf(){
	$common_data=$this->common_data();
	if(!is_null($this->request->getVar('status'))) $enable="yes"; else $enable="no";
	if(!is_null($this->request->getVar('featured'))) $featured="yes"; else $featured="no";
		 $validated = $this->validate([
		 'pdfname' => ['label' => lang('app.field_doc_title'), 'rules' => 'trim|required'],
			'filename' => [
				'uploaded[filename]',
				'mime_in[filename,application/pdf,image/jpg,image/jpeg,image/gif,image/png]',
				'max_size[filename,4096]',
			],
		]);
		
		if ($validated) { 
			$avatar_logo = $this->request->getFile('filename');
			 $logo_name = $avatar_logo->getRandomName();
			
			$avatar_logo->move(ROOTPATH.'public/uploads/corsiPDF/',$logo_name);
		$data=array(
		'id_ente'=>$common_data['user_data']['id'],
			'pdfname'=>$this->request->getVar('pdfname'),
			'filename'=>$logo_name,
			'enable'=>$enable,
			'featured'=>$featured,
			'accesso'=>$this->request->getVar('accesso'),
			'created_at'=>date('Y-m-d H:i:s'),
			
		);
		$pdf_id=$this->CorsiPDFLibModel->insert($data);
		$rr=array("id"=>$pdf_id);
		ob_start();?>
		<tr>
			<td><div class="form-check form-check-inline">
				<?php 
				
			
				$data = [
				'name'    => "ids_pdf_list[]",
				'id'      => 'ids_pdf_list_'.$pdf_id,
				'value'   => $pdf_id,
				'checked' => true,
				'class' => 'form-check-input'
					];

					echo form_checkbox($data);
					?>
				  <label class="form-check-label" for="inlineCheckbox1"><?php echo $this->request->getVar('pdfname')?></label>
		</div></td>
			
			<td class="text-center"><a target="_blank" href="<?php echo base_url('uploads/corsiPDF/'.$logo_name)?>" class="btn btn-default btn-xs btn-rounded p-l-10 p-r-10"><i class="fa fa-download"></i> <?php echo lang('app.action_download')?></a></td>
		</tr>
		<?php 
		$tr=ob_get_clean();
		$res=array("error"=>false,"tr"=>$tr);
		}
		else {
			$validated=$this->validator;
			$error_msg=$validated->listErrors();
			$res=array("error"=>true,"validation"=>$error_msg);
		}
			
	echo json_encode($res,true);
}

	
	public function test_add_from_list(){
	$common_data=$this->common_data();
		
		foreach($this->request->getVar('ids_test_list') as $pdf_id){
			
			$inf_pdf=$this->CorsiModuloTestModel->find($pdf_id);
		?>
		<tr>
			<td><div class="form-check form-check-inline">
				<?php 
				
			
				$data = [
				'name'    => "ids_test[]",
				'id'      => 'ids_test_'.$pdf_id,
				'value'   => $pdf_id,
				'checked' => true,
				'class' => 'form-check-input'
					];

					echo form_checkbox($data);
					?>
				  <label class="form-check-label" for="inlineCheckbox1"><?php echo $inf_pdf['title']?></label>
		</div></td>
			
			<td class="text-center"><?php echo $inf_pdf['type']?></td>
		</tr>
		<?php }
	}
	
	public function get_list_test(){
		$common_data=$this->common_data();
		$list_test=$this->CorsiModuloTestModel->where('banned','no')->where('id_ente',$common_data['user_data']['id'])->findAll();
		?>
		<table class="table table-td-valign-middle m-b-0">
								
			<tbody id="list_modal_test">
			<?php foreach($list_test as $kk=>$one_customer){?>
				<tr>
					<td><div class="form-check form-check-inline">
						<?php 
						$chk=false;
					
						$data = [
						'name'    => "ids_test_list[]",
						'id'      => 'ids_test_list_'.$one_customer['id'],
						'value'   => $one_customer['id'],
						'checked' => $chk,
						'class' => 'form-check-input'
							];

							echo form_checkbox($data);
							?>
						  <label class="form-check-label" for="inlineCheckbox1"><?php echo $one_customer['title']?></label>
				</div></td>
					
					<td class="text-center"><?php echo $one_customer['type']?></td>
				</tr>
			<?php }?>	
			</tbody>
		</table>
	<?php
	}
	
	public function get_profile_ente(){
		$common_data=$this->common_data();
		$id=$this->request->getVar('id');
		$inf=$this->UserModel->find($id);
		$inf_profile=$this->UserProfileModel->where('user_id',$id)->first();
		$inf_package=$this->EntePackageModel->where('id_ente',$id)->orderBy('expired_date','DESC')->first();
		$pack=json_decode($inf_package['package'],true);
		$inf_country_residenza=$this->NazioniModel->find($inf_profile['residenza_stato']);
		
		if($inf_profile['residenza_stato']==106){
			$inf_provincia_residenza=$this->ProvinceModel->find($inf_profile['residenza_stato']);
			$residenza_provincia=$inf_provincia_residenza['provincia'];
			$inf_provincia_residenza=$this->ComuniModel->find($inf_profile['residenza_provincia']);
			$residenza_comune=$inf_provincia_residenza['comune'];
		}
		else{
			$residenza_provincia=$inf_profile['residenza_provincia'];
			$residenza_comune=$inf_profile['residenza_comune'];
		}
		$inf_country_fattura=$this->NazioniModel->find($inf_profile['fattura_stato']);
		if($inf_profile['fattura_stato']==106){
			$inf_provincia_fattura=$this->ProvinceModel->find($inf_profile['fattura_stato']);
			$fattura_provincia=$inf_provincia_fattura['provincia'];
			$inf_provincia_fattura=$this->ComuniModel->find($inf_profile['fattura_provincia']);
			$fattura_comune=$inf_provincia_fattura['comune'];
		}
		else{
			$fattura_provincia=$inf_profile['fattura_provincia'];
			$fattura_comune=$inf_profile['fattura_comune'];
		}
		?>
		<h4><?php echo lang('app.menu_profile')?></h4>
		<div class="row">
			<div class="col-4"><b><?php echo lang('app.field_first_name')?></b></div>
			<div class="col-8"><?php echo $inf_profile['nome']?></div>
		</div>
		<div class="row">
			<div class="col-4"><b><?php echo lang('app.field_last_name')?></b></div>
			<div class="col-8"><?php echo $inf_profile['cognome']?></div>
		</div>
		<div class="row">
			<div class="col-4"><b><?php echo lang('app.field_phone')?></b></div>
			<div class="col-8"><?php echo $inf_profile['telefono']?></div>
		</div>
		<div class="row">
			<div class="col-4"><b><?php echo lang('app.field_mobile')?></b></div>
			<div class="col-8"><?php echo $inf_profile['mobile']?></div>
		</div>
		<div class="row">
			<div class="col-4"><b><?php echo lang('app.field_country')?></b></div>
			<div class="col-8"><?php echo $inf_country_residenza['nazione']?></div>
		</div>
		<div class="row">
			<div class="col-4"><b><?php echo lang('app.field_provincia')?></b></div>
			<div class="col-8"><?php echo $residenza_provincia?></div>
		</div>
		<div class="row">
			<div class="col-4"><b><?php echo lang('app.field_city')?></b></div>
			<div class="col-8"><?php echo $residenza_comune?></div>
		</div>
		<div class="row">
			<div class="col-4"><b><?php echo lang('app.field_address')?></b></div>
			<div class="col-8"><?php echo $inf_profile['residenza_indirizzo']?></div>
		</div>
		<div class="row">
			<div class="col-4"><b><?php echo lang('app.field_zip')?></b></div>
			<div class="col-8"><?php echo $inf_profile['residenza_cap']?></div>
		</div>
		<h4><?php echo lang('app.menu_fattura')?></h4>
		<div class="row">
			<div class="col-4"><b><?php echo lang('app.field_type')?></b></div>
			<div class="col-8"><?php switch( $inf_profile['type']){
				case 'private': echo lang('app.field_type_private');break;
				case 'professional': echo lang('app.field_type_professional');break;
				case 'company': echo lang('app.field_type_company');break;
			}?></div>
		</div>
		<?php switch( $inf_profile['type']){
			case 'professional': ?>
			<div class="row">
				<div class="col-4"><b><?php echo lang('app.field_piva')?></b></div>
				<div class="col-8"><?php echo $inf_profile['fattura_piva']?></div>
			</div>
		
		<?php break;
		case 'company': ?>
		<div class="row">
				<div class="col-4"><b><?php echo lang('app.field_company_name')?></b></div>
				<div class="col-8"><?php echo $inf_profile['ragione_sociale']?></div>
		</div>
		<div class="row">
			<div class="col-4"><b><?php echo lang('app.field_piva')?></b></div>
			<div class="col-8"><?php echo $inf_profile['fattura_piva']?></div>
		</div>
		
		<?php break;
		} ?>
		<div class="row">
			<div class="col-4"><b><?php echo lang('app.field_cf')?></b></div>
			<div class="col-8"><?php echo $inf_profile['fattura_cf']?></div>
		</div>
		<div class="row">
			<div class="col-4"><b><?php echo lang('app.field_first_name')?></b></div>
			<div class="col-8"><?php echo $inf_profile['nome']?></div>
		</div>
		<div class="row">
			<div class="col-4"><b><?php echo lang('app.field_last_name')?></b></div>
			<div class="col-8"><?php echo $inf_profile['cognome']?></div>
		</div>
		<div class="row">
			<div class="col-4"><b><?php echo lang('app.field_phone')?></b></div>
			<div class="col-8"><?php echo $inf_profile['fattura_phone']?></div>
		</div>
		
		<div class="row">
			<div class="col-4"><b><?php echo lang('app.field_country')?></b></div>
			<div class="col-8"><?php echo $inf_country_fattura['nazione']?></div>
		</div>
		<div class="row">
			<div class="col-4"><b><?php echo lang('app.field_provincia')?></b></div>
			<div class="col-8"><?php echo $fattura_provincia?></div>
		</div>
		<div class="row">
			<div class="col-4"><b><?php echo lang('app.field_city')?></b></div>
			<div class="col-8"><?php echo $fattura_comune?></div>
		</div>
		<div class="row">
			<div class="col-4"><b><?php echo lang('app.field_address')?></b></div>
			<div class="col-8"><?php echo $inf_profile['fattura_indirizzo']?></div>
		</div>
		<div class="row">
			<div class="col-4"><b><?php echo lang('app.field_zip')?></b></div>
			<div class="col-8"><?php echo $inf_profile['fattura_cap']?></div>
		</div>
		<div class="row">
			<div class="col-4"><b><?php echo lang('app.field_pec')?></b></div>
			<div class="col-8"><?php echo $inf_profile['fattura_pec']?></div>
		</div>
		<div class="row">
			<div class="col-4"><b><?php echo lang('app.field_sdi')?></b></div>
			<div class="col-8"><?php echo $inf_profile['fattura_sdi']?></div>
		</div>
		<h4><?php echo lang('app.menu_package')?></h4>
		<div class="row">
			<div class="col-4"><b><?php echo lang('app.field_expired_date')?></b></div>
			<div class="col-8"><?php echo date('d/m/Y',strtotime($inf_package['expired_date']))?></div>
		</div>
		<div class="row">
			<div class="col-4"><b><?php echo lang('app.field_type_cours')?></b></div>
			<div class="col-8"><?php echo implode(",",$pack['type_cours'])?></div>
		</div>
		<div class="row">
			<div class="col-4"><b><?php echo lang('app.field_package_extra')?></b></div>
			<div class="col-8"><?php if(!empty($pack['extra']))  echo implode(",",$pack['extra']);?></div>
		</div>
		<?php 
	}
	
	public function valid_user(){
		$common_data=$this->common_data();
		$val = $this->validate([
				
				'email' => ['label' => lang('app.field_email'), 'rules' => 'trim|required|valid_email'],	
				'Password' => ['label' => lang('app.field_password'), 'rules' => 'trim|required'],
				'confirm' => ['label' => lang('app.field_confirm_password'), 'rules' => 'trim|required|matches[Password]'],	
				
		]);
		
		if (!$val)
		{
			
				$validation=$this->validator;
				$error_msg=$validation->listErrors();
				$res=array("error"=>true,"validation"=>$error_msg,"tabs_error"=>"basictab1");
		}
		
		else{
			$val = $this->validate([
				
				'nome' => ['label' => lang('app.field_first_name'), 'rules' => 'trim|required'],	
				'cognome' => ['label' => lang('app.field_last_name'), 'rules' => 'trim|required'],
			]);
			if (!$val)
			{
				
					$validation=$this->validator;
					$error_msg=$validation->listErrors();
					$res=array("error"=>true,"validation"=>$error_msg,"tabs_error"=>"basictab2");
			}
			
			else{
				$res=array("error"=>false);
			}
		}
		echo json_encode($res,true);
	}
	
		public function valid_user_update(){
		$common_data=$this->common_data();
		$val = $this->validate([
				
				'email' => ['label' => lang('app.field_email'), 'rules' => 'trim|required|valid_email'],
]);
if($this->request->getVar('Password')!=""){	
	$val = $this->validate([			
				'Password' => ['label' => lang('app.field_password'), 'rules' => 'trim|required'],
				'confirm' => ['label' => lang('app.field_confirm_password'), 'rules' => 'trim|required|matches[Password]'],	
				
		]);
}	
		if (!$val)
		{
			
				$validation=$this->validator;
				$error_msg=$validation->listErrors();
				$res=array("error"=>true,"validation"=>$error_msg,"tabs_error"=>"basictab1");
		}
		
		else{
			$val = $this->validate([
				
				'nome' => ['label' => lang('app.field_first_name'), 'rules' => 'trim|required'],	
				'cognome' => ['label' => lang('app.field_last_name'), 'rules' => 'trim|required'],
			]);
			if (!$val)
			{
				
					$validation=$this->validator;
					$error_msg=$validation->listErrors();
					$res=array("error"=>true,"validation"=>$error_msg,"tabs_error"=>"basictab2");
			}
			
			else{
				$res=array("error"=>false);
			}
		}
		echo json_encode($res,true);
	}
}//end class
