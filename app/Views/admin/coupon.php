<?= view('admin/common/header',array('page_title'=>lang('app.title_page_coupon'))) ?>
<link href="<?php echo base_url('UBold_v4.1.0')?>/assets/libs/datatables.net-bs4/css/dataTables.bootstrap4.min.css" rel="stylesheet" type="text/css" />
<link href="<?php echo base_url('UBold_v4.1.0')?>/assets/libs/datatables.net-responsive-bs4/css/responsive.bootstrap4.min.css" rel="stylesheet" type="text/css" />
<link href="<?php echo base_url('UBold_v4.1.0')?>/assets/libs/datatables.net-buttons-bs4/css/buttons.bootstrap4.min.css" rel="stylesheet" type="text/css" />
<link href="<?php echo base_url('UBold_v4.1.0')?>/assets/libs/datatables.net-select-bs4/css//select.bootstrap4.min.css" rel="stylesheet" type="text/css" />
<link href="<?php echo base_url('UBold_v4.1.0')?>/assets/libs/flatpickr/flatpickr.min.css" rel="stylesheet" type="text/css" /> 
 <!-- ============================================================== -->
            <!-- Start Page Content here -->
            <!-- ============================================================== -->

            <div class="content-page">
                <div class="content">

                    <!-- Start Content-->
                    <div class="container-fluid">
                        
                        <!-- start page title -->
                        <div class="row">
                            <div class="col-12">
                                <div class="page-title-box">
                                    <div class="page-title-right">
                                        <ol class="breadcrumb m-0">
                                            <li class="breadcrumb-item"><a href="<?php echo base_url('admin/dashboard')?>"><?php echo lang('app.menu_dashboard')?></a></li>
											
											<li class="breadcrumb-item active"><?php echo lang('app.menu_coupon')?></li>
                                        </ol>
                                    </div>
                                    <div class="row align-items-center">
                                        <h4 class="page-title"><?= lang('app.title_page_coupon') ?></h4>
                                        <button type="button" data-toggle="modal" data-target="#new-category-modal" class="btn btn-info btn-rounded waves-effect waves-light ml-4" style="height: fit-content;">
                                            <span class="btn-label"><i class="mdi mdi-database-plus"></i></span><?= lang('app.new_coupon') ?>
                                        </button>
                                    </div>
                                </div>
                            </div>
                        </div>     
                        <!-- end page title --> 

                        <div class="row">
                            <div class="col-12">
                                <div class="card">
                                    <div class="card-body">
										<?php if(isset($success)){?>
                                       	<div class="alert alert-success" role="alert" id="error_alert" ><?php echo $success?></div>  
										<?php } ?>
                                        <!-- <p class="sub-header">Inline edit like a spreadsheet, toolbar column with edit button only and without focus on first input.</p> -->
                                        <div class="table-responsive">
                                            <table id="basic-datatable" class="table dt-responsive nowrap w-100">
                                                <thead>
                                                    <tr>
                                                     
														<th><?php echo lang('app.field_code')?></th>
														<th><?php echo lang('app.field_coupon_type')?></th>
														<th><?php echo lang('app.field_value')?></th>
														<th><?php echo lang('app.field_start_date')?></th>
														<th><?php echo lang('app.field_end_date')?></th>
														<th><?php echo lang('app.field_active_status')?></th>
														 <th data-sorting="disabled">&nbsp;</th>
                                                    </tr>
                                                </thead>
                                            
                                                <tbody>
                                                    <?php foreach($categories as $one_customer) { ?>
                                                    <tr>
                                                         <td><?php echo $one_customer['code']?></td>
														  <td><?php switch( $one_customer['coupon_type']){
															  case 'corsi': echo lang('app.field_type_coupon_corsi').'<br/><b>'.$one_customer['corsi_titolo'] ?? ''.'</b>';break;
															   case 'docenti': echo lang('app.field_type_coupon_docenti').'<br/><b>'.$one_customer['docenti_titolo'] ?? ''.'</b>';break;
																 case 'argomenti': echo lang('app.field_type_coupon_argomenti').'<br/><b>'.$one_customer['argomenti_titolo'] ?? ''.'</b>';break;
																case 'cart': echo lang('app.field_type_coupon_cart');break;
														  }?></td>
															<td><?php echo $one_customer['discount']?></td>
															 <td><?php echo $one_customer['start_date']?></td>
															  <td><?php echo $one_customer['end_date']?></td>
															 
														<td><?php if($one_customer['enable']=="yes") echo lang('app.yes'); else echo lang('app.no');?></td>
                                                        <td class="row pt-1">
                                                            <button type="button" data-toggle="modal" data-target="#update-category-modal"  onclick="get_data('<?php echo $one_customer['id']?>')" class="btn p-1 mr-2" style="font-size: 1rem">
                                                                <i class="fe-edit"></i>
                                                            </button>
															<a href="#delete-modal-dialog"  class="p-1" style="height: fit-content; font-size: 1rem; color: red" data-toggle="modal" onclick="del_data('<?php echo $one_customer['id']?>')"><i class="fe-x-circle"></i></a>	
															
                                                           
                                                        </td>
                                                    </tr>
                                                    <?php } ?>
                                                </tbody>
                                            </table>
                                        </div> <!-- end .table-responsive-->
                                    </div> <!-- end card-body -->
                                </div> <!-- end card -->
                            </div> <!-- end col -->
                        </div> <!-- end row -->
    
                    </div> <!-- container -->

                </div> <!-- content -->

                <!-- Footer Start -->
               <?php echo view('admin/common/footer_bar')?>
                <!-- end Footer -->

            </div>

            <!-- ============================================================== -->
            <!-- End Page content -->
            <!-- ============================================================== -->

            <!-- add new modal content -->
            <div id="new-category-modal" class="modal fade" tabindex="-1" role="dialog" aria-hidden="true">
                <div class="modal-dialog  modal-dialog-centered">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h4 class="modal-title" id="standard-modalLabel"><?= lang('app.new_category') ?></h4>
                            <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                        </div>
                        <div class="modal-body">
                            <form class="px-3" id="form_add" method="post" action="<?= base_url() ?>/admin/newCoupon" data-parsley-validate="">

                               
							    <div class="alert alert-danger " id="add_error_alert" role="alert" style="display:none">
											 <?php if(isset($error)) echo $error?>
											</div>
						<div class="form-group required-field">
							<label for="acc-name"><?php echo lang('app.field_code')?> *</label>
							<?php $val=""; 
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
							<?php $val=""; 
							$input = [
									'type'  => 'text',
									'name'  => 'start_date',
									'id'    => 'start_date',
									
									'value' => $val,
									'placeholder' =>lang('app.field_start_date'),
									'class' => 'form-control input_date'
									
							];

							echo form_input($input);
							?>
                                              
                         </div>
						  <div class="form-group required-field">
							<label for="acc-name"><?php echo lang('app.field_end_date')?></label>
							<?php $val="";
							$input = [
									'type'  => 'text',
									'name'  => 'end_date',
									'id'    => 'end_date',
									
									'value' => $val,
									'placeholder' =>lang('app.field_end_date'),
									'class' => 'form-control input_date'
									
							];

							echo form_input($input);
							?>
                                              
                         </div>
						<div class="form-group required-field">
							<label for="acc-name"><?php echo lang('app.field_nb_use')?> </label>
							<?php $val=""; 
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
												'onChange'=>"cp(this.value);",
												'class' => 'form-control'
										];
										$options=array();
										$options['cart']=lang('app.field_type_coupon_cart');
										$options['corsi']=lang('app.field_type_coupon_corsi');
										$options['docenti']=lang('app.field_type_coupon_docenti');
										$options['argomenti']=lang('app.field_type_coupon_argomenti');
										//var_dump($options);
										echo form_dropdown('coupon_type', $options,array(),$input);
							?>
                                              
                         </div>
							<div class="form-group required-field" id="div_type_corsi" style="display:none">
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
										echo form_dropdown($input, $options);
							?>
                                              
                         </div>
						 <div class="form-group required-field"  id="div_type_docenti" style="display:none">
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
										echo form_dropdown('id_docenti', $options,array(),$input);
							?>
                                              
                         </div>
						 <div class="form-group required-field"  id="div_type_argomenti" style="display:none">
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
										echo form_dropdown('id_argomenti', $options,array(),$input);
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
										echo form_dropdown('type', $options,array(),$input);
							?>
                                              
                         </div>
						 <div class="form-group required-field">
							<label for="acc-name"><?php echo lang('app.field_amount')?> </label>
							<?php $val=""; 
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
								  <div class="checkbox form-check-inline">
											<?php 
											$chk=false;
											
											$data = [
											'name'    => "status",
											'id'      => 'status',
											'value'   =>'enable',
											'checked' => $chk,
											'class' => 'form-check-input'
												];

												echo form_checkbox($data);
												?>
											  <label class="form-check-label" for="status"><?php echo lang("app.field_active_status")?></label>
											</div>
							   </div>
                                <div class="form-group text-center">
                                    <button class="btn btn-primary" type="button" onclick="valid_add();"><?= lang('app.btn_add') ?></button>
                                </div>

                            </form>

                        </div>
                    </div><!-- /.modal-content -->
                </div><!-- /.modal-dialog -->
            </div><!-- /.modal -->


            <!-- update category modal content -->
			   <form class="px-3" method="post" action="<?= base_url() ?>/admin/updateCoupon" data-parsley-validate="">
			     <input type="hidden" value="" id="updateId" name="catId">
            <div id="update-category-modal" class="modal fade" tabindex="-1" role="dialog" aria-hidden="true">
                <div class="modal-dialog  modal-dialog-centered">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h4 class="modal-title" id="standard-modalLabel"><?= lang('app.update_coupon') ?></h4>
                            <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                        </div>
                        <div class="modal-body px-3" id="profile_data">
                         
                              
                               
                              

                          

                        </div>
						 <div class="modal-footer">
						   <div class="form-group text-center">
                                    <button class="btn btn-primary" type="submit"><?= lang('app.btn_save') ?></button>
                                </div>
						 </div>
                    </div><!-- /.modal-content -->
                </div><!-- /.modal-dialog -->
            </div><!-- /.modal -->
  </form>
