<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8" />
       <title>Admin | <?php echo $settings['meta_title']?></title>
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <meta content="A fully featured admin theme which can be used to build CRM, CMS, etc." name="description" />
        <meta content="Coderthemes" name="author" />
        <meta http-equiv="X-UA-Compatible" content="IE=edge" />
		<?= csrf_meta() ?>
        <!-- App favicon -->
        <link rel="shortcut icon" href="<?php echo base_url('UBold_v4.1.0')?>/assets/images/favicon.ico">
		  <link href="<?php echo base_url('UBold_v4.1.0')?>/assets/libs/flatpickr/flatpickr.min.css" rel="stylesheet" type="text/css" />
  <link href="<?php echo base_url('UBold_v4.1.0')?>/assets/libs/bootstrap-datepicker/css/bootstrap-datepicker.min.css" rel="stylesheet" type="text/css" />
  
    <link href="<?php echo base_url('UBold_v4.1.0')?>/assets/libs/datatables.net-bs4/css/dataTables.bootstrap4.min.css" rel="stylesheet" type="text/css" />
        <link href="<?php echo base_url('UBold_v4.1.0')?>/assets/libs/datatables.net-responsive-bs4/css/responsive.bootstrap4.min.css" rel="stylesheet" type="text/css" />
        <link href="<?php echo base_url('UBold_v4.1.0')?>/assets/libs/datatables.net-buttons-bs4/css/buttons.bootstrap4.min.css" rel="stylesheet" type="text/css" />
        <link href="<?php echo base_url('UBold_v4.1.0')?>/assets/libs/datatables.net-select-bs4/css//select.bootstrap4.min.css" rel="stylesheet" type="text/css" />
		<!-- App css -->
		    <link href="<?php echo base_url('UBold_v4.1.0')?>/assets/libs/select2/css/select2.min.css" rel="stylesheet" type="text/css" />
        <link href="<?php echo base_url('UBold_v4.1.0')?>/assets/libs/selectize/css/selectize.bootstrap3.css" rel="stylesheet" type="text/css" />
        <link href="<?php echo base_url('UBold_v4.1.0')?>/assets/libs/bootstrap-select/css/bootstrap-select.min.css" rel="stylesheet" type="text/css" />
		<link href="<?php echo base_url('UBold_v4.1.0')?>/assets/css/bootstrap.min.css" rel="stylesheet" type="text/css" id="bs-default-stylesheet" />
		<link href="<?php echo base_url('UBold_v4.1.0')?>/assets/css/app.min.css" rel="stylesheet" type="text/css" id="app-default-stylesheet" />

		<link href="<?php echo base_url('UBold_v4.1.0')?>/assets/css/bootstrap-dark.min.css" rel="stylesheet" type="text/css" id="bs-dark-stylesheet" />
		<link href="<?php echo base_url('UBold_v4.1.0')?>/assets/css/app-dark.min.css" rel="stylesheet" type="text/css" id="app-dark-stylesheet" />

		<!-- icons -->
		<link href="<?php echo base_url('UBold_v4.1.0')?>/assets/css/icons.min.css" rel="stylesheet" type="text/css" />
  <link href="<?php echo base_url('UBold_v4.1.0')?>/assets/libs/summernote/summernote-bs4.min.css" rel="stylesheet" type="text/css" />
    </head>

    <body class="loading">

        <!-- Begin page -->
        <div id="wrapper">

           <?php echo view('superadmin/header')?>

	
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
                                            <li class="breadcrumb-item"><a href="<?php echo base_url('superadmin/dashboard')?>"><?php echo lang('app.menu_dashboard')?></a></li>
                                              <li class="breadcrumb-item"><?php echo lang('app.menu_settings')?></li>
                                            <li class="breadcrumb-item"><a href="<?php echo base_url('superadmin/emails')?>"><?php echo lang('app.menu_setting_email')?></a></li>
											<li class="breadcrumb-item active"><?php echo lang('app.menu_setting_email_edit')?></li>
                                        </ol>
                                    </div>
                                    <h4 class="page-title"><?php echo lang('app.title_page_settings_emails_edit')?></h4>
                                </div>
                            </div>
                        </div>     
                        <!-- end page title --> 
                        <div class="row">
                            <div class="col-12">
                                <div class="card">
                                    <div class="card-body">
                                      
                                        <?php //echo $validation->listErrors()
										 if(isset($validation)){?>
										 <div class="alert alert-danger m-b-20" role="alert">
											 <?php echo $validation->listErrors()?>
											</div>
										 <?php }?>
							 <?php //echo $validation->listErrors()
							 
										 if(isset($error)){?>
										 <div class="alert alert-danger m-b-20" role="alert">
											 <?php echo $error?>
											</div>
										 <?php }?>
										  <?php //echo $validation->listErrors()
										 if(isset($success)){?>
										 <div class="alert alert-success m-b-20" role="alert">
											 <?php echo $success?>
											</div>
										 <?php }?>
										<?php $attributes = ['class' => 'form-input-flat', 'id' => 'add-form','method'=>'post','data-parsley-validate'=>''];
										echo form_open_multipart( base_url().'/superadmin/emails/edit/'.$list['id'], $attributes);
										
										?>
										<input type="hidden" name="action" value="edit">
										<input type="hidden" name="id" value="<?php echo $list['id']?>">
                                        <div class="row">
										
											<div class="col-lg-8">
											
												
												
												<div class="row">
												
												<div class="col-md-12">
														<div class="form-group required-field">
															<label for="acc-mname"><?php echo lang('app.field_subject')?> <span class="text-danger">*</span></label>
														 <?php $val=$list['subject']; 
													$input = [
															'type'  => 'text',
															'name'  => 'subject',
															'id'    => 'subject',
															'required'=>true,
															'value' => $val,
															'placeholder' =>lang('app.field_subject'),
															'class' => 'form-control'
															
													];

													echo form_input($input);
													?>
														</div>
													</div>
													
													
										</div>		
									<div class="row">
									<div class="col-md-12">
														<div class="form-group">
															<label for="acc-mname"><?php echo lang('app.field_content')?></label>
														 <?php $val=$list['html']; 
													$input = [
															
															'name'  => 'html',
															'id'    => 'summernote-basic',
														
															'value' => $val,
															'placeholder' =>lang('app.field_content'),
															'class' => 'form-control'
															
													];

													echo form_textarea($input);
													?>
														</div>
													</div>
										
									</div>
									
										

							
												<input type="submit" name="submit" value="<?php echo lang('app.btn_save')?>"  class="btn btn-success width-xs">
												
					
											</div>
											<?php if($list['helps']!=""){?>
                                    				<div class="col-4">
														<div class="card text-white bg-info text-xs-center">
															<div class="card-body">
															<h5 class="card-title text-white"><?php echo lang('app.title_section_help_email')?></h5>
																<blockquote class="card-bodyquote">
																	<?php echo $list['helps']?>
																</blockquote>
															</div>
														</div> <!-- end card-box-->
													</div>		  
											<?php } ?>
                                        </div>
										  <?php echo form_close();?>		
                                        <!-- end row-->
									
                                    </div> <!-- end card-body -->
                                </div> <!-- end card -->
                            </div><!-- end col -->
                        </div>
                    </div> <!-- container -->

                </div> <!-- content -->

                <!-- Footer Start -->
                 <?php echo view('superadmin/footer');?>
                <!-- end Footer -->

            </div>

            <!-- ============================================================== -->
            <!-- End Page content -->
            <!-- ============================================================== -->



        <script src="<?php echo base_url('UBold_v4.1.0')?>/assets/js/vendor.min.js"></script>
		
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
			 <script src="<?php echo base_url('UBold_v4.1.0')?>/assets/libs/selectize/js/standalone/selectize.min.js"></script>
        <script src="<?php echo base_url('UBold_v4.1.0')?>/assets/libs/mohithg-switchery/switchery.min.js"></script>

        <script src="<?php echo base_url('UBold_v4.1.0')?>/assets/libs/select2/js/select2.min.js"></script>
		  <script src="<?php echo base_url('UBold_v4.1.0')?>/assets/libs/flatpickr/flatpickr.min.js"></script>
		  

        <!-- Init js-->
        <script src="../assets/js/pages/form-pickers.init.js"></script>
		  <script src="https://npmcdn.com/flatpickr/dist/l10n/it.js"></script>
		 <script src="<?php echo base_url('UBold_v4.1.0')?>/assets/libs/bootstrap-datepicker/js/bootstrap-datepicker.min.js"></script>
		 
		  <!-- third party js -->
       
		 <script src="https://npmcdn.com/flatpickr/dist/l10n/it.js"></script>
        <!-- App js -->
		 <!--script src="<?php echo base_url('UBold_v4.1.0')?>/assets/js/pages/form-pickers.init.js"></script-->
        <script src="<?php echo base_url('UBold_v4.1.0')?>/assets/js/app.min.js"></script>
      
        <!-- App js -->

      
        <script src="<?php echo base_url('UBold_v4.1.0')?>/assets/libs/bootstrap-select/js/bootstrap-select.min.js"></script>
  <script src="<?php echo base_url('UBold_v4.1.0')?>/assets/libs/twitter-bootstrap-wizard/jquery.bootstrap.wizard.min.js"></script>
    <script src="<?php echo base_url('UBold_v4.1.0')?>/assets/libs/summernote/summernote-bs4.min.js"></script>
		<script src="<?php echo base_url('UBold_v4.1.0')?>/assets/libs/summernote/lang/summernote-it-IT.min.js"></script>
		 <script>
		
		 $(function(){
			 $("#add-form").parsley().on("field:validated",function(){
			 var e=0===$(".parsley-error").length;$(".alert-info").toggleClass("d-none",!e),$(".alert-warning").toggleClass("d-none",e)
			 }).on("form:submit",function(){return true});
			
		});
		 </script>
	
   
       
     <script>
	 !function(n){
		 "use strict";function e(){this.$body=n("body")}
		 e.prototype.init=function(){
			 n("#summernote-basic").summernote({lang: 'it-IT',placeholder:"Write something...",height:230,callbacks:{onInit:function(e){n(e.editor).find(".custom-control-description").addClass("custom-control-label").parent().removeAttr("for")}}})
			  }
			 ,n.Summernote=new e,n.Summernote.Constructor=e}
			 (window.jQuery),function(){"use strict";window.jQuery.Summernote.init()}();
	 </script>
		
     <?= view('admin/common/endtag') ?>