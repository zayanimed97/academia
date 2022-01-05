<?php namespace App\Controllers;


class Alberghi extends BaseController
{


	
	public function index()
	{		
		
			$common_data=$this->common_data();
		$array=$common_data;
			if($this->request->getVar('action')!==null){
				
				switch($this->request->getVar('action')){
					case 'add':
						if(!is_null($this->request->getVar('pubblica'))) $status="1"; else $status="0";
						 $validated = $this->validate([
							'foto' => [
								'uploaded[foto]',
								'mime_in[foto,image/jpg,image/jpeg,image/gif,image/png]',
								'max_size[foto,4096]',
							],
						]);
						
						if ($validated) { 
							$avatar_logo = $this->request->getFile('foto');
							 $logo_name = $avatar_logo->getRandomName();
							
							$avatar_logo->move(ROOTPATH.'public/uploads/alberghi/',$logo_name);
						
						
						}
						else $logo_name=null;
						$data=array(
						'id_ente'=>$array['user_data']['id'],
							'nome'=>$this->request->getVar('nome'),
							'idluogo'=>$this->request->getVar('idluogo'),
							'indirizzo'=>$this->request->getVar('indirizzo'),
							'citta'=>$this->request->getVar('citta'),
							'provincia'=>$this->request->getVar('provincia'),
							'cap'=>$this->request->getVar('cap'),
							'telefono'=>$this->request->getVar('telefono'),
							'email'=>$this->request->getVar('email'),
							'sito'=>$this->request->getVar('sito'),
							'gmap'=>$this->request->getVar('gmap'),
							'foto'=>$logo_name,
							'pubblica'=>$status,
							'testo'=>$this->request->getVar('testo'),
							
						);
						
						 $albid=$this->AlberghiModel->insert($data);
						if(!is_null($this->request->getVar('def_sede'))){
							$this->LuoghiModel->update($this->request->getVar('idluogo'),array('id_def'=>$albid));
						}
							$success=lang('app.success_add');
					break;
					case 'edit': 
					 $id=$this->request->getVar('id');
					$inf_alb=$this->AlberghiModel->find($id);
					$inf_lug=$this->LuoghiModel->find($inf_alb['idluogo']);
					
						if(!is_null($this->request->getVar('pubblica'))) $status="1"; else $status="0";
						$data=array(
							'nome'=>$this->request->getVar('nome'),
							'idluogo'=>$this->request->getVar('idluogo'),
							'indirizzo'=>$this->request->getVar('indirizzo'),
							'citta'=>$this->request->getVar('citta'),
							'provincia'=>$this->request->getVar('provincia'),
							'cap'=>$this->request->getVar('cap'),
							'telefono'=>$this->request->getVar('telefono'),
							'email'=>$this->request->getVar('email'),
							'sito'=>$this->request->getVar('sito'),
							'gmap'=>$this->request->getVar('gmap'),
							
							'pubblica'=>$status,
							'testo'=>$this->request->getVar('testo'),
						);
						 $validated = $this->validate([
							'foto' => [
								'uploaded[foto]',
								'mime_in[foto,image/jpg,image/jpeg,image/gif,image/png]',
								'max_size[foto,4096]',
							],
						]);
						
						if ($validated) { 
							$avatar_logo = $this->request->getFile('foto');
							 $logo_name = $avatar_logo->getRandomName();
							
							$avatar_logo->move(ROOTPATH.'public/uploads/alberghi/',$logo_name);
						$data['foto']= $logo_name;
						
						}
					
						$this->AlberghiModel->update($id,$data);
						$all=$this->LuoghiModel->where('id_def',$id)->findALL();
						foreach($all as $k=>$v){
							$this->LuoghiModel->update($v['id'],array('id_def'=>null));
						}
						if(!is_null($this->request->getVar('def_sede'))){
							$this->LuoghiModel->update($this->request->getVar('idluogo'),array('id_def'=>$id));
						}
						
					
						
							$success=lang('app.success_update');
					break;
					case 'delete':
						$id=$this->request->getVar('user_to_delete');
						if($id!=""){
							$this->AlberghiModel->update($id,array("banned"=>'yes'));
						
							$success=lang('app.success_delete');
						}
					break;
				}
			}
			
			
			$data=array();
			$list=$this->AlberghiModel->where('banned','no');
			if($this->request->getVar('search')!==null){
				if($this->request->getVar('search_title')!="") $this->AlberghiModel->like('nome', $this->request->getVar('search_title'));		
				if($this->request->getVar('search_active')!="") $this->AlberghiModel->where('visibile',$this->request->getVar('search_active'));
			
			}
			
			$list=$this->AlberghiModel->where('id_ente',$array['user_data']['id'])->findAll();//search('D',$display_name,$email,$active,$is_expired,$cf);
			
			foreach($list as $kk=>$vv){
				$inf_luoghi=$this->LuoghiModel->find($vv['idluogo']);
				$vv['luoghi']=$inf_luoghi['nome'];
				$data[]=$vv;
			}
			$array['list_luoghi']=$this->LuoghiModel->where('banned','no')->where('id_ente',$array['user_data']['id'])->orderby('nome','ASC')->findAll();
			$array['list']=$data;
			
			if(isset($error)) $array['error']=$error;
			if(isset($success)) $array['success']=$success;
			return view('admin/alberghi.php',$array);
		
	}
	
