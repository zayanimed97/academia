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
        <link href="<?php echo base_url('UBold_v4.1.0')?>/assets/libs/@fullcalendar/core/main.min.css" rel="stylesheet" type="text/css" />
        <link href="<?php echo base_url('UBold_v4.1.0')?>/assets/libs/@fullcalendar/daygrid/main.min.css" rel="stylesheet" type="text/css" />
        <link href="<?php echo base_url('UBold_v4.1.0')?>/assets/libs/@fullcalendar/bootstrap/main.min.css" rel="stylesheet" type="text/css" />
        <link href="<?php echo base_url('UBold_v4.1.0')?>/assets/libs/@fullcalendar/timegrid/main.min.css" rel="stylesheet" type="text/css" />
        <link href="<?php echo base_url('UBold_v4.1.0')?>/assets/libs/@fullcalendar/list/main.min.css" rel="stylesheet" type="text/css" />
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
                                             <li class="breadcrumb-item active"><?php echo lang('app.menu_dashboard')?></li>
                                        </ol>
                                    </div>
                                    <h4 class="page-title"><?php echo lang('app.menu_dashboard')?></h4>
                                </div>
                            </div>
                        </div>     
                        <!-- end page title --> 
                          <div class="row">
                            <div class="col-md-4 col-xl-4">
                                <div class="widget-rounded-circle card-box">
                                    <div class="row">
                                        <div class="col-6">
                                            <div class="avatar-lg rounded-circle bg-soft-primary border-primary border">
                                                <i class="fe-cpu font-22 avatar-title text-primary"></i>
                                            </div>
                                        </div>
                                        <div class="col-6">
                                            <div class="text-right">
                                                <h3 class="mt-1"><span data-plugin="counterup"><?php //echo $nb_items_cars?></span></h3>
                                                <p class="text-muted mb-1 text-truncate"><?php echo lang('app.stats_tot_items_cars')?></p>
                                            </div>
                                        </div>
                                    </div> <!-- end row-->
                                </div> <!-- end widget-rounded-circle-->
                            </div> <!-- end col-->

                            <div class="col-md-4 col-xl-4">
                                <div class="widget-rounded-circle card-box">
                                    <div class="row">
                                        <div class="col-6">
                                            <div class="avatar-lg rounded-circle bg-soft-danger border-danger border">
                                                <i class="fe-move font-22 avatar-title text-danger"></i>
                                            </div>
                                        </div>
                                        <div class="col-6">
                                            <div class="text-right">
                                                <h3 class="text-dark mt-1"><span data-plugin="counterup"><?php //echo $nb_items_instrument?></span></h3>
                                                <p class="text-muted mb-1 text-truncate"><?php echo lang('app.stats_tot_items_instrument')?></p>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
							
 							<div class="col-md-4 col-xl-4">
                                <div class="widget-rounded-circle card-box">
                                    <div class="row">
                                        <div class="col-4">
                                            <div class="avatar-lg rounded-circle bg-soft-warning border-warning border">
                                                <i class="fe-users font-22 avatar-title text-warning"></i>
                                            </div>
                                        </div>
                                        <div class="col-8">
                                            <div class="text-right">
                                                <h3 class="mt-1"><span data-plugin="counterup"><?php //echo $nb_clients?></span></h3>
                                                <p class="text-muted mb-1 text-truncate"><?php echo lang('app.stats_tot_client')?></p>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            
                        </div>
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
        <script src="<?php echo base_url('UBold_v4.1.0')?>/assets/libs/@fullcalendar/core/main.min.js"></script>
        <script src="<?php echo base_url('UBold_v4.1.0')?>/assets/libs/@fullcalendar/bootstrap/main.min.js"></script>
        <script src="<?php echo base_url('UBold_v4.1.0')?>/assets/libs/@fullcalendar/daygrid/main.min.js"></script>
        <script src="<?php echo base_url('UBold_v4.1.0')?>/assets/libs/@fullcalendar/timegrid/main.min.js"></script>
        <script src="<?php echo base_url('UBold_v4.1.0')?>/assets/libs/@fullcalendar/list/main.min.js"></script>
        <script src="<?php echo base_url('UBold_v4.1.0')?>/assets/libs/@fullcalendar/interaction/main.min.js"></script>
		
		 <script src="<?php echo base_url('UBold_v4.1.0')?>/assets/libs/selectize/js/standalone/selectize.min.js"></script>
        <script src="<?php echo base_url('UBold_v4.1.0')?>/assets/libs/mohithg-switchery/switchery.min.js"></script>
       <script src="<?php echo base_url('UBold_v4.1.0')?>/assets/js/jquery.repeater/jquery.repeater.min.js"></script>
        <script src="<?php echo base_url('UBold_v4.1.0')?>/assets/libs/select2/js/select2.min.js"></script>
        <!--script src="<?php echo base_url('UBold_v4.1.0')?>/assets/libs/jquery-mockjax/jquery.mockjax.min.js"></script-->
        <script src="<?php echo base_url('UBold_v4.1.0')?>/assets/libs/devbridge-autocomplete/jquery.autocomplete.min.js"></script>
        <script src="<?php echo base_url('UBold_v4.1.0')?>/assets/libs/bootstrap-select/js/bootstrap-select.min.js"></script>
		  <script src="<?php echo base_url('UBold_v4.1.0')?>/assets/libs/sweetalert2/sweetalert2.min.js"></script>
    <!-- Todo app -->
       

        <!-- Sweet alert init js-->
      
		
        <script src="<?php echo base_url('UBold_v4.1.0')?>/assets/js/app.min.js"></script>
    </body>
</html>