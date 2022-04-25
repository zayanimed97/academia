<?php namespace App\Controllers;

class Coupon extends BaseController
{

	public function show_coupon_wallet()
	{ 	
		$common_data=$this->common_data();
		$data=$common_data;
		$user_data=$this->session->get('user_data');
		// die(var_dump($user_data));
		$categories = $this->CouponModel->where('id_ente', $user_data['id'])->where("coupon_type",'wallet')->find();
		$list=array();
			foreach($categories as $k=>$v){
				
				if($v['start_date']!=null) $v['start_date']=date('d/m/Y',strtotime($v['start_date']));
				if($v['end_date']!=null) $v['end_date']=date('d/m/Y',strtotime($v['end_date']));
				
				if($v['type']=='percent') $v['discount']=number_format($v['amount'],2,'.','').'%'; else $v['discount']=number_format($v['amount'],2,'.','').'€';
				if($v['id_user']!="") $inf_user=$this->UserModel->find($v['id_user']);
				$v['user']=$inf_user['display_name'] ?? '';
				$list[]=$v;
			}
		$data['categories'] = $list;
		
		if(null!==$this->session->get('success')){
			$data['success']=$this->session->get('success');
			$this->session->remove('success');
		}
		return view('admin/coupon_wallet.php',$data);
	}
	
	public function show()
	{ 	
		$common_data=$this->common_data();
		$data=$common_data;
		$user_data=$this->session->get('user_data');
		// die(var_dump($user_data));
		$categories = $this->CouponModel->where('id_ente', $user_data['id'])->where("coupon_type != 'wallet' ")->find();
		$list=array();
			foreach($categories as $k=>$v){
				switch($v['coupon_type']){
					case 'corsi':
						$inf=$this->CorsiModel->find($v['id_corsi']); 
						$corsi_titolo=$inf['sotto_titolo'];
						$docenti_titolo='';$argomenti_titolo='';
					break;
					case 'docenti':
						$corsi_titolo=''; $argomenti_titolo='';
						$inf=$this->UserModel->find($v['id_docenti']);
						$docenti_titolo=$inf['display_name'];
					break;
					case 'argomenti': 
						$corsi_titolo=''; $docenti_titolo='';
						$inf=$this->ArgomentiModel->find($v['id_argomenti']);
						$argomenti_titolo=$inf['nomeargomento'];
					break;
					default:$corsi_titolo='';$docenti_titolo='';$argomenti_titolo='';
				}
				$v['corsi_titolo']=$corsi_titolo;
				$v['docenti_titolo']=$docenti_titolo;
				$v['argomenti_titolo']=$argomenti_titolo;
				if($v['start_date']!=null) $v['start_date']=date('d/m/Y',strtotime($v['start_date']));
				if($v['end_date']!=null) $v['end_date']=date('d/m/Y',strtotime($v['end_date']));
				
				if($v['type']=='percent') $v['discount']=number_format($v['amount'],2,'.','').'%'; else $v['discount']=number_format($v['amount'],2,'.','').'€';
				$list[]=$v;
			}
		$data['categories'] = $list;
		$data['list_corsi']=$this->CorsiModel->where('id_ente',$user_data['id'])->where('banned','no')->where('status','si')->orderby('sotto_titolo','asc')->findAll();
		$data['list_doctors']=$this->UserModel->where('id_ente',$user_data['id'])->where('role','doctor')->find();
		$data['list_argomenti']=$this->ArgomentiModel->where('id_ente',$user_data['id'])->where('banned','no')->where('visibile','1')->orderby('nomeargomento','asc')->findAll();
		if(null!==$this->session->get('success')){
			$data['success']=$this->session->get('success');
			$this->session->remove('success');
		}
		return view('admin/coupon.php',$data);
	}

