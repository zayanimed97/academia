<?= view('admin/common/header',array('page_title'=>lang('app.title_page_coupon_wallet'))) ?>
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
											
											<li class="breadcrumb-item active"><?php echo lang('app.menu_coupon_wallet')?></li>
                                        </ol>
                                    </div>
                                    <div class="row align-items-center">
                                        <h4 class="page-title"><?= lang('app.title_page_coupon_wallet') ?></h4>
                                     
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
														<th><?php echo lang('app.field_participante')?></th>
														<th><?php echo lang('app.field_value')?></th>
														<th><?php echo lang('app.field_start_date')?></th>
														<th><?php echo lang('app.field_end_date')?></th>
														<th><?php echo lang('app.field_active_status')?></th>
														
                                                    </tr>
                                                </thead>
                                            
                                                <tbody>
                                                    <?php foreach($categories as $one_customer) { ?>
                                                    <tr>
                                                         <td><?php echo $one_customer['code']?></td>
														  <td><?php echo $one_customer['user']?></td>
															<td><?php echo $one_customer['discount']?></td>
															 <td><?php echo $one_customer['start_date']?></td>
															  <td><?php echo $one_customer['end_date']?></td>
															 
														<td><?php if($one_customer['enable']=="yes") echo lang('app.yes'); else echo lang('app.no');?></td>
                                                        
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
