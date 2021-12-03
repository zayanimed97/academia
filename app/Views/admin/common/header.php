<?php   $curdate = strtotime(date('Y-m-d'));
        $mydate = strtotime($_SESSION['user_data']['ente_package']['expired_date']);
        $disabled =  $curdate > $mydate;
?>
<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8" />
        <title><?php echo $page_title?></title>
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
        <style>
        .navbar-custom{
            background-color: #000;
        }
        </style>
    </head>

    <body class="loading">

        <!-- Begin page -->
        <div id="wrapper">

            <!-- Topbar Start -->
            <div class="navbar-custom">
                <div class="container-fluid">
                    <ul class="list-unstyled topnav-menu float-right mb-0">

    
                        <li class="dropdown notification-list topbar-dropdown">
                            <a class="nav-link dropdown-toggle nav-user mr-0 waves-effect waves-light" data-toggle="dropdown" href="#" role="button" aria-haspopup="false" aria-expanded="false">
                                <img src="<?php echo base_url('UBold_v4.1.0')?>/assets/images/users/user-1.jpg" alt="user-image" class="rounded-circle">
                                <span class="pro-user-name ml-1">
                                    <?php echo $user_data['display_name']?> <i class="mdi mdi-chevron-down"></i> 
                                </span>
                            </a>
                            <div class="dropdown-menu dropdown-menu-right profile-dropdown ">
                                <!-- item-->
                                <div class="dropdown-header noti-title">
                                    <h6 class="text-overflow m-0"><?php echo lang('app.welcome')?></h6>
                                </div>
    
                                <!-- item-->
                                <a href="<?= base_url('admin/profile') ?>" class="dropdown-item notify-item">
                                    <i class="fe-user"></i>
                                    <span><?php echo lang('app.menu_profile')?></span>
                                </a>
    
                                <!-- item-->
                               
                                <div class="dropdown-divider"></div>
								<?php if(isset($is_admin) && $is_admin==true){?>
								<a href="<?= $redirect_admin ?>" class="dropdown-item notify-item">
                                    <i class="fe-log-out"></i>
                                    <span><?php echo lang('admin')?></span>
                                </a>
									
									<?php } ?>
                                <!-- item-->
                                <a href="<?= base_url('logout') ?>" class="dropdown-item notify-item">
                                    <i class="fe-log-out"></i>
                                    <span><?php echo lang('app.menu_logout')?></span>
                                </a>
    
                            </div>
                        </li>

    
                    </ul>
    
                    <!-- LOGO -->
                    <div class="logo-box">
                        <a href="index.html" class="logo logo-dark text-center">
                            <span class="logo-sm">
                                <img src="<?php echo base_url('UBold_v4.1.0')?>/assets/images/logo-sm.png" alt="" height="22">
                                <!-- <span class="logo-lg-text-light">UBold</span> -->
                            </span>
                            <span class="logo-lg">
                                <img src="<?php echo base_url('UBold_v4.1.0')?>/assets/images/logo-dark.png" alt="" height="20">
                                <!-- <span class="logo-lg-text-light">U</span> -->
                            </span>
                        </a>
    
                        <a href="<?= base_url('/admin/dashboard') ?>" class="logo logo-light text-center h-100">
                            <span class="logo-sm">
                                <img src="<?php echo base_url('UBold_v4.1.0')?>/assets/images/logo-sm.png" alt="" height="22">
                            </span>
                            <span class="logo-lg h-100 d-flex align-items-center">
                                <img src="<?php echo base_url('UBold_v4.1.0')?>/assets/images/logo-light.png" alt="" style="width: 100%; height: auto">
                            </span>
                        </a>
                    </div>
    
                    <ul class="list-unstyled topnav-menu topnav-menu-left m-0">
                        <li>
                            <button class="button-menu-mobile waves-effect waves-light">
                                <i class="fe-menu"></i>
                            </button>
                        </li>
                    </ul>
                    <div class="clearfix"></div>
                </div>
            </div>
            <!-- end Topbar -->

            <!-- ========== Left Sidebar Start ========== -->
            <div class="left-side-menu">

                <div class="h-100" data-simplebar>

                    <!-- User box -->
                    <div class="user-box text-center">
                        <img src="<?php echo base_url('UBold_v4.1.0')?>/assets/images/users/user-1.jpg" alt="user-img" title="Mat Helme"
                            class="rounded-circle avatar-md">
                        <div class="dropdown">
                            <a href="javascript: void(0);" class="text-dark dropdown-toggle h5 mt-2 mb-1 d-block"
                                data-toggle="dropdown"><?php echo $user_data['display_name']?></a>
                            <div class="dropdown-menu user-pro-dropdown">

                                <!-- item-->
                                <a href="<?= base_url('admin/profile') ?>" class="dropdown-item notify-item">
                                    <i class="fe-user mr-1"></i>
                                    <span><?php echo lang('app.menu_profile')?></span>
                                </a>

                                <!-- item-->
                              

                                <!-- item-->
                                <a href="<?= base_url('logout') ?>" class="dropdown-item notify-item">
                                    <i class="fe-log-out mr-1"></i>
                                    <span><?php echo lang('app.menu_logout')?></span>
                                </a>

                            </div>
                        </div>
                        <p class="text-muted">Admin Head</p>
                    </div>

                    <!--- Sidemenu -->
                    <div id="sidebar-menu">

                        <ul id="side-menu">

                            <!-- <li class="menu-title">Navigation</li> -->
                
                            <li>
                            
                                
                            <a href="<?= base_url('admin/dashboard') ?>"><i data-feather="airplay"></i> <span><?php echo lang('app.menu_dashboard')?> </span> </a>
                                        
                            </li>

                            <li class="menu-title mt-2"><?= lang('app.menu_apps') ?></li>
							 <li>
                            
                                
                            <a <?= $disabled ? 'class="btn disabled text-left"' : '' ?>  href="<?= base_url('admin/corsi') ?>"><i data-feather="book"></i> <span><?php echo lang('app.menu_corsi')?> </span></a>
                                        
                            </li>
							 <li>
                            
                                
                            <a <?= $disabled ? 'class="btn disabled text-left"' : '' ?>  href="<?= base_url('admin/modulo') ?>"><i data-feather="grid"></i> <span><?php echo lang('app.menu_all_module')?> </span></a>
                                        
                            </li>
							<?php if(in_array('test',$ente_package['extra'])){?>
							 <li>
                            
                                
                            <a <?= $disabled ? 'class="btn disabled text-left"' : '' ?> href="<?= base_url('admin/test') ?>"><i data-feather="check-square"></i> <span><?php echo lang('app.menu_corsi_test')?> </span></a>
                                        
                            </li>
							<?php } ?>
                            <li>
                                <a href="#sidebarCourses" data-toggle="collapse">
                                    <i data-feather="shopping-cart"></i>
                                    <span> <?= lang('app.menu_config_corsi') ?> </span>
                                    <span class="menu-arrow"></span>
                                </a>
                                <div class="collapse" id="sidebarCourses">
                                    <ul class="nav-second-level">
                                        <li>
                                            <a <?= $disabled ? 'class="btn disabled text-left"' : '' ?> href="<?= base_url('admin/categories') ?>"><?= lang('app.menu_categorie') ?></a>
                                        </li>
                                        <li>
                                            <a <?= $disabled ? 'class="btn disabled text-left"' : '' ?> href="<?= base_url('admin/argomenti') ?>"><?= lang('app.menu_argomenti') ?></a>
                                        </li>
                                        <li>
                                            <a <?= $disabled ? 'class="btn disabled text-left"' : '' ?> href="<?= base_url('admin/professione') ?>"><?= lang('app.menu_professione') ?></a>
                                        </li>
                                        <li>
                                            <a <?= $disabled ? 'class="btn disabled text-left"' : '' ?> href="<?= base_url('admin/obiettivi') ?>"><?= lang('app.menu_obiettivi') ?></a>
                                        </li>
                                    </ul>
                                </div>
                            </li>

                            <li>
                                <a href="#sidebarDoctors" data-toggle="collapse">
                                    <i data-feather="award"></i>
                                    <span> <?= lang('app.menu_doctors') ?> </span>
                                    <span class="menu-arrow"></span>
                                </a>
                                <div class="collapse" id="sidebarDoctors">
                                    <ul class="nav-second-level">
                                        <li>
                                            <a <?= $disabled ? 'class="btn disabled text-left"' : '' ?> href="<?= base_url('admin/user_list') ?>?role=doctor"><?= lang('app.menu_list') ?></a>
                                        </li>
                                        <li>
                                            <a <?= $disabled ? 'class="btn disabled text-left"' : '' ?> href="<?= base_url('admin/new_user') ?>?role=doctor"><?= lang('app.menu_new') ?></a>
                                        </li>
                                    </ul>
                                </div>
                            </li>

                            <li>
                                <a href="#sidebarParticipant" data-toggle="collapse">
                                    <i data-feather="users"></i>
                                    <span> <?= lang('app.menu_participant') ?> </span>
                                    <span class="menu-arrow"></span>
                                </a>
                                <div class="collapse" id="sidebarParticipant">
                                    <ul class="nav-second-level">
                                        <li>
                                            <a <?= $disabled ? 'class="btn disabled text-left"' : '' ?> href="<?= base_url('admin/user_list') ?>?role=participant"><?= lang('app.menu_list') ?></a>
                                        </li>
                                        <li>
                                            <a <?= $disabled ? 'class="btn disabled text-left"' : '' ?> href="<?= base_url('admin/new_user') ?>?role=participant"><?= lang('app.menu_new') ?></a>
                                        </li>
                                    </ul>
                                </div>
                            </li>
                        </ul>

                    </div>
                    <!-- End Sidebar -->

                    <div class="clearfix"></div>

                </div>
                <!-- Sidebar -left -->

            </div>
            <!-- Left Sidebar End -->