	public function new(){
		$common_data=$this->common_data();
		$data=$common_data;
		$user_data=$this->session->get('user_data');
		if(!is_null($this->request->getVar('status'))) $status="yes"; else $status="no";
						if($this->request->getVar('start_date')!=""){  
						 $start_date=$this->request->getVar('start_date');
		
						
						 }
						 else $start_date=null;
						 if($this->request->getVar('end_date')!=""){  
							$end_date=$this->request->getVar('end_date');
						 }
						 else $end_date=null;
						 switch($this->request->getVar('coupon_type')){
							 case 'corsi':$id_corsi=$this->request->getVar('id_corsi'); $id_docenti=null;$id_argomenti=null;break;
							  case 'docenti':$id_corsi=null; $id_docenti=$this->request->getVar('id_docenti');$id_argomenti=null;break;
							   case 'argomenti':$id_corsi=null; $id_docenti=null;$id_argomenti=$this->request->getVar('id_argomenti');break;
							  default:$id_corsi=null;$id_docenti=null;$id_argomenti=null;
						 }
						$data=array(
						'id_ente'=>$user_data['id'],
							'code'=>$this->request->getVar('code'),
							'coupon_type'=>$this->request->getVar('coupon_type'),
							'start_date'=>$start_date,
							'end_date'=>$end_date,
							'id_corsi'=>$id_corsi,
							'id_docenti'=>$id_docenti,
							'id_argomenti'=>$id_argomenti,
							'nb_use'=>$this->request->getVar('nb_use'),
							'used'=>0,
							'enable'=>$status,
							'type'=>$this->request->getVar('type'),
							'amount'=>floatval($this->request->getVar('amount')),
						);
						
						$this->CouponModel->insert($data);
		return redirect()->to($_SERVER['HTTP_REFERER'])->with('success', lang('app.success_add'));
	}

	public function update()
	{$common_data=$this->common_data();
		$data=$common_data;
		$user_data=$this->session->get('user_data');
		if(!is_null($this->request->getVar('status'))) $status="yes"; else $status="no";
						 if($this->request->getVar('start_date')!=""){  
						 $start_date=$this->request->getVar('start_date');
		
						
						 }
						 else $start_date=null;
						 if($this->request->getVar('end_date')!=""){  
							$end_date=$this->request->getVar('end_date');
						 }
						 else $end_date=null;
						 switch($this->request->getVar('coupon_type')){
							 case 'corsi':$id_corsi=$this->request->getVar('id_corsi'); $id_docenti=null;$id_argomenti=null;break;
							  case 'docenti':$id_corsi=null; $id_docenti=$this->request->getVar('id_docenti');$id_argomenti=null;break;
							   case 'argomenti':$id_corsi=null; $id_docenti=null;$id_argomenti=$this->request->getVar('id_argomenti');break;
							  default:$id_corsi=null;$id_docenti=null;$id_argomenti=null;
						 }
						$data=array(
						'id_ente'=>$user_data['id'],
							'code'=>$this->request->getVar('code'),
							'coupon_type'=>$this->request->getVar('coupon_type'),
							'start_date'=>$start_date,
							'end_date'=>$end_date,
							'id_corsi'=>$id_corsi,
							'id_docenti'=>$id_docenti,
							'id_argomenti'=>$id_argomenti,
							'nb_use'=>$this->request->getVar('nb_use'),
							'used'=>0,
							'enable'=>$status,
							'type'=>$this->request->getVar('type'),
							'amount'=>floatval($this->request->getVar('amount')),
						);
						
						$this->CouponModel->update($this->request->getVar('id'),$data);
		return redirect()->to($_SERVER['HTTP_REFERER'])->with('success', lang('app.success_update'));
	}
	
	public function delete($id)
	{
		$this->CouponModel->where('id_ente', $this->session->get('user_data')['id'])->where('id', $id)->delete();
		return redirect()->to($_SERVER['HTTP_REFERER'])->with('success', lang('app.success_delete'));
	}
	
