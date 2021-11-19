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
}//end class