<?php $attributes = ['class' => 'form-input-flat', 'id' => 'deleteform','method'=>'post'];
		echo form_open("", $attributes);?>
		
		<div class="modal fade"id="delete-modal-dialog" tabindex="-1" role="dialog" style="display: none;" aria-hidden="true">
		<div class="modal-dialog modal-dialog-centered" >
                <div class="modal-content">
                    <div class="modal-header bg-light">
                        <h4 class="modal-title" id="myCenterModalLabel"><?php echo lang('app.modal_title_delete_coupon')?></h4>
                        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                    </div>
                    <div class="modal-body p-4">
                        <div class="form-group">
                           <?php  echo lang('app.alert_msg_delete_coupon')?>
						  </div>
                            <div class="text-right">
                                <button type="submit" class="btn btn-success waves-effect waves-light"><?php echo lang('app.btn_delete')?></button>
                                <button type="button" class="btn btn-danger waves-effect waves-light" data-dismiss="modal"><?php echo lang('app.btn_close')?></button>
                            </div>
                        
                    </div>
                </div><!-- /.modal-content -->
            </div>
		</div>
       <?php echo form_close();?>	
	   
<?= view('admin/common/footer') ?>


<script src="<?php echo base_url('UBold_v4.1.0')?>/assets/libs/datatables.net/js/jquery.dataTables.min.js"></script>
<script src="<?php echo base_url('UBold_v4.1.0')?>/assets/libs/datatables.net-bs4/js/dataTables.bootstrap4.min.js"></script>
<script src="<?php echo base_url('UBold_v4.1.0')?>/assets/libs/datatables.net-responsive/js/dataTables.responsive.min.js"></script>
<script src="<?php echo base_url('UBold_v4.1.0')?>/assets/libs/datatables.net-responsive-bs4/js/responsive.bootstrap4.min.js"></script>
<script src="<?php echo base_url('UBold_v4.1.0')?>/assets/libs/datatables.net-buttons/js/dataTables.buttons.min.js"></script>
<script src="<?php echo base_url('UBold_v4.1.0')?>/assets/libs/datatables.net-buttons-bs4/js/buttons.bootstrap4.min.js"></script>
<script src="<?php echo base_url('UBold_v4.1.0')?>/assets/libs/datatables.net-buttons/js/buttons.html5.min.js"></script>
<script src="<?php echo base_url('UBold_v4.1.0')?>/assets/libs/datatables.net-buttons/js/buttons.flash.min.js"></script>
<script src="<?php echo base_url('UBold_v4.1.0')?>/assets/libs/datatables.net-buttons/js/buttons.print.min.js"></script>
<script src="<?php echo base_url('UBold_v4.1.0')?>/assets/libs/datatables.net-keytable/js/dataTables.keyTable.min.js"></script>
<script src="<?php echo base_url('UBold_v4.1.0')?>/assets/libs/datatables.net-select/js/dataTables.select.min.js"></script>
<script src="<?php echo base_url('UBold_v4.1.0')?>/assets/libs/pdfmake/build/pdfmake.min.js"></script>
<script src="<?php echo base_url('UBold_v4.1.0')?>/assets/libs/pdfmake/build/vfs_fonts.js"></script>

