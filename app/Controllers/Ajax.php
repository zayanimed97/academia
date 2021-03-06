<?php

namespace App\Controllers;
use CodeIgniter\I18n\Time;
use Aws\S3\S3Client;
use Aws\S3\MultipartUploader;
use Aws\Exception\MultipartUploadException;
use Aws\S3\ObjectUploader;

class Ajax extends BaseController
{
	public function __construct(){
		ini_set('max_execution_time', 0);
	}
    public function index()
    {
       
        return view('welcome_message');
    }
	
	public function send_help_form(){
		$common_data=$this->common_data();
		$subject=$this->request->getVar('subject');
		$message=$this->request->getVar('message');
		$message.="<hr/>"."<b>Ente: </b>".$common_data['user_data']['display_name'] .' | '.$common_data['user_data']['email'];
		if($message!=""){
			$email = \Config\Services::email();
			$sender_name=$common_data['user_data']['display_name'];
			$sender_email=$common_data['user_data']['email'];
			$email->setFrom($sender_email,$sender_name);
			$inf_admin=$this->UserModel->where('role','admin')->first();
			$email->setTo($inf_admin['email']);
			
			$email->setSubject($subject." - AULEDIGITALE HELP FORM");
			$email->setMessage(nl2br($message));
			$email->setAltMessage(strip_tags($message));
			
			$xxx=$email->send();
		}
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
	
	public function get_discipline_by_professione(){
		$settings=$this->SettingModel->getByMetaKey();
		
		$id_prof=$this->request->getVar('id');
		
	
			$list_discipline=$this->DisciplineModel;
			
			if(!is_null($id_prof) && $id_prof!="") $this->DisciplineModel->where('idprofessione', $id_prof);
			$list_discipline=$this->DisciplineModel->findAll();
		foreach($list_discipline as $k=>$v){?>
		<option value="<?php echo $v['iddisciplina']?>"><?php echo $v['disciplina']?></option>
		
		<?php	
		}
		
		
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
			
			<td class="text-center"><a target="_blank" href="<?php echo base_url('user/getFile/'.$inf_pdf['id'])?>" class="btn btn-default btn-xs btn-rounded p-l-10 p-r-10"><i class="fa fa-download"></i> <?php echo lang('app.action_download')?></a></td>
		</tr>
		<?php }
	}
	

