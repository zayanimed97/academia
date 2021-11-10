 <!-- Topbar Start -->
            <div class="navbar-custom">
                <div class="container-fluid">
                    <ul class="list-unstyled topnav-menu float-right mb-0">

                       
                       
    
                        <li class="dropdown d-none d-lg-inline-block">
                            <a class="nav-link dropdown-toggle arrow-none waves-effect waves-light" data-toggle="fullscreen" href="#">
                                <i class="fe-maximize noti-icon"></i>
                            </a>
                        </li>
    
                        
                      
                      
                        <li class="dropdown notification-list topbar-dropdown">
                            <a class="nav-link dropdown-toggle nav-user mr-0 waves-effect waves-light" data-toggle="dropdown" href="#" role="button" aria-haspopup="false" aria-expanded="false">
                                <i class="fas fa-user-circle"></i>
								<!--img src="<?php echo base_url('UBold_v4.1.0/user/dist')?>/assets/images/users/user-1.jpg" alt="user-image" class="rounded-circle"-->
                                <span class="pro-user-name ml-1">
                                    <?php echo $user_data['display_name']?> <i class="mdi mdi-chevron-down"></i> 
                                </span>
                            </a>
                            <div class="dropdown-menu dropdown-menu-right profile-dropdown ">
                                <!-- item-->
                                <div class="dropdown-header noti-title">
                                    <h6 class="text-overflow m-0"> <?php echo  lang('app.welcome')?></h6>
                                </div>
    
                                <!-- item-->
                                <a href="<?php echo base_url('/superadmin/profile')?>" class="dropdown-item notify-item">
                                    <i class="fe-user"></i>
                                    <span><?php echo  lang('app.menu_profile')?></span>
                                </a>
    
                                <!-- item-->
                                
    
                                <div class="dropdown-divider"></div>
    
                                <!-- item-->
                                <a href="<?php echo base_url('/logout')?>" class="dropdown-item notify-item">
                                    <i class="fe-log-out"></i>
                                    <span><?php echo  lang('app.menu_logout')?></span>
                                </a>
    
                            </div>
                        </li>
    
                       
    
                    </ul>
    
                    <!-- LOGO -->
                    <div class="logo-box">
                        <a href="<?php echo base_url('superadmin/dashboard')?>" class="logo logo-dark text-center">
                            <span class="logo-sm">
                                <img src="<?php echo base_url('uploads/'.$settings['logo'])?>" alt="" height="30">
                                <!-- <span class="logo-lg-text-light">UBold</span> -->
                            </span>
                            <span class="logo-lg">
                                <img src="<?php echo base_url('uploads/'.$settings['logo'])?>" alt="" height="60">
                                <!-- <span class="logo-lg-text-light">U</span> -->
                            </span>
                        </a>
    
                        <a href="<?php echo base_url('superadmin/dashboard')?>" class="logo logo-light text-center">
                            <span class="logo-sm">
                                <img src="<?php echo base_url('uploads/'.$settings['logo'])?>" alt="" height="30">
                            </span>
                            <span class="logo-lg">
                                <img src="<?php echo base_url('uploads/'.$settings['logo'])?>" alt="" height="60">
                            </span>
                        </a>
                    </div>
    
                    <ul class="list-unstyled topnav-menu topnav-menu-left m-0">
                        <li>
                            <button class="button-menu-mobile waves-effect waves-light">
                                <i class="fe-menu"></i>
                            </button>
                        </li>

                        <li>
                            <!-- Mobile menu toggle (Horizontal Layout)-->
                            <a class="navbar-toggle nav-link" data-toggle="collapse" data-target="#topnav-menu-content">
                                <div class="lines">
                                    <span></span>
                                    <span></span>
                                    <span></span>
                                </div>
                            </a>
                            <!-- End mobile menu toggle-->
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
                        <img src="<?php echo base_url('UBold_v4.1.0/user/dist')?>/assets/images/users/user-1.jpg" alt="user-img" title="Mat Helme"
                            class="rounded-circle avatar-md">
                        <div class="dropdown">
                            <a href="javascript: void(0);" class="text-dark dropdown-toggle h5 mt-2 mb-1 d-block"
                                data-toggle="dropdown"><?php echo $user_data['display_name']?></a>
                            <div class="dropdown-menu user-pro-dropdown">

                                <!-- item-->
								<a href="<?php echo base_url('/superadmin/profile')?>" class="dropdown-item notify-item">
                                    <i class="fe-user"></i>
                                    <span><?php echo  lang('app.menu_profile')?></span>
                                </a>
    
                              

                                <!-- item-->
                               <a href="<?php echo base_url('/logout')?>" class="dropdown-item notify-item">
                                    <i class="fe-log-out"></i>
                                    <span><?php echo  lang('app.menu_logout')?></span>
                                </a>
    

                            </div>
                        </div>
                        <p class="text-muted">Admin Head</p>
                    </div>

                    <!--- Sidemenu -->
                    <div id="sidebar-menu">

                        <ul id="side-menu">

                            <li class="menu-title"><?php echo lang('app.menu')?></li>               

                            <li>
                                <a href="<?php echo base_url('superadmin/dashboard')?>">
                                   <i data-feather="airplay"></i>
                                    <span> <?php echo lang('app.menu_dashboard')?> </span>
                                </a>
                            </li>
							<li>
                                <a href="#menu_clients" data-toggle="collapse" >
                                    <i data-feather="users"></i>
                                    <span>  <?php echo lang('app.menu_ente')?> </span>
                                    <span class="menu-arrow"></span>
                                </a>
                                <div class="collapse" id="menu_clients">
                                    <ul class="nav-second-level">
                                        <li>
                                            <a href="<?php echo base_url('superadmin/ente/new')?>"><?php echo lang('app.menu_new')?></a>
                                        </li>
                                        <li>
                                            <a href="<?php echo base_url('superadmin/ente')?>"><?php echo lang('app.menu_list')?></a>
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