<script src="<?php echo base_url('UBold_v4.1.0')?>/assets/js/pages/datatables.init.js"></script>
   <script src="<?php echo base_url('UBold_v4.1.0')?>/assets/libs/flatpickr/flatpickr.min.js"></script>
		   <script src="<?php echo base_url('UBold_v4.1.0')?>/assets/libs/flatpickr/l10n/it.js"></script>
<script>
$(document).ready(function(){
			"use strict";
			$("#start_date").flatpickr({
				dateFormat: "Y-m-d",
				 altFormat: "d/m/Y",
				 altInput:!0,
				 locale: "it",
			});
			$("#end_date").flatpickr({
				dateFormat: "Y-m-d",
				 altFormat: "d/m/Y",
				 altInput:!0,
				 locale: "it",
			});
});
    function updateID(id, name,status){
        $('#updatename').val(name);
		if(status=='enable') var checked=true; else var checked=false;
		$('#updateenable').attr('checked',checked);
        $('#updateId').val(id);
    }
	function del_data(id){
			$("#deleteform").attr('action',"<?= base_url() ?>/admin/deleteCoupon/"+id);
		}

function cp(t){
	switch(t){
		case 'corsi':$("#div_type_corsi").show(0);$("#div_type_docenti").hide(0); $("#div_type_argomenti").hide(0);break;
		case 'docenti':$("#div_type_corsi").hide(0);$("#div_type_docenti").show(0); $("#div_type_argomenti").hide(0);break;
		case 'argomenti':$("#div_type_corsi").hide(0);$("#div_type_docenti").hide(0);$("#div_type_argomenti").show(0); break;
		default:$("#div_type_corsi").hide(0);$("#div_type_docenti").hide(0);
	}
}