	public function downloads3($id)
	{
		$common_data=$this->common_data();
		$resource = $this->CorsiPDFLibModel->where('id', $id)->where('id_ente', $common_data['selected_ente']['id'])->first();
		if ($resource) {
			if ($this->request->getVar('participation')) {
				$participation = $this->ParticipationModel->where('id', $this->request->getVar('participation'))->first();
				if (!empty($participation)) {
					// echo '<pre>';
					// print_r($participation);
					// echo '</pre>';
					// exit;
					$participation = $this->ParticipationModel->update($participation['id'], ['downloaded_pdf'=>'si']);
					
				}
			}
			if (strpos($resource['filename'], 'amazonaws') == false) {
				header("Location: ".base_url("uploads/corsiPDF/{$resource['filename']}"));
				exit;
			}
			$bucket = "appauledigitali";
			$keyname = str_replace('https://appauledigitali.s3.eu-south-1.amazonaws.com/','',$resource['filename']);
			
				//Create a S3Client
			$s3 = new S3Client([
				'version' => 'latest',
				'region'  => 'eu-south-1',
				'credentials' => [
					'key'    => config('aws_s3')->key,
					'secret' => config('aws_s3')->secret ,
				],
			]);
			
			try {
				// Get the object.
				$result = $s3->getObject([
					'Bucket' => $bucket,
					'Key'    => $keyname,
				]);
			
				// Display the object in the browser.
				$nameArray = explode('/', $keyname);

				

				header("Content-Type: {$result['ContentType']}");
				header('Content-Disposition: attachment; filename="'.end($nameArray).'"');

				echo $result['Body'];exit;
			} catch (S3Exception $e) {
				echo $e->getMessage() . PHP_EOL;
			}
		}
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
				// 'max_size[filename,16000]',
			],
		]);
		
		if ($validated) {
			$avatar_logo = $this->request->getFile('filename');
			$logo_name = $avatar_logo->getRandomName();










			$bucket = 'appauledigitali';
			$keyname = "{$common_data['selected_ente']['domain_ente']}/pdf/$logo_name";
			
			// $filepath should be an absolute path to a file on disk.
			$filepath = $avatar_logo;
			
			$s3 = new S3Client([
				'version' => 'latest',
				'region'  => 'eu-south-1',
				'credentials' => [
					'key'    => config('aws_s3')->key,
					'secret' => config('aws_s3')->secret ,
				],
			]);
			
			// Upload a file with server-side encryption.
			$result = $s3->putObject([
				'Bucket'               => $bucket,
				'Key'                  => $keyname,
				'SourceFile'           => $filepath,
				'ServerSideEncryption' => 'AES256',
			]);



				// https://appauledigitali.s3.eu-south-1.amazonaws.com/1643298379_e1414fc474abfa9b2a45.pdf

			
			// $avatar_logo->move(ROOTPATH.'public/uploads/corsiPDF/',$logo_name);
		$data=array(
			'id_ente'=>$common_data['user_data']['id'],
			'pdfname'=>$this->request->getVar('pdfname'),
			'filename'=>$result['ObjectURL'],
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
	
	public function get_cart_items(){
		$common_data=$this->common_data();
		$id=$this->request->getVar('id');
		$verif=$this->CartModel->where('id_ente',$common_data['user_data']['id'])->where('id',$id)->find();
		if(!empty($verif)){
			$list=$this->CartItemsModel->where('id_cart',$id)->where('banned','no')->find();
			?>
			<table  class="table dt-responsive nowrap w-100">
				<tr>	
					<th><?php echo lang('app.field_item_type')?></th>
					<th><?php echo lang('app.field_item')?></th>
					<th><?php echo lang('app.field_amount')?></th>
				</tr>
				<?php foreach($list as $k=>$v){
					switch($v['item_type']){
						case 'corsi': $st= lang('app.field_per_corsi');
							$inf_corsi=$this->CorsiModel->find($v['item_id']);
							$corso=$inf_corsi['sotto_titolo'];
						break;
						default: $st=lang('app.field_per_modulo');
							$inf_corsi=$this->CorsiModuloModel->find($v['item_id']);
							$corso=$inf_corsi['sotto_titolo'];
					}?>
				<tr>
					<td><?php echo $st ?></td>
					<td><?php echo $corso ?></td>
					<td><?php echo number_format($v['price_ht']+($v['price_ht']*$v['vat']/100),2,',','.') ?>???</td>
				</tr>
				<?php } ?>
			</table>
		<?php 
		}
		else 
			echo '<div class="alert alert-danger">'.lang('app.error_query').'</div>';
	}
	
	public function get_cart_payment(){
			$common_data=$this->common_data();
		$id=$this->request->getVar('id');
		$verif=$this->CartModel->where('id_ente',$common_data['user_data']['id'])->where('id',$id)->find();
		if(!empty($verif)){
			$inf_profile=$this->UserProfileModel->where('user_id',$verif[0]['id_user'])->first();
		if($inf_profile['residenza_stato']!=""){
			$inf_country_residenza=$this->NazioniModel->find($inf_profile['residenza_stato']);
		}
		else $inf_country_residenza=$this->NazioniModel->find(106);
		 
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
		
		?>
		
		
			
		<h5><?php echo lang('app.title_modal_cart_profile')?></h5>
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
		<?php
		
		$inf_fatturazione=json_decode($verif[0]['fatturazione'],true);
		
		if(!empty($inf_fatturazione)){
		
		
		$inf_country_residenza=$this->NazioniModel->find($inf_fatturazione['fattura_stato']);
		
		if($inf_fatturazione['fattura_stato']==106){
			$inf_provincia_residenza=$this->ProvinceModel->find($inf_fatturazione['fattura_stato']);
			$residenza_provincia=$inf_provincia_residenza['provincia'];
			$inf_provincia_residenza=$this->ComuniModel->find($inf_fatturazione['fattura_provincia']);
			$residenza_comune=$inf_provincia_residenza['comune'];
		}
		else{
			$residenza_provincia=$inf_fatturazione['fattura_provincia'];
			$residenza_comune=$inf_fatturazione['fattura_comune'];
		}
		
		?>
	
		<h5><?php echo lang('front.title_section_profile_fatturazione')?></h5>
		<div class="row">
			<div class="col-4"><b><?php echo lang('app.field_type')?></b></div>
			<div class="col-8"><?php switch($inf_fatturazione['type']){
				case 'private': echo lang('front.field_private');break;
				case 'professional': echo lang('front.field_prof');break;
				case 'company': echo lang('front.field_azienda');break;
			}?></div>
		</div>
		<?php if($inf_fatturazione['type']!='company'){?>
		<div class="row">
			<div class="col-4"><b><?php echo lang('app.field_first_name')?></b></div>
			<div class="col-8"><?php echo $inf_fatturazione['fattura_nome']?></div>
		</div>
		<div class="row">
			<div class="col-4"><b><?php echo lang('app.field_last_name')?></b></div>
			<div class="col-8"><?php echo $inf_fatturazione['fattura_cognome']?></div>
		</div>
		<?php } else{?>
		<div class="row">
			<div class="col-4"><b><?php echo lang('app.field_company')?></b></div>
			<div class="col-8"><?php echo $inf_fatturazione['ragione_sociale']?></div>
		</div>
		
		<?php } ?>
		<?php if($inf_fatturazione['fattura_cf']!=''){?>
		<div class="row">
			<div class="col-4"><b><?php echo lang('app.field_cf')?></b></div>
			<div class="col-8"><?php echo $inf_fatturazione['fattura_cf']?></div>
		</div>
		<?php } ?>
		<?php if($inf_fatturazione['fattura_piva']!=''){?>
		<div class="row">
			<div class="col-4"><b><?php echo lang('app.field_piva')?></b></div>
			<div class="col-8"><?php echo $inf_fatturazione['fattura_piva']?></div>
		</div>
		<?php } ?>
		<div class="row">
			<div class="col-4"><b><?php echo lang('app.field_phone')?></b></div>
			<div class="col-8"><?php echo $inf_fatturazione['fattura_phone']?></div>
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
			<div class="col-8"><?php echo $inf_fatturazione['fattura_indirizzo']?></div>
		</div>
		<div class="row">
			<div class="col-4"><b><?php echo lang('app.field_zip')?></b></div>
			<div class="col-8"><?php echo $inf_fatturazione['fattura_cap']?></div>
		</div>
			<?php if($inf_fatturazione['fattura_pec']!=''){?>
		<div class="row">
			<div class="col-4"><b><?php echo lang('app.field_pec')?></b></div>
			<div class="col-8"><?php echo $inf_fatturazione['fattura_pec']?></div>
		</div>
		<?php } ?>
		<?php if($inf_fatturazione['fattura_sdi']!=''){?>
		<div class="row">
			<div class="col-4"><b><?php echo lang('app.field_sdi')?></b></div>
			<div class="col-8"><?php echo $inf_fatturazione['fattura_sdi']?></div>
		</div>
		<?php } ?>
			<?php 
		}// end if fatturazione
		
			$list=$this->CartItemsModel->where('id_cart',$id)->where('banned','no')->find();
			?>
			<h5><?php echo lang('app.title_modal_cart_items')?></h5>
			<table  class="table dt-responsive nowrap w-100">
				<tr>	
					<th><?php echo lang('app.field_item_type')?></th>
					<th><?php echo lang('app.field_item')?></th>
					<th><?php echo lang('app.field_amount')?></th>
				</tr>
				<?php foreach($list as $k=>$v){
					switch($v['item_type']){
						case 'corsi': $st= lang('app.field_per_corsi');
							$inf_corsi=$this->CorsiModel->find($v['item_id']);
							$corso=$inf_corsi['sotto_titolo'];
						break;
						default: $st=lang('app.field_per_modulo');
							$inf_corsi=$this->CorsiModuloModel->find($v['item_id']);
							$corso=$inf_corsi['sotto_titolo'];
					}?>
				<tr>
					<td><?php echo $st ?></td>
					<td><?php echo $corso ?></td>
					<td><?php echo number_format($v['price_ht']+($v['price_ht']*$v['vat']/100),2,',','.') ?>???</td>
				</tr>
				<?php } ?>
			</table>
		<?php
			$list=$this->CartPaymentModel->where('id_cart',$id)->where('banned','no')->find();
			?>
			<h5><?php echo lang('app.title_modal_cart_payments')?></h5>
			<table  class="table dt-responsive nowrap w-100">
				<tr>	
					
					<th><?php echo lang('app.field_method_payment')?></th>
					<th><?php echo lang('app.field_amount')?></th>
					<th><?php echo lang('app.field_date')?></th>
					<th><?php echo lang('app.field_status')?></th>
				</tr>
				<?php foreach($list as $k=>$v){
					switch(strtolower($v['status'])){
						case 'pending': $st=lang('app.status_pending'); break;
						case 'completed': $st=lang('app.status_completed'); break;
						case 'canceled': $st=lang('app.status_canceled'); break;
					}
					$inf_method=$this->MethodPaymentModel->find($v['id_method']);
					?>
				<tr>
					<td><?php echo $inf_method['title'] ?></td>
					
					<td><?php echo number_format($v['amount'],2,',','.') ?>???</td>
					<td><?php echo date('d/m/Y',strtotime($v['date'])) ?></td>
						<td><?php echo $st ?></td>
				</tr>
				<?php } ?>
			</table>
		<?php 
		}
		else 
			echo '<div class="alert alert-danger">'.lang('app.error_query').'</div>';
	}
	
	public function get_alberghi(){
		$common_data=$this->common_data();
		$id_luoghi=$this->request->getVar('id_luoghi');
		$list=$this->AlberghiModel->where('banned','no')->where('idluogo',$id_luoghi)->where('id_ente',$common_data['user_data']['id'])->orderby('nome','ASC')->findAll();
		if(!empty($list)){?>
			<div class="form-group required-field">
					<label for="acc-name"><?php echo lang('app.field_alberghi')?> <span class="text-danger">*</span></label>
					<?php $val=""; 
		
			$input = [
					'name'    => 'id_alberghi',
					'id'    => 'id_alberghi',
					'placeholder' =>lang('app.field_alberghi'),
					
					'class' => 'form-control'
			];
			$options=array();
		
			foreach($list as $k=>$v){
				$options[$v['id']]=$v['nome'];
			}
			//var_dump($options);
			echo form_dropdown($input, $options);
			?>
					
				</div>
		<?php
		}
	}
	public function set_online_event(){
	
		$id_participation=$this->request->getVar('id_participation');
		$duration_video=$this->request->getVar('duration_video');
		$vimeo_id=$this->request->getVar('vimeo_id');
		$action=$this->request->getVar('action');
		switch($action){
			case 'play':
				$online_event=array("action"=>$action,'id_participation'=>$id_participation,'vimeo_id'=>$vimeo_id,"cursor_position"=>$this->request->getVar('cursor_position'));
				$this->session->set(array('online_event'=>$online_event));
			break;
			case 'stop':
				$online_event=$this->session->get('online_event');
				$duration=$this->request->getVar('cursor_position')-$online_event['cursor_position'];
				if($duration>0){
					$this->ParticipationOnlineEventModel->insert(array("id_participation"=>$id_participation,'vimeo_id'=>$vimeo_id,'event'=>'play','duration'=>$duration,'cursor_position'=>$this->request->getVar('cursor_position'),'created_at'=>date('Y-m-d H:i:s')));
				}
					$this->session->remove('online_event');
			break;
			case 'end':
				//$online_event=$this->session->get('online_event');
				$duration=$this->request->getVar('cursor_position');
				
				$this->ParticipationOnlineEventModel->insert(array("id_participation"=>$id_participation,'vimeo_id'=>$vimeo_id,'event'=>'end','duration'=>$duration,'cursor_position'=>$this->request->getVar('cursor_position'),'created_at'=>date('Y-m-d H:i:s')));
				
				//$this->session->remove('online_event');
			break;
			case 'start_session':
			$this->ParticipationOnlineEventModel->insert(array("id_participation"=>$id_participation,'vimeo_id'=>$vimeo_id,'event'=>'start_session','created_at'=>date('Y-m-d H:i:s')));
			break;
		}
		$this->verif_online_status($id_participation,$duration_video);
	}
	
	public function verif_online_status($id_participation,$duration_video=0){
		//echo $id_participation;
		$inf_participation=$this->ParticipationModel->find($id_participation);
		$list=$this->CorsiModuloVimeoModel->where('banned','no')->where('enable','yes')->where('id_modulo',$inf_participation['id_modulo'])->orderBy('ord','ASC')->find();
		foreach($list as $k=>$v){
			$last_activity=$this->ParticipationOnlineEventModel->where('id_participation',$id_participation)->where('vimeo_id',$v['vimeo'])->where('event','play')->orderBy('created_at','DESC')->selectMax('cursor_position')->find();
			//var_dump($last_activity);
			//if(!empty($last_activity) && $last_activity[0]['cursor_position']>= )
				if(isset( $last_activity[0]['cursor_position'])) $cursor_position=$last_activity[0]['cursor_position']; else $cursor_position=0;
				if($duration_video==0) $status=0;
				else $status=$cursor_position*100/$duration_video;
				if($status>100) $status=100;
				$verif=$this->ParticipationOnlineStatusModel->where("id_participation",$id_participation)->where('vimeo_id',$v['vimeo'])->orderBy('created_at','DESC')->first();
				if(!empty($verif) && $verif['status']<100) $this->ParticipationOnlineStatusModel->update($verif['id'],array("id_participation"=>$id_participation,'vimeo_id'=>$v['vimeo'],"status"=>$status,'cursor_position'=>$cursor_position,'created_at'=>date('Y-m-d H:i:s')));
				elseif(empty($verif)) $this->ParticipationOnlineStatusModel->insert(array("id_participation"=>$id_participation,'vimeo_id'=>$v['vimeo'],"status"=>$status,'cursor_position'=>$cursor_position,'created_at'=>date('Y-m-d H:i:s')));
				//else $this->ParticipationOnlineStatusModel->update($verif['id'],array("id_participation"=>$id_participation,'vimeo_id'=>$v['vimeo'],"status"=>$status,'cursor_position'=>$cursor_position,'created_at'=>date('Y-m-d H:i:s')));
		}
	}
	
	public function get_details_cart(){
		$common_data=$this->common_data();
		$id_cart=$this->request->getVar('id_cart');
		$inf=$this->CartModel->where('id',$id_cart)->where('id_user',$common_data['user_data']['id'])->where('banned','no')->first();
		if(empty($inf)) echo "<div uk-alert>".lang('front.empty_cart')."</div>";
		else{?>
			<table class="table col-span-2">
			  <thead class="border-b">
				<tr>
					<th>#</th>
					<th><?php echo lang('app.field_title')?></th>
					<th><?php echo lang('app.field_total')?></th>
					<th>&nbsp;</th>
				</tr>
			</thead>
			<tbody class="mt-8">
			<?php $list_items=$this->CartItemsModel->where('id_cart',$id_cart)->where('banned','no')->find();
				if(!empty( $list_items)){
					foreach( $list_items as $kk=>$vv){
						$det=json_decode($vv['details'],true);
					
						switch($vv['item_type']){
							case 'modulo':
								$inf_module=$this->CorsiModuloModel->find($vv['item_id']);
								$item_name=$inf_module['sotto_titolo'];
								$url=base_url('modulos/'.$inf_module['url']);
							break;
							case 'corsi':
								$inf_corsi=$this->CorsiModel->find($vv['item_id']);
								$item_name=$inf_corsi['sotto_titolo'];
								$url=base_url('corsi/'.$inf_corsi['url']);
							break;
						}?>
					<tr>
					<td><?php echo ($kk+1)?></td>
					<td><?php echo $item_name?></td>
					<td><?php echo number_format($vv['price_ht']*(1+($vv['vat']/100)),2,',','.')?></td>
					<td>
					 <?php 
					  if(in_array('wallet',$common_data['ente_package']['extra'])){ 
					 if(isset($common_data['settings']['facebook_id'])&& isset($common_data['settings']['facebook_discount']) && (empty($det['share']) || $det['share']['facebook']=='cancelled')){ ?>
						<div class="flex justify-between mt-1">
							<p @click="shareFacebook_wallet('<?= $vv['id']?>', '<?= $url?>')" class="text-green-400 cursor-pointer hover:underline">Condividi e risparmia <?php //echo $amount->format($common_data['settings']['facebook_discount'] ?? 0) ?></p>
						</div>
						<?php } 
					  }?>
					</td>
				</tr>
				<?php } }?>
				</tbody>
			</table>
		<?php }
	}
	
	
	    public function postShared()
    {
        $data = $this->common_data();
		 if(!in_array('wallet',$common_data['ente_package']['extra'])){ 
		 return json_encode  ([ "status" => 'error', 
							"message" => lang('front.post_shared') 		   
							]);
		 }
		 else{
        $id =$this->request->getVar('rowid');
        $platform =$this->request->getVar('platform');
     
        $row = $this->CartItemsModel->find($id);
        $item = $row['item_type'] == 'corsi' ? $this->CorsiModel : $this->CorsiModuloModel;
        $item = $item->where('id',  $row['item_id'])->where('banned', 'no')->first();
		$verify_wallet=$this->UserWalletModel->where('id_user',$data['user_data']['id'])->where('id_ente',$data['selected_ente']['id'])->where('id_item',$id)->first();
		$det=json_decode($row['details'],true); 
	
		$discount =0;		
	 if(empty($verify_wallet) && isset($data['settings']['facebook_id'])&& isset($data['settings']['facebook_discount']) && (empty($det['share']) || $det['share'][$platform]=='cancelled')){
		  switch($platform){
			  case 'facebook':
				if(isset($data['settings']['facebook_discount'])) $discount =$data['settings']['facebook_discount'];
			break;
		  }
		
		  $this->UserWalletModel->insert(array(
			'id_user'=>$data['user_data']['id'],
			'id_ente'=>$data['selected_ente']['id'],
			'id_item'=>$id,
			'discount'=>$discount,
			'created_at'=>date('Y-m-d H:i:s'),
		  ));
		   $det['share'][$platform] = $discount;
		    $this->CartItemsModel->update($id,array('details'=>json_encode($det,true)));
		  $inf_user=$this->UserModel->find($data['user_data']['id']);
		  $this->UserModel->edit($data['user_data']['id'],array("wallet"=>($discount+$inf_user['wallet'])));
		   $inf_user=$this->UserModel->find($data['user_data']['id']);
		  $this->session->set(array('user_data'=>$inf_user));
		  return json_encode  ([  "status" => 'success', 
                                  "message" => lang('front.success_share'),
								"total_wallet"=>number_format($inf_user['wallet'],2)
                              ]);
	 }
	 else{
		 
		return json_encode  ([ "status" => 'error', 
							"message" => lang('front.post_shared') 		   
							]);
	 }
		 }
    }

	public function set_zoom_confirm(){
		$common_data=$this->common_data();
		$id=$this->request->getVar('id');
		$id_participation=$this->request->getVar('id_participation');
		$verif=$this->ParticipationModel->where('id',$id_participation)->where('id_user',$common_data['user_data']['id'])->first();
		if(!empty($verif)){
			$det=json_decode($verif['confirm_zoom'],true);
			if(!isset($det[$id]) || $det[$id]==""){
				$det[$id]=date('Y-m-d H:i:s');
				$confirm_zoom=json_encode($det,true);
				$this->ParticipationModel->update($verif['id'],array("confirm_zoom"=>$confirm_zoom));
				$inf_zoom=$this->CorsiModuloDateModel->find($id);
				$inf_modulo=$this->CorsiModuloModel->find($inf_zoom['id_modulo']);
				############### send mail ################""
				$temp=$this->TemplatesModel->where('module','confirm_zoom')->where('id_ente',$common_data['selected_ente']['id'])->find();
						if(empty($temp)) $temp=$this->TemplatesModel->where('module','confirm_zoom')->where('id_ente IS NULL')->find();
						$email = \Config\Services::email();
						$sender_name=$common_data['settings']['sender_name'];
						$sender_email=$common_data['settings']['sender_email'];
						$email->setFrom($sender_email,$sender_name);
						if(!empty($common_data['selected_ente']) && isset($common_data['selected_ente'])){
						
					
						$SMTP=$this->SettingModel->getByMetaKeyEnte($common_data['selected_ente']['id'],'SMTP')['SMTP'];
							if($SMTP!="") $vals=json_decode($SMTP,true);
						
							if(!empty($vals)){
								if(isset($vals['sender_name'])) $sender_name=$vals['sender_name'];
								if(isset($vals['sender_email'])) $sender_email=$vals['sender_email'];
								
								$email->SMTPHost=$vals['host'];
								$email->SMTPUser=$vals['username'];
								$email->SMTPPass=$vals['password'];
								$email->SMTPPort=$vals['port'];
							}
							
						}
					
						$email->setTo($common_data['user_data']['email']);
						$email->setCc($common_data['selected_ente']['email']);
						$email->setSubject($temp[0]['subject']);
						$titolo=$inf_modulo['sotto_titolo'];
						$zoom_date= Time::parse($inf_zoom['date'].' '.$inf_zoom['start_time'], 'Europe/Rome', 'it_IT')->toLocalizedString('d MMMM Y HH:mm');
						$html=str_replace(array("{var_user_name}","{modulo_titolo}","{zoom_date}"),
					array($common_data['user_data']['display_name'] ?? '',$titolo,$zoom_date),
					$temp[0]['html']);
						
						$email->setMessage($html);
						$email->setAltMessage(strip_tags($html));
						
						$xxx=$email->send();
						$yy=$this->NotifLogModel->insert(array('id_participant'=>$common_data['user_data']['id'],'type'=>'email','user_to'=>$common_data['user_data']['email'],'subject'=>$temp[0]['subject'],'message'=>$html,'date'=>date('Y-m-d H:i:s')));
		
			
						return true;
			}
		}
	}
	
	public function get_video_details(){
		$common_data=$this->common_data();
		 $id_participation=$this->request->getVar('id');
		$inf_p=$this->ParticipationModel->find($id_participation);
		?>
		<table class="table">
		<tr>
			<th><?php echo lang('app.field_vimeo')?></th>
			<th><?php echo lang('app.field_date')?></th>
			<th><?php echo lang('app.field_progress_video')?></th>
		</tr>
		<?php
		$list_vimeo=$this->CorsiModuloVimeoModel->where('banned','no')->where('enable','yes')->where('id_modulo',$inf_p['id_modulo'])->orderBy('ord','ASC')->find();
		if(!empty($list_vimeo)){
		foreach($list_vimeo as $kk=>$vv){
			$inf_last_status=$this->ParticipationOnlineStatusModel->where('id_participation',$id_participation)->where('vimeo_id',$vv['vimeo'])->orderBy('created_at','DESC')->first();
			if(!empty($inf_last_status)){
			$total_vimeo_percent=$inf_last_status['status'] ?? 0;
			?>
			<tr>
				<td><?php echo $vv['vimeo']?></td>
				<td><?php echo date('d/m/Y H:i',strtotime($inf_last_status['created_at']))?></td>
				<td><div class="progress">
  <div class="progress-bar" role="progressbar" style="width: <?= round($total_vimeo_percent) ?>%" aria-valuenow="<?= round($total_vimeo_percent) ?>" aria-valuemin="0" aria-valuemax="100"></div>
</div></td>
			</tr>
		<?php } }
		}
	}
	
	public function send_email_remember_cart(){
		$common_data=$this->common_data();
		$settings=$common_data['settings'];
		 $id=$this->request->getVar('id');
		 $inf_cart=$this->RememberCartModel->find($id);
		 	$inf_participant=$this->UserModel->where('id',$inf_cart['id_user'])->first();
			
			$inf_profile=$this->UserProfileModel->where('user_id',$inf_cart['id_user'])->first();
			
			$temp=$this->TemplatesModel->where('module','remember_cart')->where('id_ente',$inf_cart['id_ente'])->find();
			if(empty($temp)) $temp=$this->TemplatesModel->where('module','remember_cart')->where('id_ente IS NULL')->find();
			ob_start();
		 $inf_stato=$this->NazioniModel->find($inf_profile['fattura_stato']);
		 if($inf_profile['fattura_stato']==106){
				$inf_provincia=$this->ProvinceModel->find($inf_profile['fattura_provincia']);
				$inf_comune=$this->ComuniModel->find($inf_profile['fattura_comune']);
			}else{
				$inf_provincia['provincia']=$inf_profile['fattura_provincia'];
				$inf_comune['comune']=$inf_profile['fattura_comune'];
			}
			$list_items=json_decode($inf_cart['cart'],true);
			 ob_start();?>
		 <table style="width:100% !important; border:1px solid #a1a1a1;">
    <tbody>
        <tr style="border-bottom:1px solid #a1a1a1;">
            <th>Codice</th>
            <th>Descrizione</th>
            <th>Prezzo</th>
            <th>Docente</th>
        </tr>
        <?php $cart_total=0;
		$cart_vat=0;
		$discount_row="";
		$payment_status="";$coupon="";$invoice_data="";$cart_items="";$payment_details="";$cart_url="";
		  if(!empty($list_items)){
				foreach($list_items as $k=>$one){
					if(!in_array($k,array('cart_total','total_items'))){
					$cart_total+=$one['price'];
					$cart_vat+=($one['price']*$one['tax']/100);
					switch($one['type'] ?? ''){
						case 'corsi':
						//echo $one['id'];
						 $item_id=substr($one['id'],5);
							$inf_item=$this->CorsiModel->find($item_id);
							//var_dump($inf_item); exit;
							$url=base_url('corsi/'.$inf_item['url']);
							$tt=explode(",",$inf_item['ids_doctors']);
							$str_date="";
							$str_docente="";
							foreach($tt as $kk=>$vv){
								$inf_docente=$this->UserProfileModel->where('user_id',$vv)->first();
								$str_docente.=$inf_docente['nome'].' '.	$inf_docente['nome'].',';
							}
							$str_docente=substr($str_docente,0,-1);
							if($inf_item['foto']!="") $foto=base_url('uploads/corsi/'.$inf_item['foto']);
							else{
								$foto=base_url('front/assets/images/courses/img-4.jpg');
								switch($inf_item['tipologia_corsi']){
									case 'online': if($settings['default_img_online']!="") $foto=base_url('uploads/'.$settings['default_img_online']); break;
									case 'aula': if($settings['default_img_aula']!="") $foto=base_url('uploads/'.$settings['default_img_aula']); break;
									case 'webinar': if($settings['default_img_webinar']!="") $foto=base_url('uploads/'.$settings['default_img_webinar']); break;
								}
							}
							if($inf_item['tipologia_corsi']!='online'){
								$start_date=$this->CorsiModuloDateModel->where("id_modulo IN (select id from corsi_modulo where banned='no' and status='si' and id_corsi='".$item_id."')")->where('banned','no')->orderBy('date','ASC')->first();
								$end_date=$this->CorsiModuloDateModel->where("id_modulo IN (select id from corsi_modulo where banned='no' and status='si' and id_corsi='".$item_id."')")->where('banned','no')->orderBy('date','DESC')->first();
								if(!empty($start_date) && !empty($end_date))$str_date=lang('front.field_de')." ".date('d/m/Y H:i',strtotime($start_date['date'].' '.$start_date['start_time']))." ".lang('front.field_a')." ".date('d/m/Y H:i',strtotime($end_date['date'].' '.$end_date['end_time']));
							}
						break;
						case 'modulo':
						 $item_id=substr($one['id'],6); 
							$inf_item=$this->CorsiModuloModel->find($item_id);
							$url=base_url('modulo/'.$inf_item['url']);
							$inf_corsi=$this->CorsiModel->find($inf_item['id_corsi']);
							$inf_docente=$this->UserProfileModel->where('user_id',$inf_item['instructor'])->first();
							$str_docente=($inf_docente['nome'] ?? '').' '.	($inf_docente['nome'] ?? '');
							if($inf_item['foto']!="") $foto=base_url('uploads/corsi/'.$inf_item['foto']);
							else{
								$foto=base_url('front/assets/images/courses/img-4.jpg');
								switch($inf_corsi['tipologia_corsi']){
									case 'online': if($settings['default_img_online']!="") $foto=base_url('uploads/'.$settings['default_img_online']); break;
									case 'aula': if($settings['default_img_aula']!="") $foto=base_url('uploads/'.$settings['default_img_aula']); break;
									case 'webinar': if(($settings['default_img_webinar'] ?? '')!="") $foto=base_url('uploads/'.$settings['default_img_webinar']); break;
								}
							}
							$str_date="";
							$start_date=$this->CorsiModuloDateModel->where('id_modulo',$item_id)->where('banned','no')->orderBy('date','ASC')->first();
							$end_date=$this->CorsiModuloDateModel->where('id_modulo',$item_id)->where('banned','no')->orderBy('date','DESC')->first();
							if($inf_corsi['tipologia_corsi']!='online')
								$str_date=lang('front.field_de')." ".date('d/m/Y H:i',strtotime($start_date['date'].' '.$start_date['start_time']))." ".lang('front.field_a')." ".date('d/m/Y H:i',strtotime($end_date['date'].' '.$end_date['end_time']));
						break;
						case 'date':
						 $item_id=substr($one['id'],6); 
							$inf_date=$this->CorsiModuloDateModel->find($item_id);
							$inf_item=$this->CorsiModuloModel->find($inf_date['id_modulo']);
							$url=base_url('modulo/'.$inf_item['url']);
							$inf_docente=$this->UserProfileModel->where('user_id',$inf_item['instructor'])->first();
							$str_docente=$inf_docente['nome'].' '.	$inf_docente['nome'];
							$inf_corsi=$this->CorsiModel->find($inf_item['id_corsi']);
							if($inf_item['foto']!="") $foto=base_url('uploads/corsi/'.$inf_item['foto']);
							else{
								$foto=base_url('front/assets/images/courses/img-4.jpg');
								switch($inf_corsi['tipologia_corsi']){
									case 'online': if($settings['default_img_online']!="") $foto=base_url('uploads/'.$settings['default_img_online']); break;
									case 'aula': if($settings['default_img_aula']!="") $foto=base_url('uploads/'.$settings['default_img_aula']); break;
									case 'webinar': if($settings['default_img_webinar']!="") $foto=base_url('uploads/'.$settings['default_img_webinar']); break;
								}
							}
							$str_date=lang('front.field_de')." ".date('d/m/Y H:i',strtotime($inf_date['date'].' '.$inf_date['start_time']))." ".lang('front.field_a')." ".date('d/m/Y H:i',strtotime($inf_date['date'].' '.$inf_date['end_time']));
						break;
					}						
										 ?>
										  <tr>
            <td style="border-right:1px solid #a1a1a1;"><?php echo $inf_item['codice'] ?></td>
            <td style="border-right:1px solid #a1a1a1;"><b><?php echo $inf_item['sotto_titolo']?></b><br><?php echo $str_date;?></td>
            <td style="border-right:1px solid #a1a1a1;"><b><?php echo floatval($one['price'])?></b></td>
            <td>Dott. <?php echo $str_docente?></td>
        </tr>
					
					<?php  } } } ?>
		  </tbody>
</table>
<?php
			 $cart_items=ob_get_clean();
   $html=str_replace(array("{var_name}","{var_email}","{var_date}","{var_total_ht}","{var_discount_row}","{var_total_tax}","{var_total}","{var_payment_status}","{var_coupon}","{var_invoice_data}","{var_cart_details}","{var_payment_details}","{cart_url}","{var_password}"),
			array($inf_participant['display_name'],$inf_participant['email'],date('d/m/Y',strtotime($inf_cart['created_at'])),number_format($cart_total,2,',','.'),$discount_row,number_format($cart_total,2,',','.'),number_format($cart_total+$cart_vat,2,',','.'),$payment_status,$coupon,$invoice_data,$cart_items,$payment_details,$cart_url,$inf_participant['pass'] ),
			$temp[0]['html']);
			
			$email = \Config\Services::email();
			$sender_name=$settings['sender_name'];
			$sender_email=$settings['sender_email'];
			
			
			$SMTP=$this->SettingModel->getByMetaKeyEnte($common_data['user_data']['id'],'SMTP')['SMTP'];
				if($SMTP!="") $vals=json_decode($SMTP,true);
			
				if(!empty($vals)){
					if(isset($vals['sender_name'])  && $vals['sender_name']!="") $sender_name=$vals['sender_name']; else $sender_name=$settings['sender_name'];
					if(isset($vals['sender_email']) && $vals['sender_email']!="") $sender_email=$vals['sender_email']; else $sender_email=$settings['sender_email'];
					
					$email->SMTPHost=$vals['host'];
					$email->SMTPUser=$vals['username'];
					$email->SMTPPass=$vals['password'];
					$email->SMTPPort=$vals['port'];
				}
		
			
				$email->setFrom($sender_email,$sender_name);
				
			$email->setTo($inf_participant['email']);
			$email->setSubject($temp[0]['subject']);
			$email->setMessage($html);
			$email->setAltMessage(strip_tags($html));
			
			$xxx=$email->send();
			$yy=$this->NotifLogModel->insert(array('id_participant'=>$inf_participant['id'],'type'=>'email','user_to'=>$inf_participant['email'],'subject'=>$temp[0]['subject'],'message'=>$html,'date'=>date('Y-m-d H:i:s')));
		
		
		 
		 
	}
	
	public function get_info_cart(){
		$id=$this->request->getVar('id');
		$inf=$this->CartModel->find($id);
		$amount=number_format($inf['total_ht']+$inf['total_vat'],2,',','.');
		echo str_replace(array("{amount}"),array($amount),lang('app.alert_msg_creat_invoice'));
	}
}//end class
