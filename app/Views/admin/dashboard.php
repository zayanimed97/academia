<?= view('admin/common/header',array('page_title'=>'Dashboard')) ?>

<link href="<?php echo base_url('UBold_v4.1.0')?>/assets/libs/admin-resources/jquery.vectormap/jquery-jvectormap-1.2.2.css" rel="stylesheet" type="text/css" />

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
                                    
                                    <h4 class="page-title">Dashboard</h4>
                                </div>
                            </div>
                        </div>     
                        <!-- end page title --> 

                        <div class="row">
                            <div class="col-md-6 col-xl-3">
                                <div class="card-box">
                                    <div class="row">
                                        <div class="col-6">
                                            <div class="avatar-sm bg-blue rounded">
                                                <i class="fe-bar-chart-2 avatar-title font-22 text-white"></i>
                                            </div>
                                        </div>
                                        <div class="col-6">
                                            <div class="text-right">
                                                <h3 class="text-dark my-1">€<span data-plugin="counterup"><?php echo $incomes?></span></h3>
                                                <p class="text-muted mb-1 text-truncate"><?php echo lang('app.dashboard_section_incomes')?></p>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="mt-3">
                                        <h6 class="text-uppercase">&nbsp;</h6>
                                        <div class="progress progress-sm m-0">
                                            
                                        </div>
                                    </div>
                                </div> <!-- end card-box-->
                            </div> <!-- end col -->

                            <div class="col-md-6 col-xl-3">
                                <div class="card-box">
                                    <div class="row">
                                        <div class="col-6">
                                            <div class="avatar-sm bg-success rounded">
                                                <i class="fe-shopping-cart avatar-title font-22 text-white"></i>
                                            </div>
                                        </div>
                                        <div class="col-6">
                                            <div class="text-right">
                                                <h3 class="text-dark my-1"><span data-plugin="counterup"><?php echo $tot_orders_success?></span></h3>
                                                <p class="text-muted mb-1 text-truncate"><?php echo lang('app.dashboard_section_orders')?></p>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="mt-3">
                                        <h6 class="text-uppercase"><?php echo lang('app.dashboard_section_orders_completed')?> <span class="float-right"><?php echo $percent_success?>%</span></h6>
                                        <div class="progress progress-sm m-0">
                                            <div class="progress-bar bg-success" role="progressbar" aria-valuenow="<?php echo $percent_success?>" aria-valuemin="0" aria-valuemax="100" style="width: <?php echo $percent_success?>%">
                                                <span class="sr-only"><?php echo $percent_success?>%</span>
                                            </div>
                                        </div>
                                    </div>
                                </div> <!-- end card-box-->
                            </div> <!-- end col -->

                            <div class="col-md-6 col-xl-3">
                                <div class="card-box">
                                    <div class="row">
                                        <div class="col-6">
                                            <div class="avatar-sm bg-warning rounded">
                                                <i class="fe-grid avatar-title font-22 text-white"></i>
                                            </div>
                                        </div>
                                        <div class="col-6">
                                            <div class="text-right">
                                                <h3 class="text-dark my-1"><span data-plugin="counterup"><?php echo $tot_modulo?></span></h3>
                                                <p class="text-muted mb-1 text-truncate"><?php echo lang('app.dashboard_section_total_modulo')?></p>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="mt-3">
                                        <h6 class="text-uppercase"><?php echo lang('app.dashboard_section_total_modulo_buyed')?> <span class="float-right"><?php echo $tot_modulo_buyed?></span></h6>
                                        <div class="progress progress-sm m-0">
                                           
                                        </div>
                                    </div>
                                </div> <!-- end card-box-->
                            </div> <!-- end col -->

                            <div class="col-md-6 col-xl-3">
                                <div class="card-box">
                                    <div class="row">
                                        <div class="col-6">
                                            <div class="avatar-sm bg-info rounded">
                                                <i class="fe-users avatar-title font-22 text-white"></i>
                                            </div>
                                        </div>
                                        <div class="col-6">
                                            <div class="text-right">
                                                <h3 class="text-dark my-1"><span data-plugin="counterup"><?php echo $tot_participant?></span></h3>
                                                <p class="text-muted mb-1 text-truncate"><?php echo lang('app.dashboard_section_total_participant')?></p>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="mt-3">
                                        <h6 class="text-uppercase"><?php echo lang('app.dashboard_section_total_participant_buyed')?> <span class="float-right"><?php echo $tot_participant_buyed?>%</span></h6>
                                        <div class="progress progress-sm m-0">
                                            <div class="progress-bar bg-info" role="progressbar" aria-valuenow="<?php echo $tot_participant_buyed?>" aria-valuemin="0" aria-valuemax="100" style="width: <?php echo $tot_participant_buyed?>%">
                                                <span class="sr-only"><?php echo $tot_participant_buyed?>%</span>
                                            </div>
                                        </div>
                                    </div>
                                </div> <!-- end card-box-->
                            </div> <!-- end col -->
                        </div>
                        <!-- end row -->

                     


                    </div> <!-- container -->

                </div> <!-- content -->

                <!-- Footer Start -->
                <?php echo view('admin/common/footer_bar')?>
                <!-- end Footer -->

            </div>

            <!-- ============================================================== -->
            <!-- End Page content -->
            <!-- ============================================================== -->

<?= view('admin/common/footer') ?>

 <!-- Plugins js-->
        <script src="<?php echo base_url('UBold_v4.1.0')?>/assets/libs/jquery-sparkline/jquery.sparkline.min.js"></script>
        <script src="<?php echo base_url('UBold_v4.1.0')?>/assets/libs/admin-resources/jquery.vectormap/jquery-jvectormap-1.2.2.min.js"></script>
        <script src="<?php echo base_url('UBold_v4.1.0')?>/assets/libs/admin-resources/jquery.vectormap/maps/jquery-jvectormap-world-mill-en.js"></script>

        <!-- Dashboard 2 init -->
        <script src="<?php echo base_url('UBold_v4.1.0')?>/assets/js/pages/dashboard-2.init.js"></script>

<?= view('admin/common/endtag') ?>