function cp_edit(t){
	switch(t){
		case 'corsi':$("#edit_div_type_corsi").show(0);$("#edit_div_type_docenti").hide(0);$("#edit_div_type_argomenti").hide(0); break;
		case 'docenti':$("#edit_div_type_corsi").hide(0);$("#edit_div_type_docenti").show(0);$("#edit_div_type_argomenti").hide(0); break;
		case 'argomenti':$("#edit_div_type_corsi").hide(0);$("#edit_div_type_docenti").hide(0);$("#edit_div_type_argomenti").show(0); break;
		default:$("#edit_div_type_corsi").hide(0);$("#edit_div_type_docenti").hide(0);
	}
}
function valid_add(){
		var fields = $( "#form_add" ).serializeArray();
			
			$.ajax({
				  url:"<?php echo base_url()?>/Coupon/validation_add",
				  method:"POST",
				  data:fields
				  
			}).done(function(data){
				
				var obj=JSON.parse(data);
				if(obj.error==true){
					$("#add_error_alert").html(obj.validation);
					$("#add_error_alert").show('slow');
					return false;
				}
				else{
					$("#add_error_alert").hide('slow');
					$( "#form_add" ).submit();
					//return true;
				}
			});
			return false;
	}
	
	function valid_edit(){
		var fields = $( "#form_edit" ).serializeArray();
			
			$.ajax({
				  url:"<?php echo base_url()?>/Coupon/validation_edit",
				  method:"POST",
				  data:fields
				  
			}).done(function(data){
				
				var obj=JSON.parse(data);
				if(obj.error==true){
					$("#edit_error_alert").html(obj.validation);
					$("#edit_error_alert").show('slow');
					return false;
				}
				else{
					$("#edit_error_alert").hide('slow');
					$( "#form_edit" ).submit();
					//return true;
				}
			});
			return false;
	}
	
		function get_data(id){ 
			$.ajax({  
				url:"<?php echo base_url('Coupon/get_data'); ?>",
				type: 'post',
				
				data:{id:id},
			/*	success:function(data){ 
					$("#profile_data").html(data);
					$('.input_date').datepicker({
						 //dateFormat: 'dd-mm-yy',
						 language: 'it',
						todayHighlight: true,
						autoclose: true
					
					});
				}  */
			}).done(function(data){
				
				$("#profile_data").html(data);
				$("#edit_start_date").flatpickr({
				dateFormat: "Y-m-d",
				 altFormat: "d/m/Y",
				 altInput:!0,
				 locale: "it",
			});
			$("#edit_end_date").flatpickr({
				dateFormat: "Y-m-d",
				 altFormat: "d/m/Y",
				 altInput:!0,
				 locale: "it",
			});
			});
	
		}
		
		
</script>
<?= view('admin/common/endtag') ?>