	public function validation_add(){
		$val = $this->validate([
				
			'nome' => ['label' => lang('app.field_first_name'), 'rules' => 'trim|required'],
			'idluogo' => ['label' => lang('app.field_luoghi'), 'rules' => 'trim|required']					
				
		]);
		if (!$val)
		{
				//var_dump($this->validator);
				$validation=$this->validator;
				$error_msg=$validation->listErrors();
				$res=array("error"=>true,"validation"=>$error_msg);
		}
		else{
			$res=array("error"=>false);
		}
		echo json_encode($res);
	}
	
	public function validation_edit(){
		$val = $this->validate([
				
				'nome' => ['label' => lang('app.field_first_name'), 'rules' => 'trim|required'],
			'idluogo' => ['label' => lang('app.field_luoghi'), 'rules' => 'trim|required']					
				
		]);
		if (!$val)
		{
				//var_dump($this->validator);
				$validation=$this->validator;
				$error_msg=$validation->listErrors();
				$res=array("error"=>true,"validation"=>$error_msg);
		}
		else{
			$res=array("error"=>false);
		}
		echo json_encode($res);
	}
	
	public function get_data(){
		$common_data=$this->common_data();
		$id=$this->request->getVar('id');
		$data=$this->AlberghiModel->find($id);
$inf_profile=$data;	
$inf_l=$this->LuoghiModel->find($data['idluogo']);
		$list_luoghi=$this->LuoghiModel->where('banned','no')->where('id_ente',$common_data['user_data']['id'])->orderby('nome','ASC')->findAll();
		?>
		
	
						<div class="form-group required-field">
							<label for="acc-name"><?php echo lang('app.field_first_name')?></label>
							<?php $val=""; $val=$inf_profile['nome'];
							$input = [
									'type'  => 'text',
									'name'  => 'nome',
									'id'    => 'nome',
									'required' =>true,
									'value' => $val,
									'placeholder' =>lang('app.field_first_name'),
									'class' => 'form-control'
									
							];

							echo form_input($input);
							?>
                                              
                         </div>
						 <div class="form-group required-field">
							<label for="acc-name"><?php echo lang('app.field_luoghi')?></label>
							
                               <div class="form-group">
								<select class="form-control" name="idluogo" id="idluogo">
									<option value=""><?php echo  lang('app.field_select') ?></option>
									<?php foreach($list_luoghi as $k=>$v){?>
										<option value="<?php echo $v['id']?>" <?php if($v['id']==$inf_profile['idluogo']) echo 'selected'?>><?php echo  $v['nome'] ?></option>
									<?php }?>
								</select>
							</div>               
                         </div>
						 <div class="form-group required-field">
							<label for="acc-name"><?php echo lang('app.field_address')?></label>
							<?php $val=""; $val=$inf_profile['indirizzo'];
							$input = [
									'type'  => 'text',
									'name'  => 'indirizzo',
									'id'    => 'indirizzo',
									'required' =>true,
									'value' => $val,
									'placeholder' =>lang('app.field_address'),
									'class' => 'form-control'
									
							];

							echo form_input($input);
							?>
                                              
                         </div>
						 <div class="form-group required-field">
							<label for="acc-name"><?php echo lang('app.field_city')?></label>
							<?php $val=""; $val=$inf_profile['citta'];
							$input = [
									'type'  => 'text',
									'name'  => 'citta',
									'id'    => 'citta',
									'required' =>true,
									'value' => $val,
									'placeholder' =>lang('app.field_city'),
									'class' => 'form-control'
									
							];

							echo form_input($input);
							?>
                                              
                         </div>
						 <div class="form-group required-field">
							<label for="acc-name"><?php echo lang('app.field_provincia')?></label>
							<?php $val=""; $val=$inf_profile['provincia'];
							$input = [
									'type'  => 'text',
									'name'  => 'provincia',
									'id'    => 'provincia',
									'required' =>true,
									'value' => $val,
									'placeholder' =>lang('app.field_provincia'),
									'class' => 'form-control'
									
							];

							echo form_input($input);
							?>
                                              
                         </div>
						  <div class="form-group required-field">
							<label for="acc-name"><?php echo lang('app.field_zip')?></label>
							<?php $val=""; $val=$inf_profile['cap'];
							$input = [
									'type'  => 'text',
									'name'  => 'cap',
									'id'    => 'cap',
									'required' =>true,
									'value' => $val,
									'placeholder' =>lang('app.field_zip'),
									'class' => 'form-control'
									
							];

							echo form_input($input);
							?>
                                              
                         </div>
						  <div class="form-group required-field">
							<label for="acc-name"><?php echo lang('app.field_phone')?></label>
							<?php $val=""; $val=$inf_profile['telefono'];
							$input = [
									'type'  => 'text',
									'name'  => 'telefono',
									'id'    => 'telefono',
									
									'value' => $val,
									'placeholder' =>lang('app.field_phone'),
									'class' => 'form-control'
									
							];

							echo form_input($input);
							?>
                                              
                         </div>
						  <div class="form-group required-field">
							<label for="acc-name"><?php echo lang('app.field_email')?></label>
							<?php $val=""; $val=$inf_profile['email'];
							$input = [
									'type'  => 'text',
									'name'  => 'email',
									'id'    => 'email',
									
									'value' => $val,
									'placeholder' =>lang('app.field_email'),
									'class' => 'form-control'
									
							];

							echo form_input($input);
							?>
                                              
                         </div>
						 <div class="form-group required-field">
							<label for="acc-name"><?php echo lang('app.field_publica_sitoweb')?></label>
							<?php $val=""; $val=$inf_profile['sito'];
							$input = [
									'type'  => 'text',
									'name'  => 'sito',
									'id'    => 'sito',
									
									'value' => $val,
									'placeholder' =>lang('app.field_publica_sitoweb'),
									'class' => 'form-control'
									
							];

							echo form_input($input);
							?>
                                              
                         </div>
						 <div class="form-group required-field">
							<label for="acc-name"><?php echo lang('app.field_testo')?></label>
							<?php $val=""; $val=$inf_profile['testo'];
							$input = [
									
									'name'  => 'testo',
									'id'    => 'edit_testo',
									
									'value' => $val,
									'placeholder' =>lang('app.field_testo'),
									'class' => 'form-control'
									
							];

							echo form_textarea($input);
							?>
                                              
                         </div>
						<div class="form-group required-field">
							<label for="acc-name"><?php echo lang('app.field_gmap')?></label>
							<?php $val=""; $val=$inf_profile['gmap'];
							$input = [
									
									'name'  => 'gmap',
									'id'    => 'gmap',
									
									'value' => $val,
									'placeholder' =>lang('app.field_gmap'),
									'class' => 'form-control'
									
							];

							echo form_textarea($input);
							?>
                                              
                         </div>
							<label class="col-form-label " for="foto"><?php echo lang("app.field_image")?> </label>
							<div class="col-sm-12">
								<input class="form-control" type="file" id="foto" name="foto"  />
							</div>
						 <div class="form-check form-check-inline">
											<?php 
											$chk=false;
											if($inf_profile['pubblica']==1) $chk=true;
											$data = [
											'name'    => "pubblica",
											'id'      => 'pubblica',
											'value'   =>'1',
											'checked' => $chk,
											'class' => 'form-check-input'
												];

												echo form_checkbox($data);
												?>
											  <label class="form-check-label" for="inlineCheckbox1"><?php echo lang("app.field_active_status")?></label>
											</div>
						<div class="form-check form-check-inline">
											<?php 
											$chk=false;
											if(isset($inf_l['def_sede']) && $inf_l['def_sede']==1) $chk=true;
											$data = [
											'name'    => "def_sede",
											'id'      => 'def_sede',
											'value'   =>'1',
											'checked' => $chk,
											'class' => 'form-check-input'
												];

												echo form_checkbox($data);
												?>
											  <label class="form-check-label" for="inlineCheckbox1"><?php echo lang("app.field_def_sede")?></label>
											</div>
	<?php
	}
}