	public function validation_add(){
		$val = $this->validate([
				
				'code' => ['label' => lang('app.field_code'), 'rules' => 'trim|required']	,
				'type' => ['label' => lang('app.field_type'), 'rules' => 'trim|required'],
				'amount' => ['label' => lang('app.field_amount'), 'rules' => 'trim|required|decimal']
				
		]);
		$start_date=$this->request->getVar('start_date');
		$end_date=$this->request->getVar('end_date');
		/* if($this->request->getVar('start_date')!=""){  
							$dt=explode('/',$this->request->getVar('start_date'));
							$start_date=$dt[2]."-".$dt[1]."-".$dt[0];
						 }
						
						 if($this->request->getVar('end_date')!=""){  
							$dt=explode('/',$this->request->getVar('end_date'));
							$end_date=$dt[2]."-".$dt[1]."-".$dt[0];
						 }
						
		*/
		$exist_code=$this->CouponModel->where('id_ente', $this->session->get('user_data')['id'])->where('code',$this->request->getVar('code'))->find();
		if (!$val)
		{
				//var_dump($this->validator);
				$validation=$this->validator;
				$error_msg=$validation->listErrors();
				$res=array("error"=>true,"validation"=>$error_msg);
		}
		elseif(!empty($exist_code)){
			$error_msg=lang('app.error_code_exist');
			$res=array("error"=>true,"validation"=>$error_msg);
		}
		elseif($this->request->getVar('coupon_type')=='corsi' && $this->request->getVar('id_corsi')=='select'){
			$error_msg=str_replace('{field}',lang('app.field_corsi'),lang('app.error_required_field'));
			$res=array("error"=>true,"validation"=>$error_msg);
		}
		elseif($this->request->getVar('coupon_type')=='docenti' && $this->request->getVar('id_docenti')=='select'){
			$error_msg=str_replace('{field}',lang('app.field_docenti'),lang('app.error_required_field'));
			$res=array("error"=>true,"validation"=>$error_msg);
		}
		elseif($this->request->getVar('coupon_type')=='argomenti' && $this->request->getVar('id_argomenti')=='select'){
			$error_msg=str_replace('{field}',lang('app.field_argomenti'),lang('app.error_required_field'));
			$res=array("error"=>true,"validation"=>$error_msg);
		}
		elseif($this->request->getVar('start_date')!="" && $this->request->getVar('end_date')!="" && strtotime($end_date)<=strtotime($start_date)){
			$error_msg=lang('app.error_coupon_date');
			$res=array("error"=>true,"validation"=>$error_msg);	
		}
		else{
			$res=array("error"=>false);
		}
		echo json_encode($res);
	}
	
	public function validation_edit(){
		$val = $this->validate([
				
				'code' => ['label' => lang('app.field_code'), 'rules' => 'trim|required|is_unique[coupon.code,id,'.$this->request->getVar('id').']'],
				'type' => ['label' => lang('app.field_type'), 'rules' => 'trim|required'],
				'amount' => ['label' => lang('app.field_amount'), 'rules' => 'trim|required|decimal']
				
		]);
		 $start_date=$this->request->getVar('start_date');
		$end_date=$this->request->getVar('end_date');
		if (!$val)
		{
				//var_dump($this->validator);
				$validation=$this->validator;
				$error_msg=$validation->listErrors();
				$res=array("error"=>true,"validation"=>$error_msg);
		}
		elseif($this->request->getVar('coupon_type')=='corsi' && $this->request->getVar('id_corsi')=='select'){
			$error_msg=str_replace('{field}',lang('app.field_corsi'),lang('app.error_required_field'));
			$res=array("error"=>true,"validation"=>$error_msg);
		}
		elseif($this->request->getVar('coupon_type')=='docenti' && $this->request->getVar('id_docenti')=='select'){
			$error_msg=str_replace('{field}',lang('app.field_docenti'),lang('app.error_required_field'));
			$res=array("error"=>true,"validation"=>$error_msg);
		}
		elseif($this->request->getVar('coupon_type')=='argomenti' && $this->request->getVar('id_argomenti')=='select'){
			$error_msg=str_replace('{field}',lang('app.field_argomenti'),lang('app.error_required_field'));
			$res=array("error"=>true,"validation"=>$error_msg);
		}
		elseif($this->request->getVar('start_date')!="" && $this->request->getVar('end_date')!="" && strtotime($end_date)<=strtotime($start_date)){
			$error_msg=lang('app.error_coupon_date');
			$res=array("error"=>true,"validation"=>$error_msg);	
		}
		else{
			$res=array("error"=>false);
		}
		echo json_encode($res);
	}
	
