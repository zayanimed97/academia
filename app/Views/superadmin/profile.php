<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8" />
        <title>Admin | <?php echo $settings['meta_title']?></title>
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <meta content="A fully featured admin theme which can be used to build CRM, CMS, etc." name="description" />
        <meta content="Coderthemes" name="author" />
        <meta http-equiv="X-UA-Compatible" content="IE=edge" />
        <!-- App favicon -->
        <link rel="shortcut icon" href="<?php echo base_url('UBold_v4.1.0')?>/assets/images/favicon.ico">

		<!-- App css -->
		<link href="<?php echo base_url('UBold_v4.1.0')?>/assets/css/bootstrap.min.css" rel="stylesheet" type="text/css" id="bs-default-stylesheet" />
		<link href="<?php echo base_url('UBold_v4.1.0')?>/assets/css/app.min.css" rel="stylesheet" type="text/css" id="app-default-stylesheet" />

		<link href="<?php echo base_url('UBold_v4.1.0')?>/assets/css/bootstrap-dark.min.css" rel="stylesheet" type="text/css" id="bs-dark-stylesheet" />
		<link href="<?php echo base_url('UBold_v4.1.0')?>/assets/css/app-dark.min.css" rel="stylesheet" type="text/css" id="app-dark-stylesheet" />

		<!-- icons -->
		<link href="<?php echo base_url('UBold_v4.1.0')?>/assets/css/icons.min.css" rel="stylesheet" type="text/css" />

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
                                           
                                            <li class="breadcrumb-item active"><?php echo lang('app.menu_profile')?></li>
                                        </ol>
                                    </div>
                                    <h4 class="page-title"><?php echo lang('app.title_page_profile')?></h4>
                                </div>
                            </div>
                        </div>     
                        <!-- end page title --> 
                        <div class="row">
                            <div class="col-12">
                                <div class="card">
                                    <div class="card-body">
                                        <h4 class="header-title"><?php echo lang('app.title_section_menu_account')?></h4>
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
<?php $attributes = ['class' => 'form-input-flat', 'id' => 'myform','method'=>'post'];
					echo form_open( base_url().'/superadmin/profile', $attributes);?>
                                        <div class="row">
										
										<div class="col-lg-12">
                                            	
								<input type="hidden" name="action" value="edit">
								
									
								
								<div class="form-group">
									<label class="col-form-label col-sm-3" for="email"><?php echo lang("app.field_email")?> <span class="text-danger">*</span></label>
									<div class="col-sm-6">
										<input class="form-control" type="text" id="email" name="email" value="<?php echo $profile_data['email']?>"  />
									</div>
								</div>

								<div class="form-group">
									<label class="col-form-label col-sm-3" for="password"><?php echo lang("app.field_password")?> </label>
									<div class="col-sm-6">
										<input class="form-control" type="password" id="password" name="password"  />
									</div>
								</div>

								<div class="form-group">
									<label class="col-form-label col-sm-3" for="repassword"><?php echo lang("app.field_confirm_password")?> </label>
									<div class="col-sm-6">
										<input class="form-control" type="password" id="repassword" name="repassword"  />
									</div>
								</div>
								
								
								<input type="submit" name="aa" value="<?php echo lang('app.btn_save')?>"  class="btn btn-success width-xs">
						<div class="alert alert-danger m-t-20" role="alert" id="error_alert" style="display:none"></div>
					
									</div>
                                    						  
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


        </div>
        <!-- END wrapper -->

        <!-- Right Sidebar -->
       
        <!-- /Right-bar -->

        <!-- Right bar overlay-->
        <div class="rightbar-overlay"></div>

        <!-- Vendor js -->
        <script src="<?php echo base_url('UBold_v4.1.0')?>/assets/js/vendor.min.js"></script>

        <!-- App js -->
        <script src="<?php echo base_url('UBold_v4.1.0')?>/assets/js/app.min.js"></script>
        <script>
		 function  valid_fct(){
			var fields = $( "#myform" ).serializeArray();
			
			$.ajax({
				  url:"<?php echo base_url('Ajax/validate_account')?>",
				  method:"POST",
				  data:fields
				  
			}).done(function(data){
				
				var obj=JSON.parse(data);
				if(obj.error==true){
					$("#error_alert").html(obj.validation);
					$("#error_alert").show('slow');
				
				}
				else{
					$("#error_alert").hide('slow');
					$( "#myform" ).submit();
				//	return true;
				}
			});
				
		}
		</script>
    </body>
</html>