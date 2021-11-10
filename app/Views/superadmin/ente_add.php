<!DOCTYPE html>
<html lang="it">
    <head>
        <meta charset="utf-8" />
       <title>Admin | <?php echo $settings['meta_title']?></title>
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <meta content="A fully featured admin theme which can be used to build CRM, CMS, etc." name="description" />
        <meta content="Coderthemes" name="author" />
        <meta http-equiv="X-UA-Compatible" content="IE=edge" />
        <!-- App favicon -->
        <link rel="shortcut icon" href="<?php echo base_url('UBold_v4.1.0')?>/assets/images/favicon.ico">

		<link href="<?php echo base_url('UBold_v4.1.0')?>/assets/libs/flatpickr/flatpickr.min.css" rel="stylesheet" type="text/css" />
      
		<link href="<?php echo base_url('UBold_v4.1.0')?>/assets/libs/multiselect/css/multi-select.css" rel="stylesheet" type="text/css" />
        <link href="<?php echo base_url('UBold_v4.1.0')?>/assets/libs/select2/css/select2.min.css" rel="stylesheet" type="text/css" />
        <link href="<?php echo base_url('UBold_v4.1.0')?>/assets/libs/selectize/css/selectize.bootstrap3.css" rel="stylesheet" type="text/css" />
        <link href="<?php echo base_url('UBold_v4.1.0')?>/assets/libs/bootstrap-select/css/bootstrap-select.min.css" rel="stylesheet" type="text/css" />
         <link href="<?php echo base_url('UBold_v4.1.0')?>/assets/libs/sweetalert2/sweetalert2.min.css" rel="stylesheet" type="text/css" />
		<!-- App css -->
        <link href="<?php echo base_url('UBold_v4.1.0')?>/assets/css/bootstrap.min.css" rel="stylesheet" type="text/css" id="bs-default-stylesheet" />
        <link href="<?php echo base_url('UBold_v4.1.0')?>/assets/css/app.min.css" rel="stylesheet" type="text/css" id="app-default-stylesheet" />

        <link href="<?php echo base_url('UBold_v4.1.0')?>/assets/css/bootstrap-dark.min.css" rel="stylesheet" type="text/css" id="bs-dark-stylesheet" />
        <link href="<?php echo base_url('UBold_v4.1.0')?>/assets/css/app-dark.min.css" rel="stylesheet" type="text/css" id="app-dark-stylesheet" />
  
        <!-- icons -->
        <link href="<?php echo base_url('UBold_v4.1.0')?>/assets/css/icons.min.css" rel="stylesheet" type="text/css" />
		<style>
		.ms-container { width:100%;
			max-width: 700px;
		}
		</style>

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
											 <li class="breadcrumb-item active"><?php echo lang('app.menu_ente')?></li>
                                        </ol>
                                    </div>
                                    <h4 class="page-title"><?php echo lang('app.title_page_new_ente')?></h4>
                                </div>
                            </div>
                        </div>     
                        <!-- end page title --> 
                        <div class="row">
                             <div class="col-xl-6">
                                <div class="card">
                                    <div class="card-body">

                                      

                                        <div id="rootwizard">
                                            <ul class="nav nav-pills bg-light nav-justified form-wizard-header mb-3">
                                                <li class="nav-item" data-target-form="#accountForm">
                                                    <a href="#first" data-toggle="tab" class="nav-link rounded-0 pt-2 pb-2">
                                                        <i class="mdi mdi-account-circle mr-1"></i>
                                                        <span class="d-none d-sm-inline"><?php echo lang('app.menu_account')?></span>
                                                    </a>
                                                </li>
												 <li class="nav-item" data-target-form="#packageForm">
                                                    <a href="#second" data-toggle="tab" class="nav-link rounded-0 pt-2 pb-2">
                                                        <i class="mdi mdi-face-profile mr-1"></i>
                                                        <span class="d-none d-sm-inline"><?php echo lang('app.menu_package')?></span>
                                                    </a>
                                                </li>
                                                <li class="nav-item" data-target-form="#profileForm">
                                                    <a href="#third" data-toggle="tab" class="nav-link rounded-0 pt-2 pb-2">
                                                        <i class="mdi mdi-face-profile mr-1"></i>
                                                        <span class="d-none d-sm-inline"><?php echo lang('app.menu_profile')?></span>
                                                    </a>
                                                </li>
                                                <li class="nav-item" data-target-form="#otherForm">
                                                    <a href="#fourth" data-toggle="tab" class="nav-link rounded-0 pt-2 pb-2">
                                                        <i class="mdi mdi-checkbox-marked-circle-outline mr-1"></i>
                                                        <span class="d-none d-sm-inline">Finish</span>
                                                    </a>
                                                </li>
                                            </ul>

                                            <div class="tab-content mb-0 b-0 pt-0">

                                                <div class="tab-pane" id="first">
                                                    <form id="accountForm" method="post" action="#" class="form-horizontal">
                                                        <div class="row">
                                                            <div class="col-12">
                                                                <div class="form-group row mb-3">
                                                                    <label class="col-md-3 col-form-label" for="email">Email</label>
                                                                    <div class="col-md-9">
                                                                        <input type="email" class="form-control" id="email" name="email" required>
                                                                    </div>
                                                                </div>
                                                                <div class="form-group row mb-3">
                                                                    <label class="col-md-3 col-form-label" for="domain_ente"> <?php echo lang('app.field_server_name')?></label>
                                                                    <div class="col-md-9">
                                                                        <input type="text" id="domain_ente" name="domain_ente" class="form-control" placeholder="<?php echo lang('app.help_server_name')?>" required>
                                                                    </div>
                                                                </div>
                                                                
                                                                
                                                            </div> <!-- end col -->
                                                        </div> <!-- end row -->
                                                    </form>
                                                </div>
											<div class="tab-pane fade" id="second">
                                                    <form id="packageForm" method="post" action="#" class="form-horizontal">
                                                        <div class="row">
                                                            <div class="col-12">
                                                                <div class="form-group row mb-3">
                                                                    <label class="col-md-3 col-form-label" for="name3"> First name</label>
                                                                    <div class="col-md-9">
                                                                        <input type="text" id="name3" name="name3" class="form-control" required>
                                                                    </div>
                                                                </div>
                                                                <div class="form-group row mb-3">
                                                                    <label class="col-md-3 col-form-label" for="surname3"> Last name</label>
                                                                    <div class="col-md-9">
                                                                        <input type="text" id="surname3" name="surname3" class="form-control" required>
                                                                    </div>
                                                                </div>
                                                    
                                                                <div class="form-group row mb-3">
                                                                    <label class="col-md-3 col-form-label" for="email3">Email</label>
                                                                    <div class="col-md-9">
                                                                        <input type="email" id="email3" name="email3" class="form-control" required>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                            <!-- end col -->
                                                        </div>
                                                        <!-- end row -->
                                                    </form>
                                                </div>
                                                <div class="tab-pane fade" id="third">
                                                    <form id="profileForm" method="post" action="#" class="form-horizontal">
                                                        <div class="row">
                                                            <div class="col-12">
                                                                <div class="form-group row mb-3">
                                                                    <label class="col-md-3 col-form-label" for="name3"> First name</label>
                                                                    <div class="col-md-9">
                                                                        <input type="text" id="name3" name="name3" class="form-control" required>
                                                                    </div>
                                                                </div>
                                                                <div class="form-group row mb-3">
                                                                    <label class="col-md-3 col-form-label" for="surname3"> Last name</label>
                                                                    <div class="col-md-9">
                                                                        <input type="text" id="surname3" name="surname3" class="form-control" required>
                                                                    </div>
                                                                </div>
                                                    
                                                                <div class="form-group row mb-3">
                                                                    <label class="col-md-3 col-form-label" for="email3">Email</label>
                                                                    <div class="col-md-9">
                                                                        <input type="email" id="email3" name="email3" class="form-control" required>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                            <!-- end col -->
                                                        </div>
                                                        <!-- end row -->
                                                    </form>
                                                </div>

                                                <div class="tab-pane fade" id="fourth">
                                                    <form id="otherForm" method="post" action="#" class="form-horizontal">
                                                        <div class="row">
                                                            <div class="col-12">
                                                                <div class="text-center">
                                                                    <h2 class="mt-0">
                                                                        <i class="mdi mdi-check-all"></i>
                                                                    </h2>
                                                                    <h3 class="mt-0">Thank you !</h3>
                                                    
                                                                    <p class="w-75 mb-2 mx-auto">Quisque nec turpis at urna dictum luctus. Suspendisse convallis dignissim eros at volutpat. In egestas mattis
                                                                        dui. Aliquam mattis dictum aliquet.</p>
                                                    
                                                                    <div class="mb-3">
                                                                        <div class="custom-control custom-checkbox">
                                                                            <input type="checkbox" class="custom-control-input" id="customCheck4" required>
                                                                            <label class="custom-control-label" for="customCheck4">I agree with the Terms and Conditions</label>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                            <!-- end col -->
                                                        </div>
                                                        <!-- end row -->
                                                    </form>
                                                </div>

                                                <ul class="list-inline wizard mb-0">
                                                    <li class="previous list-inline-item"><a href="javascript: void(0);" class="btn btn-secondary">Previous</a>
                                                    </li>
                                                    <li class="next list-inline-item float-right"><a href="javascript: void(0);" class="btn btn-secondary">Next</a></li>
                                                </ul>

                                            </div> <!-- tab-content -->
                                        </div> <!-- end #rootwizard-->

                                    </div> <!-- end card-body -->
                                </div> <!-- end card-->
                            </div> <!-- end col -->
                        </div> <!-- end row -->
                        <!-- end row-->
						 
                        <div class="row">
                    
                        </div> <!-- end row -->
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

        <!-- plugin js -->
		   <script src="<?php echo base_url('UBold_v4.1.0')?>/assets/libs/flatpickr/flatpickr.min.js"></script>
		   <!--script src="<?php echo base_url('UBold_v4.1.0')?>/assets/libs/flatpickr/I10n/it.js"></script-->
        <script src="<?php echo base_url('UBold_v4.1.0')?>/assets/libs/moment/min/moment.min.js"></script>
        
		
		 <script src="<?php echo base_url('UBold_v4.1.0')?>/assets/libs/selectize/js/standalone/selectize.min.js"></script>
        <script src="<?php echo base_url('UBold_v4.1.0')?>/assets/libs/mohithg-switchery/switchery.min.js"></script>
       <script src="<?php echo base_url('UBold_v4.1.0')?>/assets/js/jquery.repeater/jquery.repeater.min.js"></script>
        <script src="<?php echo base_url('UBold_v4.1.0')?>/assets/libs/select2/js/select2.min.js"></script>
        <!--script src="<?php echo base_url('UBold_v4.1.0')?>/assets/libs/jquery-mockjax/jquery.mockjax.min.js"></script-->
        <script src="<?php echo base_url('UBold_v4.1.0')?>/assets/libs/devbridge-autocomplete/jquery.autocomplete.min.js"></script>
        <script src="<?php echo base_url('UBold_v4.1.0')?>/assets/libs/bootstrap-select/js/bootstrap-select.min.js"></script>
		  <script src="<?php echo base_url('UBold_v4.1.0')?>/assets/libs/sweetalert2/sweetalert2.min.js"></script>
    <!-- Todo app -->
       
    <script src="<?php echo base_url('UBold_v4.1.0')?>/assets/libs/twitter-bootstrap-wizard/jquery.bootstrap.wizard.min.js"></script>
        <!-- Sweet alert init js-->
     <script>
		$(document).ready(function(){
			"use strict";
			/*$("#basicwizard").bootstrapWizard(),
			$("#progressbarwizard").bootstrapWizard({onTabShow:function(t,r,a){var o=(a+1)/r.find("li").length*100;$("#progressbarwizard").find(".bar").css({width:o+"%"})}}),
			$("#btnwizard").bootstrapWizard({nextSelector:".button-next",previousSelector:".button-previous",firstSelector:".button-first",lastSelector:".button-last"}),*/
			$("#rootwizard").bootstrapWizard({
				onTabShow: function(tab, navigation, index) {
					
					var $total = navigation.find('li').length;
					
					var $current = index+1;

					var wizard = navigation.closest('#rootwizard');

					// If it's the last tab then hide the last button and show the finish instead
					if($current >= $total) {
						$(wizard).find('.btn-next').hide();
						$(wizard).find('.btn-finish').show();
					} else {
						$(wizard).find('.btn-next').show();
						$(wizard).find('.btn-finish').hide();
					}
				},
				onNext:function(t,r,a){
					var o=$($(t).data("targetForm"));
					if(o&&(o.addClass("was-validated"),!1===o[0].checkValidity()))return event.preventDefault(),event.stopPropagation(),!1
				}
			})
		});
	</script>
        <script src="<?php echo base_url('UBold_v4.1.0')?>/assets/js/app.min.js"></script>
    </body>
</html>