	public function get_data(){
		$user_data=$this->session->get('user_data');
		$id=$this->request->getVar('id');
		$data=$this->CouponModel->find($id);	
		$list_argomenti=$this->ArgomentiModel->where('id_ente',$user_data['id'])->where('banned','no')->where('visibile','1')->orderby('nomeargomento','asc')->findAll();
		$list_corsi=$this->CorsiModel->where('id_ente',$user_data['id'])->where('banned','no')->where('status','si')->orderby('sotto_titolo','asc')->findAll();
			$list_doctors=$this->UserModel->where('id_ente',$user_data['id'])->where('role','doctor')->find();
	
		
		?>
		<input type="hidden" name="id" value="<?php echo $data['id']?>">
		<div class="alert alert-danger " id="edit_error_alert" role="alert" style="display:none">
											 <?php if(isset($error)) echo $error?>
											</div>
							<div class="form-group required-field">
							<label for="acc-name"><?php echo lang('app.field_code')?> *</label>
							<?php $val=""; $val=$data['code'];
							$input = [
									'type'  => 'text',
									'name'  => 'code',
									'id'    => 'code',
									'required' =>true,
									'value' => $val,
									'placeholder' =>lang('app.field_code'),
									'class' => 'form-control'
									
							];

							echo form_input($input);
							?>
                                              
                         </div>
						 <div class="form-group required-field">
							<label for="acc-name"><?php echo lang('app.field_start_date')?></label>
							<?php $val=""; if($data['start_date']!=null) $val=date('Y-m-d',strtotime($data['start_date']));
							$input = [
									'type'  => 'text',
									'name'  => 'start_date',
									'id'    => 'edit_start_date',
									
									'value' => $val,
									'placeholder' =>lang('app.field_start_date'),
									'class' => 'form-control input_date'
									
							];

							echo form_input($input);
							?>
                                              
                         </div>
						  <div class="form-group required-field">
							<label for="acc-name"><?php echo lang('app.field_end_date')?></label>
							<?php $val="";  if($data['end_date']!=null) $val=date('Y-m-d',strtotime($data['end_date']));
							$input = [
									'type'  => 'text',
									'name'  => 'end_date',
									'id'    => 'edit_end_date',
									
									'value' => $val,
									'placeholder' =>lang('app.field_end_date'),
									'class' => 'form-control input_date'
									
							];

							echo form_input($input);
							?>
                                              
                         </div>
						<div class="form-group required-field">
							<label for="acc-name"><?php echo lang('app.field_nb_use')?> </label>
							<?php $val=""; $val=$data['nb_use'];
							$input = [
									'type'  => 'number',
									'name'  => 'nb_use',
									'id'    => 'nb_use',
									'step'=>1,
									'value' => $val,
									'placeholder' =>lang('app.field_nb_use'),
									'class' => 'form-control'
									
							];

							echo form_input($input);
							?>
                                              
                         </div>
						 <div class="form-group required-field">
							<label for="acc-name"><?php echo lang('app.field_coupon_type')?> </label>
							<?php $val=""; 
							
							$input = [
												
												'id'    => 'coupon_type',
												'placeholder' =>lang('app.field_type'),
												'onChange'=>"cp_edit(this.value);",
												'class' => 'form-control'
										];
										$options=array();
										$options['cart']=lang('app.field_type_coupon_cart');
										$options['corsi']=lang('app.field_type_coupon_corsi');
										$options['docenti']=lang('app.field_type_coupon_docenti');
									$options['argomenti']=lang('app.field_type_coupon_argomenti');
										//var_dump($options);
										echo form_dropdown('coupon_type', $options,$data['coupon_type'],$input);
							?>
                                              
                         </div>
							<div class="form-group required-field" id="edit_div_type_corsi" <?php if($data['coupon_type']!='corsi'){?>style="display:none"<?php } ?>>
							<label for="acc-name"><?php echo lang('app.field_corsi')?> *</label>
							<?php $val=""; 
							
							$input = [
												'name'    => 'id_corsi',
												'id'    => 'id_corsi',
												'placeholder' =>lang('app.field_corsi'),
												
												'class' => 'form-control'
										];
										$options=array();
										$options['select']=lang('app.field_select');
										foreach($list_corsi as $k=>$v){
											$options[$v['id']]=$v['sotto_titolo'];
										}
										//var_dump($options);
										echo form_dropdown($input, $options,$data['id_corsi']);
							?>
                                              
                         </div>
						 <div class="form-group required-field"  id="edit_div_type_docenti" <?php if($data['coupon_type']!='docenti'){?>style="display:none"<?php } ?>>
							<label for="acc-name"><?php echo lang('app.field_docente')?> *</label>
							<?php $val=""; 
							
							$input = [
												
												'id'    => 'id_docenti',
												'placeholder' =>lang('app.field_docente'),
												
												'class' => 'form-control'
										];
										$options=array();
									$options['select']=lang('app.field_select');
										foreach($list_doctors as $k=>$v){
											$options[$v['id']]=$v['display_name'];
										}
										//var_dump($options);
										echo form_dropdown('id_docenti', $options,$data['id_docenti'],$input);
							?>
                                              
                         </div>
						 <div class="form-group required-field"  id="edit_div_type_argomenti" <?php if($data['coupon_type']!='argomenti'){?>style="display:none"<?php } ?>>
							<label for="acc-name"><?php echo lang('app.field_argomenti')?> *</label>
							<?php $val=""; 
							
							$input = [
												
												'id'    => 'id_argomenti',
												'placeholder' =>lang('app.field_argomenti'),
												
												'class' => 'form-control'
										];
										$options=array();
									$options['select']=lang('app.field_select');
										foreach($list_argomenti as $k=>$v){
											$options[$v['idargomenti']]=$v['nomeargomento'];
										}
										//var_dump($options);
										echo form_dropdown('id_argomenti', $options,$data['id_argomenti'],$input);
							?>
                                              
                         </div>
						  <div class="form-group required-field">
							<label for="acc-name"><?php echo lang('app.field_discount_type')?> </label>
							<?php $val=""; 
							
							$input = [
												
												'id'    => 'type',
												'placeholder' =>lang('app.field_discount_type'),
												
												'class' => 'form-control'
										];
										$options=array();
										
										$options['fixed']=lang('app.field_fixed');
										$options['percent']=lang('app.field_percent');
									
										//var_dump($options);
										echo form_dropdown('type', $options,$data['type'],$input);
							?>
                                              
                         </div>
						 <div class="form-group required-field">
							<label for="acc-name"><?php echo lang('app.field_amount')?> </label>
							<?php $val=""; $val=$data['amount'];
							$input = [
									'type'  => 'number',
									'name'  => 'amount',
									'id'    => 'amount',
									
									'value' => $val,
									'placeholder' =>lang('app.field_amount'),
									'class' => 'form-control'
									
							];

							echo form_input($input);
							?>
                                              
                         </div>
						<div class="form-group">
								  <div class="checkbox ">
											<?php 
											if($data['enable']=='yes') $chk=true; else $chk=false;
											
											$data = [
											'name'    => "status",
											'id'      => 'status_edit',
											'value'   =>'enable',
											'checked' => $chk,
											'class' => 'form-check-input'
												];

												echo form_checkbox($data);
												?>
											  <label class="form-check-label" for="status_edit"><?php echo lang("app.field_active_status")?></label>
											</div>
							   </div>
	<?php
	}
}
?>
