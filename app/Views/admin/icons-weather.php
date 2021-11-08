<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8" />
        <title>Weather Icons | UBold - Responsive Admin Dashboard Template</title>
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <meta content="A fully featured admin theme which can be used to build CRM, CMS, etc." name="description" />
        <meta content="Coderthemes" name="author" />
        <meta http-equiv="X-UA-Compatible" content="IE=edge" />
        <!-- App favicon -->
        <link rel="shortcut icon" href="../assets/images/favicon.ico">

		<!-- App css -->
		<link href="../assets/css/bootstrap.min.css" rel="stylesheet" type="text/css" id="bs-default-stylesheet" />
		<link href="../assets/css/app.min.css" rel="stylesheet" type="text/css" id="app-default-stylesheet" />

		<link href="../assets/css/bootstrap-dark.min.css" rel="stylesheet" type="text/css" id="bs-dark-stylesheet" />
		<link href="../assets/css/app-dark.min.css" rel="stylesheet" type="text/css" id="app-dark-stylesheet" />

		<!-- icons -->
		<link href="../assets/css/icons.min.css" rel="stylesheet" type="text/css" />

    </head>

    <body class="loading">

        <!-- Begin page -->
        <div id="wrapper">

            <!-- Topbar Start -->
            <div class="navbar-custom">
                <div class="container-fluid">
                    <ul class="list-unstyled topnav-menu float-right mb-0">

                        <li class="d-none d-lg-block">
                            <form class="app-search">
                                <div class="app-search-box dropdown">
                                    <div class="input-group">
                                        <input type="search" class="form-control" placeholder="Search..." id="top-search">
                                        <div class="input-group-append">
                                            <button class="btn" type="submit">
                                                <i class="fe-search"></i>
                                            </button>
                                        </div>
                                    </div>
                                    <div class="dropdown-menu dropdown-lg" id="search-dropdown">
                                        <!-- item-->
                                        <div class="dropdown-header noti-title">
                                            <h5 class="text-overflow mb-2">Found 22 results</h5>
                                        </div>
            
                                        <!-- item-->
                                        <a href="javascript:void(0);" class="dropdown-item notify-item">
                                            <i class="fe-home mr-1"></i>
                                            <span>Analytics Report</span>
                                        </a>
            
                                        <!-- item-->
                                        <a href="javascript:void(0);" class="dropdown-item notify-item">
                                            <i class="fe-aperture mr-1"></i>
                                            <span>How can I help you?</span>
                                        </a>
                            
                                        <!-- item-->
                                        <a href="javascript:void(0);" class="dropdown-item notify-item">
                                            <i class="fe-settings mr-1"></i>
                                            <span>User profile settings</span>
                                        </a>

                                        <!-- item-->
                                        <div class="dropdown-header noti-title">
                                            <h6 class="text-overflow mb-2 text-uppercase">Users</h6>
                                        </div>

                                        <div class="notification-list">
                                            <!-- item-->
                                            <a href="javascript:void(0);" class="dropdown-item notify-item">
                                                <div class="media">
                                                    <img class="d-flex mr-2 rounded-circle" src="../assets/images/users/user-2.jpg" alt="Generic placeholder image" height="32">
                                                    <div class="media-body">
                                                        <h5 class="m-0 font-14">Erwin E. Brown</h5>
                                                        <span class="font-12 mb-0">UI Designer</span>
                                                    </div>
                                                </div>
                                            </a>

                                            <!-- item-->
                                            <a href="javascript:void(0);" class="dropdown-item notify-item">
                                                <div class="media">
                                                    <img class="d-flex mr-2 rounded-circle" src="../assets/images/users/user-5.jpg" alt="Generic placeholder image" height="32">
                                                    <div class="media-body">
                                                        <h5 class="m-0 font-14">Jacob Deo</h5>
                                                        <span class="font-12 mb-0">Developer</span>
                                                    </div>
                                                </div>
                                            </a>
                                        </div>
            
                                    </div>  
                                </div>
                            </form>
                        </li>
    
                        <li class="dropdown d-inline-block d-lg-none">
                            <a class="nav-link dropdown-toggle arrow-none waves-effect waves-light" data-toggle="dropdown" href="#" role="button" aria-haspopup="false" aria-expanded="false">
                                <i class="fe-search noti-icon"></i>
                            </a>
                            <div class="dropdown-menu dropdown-lg dropdown-menu-right p-0">
                                <form class="p-3">
                                    <input type="text" class="form-control" placeholder="Search ..." aria-label="Recipient's username">
                                </form>
                            </div>
                        </li>
    
                        <li class="dropdown d-none d-lg-inline-block">
                            <a class="nav-link dropdown-toggle arrow-none waves-effect waves-light" data-toggle="fullscreen" href="#">
                                <i class="fe-maximize noti-icon"></i>
                            </a>
                        </li>
    
                        <li class="dropdown d-none d-lg-inline-block topbar-dropdown">
                            <a class="nav-link dropdown-toggle arrow-none waves-effect waves-light" data-toggle="dropdown" href="#" role="button" aria-haspopup="false" aria-expanded="false">
                                <i class="fe-grid noti-icon"></i>
                            </a>
                            <div class="dropdown-menu dropdown-lg dropdown-menu-right">
    
                                <div class="p-lg-1">
                                    <div class="row no-gutters">
                                        <div class="col">
                                            <a class="dropdown-icon-item" href="#">
                                                <img src="../assets/images/brands/slack.png" alt="slack">
                                                <span>Slack</span>
                                            </a>
                                        </div>
                                        <div class="col">
                                            <a class="dropdown-icon-item" href="#">
                                                <img src="../assets/images/brands/github.png" alt="Github">
                                                <span>GitHub</span>
                                            </a>
                                        </div>
                                        <div class="col">
                                            <a class="dropdown-icon-item" href="#">
                                                <img src="../assets/images/brands/dribbble.png" alt="dribbble">
                                                <span>Dribbble</span>
                                            </a>
                                        </div>
                                    </div>
    
                                    <div class="row no-gutters">
                                        <div class="col">
                                            <a class="dropdown-icon-item" href="#">
                                                <img src="../assets/images/brands/bitbucket.png" alt="bitbucket">
                                                <span>Bitbucket</span>
                                            </a>
                                        </div>
                                        <div class="col">
                                            <a class="dropdown-icon-item" href="#">
                                                <img src="../assets/images/brands/dropbox.png" alt="dropbox">
                                                <span>Dropbox</span>
                                            </a>
                                        </div>
                                        <div class="col">
                                            <a class="dropdown-icon-item" href="#">
                                                <img src="../assets/images/brands/g-suite.png" alt="G Suite">
                                                <span>G Suite</span>
                                            </a>
                                        </div>
                            
                                    </div>
                                </div>
    
                            </div>
                        </li>
    
                        <li class="dropdown d-none d-lg-inline-block topbar-dropdown">
                            <a class="nav-link dropdown-toggle arrow-none waves-effect waves-light" data-toggle="dropdown" href="#" role="button" aria-haspopup="false" aria-expanded="false">
                                <img src="../assets/images/flags/us.jpg" alt="user-image" height="16">
                            </a>
                            <div class="dropdown-menu dropdown-menu-right">
    
                                <!-- item-->
                                <a href="javascript:void(0);" class="dropdown-item">
                                    <img src="../assets/images/flags/germany.jpg" alt="user-image" class="mr-1" height="12"> <span class="align-middle">German</span>
                                </a>
    
                                <!-- item-->
                                <a href="javascript:void(0);" class="dropdown-item">
                                    <img src="../assets/images/flags/italy.jpg" alt="user-image" class="mr-1" height="12"> <span class="align-middle">Italian</span>
                                </a>
    
                                <!-- item-->
                                <a href="javascript:void(0);" class="dropdown-item">
                                    <img src="../assets/images/flags/spain.jpg" alt="user-image" class="mr-1" height="12"> <span class="align-middle">Spanish</span>
                                </a>
    
                                <!-- item-->
                                <a href="javascript:void(0);" class="dropdown-item">
                                    <img src="../assets/images/flags/russia.jpg" alt="user-image" class="mr-1" height="12"> <span class="align-middle">Russian</span>
                                </a>
    
                            </div>
                        </li>
            
                        <li class="dropdown notification-list topbar-dropdown">
                            <a class="nav-link dropdown-toggle waves-effect waves-light" data-toggle="dropdown" href="#" role="button" aria-haspopup="false" aria-expanded="false">
                                <i class="fe-bell noti-icon"></i>
                                <span class="badge badge-danger rounded-circle noti-icon-badge">9</span>
                            </a>
                            <div class="dropdown-menu dropdown-menu-right dropdown-lg">
    
                                <!-- item-->
                                <div class="dropdown-item noti-title">
                                    <h5 class="m-0">
                                        <span class="float-right">
                                            <a href="" class="text-dark">
                                                <small>Clear All</small>
                                            </a>
                                        </span>Notification
                                    </h5>
                                </div>
    
                                <div class="noti-scroll" data-simplebar>
    
                                    <!-- item-->
                                    <a href="javascript:void(0);" class="dropdown-item notify-item active">
                                        <div class="notify-icon">
                                            <img src="../assets/images/users/user-1.jpg" class="img-fluid rounded-circle" alt="" /> </div>
                                        <p class="notify-details">Cristina Pride</p>
                                        <p class="text-muted mb-0 user-msg">
                                            <small>Hi, How are you? What about our next meeting</small>
                                        </p>
                                    </a>
    
                                    <!-- item-->
                                    <a href="javascript:void(0);" class="dropdown-item notify-item">
                                        <div class="notify-icon bg-primary">
                                            <i class="mdi mdi-comment-account-outline"></i>
                                        </div>
                                        <p class="notify-details">Caleb Flakelar commented on Admin
                                            <small class="text-muted">1 min ago</small>
                                        </p>
                                    </a>
    
                                    <!-- item-->
                                    <a href="javascript:void(0);" class="dropdown-item notify-item">
                                        <div class="notify-icon">
                                            <img src="../assets/images/users/user-4.jpg" class="img-fluid rounded-circle" alt="" /> </div>
                                        <p class="notify-details">Karen Robinson</p>
                                        <p class="text-muted mb-0 user-msg">
                                            <small>Wow ! this admin looks good and awesome design</small>
                                        </p>
                                    </a>
    
                                    <!-- item-->
                                    <a href="javascript:void(0);" class="dropdown-item notify-item">
                                        <div class="notify-icon bg-warning">
                                            <i class="mdi mdi-account-plus"></i>
                                        </div>
                                        <p class="notify-details">New user registered.
                                            <small class="text-muted">5 hours ago</small>
                                        </p>
                                    </a>
    
                                    <!-- item-->
                                    <a href="javascript:void(0);" class="dropdown-item notify-item">
                                        <div class="notify-icon bg-info">
                                            <i class="mdi mdi-comment-account-outline"></i>
                                        </div>
                                        <p class="notify-details">Caleb Flakelar commented on Admin
                                            <small class="text-muted">4 days ago</small>
                                        </p>
                                    </a>
    
                                    <!-- item-->
                                    <a href="javascript:void(0);" class="dropdown-item notify-item">
                                        <div class="notify-icon bg-secondary">
                                            <i class="mdi mdi-heart"></i>
                                        </div>
                                        <p class="notify-details">Carlos Crouch liked
                                            <b>Admin</b>
                                            <small class="text-muted">13 days ago</small>
                                        </p>
                                    </a>
                                </div>
    
                                <!-- All-->
                                <a href="javascript:void(0);" class="dropdown-item text-center text-primary notify-item notify-all">
                                    View all
                                    <i class="fe-arrow-right"></i>
                                </a>
    
                            </div>
                        </li>
    
                        <li class="dropdown notification-list topbar-dropdown">
                            <a class="nav-link dropdown-toggle nav-user mr-0 waves-effect waves-light" data-toggle="dropdown" href="#" role="button" aria-haspopup="false" aria-expanded="false">
                                <img src="../assets/images/users/user-1.jpg" alt="user-image" class="rounded-circle">
                                <span class="pro-user-name ml-1">
                                    Geneva <i class="mdi mdi-chevron-down"></i> 
                                </span>
                            </a>
                            <div class="dropdown-menu dropdown-menu-right profile-dropdown ">
                                <!-- item-->
                                <div class="dropdown-header noti-title">
                                    <h6 class="text-overflow m-0">Welcome !</h6>
                                </div>
    
                                <!-- item-->
                                <a href="javascript:void(0);" class="dropdown-item notify-item">
                                    <i class="fe-user"></i>
                                    <span>My Account</span>
                                </a>
    
                                <!-- item-->
                                <a href="javascript:void(0);" class="dropdown-item notify-item">
                                    <i class="fe-settings"></i>
                                    <span>Settings</span>
                                </a>
    
                                <!-- item-->
                                <a href="javascript:void(0);" class="dropdown-item notify-item">
                                    <i class="fe-lock"></i>
                                    <span>Lock Screen</span>
                                </a>
    
                                <div class="dropdown-divider"></div>
    
                                <!-- item-->
                                <a href="javascript:void(0);" class="dropdown-item notify-item">
                                    <i class="fe-log-out"></i>
                                    <span>Logout</span>
                                </a>
    
                            </div>
                        </li>
    
                        <li class="dropdown notification-list">
                            <a href="javascript:void(0);" class="nav-link right-bar-toggle waves-effect waves-light">
                                <i class="fe-settings noti-icon"></i>
                            </a>
                        </li>
    
                    </ul>
    
                    <!-- LOGO -->
                    <div class="logo-box">
                        <a href="index.html" class="logo logo-dark text-center">
                            <span class="logo-sm">
                                <img src="../assets/images/logo-sm.png" alt="" height="22">
                                <!-- <span class="logo-lg-text-light">UBold</span> -->
                            </span>
                            <span class="logo-lg">
                                <img src="../assets/images/logo-dark.png" alt="" height="20">
                                <!-- <span class="logo-lg-text-light">U</span> -->
                            </span>
                        </a>
    
                        <a href="index.html" class="logo logo-light text-center">
                            <span class="logo-sm">
                                <img src="../assets/images/logo-sm.png" alt="" height="22">
                            </span>
                            <span class="logo-lg">
                                <img src="../assets/images/logo-light.png" alt="" height="20">
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
            
                        <li class="dropdown d-none d-xl-block">
                            <a class="nav-link dropdown-toggle waves-effect waves-light" data-toggle="dropdown" href="#" role="button" aria-haspopup="false" aria-expanded="false">
                                Create New
                                <i class="mdi mdi-chevron-down"></i> 
                            </a>
                            <div class="dropdown-menu">
                                <!-- item-->
                                <a href="javascript:void(0);" class="dropdown-item">
                                    <i class="fe-briefcase mr-1"></i>
                                    <span>New Projects</span>
                                </a>
    
                                <!-- item-->
                                <a href="javascript:void(0);" class="dropdown-item">
                                    <i class="fe-user mr-1"></i>
                                    <span>Create Users</span>
                                </a>
    
                                <!-- item-->
                                <a href="javascript:void(0);" class="dropdown-item">
                                    <i class="fe-bar-chart-line- mr-1"></i>
                                    <span>Revenue Report</span>
                                </a>
    
                                <!-- item-->
                                <a href="javascript:void(0);" class="dropdown-item">
                                    <i class="fe-settings mr-1"></i>
                                    <span>Settings</span>
                                </a>
    
                                <div class="dropdown-divider"></div>
    
                                <!-- item-->
                                <a href="javascript:void(0);" class="dropdown-item">
                                    <i class="fe-headphones mr-1"></i>
                                    <span>Help & Support</span>
                                </a>
    
                            </div>
                        </li>
    
                        <li class="dropdown dropdown-mega d-none d-xl-block">
                            <a class="nav-link dropdown-toggle waves-effect waves-light" data-toggle="dropdown" href="#" role="button" aria-haspopup="false" aria-expanded="false">
                                Mega Menu
                                <i class="mdi mdi-chevron-down"></i> 
                            </a>
                            <div class="dropdown-menu dropdown-megamenu">
                                <div class="row">
                                    <div class="col-sm-8">
                            
                                        <div class="row">
                                            <div class="col-md-4">
                                                <h5 class="text-dark mt-0">UI Components</h5>
                                                <ul class="list-unstyled megamenu-list">
                                                    <li>
                                                        <a href="javascript:void(0);">Widgets</a>
                                                    </li>
                                                    <li>
                                                        <a href="javascript:void(0);">Nestable List</a>
                                                    </li>
                                                    <li>
                                                        <a href="javascript:void(0);">Range Sliders</a>
                                                    </li>
                                                    <li>
                                                        <a href="javascript:void(0);">Masonry Items</a>
                                                    </li>
                                                    <li>
                                                        <a href="javascript:void(0);">Sweet Alerts</a>
                                                    </li>
                                                    <li>
                                                        <a href="javascript:void(0);">Treeview Page</a>
                                                    </li>
                                                    <li>
                                                        <a href="javascript:void(0);">Tour Page</a>
                                                    </li>
                                                </ul>
                                            </div>
    
                                            <div class="col-md-4">
                                                <h5 class="text-dark mt-0">Applications</h5>
                                                <ul class="list-unstyled megamenu-list">
                                                    <li>
                                                        <a href="javascript:void(0);">eCommerce Pages</a>
                                                    </li>
                                                    <li>
                                                        <a href="javascript:void(0);">CRM Pages</a>
                                                    </li>
                                                    <li>
                                                        <a href="javascript:void(0);">Email</a>
                                                    </li>
                                                    <li>
                                                        <a href="javascript:void(0);">Calendar</a>
                                                    </li>
                                                    <li>
                                                        <a href="javascript:void(0);">Team Contacts</a>
                                                    </li>
                                                    <li>
                                                        <a href="javascript:void(0);">Task Board</a>
                                                    </li>
                                                    <li>
                                                        <a href="javascript:void(0);">Email Templates</a>
                                                    </li>
                                                </ul>
                                            </div>
    
                                            <div class="col-md-4">
                                                <h5 class="text-dark mt-0">Extra Pages</h5>
                                                <ul class="list-unstyled megamenu-list">
                                                    <li>
                                                        <a href="javascript:void(0);">Left Sidebar with User</a>
                                                    </li>
                                                    <li>
                                                        <a href="javascript:void(0);">Menu Collapsed</a>
                                                    </li>
                                                    <li>
                                                        <a href="javascript:void(0);">Small Left Sidebar</a>
                                                    </li>
                                                    <li>
                                                        <a href="javascript:void(0);">New Header Style</a>
                                                    </li>
                                                    <li>
                                                        <a href="javascript:void(0);">Search Result</a>
                                                    </li>
                                                    <li>
                                                        <a href="javascript:void(0);">Gallery Pages</a>
                                                    </li>
                                                    <li>
                                                        <a href="javascript:void(0);">Maintenance & Coming Soon</a>
                                                    </li>
                                                </ul>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-sm-4">
                                        <div class="text-center mt-3">
                                            <h3 class="text-dark">Special Discount Sale!</h3>
                                            <h4>Save up to 70% off.</h4>
                                            <button class="btn btn-primary btn-rounded mt-3">Download Now</button>
                                        </div>
                                    </div>
                                </div>
    
                            </div>
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
                        <img src="../assets/images/users/user-1.jpg" alt="user-img" title="Mat Helme"
                            class="rounded-circle avatar-md">
                        <div class="dropdown">
                            <a href="javascript: void(0);" class="text-dark dropdown-toggle h5 mt-2 mb-1 d-block"
                                data-toggle="dropdown">Geneva Kennedy</a>
                            <div class="dropdown-menu user-pro-dropdown">

                                <!-- item-->
                                <a href="javascript:void(0);" class="dropdown-item notify-item">
                                    <i class="fe-user mr-1"></i>
                                    <span>My Account</span>
                                </a>

                                <!-- item-->
                                <a href="javascript:void(0);" class="dropdown-item notify-item">
                                    <i class="fe-settings mr-1"></i>
                                    <span>Settings</span>
                                </a>

                                <!-- item-->
                                <a href="javascript:void(0);" class="dropdown-item notify-item">
                                    <i class="fe-lock mr-1"></i>
                                    <span>Lock Screen</span>
                                </a>

                                <!-- item-->
                                <a href="javascript:void(0);" class="dropdown-item notify-item">
                                    <i class="fe-log-out mr-1"></i>
                                    <span>Logout</span>
                                </a>

                            </div>
                        </div>
                        <p class="text-muted">Admin Head</p>
                    </div>

                    <!--- Sidemenu -->
                    <div id="sidebar-menu">

                        <ul id="side-menu">

                            <li class="menu-title">Navigation</li>
                
                            <li>
                                <a href="#sidebarDashboards" data-toggle="collapse">
                                    <i data-feather="airplay"></i>
                                    <span class="badge badge-success badge-pill float-right">4</span>
                                    <span> Dashboards </span>
                                </a>
                                <div class="collapse" id="sidebarDashboards">
                                    <ul class="nav-second-level">
                                        <li>
                                            <a href="index.html">Dashboard 1</a>
                                        </li>
                                        <li>
                                            <a href="dashboard-2.html">Dashboard 2</a>
                                        </li>
                                        <li>
                                            <a href="dashboard-3.html">Dashboard 3</a>
                                        </li>
                                        <li>
                                            <a href="dashboard-4.html">Dashboard 4</a>
                                        </li>
                                    </ul>
                                </div>
                            </li>

                            <li class="menu-title mt-2">Apps</li>

                            <li>
                                <a href="apps-calendar.html">
                                    <i data-feather="calendar"></i>
                                    <span> Calendar </span>
                                </a>
                            </li>

                            <li>
                                <a href="apps-chat.html">
                                    <i data-feather="message-square"></i>
                                    <span> Chat </span>
                                </a>
                            </li>

                            <li>
                                <a href="#sidebarEcommerce" data-toggle="collapse">
                                    <i data-feather="shopping-cart"></i>
                                    <span> Ecommerce </span>
                                    <span class="menu-arrow"></span>
                                </a>
                                <div class="collapse" id="sidebarEcommerce">
                                    <ul class="nav-second-level">
                                        <li>
                                            <a href="ecommerce-dashboard.html">Dashboard</a>
                                        </li>
                                        <li>
                                            <a href="ecommerce-products.html">Products</a>
                                        </li>
                                        <li>
                                            <a href="ecommerce-product-detail.html">Product Detail</a>
                                        </li>
                                        <li>
                                            <a href="ecommerce-product-edit.html">Add Product</a>
                                        </li>
                                        <li>
                                            <a href="ecommerce-customers.html">Customers</a>
                                        </li>
                                        <li>
                                            <a href="ecommerce-orders.html">Orders</a>
                                        </li>
                                        <li>
                                            <a href="ecommerce-order-detail.html">Order Detail</a>
                                        </li>
                                        <li>
                                            <a href="ecommerce-sellers.html">Sellers</a>
                                        </li>
                                        <li>
                                            <a href="ecommerce-cart.html">Shopping Cart</a>
                                        </li>
                                        <li>
                                            <a href="ecommerce-checkout.html">Checkout</a>
                                        </li>
                                    </ul>
                                </div>
                            </li>

                            <li>
                                <a href="#sidebarCrm" data-toggle="collapse">
                                    <i data-feather="users"></i>
                                    <span> CRM </span>
                                    <span class="menu-arrow"></span>
                                </a>
                                <div class="collapse" id="sidebarCrm">
                                    <ul class="nav-second-level">
                                        <li>
                                            <a href="crm-dashboard.html">Dashboard</a>
                                        </li>
                                        <li>
                                            <a href="crm-contacts.html">Contacts</a>
                                        </li>
                                        <li>
                                            <a href="crm-opportunities.html">Opportunities</a>
                                        </li>
                                        <li>
                                            <a href="crm-leads.html">Leads</a>
                                        </li>
                                        <li>
                                            <a href="crm-customers.html">Customers</a>
                                        </li>
                                    </ul>
                                </div>
                            </li>

                            <li>
                                <a href="#sidebarEmail" data-toggle="collapse">
                                    <i data-feather="mail"></i>
                                    <span> Email </span>
                                    <span class="menu-arrow"></span>
                                </a>
                                <div class="collapse" id="sidebarEmail">
                                    <ul class="nav-second-level">
                                        <li>
                                            <a href="email-inbox.html">Inbox</a>
                                        </li>
                                        <li>
                                            <a href="email-read.html">Read Email</a>
                                        </li>
                                        <li>
                                            <a href="email-compose.html">Compose Email</a>
                                        </li>
                                        <li>
                                            <a href="email-templates.html">Email Templates</a>
                                        </li>
                                    </ul>
                                </div>
                            </li>

                            <li>
                                <a href="apps-social-feed.html">
                                    <span class="badge badge-pink float-right">Hot</span>
                                    <i data-feather="rss"></i>
                                    <span> Social Feed </span>
                                </a>
                            </li>

                            <li>
                                <a href="apps-companies.html">
                                    <i data-feather="activity"></i>
                                    <span> Companies </span>
                                </a>
                            </li>

                            <li>
                                <a href="#sidebarProjects" data-toggle="collapse">
                                    <i data-feather="briefcase"></i>
                                    <span> Projects </span>
                                    <span class="menu-arrow"></span>
                                </a>
                                <div class="collapse" id="sidebarProjects">
                                    <ul class="nav-second-level">
                                        <li>
                                            <a href="project-list.html">List</a>
                                        </li>
                                        <li>
                                            <a href="project-detail.html">Detail</a>
                                        </li>
                                        <li>
                                            <a href="project-create.html">Create Project</a>
                                        </li>
                                    </ul>
                                </div>
                            </li>

                            <li>
                                <a href="#sidebarTasks" data-toggle="collapse">
                                    <i data-feather="clipboard"></i>
                                    <span> Tasks </span>
                                    <span class="menu-arrow"></span>
                                </a>
                                <div class="collapse" id="sidebarTasks">
                                    <ul class="nav-second-level">
                                        <li>
                                            <a href="task-list.html">List</a>
                                        </li>
                                        <li>
                                            <a href="task-details.html">Details</a>
                                        </li>
                                        <li>
                                            <a href="task-kanban-board.html">Kanban Board</a>
                                        </li>
                                    </ul>
                                </div>
                            </li>

                            <li>
                                <a href="#sidebarContacts" data-toggle="collapse">
                                    <i data-feather="book"></i>
                                    <span> Contacts </span>
                                    <span class="menu-arrow"></span>
                                </a>
                                <div class="collapse" id="sidebarContacts">
                                    <ul class="nav-second-level">
                                        <li>
                                            <a href="contacts-list.html">Members List</a>
                                        </li>
                                        <li>
                                            <a href="contacts-profile.html">Profile</a>
                                        </li>
                                    </ul>
                                </div>
                            </li>

                            <li>
                                <a href="#sidebarTickets" data-toggle="collapse">
                                    <i data-feather="aperture"></i>
                                    <span> Tickets </span>
                                    <span class="menu-arrow"></span>
                                </a>
                                <div class="collapse" id="sidebarTickets">
                                    <ul class="nav-second-level">
                                        <li>
                                            <a href="tickets-list.html">List</a>
                                        </li>
                                        <li>
                                            <a href="tickets-detail.html">Detail</a>
                                        </li>
                                    </ul>
                                </div>
                            </li>

                            <li>
                                <a href="apps-file-manager.html">
                                    <i data-feather="folder-plus"></i>
                                    <span> File Manager </span>
                                </a>
                            </li>

                            <li class="menu-title mt-2">Custom</li>

                            <li>
                                <a href="#sidebarAuth" data-toggle="collapse">
                                    <i data-feather="file-text"></i>
                                    <span> Auth Pages </span>
                                    <span class="menu-arrow"></span>
                                </a>
                                <div class="collapse" id="sidebarAuth">
                                    <ul class="nav-second-level">
                                        <li>
                                            <a href="auth-login.html">Log In</a>
                                        </li>
                                        <li>
                                            <a href="auth-login-2.html">Log In 2</a>
                                        </li>
                                        <li>
                                            <a href="auth-register.html">Register</a>
                                        </li>
                                        <li>
                                            <a href="auth-register-2.html">Register 2</a>
                                        </li>
                                        <li>
                                            <a href="auth-signin-signup.html">Signin - Signup</a>
                                        </li>
                                        <li>
                                            <a href="auth-signin-signup-2.html">Signin - Signup 2</a>
                                        </li>
                                        <li>
                                            <a href="auth-recoverpw.html">Recover Password</a>
                                        </li>
                                        <li>
                                            <a href="auth-recoverpw-2.html">Recover Password 2</a>
                                        </li>
                                        <li>
                                            <a href="auth-lock-screen.html">Lock Screen</a>
                                        </li>
                                        <li>
                                            <a href="auth-lock-screen-2.html">Lock Screen 2</a>
                                        </li>
                                        <li>
                                            <a href="auth-logout.html">Logout</a>
                                        </li>
                                        <li>
                                            <a href="auth-logout-2.html">Logout 2</a>
                                        </li>
                                        <li>
                                            <a href="auth-confirm-mail.html">Confirm Mail</a>
                                        </li>
                                        <li>
                                            <a href="auth-confirm-mail-2.html">Confirm Mail 2</a>
                                        </li>
                                    </ul>
                                </div>
                            </li>

                            <li>
                                <a href="#sidebarExpages" data-toggle="collapse">
                                    <i data-feather="package"></i>
                                    <span> Extra Pages </span>
                                    <span class="menu-arrow"></span>
                                </a>
                                <div class="collapse" id="sidebarExpages">
                                    <ul class="nav-second-level">
                                        <li>
                                            <a href="pages-starter.html">Starter</a>
                                        </li>
                                        <li>
                                            <a href="pages-timeline.html">Timeline</a>
                                        </li>
                                        <li>
                                            <a href="pages-sitemap.html">Sitemap</a>
                                        </li>
                                        <li>
                                            <a href="pages-invoice.html">Invoice</a>
                                        </li>
                                        <li>
                                            <a href="pages-faqs.html">FAQs</a>
                                        </li>
                                        <li>
                                            <a href="pages-search-results.html">Search Results</a>
                                        </li>
                                        <li>
                                            <a href="pages-pricing.html">Pricing</a>
                                        </li>
                                        <li>
                                            <a href="pages-maintenance.html">Maintenance</a>
                                        </li>
                                        <li>
                                            <a href="pages-coming-soon.html">Coming Soon</a>
                                        </li>
                                        <li>
                                            <a href="pages-gallery.html">Gallery</a>
                                        </li>
                                        <li>
                                            <a href="pages-404.html">Error 404</a>
                                        </li>
                                        <li>
                                            <a href="pages-404-two.html">Error 404 Two</a>
                                        </li>
                                        <li>
                                            <a href="pages-404-alt.html">Error 404-alt</a>
                                        </li>
                                        <li>
                                            <a href="pages-500.html">Error 500</a>
                                        </li>
                                        <li>
                                            <a href="pages-500-two.html">Error 500 Two</a>
                                        </li>
                                    </ul>
                                </div>
                            </li>

                            <li>
                                <a href="#sidebarLayouts" data-toggle="collapse">
                                    <i data-feather="layout"></i>
                                    <span class="badge badge-blue float-right">New</span>
                                    <span> Layouts </span>
                                </a>
                                <div class="collapse" id="sidebarLayouts">
                                    <ul class="nav-second-level">
                                        <li>
                                            <a href="layouts-horizontal.html">Horizontal</a>
                                        </li>
                                        <li>
                                            <a href="layouts-detached.html">Detached</a>
                                        </li>
                                        <li>
                                            <a href="layouts-two-column.html">Two Column Menu</a>
                                        </li>
                                        <li>
                                            <a href="layouts-two-tone-icons.html">Two Tones Icons</a>
                                        </li>
                                        <li>
                                            <a href="layouts-preloader.html">Preloader</a>
                                        </li>
                                    </ul>
                                </div>
                            </li>

                            <li class="menu-title mt-2">Components</li>

                            <li>
                                <a href="#sidebarBaseui" data-toggle="collapse">
                                    <i data-feather="pocket"></i>
                                    <span> Base UI </span>
                                    <span class="menu-arrow"></span>
                                </a>
                                <div class="collapse" id="sidebarBaseui">
                                    <ul class="nav-second-level">
                                        <li>
                                            <a href="ui-buttons.html">Buttons</a>
                                        </li>
                                        <li>
                                            <a href="ui-cards.html">Cards</a>
                                        </li>
                                        <li>
                                            <a href="ui-avatars.html">Avatars</a>
                                        </li>
                                        <li>
                                            <a href="ui-portlets.html">Portlets</a>
                                        </li>
                                        <li>
                                            <a href="ui-tabs-accordions.html">Tabs & Accordions</a>
                                        </li>
                                        <li>
                                            <a href="ui-modals.html">Modals</a>
                                        </li>
                                        <li>
                                            <a href="ui-progress.html">Progress</a>
                                        </li>
                                        <li>
                                            <a href="ui-notifications.html">Notifications</a>
                                        </li>
                                        <li>
                                            <a href="ui-spinners.html">Spinners</a>
                                        </li>
                                        <li>
                                            <a href="ui-images.html">Images</a>
                                        </li>
                                        <li>
                                            <a href="ui-carousel.html">Carousel</a>
                                        </li>
                                        <li>
                                            <a href="ui-list-group.html">List Group</a>
                                        </li>
                                        <li>
                                            <a href="ui-video.html">Embed Video</a>
                                        </li>
                                        <li>
                                            <a href="ui-dropdowns.html">Dropdowns</a>
                                        </li>
                                        <li>
                                            <a href="ui-ribbons.html">Ribbons</a>
                                        </li>
                                        <li>
                                            <a href="ui-tooltips-popovers.html">Tooltips & Popovers</a>
                                        </li>
                                        <li>
                                            <a href="ui-general.html">General UI</a>
                                        </li>
                                        <li>
                                            <a href="ui-typography.html">Typography</a>
                                        </li>
                                        <li>
                                            <a href="ui-grid.html">Grid</a>
                                        </li>
                                    </ul>
                                </div>
                            </li>

                            <li>
                                <a href="#sidebarExtendedui" data-toggle="collapse">
                                    <i data-feather="layers"></i>
                                    <span class="badge badge-info float-right">Hot</span>
                                    <span> Extended UI </span>
                                </a>
                                <div class="collapse" id="sidebarExtendedui">
                                    <ul class="nav-second-level">
                                        <li>
                                            <a href="extended-nestable.html">Nestable List</a>
                                        </li>
                                        <li>
                                            <a href="extended-range-slider.html">Range Slider</a>
                                        </li>
                                        <li>
                                            <a href="extended-dragula.html">Dragula</a>
                                        </li>
                                        <li>
                                            <a href="extended-animation.html">Animation</a>
                                        </li>
                                        <li>
                                            <a href="extended-sweet-alert.html">Sweet Alert</a>
                                        </li>
                                        <li>
                                            <a href="extended-tour.html">Tour Page</a>
                                        </li>
                                        <li>
                                            <a href="extended-scrollspy.html">Scrollspy</a>
                                        </li>
                                        <li>
                                            <a href="extended-loading-buttons.html">Loading Buttons</a>
                                        </li>
                                    </ul>
                                </div>
                            </li>

                            <li>
                                <a href="widgets.html">
                                    <i data-feather="gift"></i>
                                    <span> Widgets </span>
                                </a>
                            </li>

                            <li>
                                <a href="#sidebarIcons" data-toggle="collapse">
                                    <i data-feather="cpu"></i>
                                    <span> Icons </span>
                                    <span class="menu-arrow"></span>
                                </a>
                                <div class="collapse" id="sidebarIcons">
                                    <ul class="nav-second-level">
                                        <li>
                                            <a href="icons-two-tone.html">Two Tone Icons</a>
                                        </li>
                                        <li>
                                            <a href="icons-feather.html">Feather Icons</a>
                                        </li>
                                        <li>
                                            <a href="icons-mdi.html">Material Design Icons</a>
                                        </li>
                                        <li>
                                            <a href="icons-dripicons.html">Dripicons</a>
                                        </li>
                                        <li>
                                            <a href="icons-font-awesome.html">Font Awesome 5</a>
                                        </li>
                                        <li>
                                            <a href="icons-themify.html">Themify</a>
                                        </li>
                                        <li>
                                            <a href="icons-simple-line.html">Simple Line</a>
                                        </li>
                                        <li>
                                            <a href="icons-weather.html">Weather</a>
                                        </li>
                                    </ul>
                                </div>
                            </li>

                            <li>
                                <a href="#sidebarForms" data-toggle="collapse">
                                    <i data-feather="bookmark"></i>
                                    <span> Forms </span>
                                    <span class="menu-arrow"></span>
                                </a>
                                <div class="collapse" id="sidebarForms">
                                    <ul class="nav-second-level">
                                        <li>
                                            <a href="forms-elements.html">General Elements</a>
                                        </li>
                                        <li>
                                            <a href="forms-advanced.html">Advanced</a>
                                        </li>
                                        <li>
                                            <a href="forms-validation.html">Validation</a>
                                        </li>
                                        <li>
                                            <a href="forms-pickers.html">Pickers</a>
                                        </li>
                                        <li>
                                            <a href="forms-wizard.html">Wizard</a>
                                        </li>
                                        <li>
                                            <a href="forms-masks.html">Masks</a>
                                        </li>
                                        <li>
                                            <a href="forms-summernote.html">Summernote</a>
                                        </li>
                                        <li>
                                            <a href="forms-quilljs.html">Quilljs Editor</a>
                                        </li>
                                        <li>
                                            <a href="forms-file-uploads.html">File Uploads</a>
                                        </li>
                                        <li>
                                            <a href="forms-x-editable.html">X Editable</a>
                                        </li>
                                        <li>
                                            <a href="forms-image-crop.html">Image Crop</a>
                                        </li>
                                    </ul>
                                </div>
                            </li>

                            <li>
                                <a href="#sidebarTables" data-toggle="collapse">
                                    <i data-feather="grid"></i>
                                    <span> Tables </span>
                                    <span class="menu-arrow"></span>
                                </a>
                                <div class="collapse" id="sidebarTables">
                                    <ul class="nav-second-level">
                                        <li>
                                            <a href="tables-basic.html">Basic Tables</a>
                                        </li>
                                        <li>
                                            <a href="tables-datatables.html">Data Tables</a>
                                        </li>
                                        <li>
                                            <a href="tables-editable.html">Editable Tables</a>
                                        </li>
                                        <li>
                                            <a href="tables-responsive.html">Responsive Tables</a>
                                        </li>
                                        <li>
                                            <a href="tables-footables.html">FooTable</a>
                                        </li>
                                        <li>
                                            <a href="tables-bootstrap.html">Bootstrap Tables</a>
                                        </li>
                                        <li>
                                            <a href="tables-tablesaw.html">Tablesaw Tables</a>
                                        </li>
                                        <li>
                                            <a href="tables-jsgrid.html">JsGrid Tables</a>
                                        </li>
                                    </ul>
                                </div>
                            </li>

                            <li>
                                <a href="#sidebarCharts" data-toggle="collapse">
                                    <i data-feather="bar-chart-2"></i>
                                    <span> Charts </span>
                                    <span class="menu-arrow"></span>
                                </a>
                                <div class="collapse" id="sidebarCharts">
                                    <ul class="nav-second-level">
                                        <li>
                                            <a href="charts-apex.html">Apex Charts</a>
                                        </li>
                                        <li>
                                            <a href="charts-flot.html">Flot Charts</a>
                                        </li>
                                        <li>
                                            <a href="charts-morris.html">Morris Charts</a>
                                        </li>
                                        <li>
                                            <a href="charts-chartjs.html">Chartjs Charts</a>
                                        </li>
                                        <li>
                                            <a href="charts-peity.html">Peity Charts</a>
                                        </li>
                                        <li>
                                            <a href="charts-chartist.html">Chartist Charts</a>
                                        </li>
                                        <li>
                                            <a href="charts-c3.html">C3 Charts</a>
                                        </li>
                                        <li>
                                            <a href="charts-sparklines.html">Sparklines Charts</a>
                                        </li>
                                        <li>
                                            <a href="charts-knob.html">Jquery Knob Charts</a>
                                        </li>
                                    </ul>
                                </div>
                            </li>

                            <li>
                                <a href="#sidebarMaps" data-toggle="collapse">
                                    <i data-feather="map"></i>
                                    <span> Maps </span>
                                    <span class="menu-arrow"></span>
                                </a>
                                <div class="collapse" id="sidebarMaps">
                                    <ul class="nav-second-level">
                                        <li>
                                            <a href="maps-google.html">Google Maps</a>
                                        </li>
                                        <li>
                                            <a href="maps-vector.html">Vector Maps</a>
                                        </li>
                                        <li>
                                            <a href="maps-mapael.html">Mapael Maps</a>
                                        </li>
                                    </ul>
                                </div>
                            </li>

                            <li>
                                <a href="#sidebarMultilevel" data-toggle="collapse">
                                    <i data-feather="share-2"></i>
                                    <span> Multi Level </span>
                                    <span class="menu-arrow"></span>
                                </a>
                                <div class="collapse" id="sidebarMultilevel">
                                    <ul class="nav-second-level">
                                        <li>
                                            <a href="#sidebarMultilevel2" data-toggle="collapse">
                                                Second Level <span class="menu-arrow"></span>
                                            </a>
                                            <div class="collapse" id="sidebarMultilevel2">
                                                <ul class="nav-second-level">
                                                    <li>
                                                        <a href="javascript: void(0);">Item 1</a>
                                                    </li>
                                                    <li>
                                                        <a href="javascript: void(0);">Item 2</a>
                                                    </li>
                                                </ul>
                                            </div>
                                        </li>

                                        <li>
                                            <a href="#sidebarMultilevel3" data-toggle="collapse">
                                                Third Level <span class="menu-arrow"></span>
                                            </a>
                                            <div class="collapse" id="sidebarMultilevel3">
                                                <ul class="nav-second-level">
                                                    <li>
                                                        <a href="javascript: void(0);">Item 1</a>
                                                    </li>
                                                    <li>
                                                        <a href="#sidebarMultilevel4" data-toggle="collapse">
                                                            Item 2 <span class="menu-arrow"></span>
                                                        </a>
                                                        <div class="collapse" id="sidebarMultilevel4">
                                                            <ul class="nav-second-level">
                                                                <li>
                                                                    <a href="javascript: void(0);">Item 1</a>
                                                                </li>
                                                                <li>
                                                                    <a href="javascript: void(0);">Item 2</a>
                                                                </li>
                                                            </ul>
                                                        </div>
                                                    </li>
                                                </ul>
                                            </div>
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
                                            <li class="breadcrumb-item"><a href="javascript: void(0);">UBold</a></li>
                                            <li class="breadcrumb-item"><a href="javascript: void(0);">Icons</a></li>
                                            <li class="breadcrumb-item active">Weather</li>
                                        </ol>
                                    </div>
                                    <h4 class="page-title">Weather Icons</h4>
                                </div>
                            </div>
                        </div>     
                        <!-- end page title --> 

                        <div class="row">
                            <div class="col-12">
                                <div class="card-box">
                                    <h4 class="header-title mb-3">26 New 2.0 Icons</h4>
                                    <div class="row icons-list-demo">
                                        <div class="col-sm-6 col-md-4 col-xl-3">
                                            <i class="wi wi-day-cloudy-high"></i> wi wi-day-cloudy-high
                                        </div>
                                        <div class="col-sm-6 col-md-4 col-xl-3">
                                            <i class="wi wi-moonrise"></i>wi wi-moonrise
                                        </div>
                                        <div class="col-sm-6 col-md-4 col-xl-3">
                                            <i class="wi wi-na"></i>wi wi-na
                                        </div>
                                        <div class="col-sm-6 col-md-4 col-xl-3">
                                            <i class="wi wi-volcano"></i>wi wi-volcano
                                        </div>
                                        <div class="col-sm-6 col-md-4 col-xl-3">
                                            <i class="wi wi-day-light-wind"></i>wi wi-day-light-wind
                                        </div>
                                        <div class="col-sm-6 col-md-4 col-xl-3">
                                            <i class="wi wi-moonset"></i>wi wi-moonset
                                        </div>
                                        <div class="col-sm-6 col-md-4 col-xl-3">
                                            <i class="wi wi-flood"></i>wi wi-flood
                                        </div>
                                        <div class="col-sm-6 col-md-4 col-xl-3">
                                            <i class="wi wi-train"></i>wi wi-train
                                        </div>
                                        <div class="col-sm-6 col-md-4 col-xl-3">
                                            <i class="wi wi-day-sleet"></i>wi wi-day-sleet
                                        </div>
                                        <div class="col-sm-6 col-md-4 col-xl-3">
                                            <i class="wi wi-night-sleet"></i>wi wi-night-sleet
                                        </div>
                                        <div class="col-sm-6 col-md-4 col-xl-3">
                                            <i class="wi wi-sandstorm"></i>wi wi-sandstorm
                                        </div>
                                        <div class="col-sm-6 col-md-4 col-xl-3">
                                            <i class="wi wi-small-craft-advisory"></i>wi wi-small-craft-advisory
                                        </div>
                                        <div class="col-sm-6 col-md-4 col-xl-3">
                                            <i class="wi wi-day-haze"></i>wi wi-day-haze
                                        </div>
                                        <div class="col-sm-6 col-md-4 col-xl-3">
                                            <i class="wi wi-night-alt-sleet"></i>wi wi-night-alt-sleet
                                        </div>
                                        <div class="col-sm-6 col-md-4 col-xl-3">
                                            <i class="wi wi-tsunami"></i>wi wi-tsunami
                                        </div>
                                        <div class="col-sm-6 col-md-4 col-xl-3">
                                            <i class="wi wi-gale-warning"></i>wi wi-gale-warning
                                        </div>
                                        <div class="col-sm-6 col-md-4 col-xl-3">
                                            <i class="wi wi-night-cloudy-high"></i>wi wi-night-cloudy-high
                                        </div>
                                        <div class="col-sm-6 col-md-4 col-xl-3">
                                            <i class="wi wi-raindrop"></i>wi wi-raindrop
                                        </div>
                                        <div class="col-sm-6 col-md-4 col-xl-3">
                                            <i class="wi wi-earthquake"></i>wi wi-earthquake
                                        </div>
                                        <div class="col-sm-6 col-md-4 col-xl-3">
                                            <i class="wi wi-storm-warning"></i>wi wi-storm-warning
                                        </div>
                                        <div class="col-sm-6 col-md-4 col-xl-3">
                                            <i class="wi wi-night-alt-partly-cloudy"></i>wi wi-night-alt-partly-cloudy
                                        </div>
                                        <div class="col-sm-6 col-md-4 col-xl-3">
                                            <i class="wi wi-barometer"></i>wi wi-barometer
                                        </div>
                                        <div class="col-sm-6 col-md-4 col-xl-3">
                                            <i class="wi wi-fire"></i>wi wi-fire
                                        </div>
                                        <div class="col-sm-6 col-md-4 col-xl-3">
                                            <i class="wi wi-hurricane-warning"></i>wi wi-hurricane-warning
                                        </div>
                                        <div class="col-sm-6 col-md-4 col-xl-3">
                                            <i class="wi wi-sleet"></i>wi wi-sleet
                                        </div>
                                        <div class="col-sm-6 col-md-4 col-xl-3">
                                            <i class="wi wi-humidity"></i>wi wi-humidity
                                        </div>
                                    </div>
                                    <!-- End row -->

                                    <h4 class="header-title my-3">Daytime Icons</h4>
                                    <div class="row icons-list-demo">
                                        <div class="col-sm-6 col-md-4 col-xl-3">
                                            <i class="wi wi-day-sunny"></i> wi wi-day-sunny
                                        </div>
                                        <div class="col-sm-6 col-md-4 col-xl-3">
                                            <i class="wi wi-day-cloudy"></i> wi wi-day-cloudy
                                        </div>
                                        <div class="col-sm-6 col-md-4 col-xl-3">
                                            <i class="wi wi-day-cloudy-gusts"></i> wi wi-day-cloudy-gusts
                                        </div>
                                        <div class="col-sm-6 col-md-4 col-xl-3">
                                            <i class="wi wi-day-cloudy-windy"></i> wi wi-day-cloudy-windy
                                        </div>
                                        <div class="col-sm-6 col-md-4 col-xl-3">
                                            <i class="wi wi-day-fog"></i> wi wi-day-fog
                                        </div>
                                        <div class="col-sm-6 col-md-4 col-xl-3">
                                            <i class="wi wi-day-hail"></i> wi wi-day-hail
                                        </div>
                                        <div class="col-sm-6 col-md-4 col-xl-3">
                                            <i class="wi wi-day-haze"></i> wi wi-day-haze
                                        </div>
                                        <div class="col-sm-6 col-md-4 col-xl-3">
                                            <i class="wi wi-day-lightning"></i> wi wi-day-lightning
                                        </div>
                                        <div class="col-sm-6 col-md-4 col-xl-3">
                                            <i class="wi wi-day-rain"></i> wi wi-day-rain
                                        </div>
                                        <div class="col-sm-6 col-md-4 col-xl-3">
                                            <i class="wi wi-day-rain-mix"></i> wi wi-day-rain-mix
                                        </div>
                                        <div class="col-sm-6 col-md-4 col-xl-3">
                                            <i class="wi wi-day-rain-wind"></i> wi wi-day-rain-wind
                                        </div>
                                        <div class="col-sm-6 col-md-4 col-xl-3">
                                            <i class="wi wi-day-showers"></i> wi wi-day-showers
                                        </div>
                                        <div class="col-sm-6 col-md-4 col-xl-3">
                                            <i class="wi wi-day-sleet"></i> wi wi-day-sleet
                                        </div>
                                        <div class="col-sm-6 col-md-4 col-xl-3">
                                            <i class="wi wi-day-sleet-storm"></i> wi wi-day-sleet-storm
                                        </div>
                                        <div class="col-sm-6 col-md-4 col-xl-3">
                                            <i class="wi wi-day-snow"></i> wi wi-day-snow
                                        </div>
                                        <div class="col-sm-6 col-md-4 col-xl-3">
                                            <i class="wi wi-day-snow-thunderstorm"></i> wi wi-day-snow-thunderstorm
                                        </div>
                                        <div class="col-sm-6 col-md-4 col-xl-3">
                                            <i class="wi wi-day-snow-wind"></i> wi wi-day-snow-wind
                                        </div>
                                        <div class="col-sm-6 col-md-4 col-xl-3">
                                            <i class="wi wi-day-sprinkle"></i> wi wi-day-sprinkle
                                        </div>
                                        <div class="col-sm-6 col-md-4 col-xl-3">
                                            <i class="wi wi-day-storm-showers"></i> wi wi-day-storm-showers
                                        </div>
                                        <div class="col-sm-6 col-md-4 col-xl-3">
                                            <i class="wi wi-day-sunny-overcast"></i> wi wi-day-sunny-overcast
                                        </div>
                                        <div class="col-sm-6 col-md-4 col-xl-3">
                                            <i class="wi wi-day-thunderstorm"></i> wi wi-day-thunderstorm
                                        </div>
                                        <div class="col-sm-6 col-md-4 col-xl-3">
                                            <i class="wi wi-day-windy"></i> wi wi-day-windy
                                        </div>
                                        <div class="col-sm-6 col-md-4 col-xl-3">
                                            <i class="wi wi-solar-eclipse"></i> wi wi-solar-eclipse
                                        </div>
                                        <div class="col-sm-6 col-md-4 col-xl-3">
                                            <i class="wi wi-hot"></i> wi wi-hot
                                        </div>
                                        <div class="col-sm-6 col-md-4 col-xl-3">
                                            <i class="wi wi-day-cloudy-high"></i> wi wi-day-cloudy-high
                                        </div>
                                        <div class="col-sm-6 col-md-4 col-xl-3">
                                            <i class="wi wi-day-light-wind"></i> wi wi-day-light-wind
                                        </div>

                                    </div>
                                    <!-- End row -->

                                    <h4 class="header-title my-3">Nighttime Icons</h4>
                                    <div class="row icons-list-demo">

                                        <div class="col-sm-6 col-md-4 col-xl-3">
                                            <i class="wi wi-night-clear"></i> wi wi-night-clear
                                        </div>
                                        <div class="col-sm-6 col-md-4 col-xl-3">
                                            <i class="wi wi-night-alt-cloudy"></i> wi wi-night-alt-cloudy
                                        </div>
                                        <div class="col-sm-6 col-md-4 col-xl-3">
                                            <i class="wi wi-night-alt-cloudy-gusts"></i> wi wi-night-alt-cloudy-gusts
                                        </div>
                                        <div class="col-sm-6 col-md-4 col-xl-3">
                                            <i class="wi wi-night-alt-cloudy-windy"></i> wi wi-night-alt-cloudy-windy
                                        </div>
                                        <div class="col-sm-6 col-md-4 col-xl-3">
                                            <i class="wi wi-night-alt-hail"></i> wi wi-night-alt-hail
                                        </div>
                                        <div class="col-sm-6 col-md-4 col-xl-3">
                                            <i class="wi wi-night-alt-lightning"></i> wi wi-night-alt-lightning
                                        </div>
                                        <div class="col-sm-6 col-md-4 col-xl-3">
                                            <i class="wi wi-night-alt-rain"></i> wi wi-night-alt-rain
                                        </div>
                                        <div class="col-sm-6 col-md-4 col-xl-3">
                                            <i class="wi wi-night-alt-rain-mix"></i> wi wi-night-alt-rain-mix
                                        </div>
                                        <div class="col-sm-6 col-md-4 col-xl-3">
                                            <i class="wi wi-night-alt-rain-wind"></i> wi wi-night-alt-rain-wind
                                        </div>
                                        <div class="col-sm-6 col-md-4 col-xl-3">
                                            <i class="wi wi-night-alt-showers"></i> wi wi-night-alt-showers
                                        </div>
                                        <div class="col-sm-6 col-md-4 col-xl-3">
                                            <i class="wi wi-night-alt-sleet"></i> wi wi-night-alt-sleet
                                        </div>
                                        <div class="col-sm-6 col-md-4 col-xl-3">
                                            <i class="wi wi-night-alt-sleet-storm"></i> wi wi-night-alt-sleet-storm
                                        </div>
                                        <div class="col-sm-6 col-md-4 col-xl-3">
                                            <i class="wi wi-night-alt-snow"></i> wi wi-night-alt-snow
                                        </div>
                                        <div class="col-sm-6 col-md-4 col-xl-3">
                                            <i class="wi wi-night-alt-snow-thunderstorm"></i> wi wi-night-alt-snow-thunderstorm
                                        </div>
                                        <div class="col-sm-6 col-md-4 col-xl-3">
                                            <i class="wi wi-night-alt-snow-wind"></i> wi wi-night-alt-snow-wind
                                        </div>
                                        <div class="col-sm-6 col-md-4 col-xl-3">
                                            <i class="wi wi-night-alt-sprinkle"></i> wi wi-night-alt-sprinkle
                                        </div>
                                        <div class="col-sm-6 col-md-4 col-xl-3">
                                            <i class="wi wi-night-alt-storm-showers"></i> wi wi-night-alt-storm-showers
                                        </div>
                                        <div class="col-sm-6 col-md-4 col-xl-3">
                                            <i class="wi wi-night-alt-thunderstorm"></i> wi wi-night-alt-thunderstorm
                                        </div>
                                        <div class="col-sm-6 col-md-4 col-xl-3">
                                            <i class="wi wi-night-cloudy"></i> wi wi-night-cloudy
                                        </div>
                                        <div class="col-sm-6 col-md-4 col-xl-3">
                                            <i class="wi wi-night-cloudy-gusts"></i> wi wi-night-cloudy-gusts
                                        </div>
                                        <div class="col-sm-6 col-md-4 col-xl-3">
                                            <i class="wi wi-night-cloudy-windy"></i> wi wi-night-cloudy-windy
                                        </div>
                                        <div class="col-sm-6 col-md-4 col-xl-3">
                                            <i class="wi wi-night-fog"></i> wi wi-night-fog
                                        </div>
                                        <div class="col-sm-6 col-md-4 col-xl-3">
                                            <i class="wi wi-night-hail"></i> wi wi-night-hail
                                        </div>
                                        <div class="col-sm-6 col-md-4 col-xl-3">
                                            <i class="wi wi-night-lightning"></i> wi wi-night-lightning
                                        </div>
                                        <div class="col-sm-6 col-md-4 col-xl-3">
                                            <i class="wi wi-night-partly-cloudy"></i> wi wi-night-partly-cloudy
                                        </div>
                                        <div class="col-sm-6 col-md-4 col-xl-3">
                                            <i class="wi wi-night-rain"></i> wi wi-night-rain
                                        </div>
                                        <div class="col-sm-6 col-md-4 col-xl-3">
                                            <i class="wi wi-night-rain-mix"></i> wi wi-night-rain-mix
                                        </div>
                                        <div class="col-sm-6 col-md-4 col-xl-3">
                                            <i class="wi wi-night-rain-wind"></i> wi wi-night-rain-wind
                                        </div>
                                        <div class="col-sm-6 col-md-4 col-xl-3">
                                            <i class="wi wi-night-showers"></i> wi wi-night-showers
                                        </div>
                                        <div class="col-sm-6 col-md-4 col-xl-3">
                                            <i class="wi wi-night-sleet"></i> wi wi-night-sleet
                                        </div>
                                        <div class="col-sm-6 col-md-4 col-xl-3">
                                            <i class="wi wi-night-sleet-storm"></i> wi wi-night-sleet-storm
                                        </div>
                                        <div class="col-sm-6 col-md-4 col-xl-3">
                                            <i class="wi wi-night-snow"></i> wi wi-night-snow
                                        </div>
                                        <div class="col-sm-6 col-md-4 col-xl-3">
                                            <i class="wi wi-night-snow-thunderstorm"></i> wi wi-night-snow-thunderstorm
                                        </div>
                                        <div class="col-sm-6 col-md-4 col-xl-3">
                                            <i class="wi wi-night-snow-wind"></i> wi wi-night-snow-wind
                                        </div>
                                        <div class="col-sm-6 col-md-4 col-xl-3">
                                            <i class="wi wi-night-sprinkle"></i> wi wi-night-sprinkle
                                        </div>
                                        <div class="col-sm-6 col-md-4 col-xl-3">
                                            <i class="wi wi-night-storm-showers"></i> wi wi-night-storm-showers
                                        </div>
                                        <div class="col-sm-6 col-md-4 col-xl-3">
                                            <i class="wi wi-night-thunderstorm"></i> wi wi-night-thunderstorm
                                        </div>
                                        <div class="col-sm-6 col-md-4 col-xl-3">
                                            <i class="wi wi-lunar-eclipse"></i> wi wi-lunar-eclipse
                                        </div>
                                        <div class="col-sm-6 col-md-4 col-xl-3">
                                            <i class="wi wi-stars"></i> wi wi-stars
                                        </div>
                                        <div class="col-sm-6 col-md-4 col-xl-3">
                                            <i class="wi wi-storm-showers"></i> wi wi-storm-showers
                                        </div>
                                        <div class="col-sm-6 col-md-4 col-xl-3">
                                            <i class="wi wi-thunderstorm"></i> wi wi-thunderstorm
                                        </div>
                                        <div class="col-sm-6 col-md-4 col-xl-3">
                                            <i class="wi wi-night-alt-cloudy-high"></i> wi wi-night-alt-cloudy-high
                                        </div>
                                        <div class="col-sm-6 col-md-4 col-xl-3">
                                            <i class="wi wi-night-cloudy-high"></i> wi wi-night-cloudy-high
                                        </div>
                                        <div class="col-sm-6 col-md-4 col-xl-3">
                                            <i class="wi wi-night-alt-partly-cloudy"></i> wi wi-night-alt-partly-cloudy
                                        </div>

                                    </div>
                                    <!-- End row -->

                                    <h4 class="header-title my-3">Neutral Icons</h4>
                                    <div class="row icons-list-demo">

                                        <div class="col-sm-6 col-md-4 col-xl-3">
                                            <i class="wi wi-cloud"></i> wi wi-cloud
                                        </div>
                                        <div class="col-sm-6 col-md-4 col-xl-3">
                                            <i class="wi wi-cloudy"></i> wi wi-cloudy
                                        </div>
                                        <div class="col-sm-6 col-md-4 col-xl-3">
                                            <i class="wi wi-cloudy-gusts"></i> wi wi-cloudy-gusts
                                        </div>
                                        <div class="col-sm-6 col-md-4 col-xl-3">
                                            <i class="wi wi-cloudy-windy"></i> wi wi-cloudy-windy
                                        </div>
                                        <div class="col-sm-6 col-md-4 col-xl-3">
                                            <i class="wi wi-fog"></i> wi wi-fog
                                        </div>
                                        <div class="col-sm-6 col-md-4 col-xl-3">
                                            <i class="wi wi-hail"></i> wi wi-hail
                                        </div>
                                        <div class="col-sm-6 col-md-4 col-xl-3">
                                            <i class="wi wi-rain"></i> wi wi-rain
                                        </div>
                                        <div class="col-sm-6 col-md-4 col-xl-3">
                                            <i class="wi wi-rain-mix"></i> wi wi-rain-mix
                                        </div>
                                        <div class="col-sm-6 col-md-4 col-xl-3">
                                            <i class="wi wi-rain-wind"></i> wi wi-rain-wind
                                        </div>
                                        <div class="col-sm-6 col-md-4 col-xl-3">
                                            <i class="wi wi-showers"></i> wi wi-showers
                                        </div>
                                        <div class="col-sm-6 col-md-4 col-xl-3">
                                            <i class="wi wi-sleet"></i> wi wi-sleet
                                        </div>
                                        <div class="col-sm-6 col-md-4 col-xl-3">
                                            <i class="wi wi-snow"></i> wi wi-snow
                                        </div>
                                        <div class="col-sm-6 col-md-4 col-xl-3">
                                            <i class="wi wi-sprinkle"></i> wi wi-sprinkle
                                        </div>
                                        <div class="col-sm-6 col-md-4 col-xl-3">
                                            <i class="wi wi-storm-showers"></i> wi wi-storm-showers
                                        </div>
                                        <div class="col-sm-6 col-md-4 col-xl-3">
                                            <i class="wi wi-thunderstorm"></i> wi wi-thunderstorm
                                        </div>
                                        <div class="col-sm-6 col-md-4 col-xl-3">
                                            <i class="wi wi-snow-wind"></i> wi wi-snow-wind
                                        </div>
                                        <div class="col-sm-6 col-md-4 col-xl-3">
                                            <i class="wi wi-snow"></i> wi wi-snow
                                        </div>
                                        <div class="col-sm-6 col-md-4 col-xl-3">
                                            <i class="wi wi-smog"></i> wi wi-smog
                                        </div>
                                        <div class="col-sm-6 col-md-4 col-xl-3">
                                            <i class="wi wi-smoke"></i> wi wi-smoke
                                        </div>
                                        <div class="col-sm-6 col-md-4 col-xl-3">
                                            <i class="wi wi-lightning"></i> wi wi-lightning
                                        </div>
                                        <div class="col-sm-6 col-md-4 col-xl-3">
                                            <i class="wi wi-raindrops"></i> wi wi-raindrops
                                        </div>
                                        <div class="col-sm-6 col-md-4 col-xl-3">
                                            <i class="wi wi-raindrop"></i> wi wi-raindrop
                                        </div>
                                        <div class="col-sm-6 col-md-4 col-xl-3">
                                            <i class="wi wi-dust"></i> wi wi-dust
                                        </div>
                                        <div class="col-sm-6 col-md-4 col-xl-3">
                                            <i class="wi wi-snowflake-cold"></i> wi wi-snowflake-cold
                                        </div>
                                        <div class="col-sm-6 col-md-4 col-xl-3">
                                            <i class="wi wi-windy"></i> wi wi-windy
                                        </div>
                                        <div class="col-sm-6 col-md-4 col-xl-3">
                                            <i class="wi wi-strong-wind"></i> wi wi-strong-wind
                                        </div>
                                        <div class="col-sm-6 col-md-4 col-xl-3">
                                            <i class="wi wi-sandstorm"></i> wi wi-sandstorm
                                        </div>
                                        <div class="col-sm-6 col-md-4 col-xl-3">
                                            <i class="wi wi-earthquake"></i> wi wi-earthquake
                                        </div>
                                        <div class="col-sm-6 col-md-4 col-xl-3">
                                            <i class="wi wi-fire"></i> wi wi-fire
                                        </div>
                                        <div class="col-sm-6 col-md-4 col-xl-3">
                                            <i class="wi wi-flood"></i> wi wi-flood
                                        </div>
                                        <div class="col-sm-6 col-md-4 col-xl-3">
                                            <i class="wi wi-meteor"></i> wi wi-meteor
                                        </div>
                                        <div class="col-sm-6 col-md-4 col-xl-3">
                                            <i class="wi wi-tsunami"></i> wi wi-tsunami
                                        </div>
                                        <div class="col-sm-6 col-md-4 col-xl-3">
                                            <i class="wi wi-volcano"></i> wi wi-volcano
                                        </div>
                                        <div class="col-sm-6 col-md-4 col-xl-3">
                                            <i class="wi wi-hurricane"></i> wi wi-hurricane
                                        </div>
                                        <div class="col-sm-6 col-md-4 col-xl-3">
                                            <i class="wi wi-tornado"></i> wi wi-tornado
                                        </div>
                                        <div class="col-sm-6 col-md-4 col-xl-3">
                                            <i class="wi wi-small-craft-advisory"></i> wi wi-small-craft-advisory
                                        </div>
                                        <div class="col-sm-6 col-md-4 col-xl-3">
                                            <i class="wi wi-gale-warning"></i> wi wi-gale-warning
                                        </div>
                                        <div class="col-sm-6 col-md-4 col-xl-3">
                                            <i class="wi wi-storm-warning"></i> wi wi-storm-warning
                                        </div>
                                        <div class="col-sm-6 col-md-4 col-xl-3">
                                            <i class="wi wi-hurricane-warning"></i> wi wi-hurricane-warning
                                        </div>
                                        <div class="col-sm-6 col-md-4 col-xl-3">
                                            <i class="wi wi-wind-direction"></i> wi wi-wind-direction
                                        </div>
                                    </div>
                                    <!-- End row -->

                                    <h4 class="header-title my-3">Miscellaneous Icons</h4>
                                    <div class="row icons-list-demo">

                                        <div class="col-sm-6 col-md-4 col-xl-3">
                                            <i class="wi wi-alien"></i> wi wi-alien
                                        </div>
                                        <div class="col-sm-6 col-md-4 col-xl-3">
                                            <i class="wi wi-celsius"></i> wi wi-celsius
                                        </div>
                                        <div class="col-sm-6 col-md-4 col-xl-3">
                                            <i class="wi wi-fahrenheit"></i> wi wi-fahrenheit
                                        </div>
                                        <div class="col-sm-6 col-md-4 col-xl-3">
                                            <i class="wi wi-degrees"></i> wi wi-degrees
                                        </div>
                                        <div class="col-sm-6 col-md-4 col-xl-3">
                                            <i class="wi wi-thermometer"></i> wi wi-thermometer
                                        </div>
                                        <div class="col-sm-6 col-md-4 col-xl-3">
                                            <i class="wi wi-thermometer-exterior"></i> wi wi-thermometer-exterior
                                        </div>
                                        <div class="col-sm-6 col-md-4 col-xl-3">
                                            <i class="wi wi-thermometer-internal"></i> wi wi-thermometer-internal
                                        </div>
                                        <div class="col-sm-6 col-md-4 col-xl-3">
                                            <i class="wi wi-cloud-down"></i> wi wi-cloud-down
                                        </div>
                                        <div class="col-sm-6 col-md-4 col-xl-3">
                                            <i class="wi wi-cloud-up"></i> wi wi-cloud-up
                                        </div>
                                        <div class="col-sm-6 col-md-4 col-xl-3">
                                            <i class="wi wi-cloud-refresh"></i> wi wi-cloud-refresh
                                        </div>
                                        <div class="col-sm-6 col-md-4 col-xl-3">
                                            <i class="wi wi-horizon"></i> wi wi-horizon
                                        </div>
                                        <div class="col-sm-6 col-md-4 col-xl-3">
                                            <i class="wi wi-horizon-alt"></i> wi wi-horizon-alt
                                        </div>
                                        <div class="col-sm-6 col-md-4 col-xl-3">
                                            <i class="wi wi-sunrise"></i> wi wi-sunrise
                                        </div>
                                        <div class="col-sm-6 col-md-4 col-xl-3">
                                            <i class="wi wi-sunset"></i> wi wi-sunset
                                        </div>
                                        <div class="col-sm-6 col-md-4 col-xl-3">
                                            <i class="wi wi-moonrise"></i> wi wi-moonrise
                                        </div>
                                        <div class="col-sm-6 col-md-4 col-xl-3">
                                            <i class="wi wi-moonset"></i> wi wi-moonset
                                        </div>
                                        <div class="col-sm-6 col-md-4 col-xl-3">
                                            <i class="wi wi-refresh"></i> wi wi-refresh
                                        </div>
                                        <div class="col-sm-6 col-md-4 col-xl-3">
                                            <i class="wi wi-refresh-alt"></i> wi wi-refresh-alt
                                        </div>
                                        <div class="col-sm-6 col-md-4 col-xl-3">
                                            <i class="wi wi-umbrella"></i> wi wi-umbrella
                                        </div>
                                        <div class="col-sm-6 col-md-4 col-xl-3">
                                            <i class="wi wi-barometer"></i> wi wi-barometer
                                        </div>
                                        <div class="col-sm-6 col-md-4 col-xl-3">
                                            <i class="wi wi-humidity"></i> wi wi-humidity
                                        </div>
                                        <div class="col-sm-6 col-md-4 col-xl-3">
                                            <i class="wi wi-na"></i> wi wi-na
                                        </div>
                                        <div class="col-sm-6 col-md-4 col-xl-3">
                                            <i class="wi wi-train"></i> wi wi-train
                                        </div>
                                    </div>
                                    <!-- End row -->

                                    <h4 class="header-title my-3">Moon Phases Icons</h4>
                                    <div class="alert alert-success">
                                        The moons are split into 28 icons, to correspond neatly with the 28 day moon cycle. There is a primary
                                        set and alternate set. The primary set is meant to be interpreted as: where there are pixels, that is the
                                        illuminated part of the moon. The alternate set is meant to be interpreted as: where there are pixels,
                                        that is the shadowed part of the moon.
                                    </div>
                                    <div class="row icons-list-demo">

                                        <div class="col-sm-6 col-md-4 col-xl-3">
                                            <i class="wi wi-moon-new"></i> wi wi-moon-new
                                        </div>
                                        <div class="col-sm-6 col-md-4 col-xl-3">
                                            <i class="wi wi-moon-waxing-cresent-1"></i> wi wi-moon-waxing-cresent-1
                                        </div>
                                        <div class="col-sm-6 col-md-4 col-xl-3">
                                            <i class="wi wi-moon-waxing-cresent-2"></i> wi wi-moon-waxing-cresent-2
                                        </div>
                                        <div class="col-sm-6 col-md-4 col-xl-3">
                                            <i class="wi wi-moon-waxing-cresent-3"></i> wi wi-moon-waxing-cresent-3
                                        </div>
                                        <div class="col-sm-6 col-md-4 col-xl-3">
                                            <i class="wi wi-moon-waxing-cresent-4"></i> wi wi-moon-waxing-cresent-4
                                        </div>
                                        <div class="col-sm-6 col-md-4 col-xl-3">
                                            <i class="wi wi-moon-waxing-cresent-5"></i> wi wi-moon-waxing-cresent-5
                                        </div>
                                        <div class="col-sm-6 col-md-4 col-xl-3">
                                            <i class="wi wi-moon-waxing-cresent-6"></i> wi wi-moon-waxing-cresent-6
                                        </div>
                                        <div class="col-sm-6 col-md-4 col-xl-3">
                                            <i class="wi wi-moon-first-quarter"></i> wi wi-moon-first-quarter
                                        </div>
                                        <div class="col-sm-6 col-md-4 col-xl-3">
                                            <i class="wi wi-moon-waxing-gibbous-1"></i> wi wi-moon-waxing-gibbous-1
                                        </div>
                                        <div class="col-sm-6 col-md-4 col-xl-3">
                                            <i class="wi wi-moon-waxing-gibbous-2"></i> wi wi-moon-waxing-gibbous-2
                                        </div>
                                        <div class="col-sm-6 col-md-4 col-xl-3">
                                            <i class="wi wi-moon-waxing-gibbous-3"></i> wi wi-moon-waxing-gibbous-3
                                        </div>
                                        <div class="col-sm-6 col-md-4 col-xl-3">
                                            <i class="wi wi-moon-waxing-gibbous-4"></i> wi wi-moon-waxing-gibbous-4
                                        </div>
                                        <div class="col-sm-6 col-md-4 col-xl-3">
                                            <i class="wi wi-moon-waxing-gibbous-5"></i> wi wi-moon-waxing-gibbous-5
                                        </div>
                                        <div class="col-sm-6 col-md-4 col-xl-3">
                                            <i class="wi wi-moon-waxing-gibbous-6"></i> wi wi-moon-waxing-gibbous-6
                                        </div>
                                        <div class="col-sm-6 col-md-4 col-xl-3">
                                            <i class="wi wi-moon-full"></i> wi wi-moon-full
                                        </div>
                                        <div class="col-sm-6 col-md-4 col-xl-3">
                                            <i class="wi wi-moon-waning-gibbous-1"></i> wi wi-moon-waning-gibbous-1
                                        </div>
                                        <div class="col-sm-6 col-md-4 col-xl-3">
                                            <i class="wi wi-moon-waning-gibbous-2"></i> wi wi-moon-waning-gibbous-2
                                        </div>
                                        <div class="col-sm-6 col-md-4 col-xl-3">
                                            <i class="wi wi-moon-waning-gibbous-3"></i> wi wi-moon-waning-gibbous-3
                                        </div>
                                        <div class="col-sm-6 col-md-4 col-xl-3">
                                            <i class="wi wi-moon-waning-gibbous-4"></i> wi wi-moon-waning-gibbous-4
                                        </div>
                                        <div class="col-sm-6 col-md-4 col-xl-3">
                                            <i class="wi wi-moon-waning-gibbous-5"></i> wi wi-moon-waning-gibbous-5
                                        </div>
                                        <div class="col-sm-6 col-md-4 col-xl-3">
                                            <i class="wi wi-moon-waning-gibbous-6"></i> wi wi-moon-waning-gibbous-6
                                        </div>
                                        <div class="col-sm-6 col-md-4 col-xl-3">
                                            <i class="wi wi-moon-third-quarter"></i> wi wi-moon-third-quarter
                                        </div>
                                        <div class="col-sm-6 col-md-4 col-xl-3">
                                            <i class="wi wi-moon-waning-crescent-1"></i> wi wi-moon-waning-crescent-1
                                        </div>
                                        <div class="col-sm-6 col-md-4 col-xl-3">
                                            <i class="wi wi-moon-waning-crescent-2"></i> wi wi-moon-waning-crescent-2
                                        </div>
                                        <div class="col-sm-6 col-md-4 col-xl-3">
                                            <i class="wi wi-moon-waning-crescent-3"></i> wi wi-moon-waning-crescent-3
                                        </div>
                                        <div class="col-sm-6 col-md-4 col-xl-3">
                                            <i class="wi wi-moon-waning-crescent-4"></i> wi wi-moon-waning-crescent-4
                                        </div>
                                        <div class="col-sm-6 col-md-4 col-xl-3">
                                            <i class="wi wi-moon-waning-crescent-5"></i> wi wi-moon-waning-crescent-5
                                        </div>
                                        <div class="col-sm-6 col-md-4 col-xl-3">
                                            <i class="wi wi-moon-waning-crescent-6"></i> wi wi-moon-waning-crescent-6
                                        </div>
                                        <div class="col-sm-6 col-md-4 col-xl-3">
                                            <i class="wi wi-moon-alt-new"></i> wi wi-moon-alt-new
                                        </div>
                                        <div class="col-sm-6 col-md-4 col-xl-3">
                                            <i class="wi wi-moon-alt-waxing-cresent-1"></i> wi wi-moon-alt-waxing-cresent-1
                                        </div>
                                        <div class="col-sm-6 col-md-4 col-xl-3">
                                            <i class="wi wi-moon-alt-waxing-cresent-2"></i> wi wi-moon-alt-waxing-cresent-2
                                        </div>
                                        <div class="col-sm-6 col-md-4 col-xl-3">
                                            <i class="wi wi-moon-alt-waxing-cresent-3"></i> wi wi-moon-alt-waxing-cresent-3
                                        </div>
                                        <div class="col-sm-6 col-md-4 col-xl-3">
                                            <i class="wi wi-moon-alt-waxing-cresent-4"></i> wi wi-moon-alt-waxing-cresent-4
                                        </div>
                                        <div class="col-sm-6 col-md-4 col-xl-3">
                                            <i class="wi wi-moon-alt-waxing-cresent-5"></i> wi wi-moon-alt-waxing-cresent-5
                                        </div>
                                        <div class="col-sm-6 col-md-4 col-xl-3">
                                            <i class="wi wi-moon-alt-waxing-cresent-6"></i> wi wi-moon-alt-waxing-cresent-6
                                        </div>
                                        <div class="col-sm-6 col-md-4 col-xl-3">
                                            <i class="wi wi-moon-alt-first-quarter"></i> wi wi-moon-alt-first-quarter
                                        </div>
                                        <div class="col-sm-6 col-md-4 col-xl-3">
                                            <i class="wi wi-moon-alt-waxing-gibbous-1"></i> wi wi-moon-alt-waxing-gibbous-1
                                        </div>
                                        <div class="col-sm-6 col-md-4 col-xl-3">
                                            <i class="wi wi-moon-alt-waxing-gibbous-2"></i> wi wi-moon-alt-waxing-gibbous-2
                                        </div>
                                        <div class="col-sm-6 col-md-4 col-xl-3">
                                            <i class="wi wi-moon-alt-waxing-gibbous-3"></i> wi wi-moon-alt-waxing-gibbous-3
                                        </div>
                                        <div class="col-sm-6 col-md-4 col-xl-3">
                                            <i class="wi wi-moon-alt-waxing-gibbous-4"></i> wi wi-moon-alt-waxing-gibbous-4
                                        </div>
                                        <div class="col-sm-6 col-md-4 col-xl-3">
                                            <i class="wi wi-moon-alt-waxing-gibbous-5"></i> wi wi-moon-alt-waxing-gibbous-5
                                        </div>
                                        <div class="col-sm-6 col-md-4 col-xl-3">
                                            <i class="wi wi-moon-alt-waxing-gibbous-6"></i> wi wi-moon-alt-waxing-gibbous-6
                                        </div>
                                        <div class="col-sm-6 col-md-4 col-xl-3">
                                            <i class="wi wi-moon-alt-full"></i> wi wi-moon-alt-full
                                        </div>
                                        <div class="col-sm-6 col-md-4 col-xl-3">
                                            <i class="wi wi-moon-alt-waning-gibbous-1"></i> wi wi-moon-alt-waning-gibbous-1
                                        </div>
                                        <div class="col-sm-6 col-md-4 col-xl-3">
                                            <i class="wi wi-moon-alt-waning-gibbous-2"></i> wi wi-moon-alt-waning-gibbous-2
                                        </div>
                                        <div class="col-sm-6 col-md-4 col-xl-3">
                                            <i class="wi wi-moon-alt-waning-gibbous-3"></i> wi wi-moon-alt-waning-gibbous-3
                                        </div>
                                        <div class="col-sm-6 col-md-4 col-xl-3">
                                            <i class="wi wi-moon-alt-waning-gibbous-4"></i> wi wi-moon-alt-waning-gibbous-4
                                        </div>
                                        <div class="col-sm-6 col-md-4 col-xl-3">
                                            <i class="wi wi-moon-alt-waning-gibbous-5"></i> wi wi-moon-alt-waning-gibbous-5
                                        </div>
                                        <div class="col-sm-6 col-md-4 col-xl-3">
                                            <i class="wi wi-moon-alt-waning-gibbous-6"></i> wi wi-moon-alt-waning-gibbous-6
                                        </div>
                                        <div class="col-sm-6 col-md-4 col-xl-3">
                                            <i class="wi wi-moon-alt-third-quarter"></i> wi wi-moon-alt-third-quarter
                                        </div>
                                        <div class="col-sm-6 col-md-4 col-xl-3">
                                            <i class="wi wi-moon-alt-waning-crescent-1"></i> wi wi-moon-alt-waning-crescent-1
                                        </div>
                                        <div class="col-sm-6 col-md-4 col-xl-3">
                                            <i class="wi wi-moon-alt-waning-crescent-2"></i> wi wi-moon-alt-waning-crescent-2
                                        </div>
                                        <div class="col-sm-6 col-md-4 col-xl-3">
                                            <i class="wi wi-moon-alt-waning-crescent-3"></i> wi wi-moon-alt-waning-crescent-3
                                        </div>
                                        <div class="col-sm-6 col-md-4 col-xl-3">
                                            <i class="wi wi-moon-alt-waning-crescent-4"></i> wi wi-moon-alt-waning-crescent-4
                                        </div>
                                        <div class="col-sm-6 col-md-4 col-xl-3">
                                            <i class="wi wi-moon-alt-waning-crescent-5"></i> wi wi-moon-alt-waning-crescent-5
                                        </div>
                                        <div class="col-sm-6 col-md-4 col-xl-3">
                                            <i class="wi wi-moon-alt-waning-crescent-6"></i> wi wi-moon-alt-waning-crescent-6
                                        </div>
                                    </div>
                                    <!-- End row -->

                                    <h4 class="header-title my-3">Time Icons</h4>

                                    <div class="row icons-list-demo">

                                        <div class="col-sm-6 col-md-4 col-xl-3">
                                            <i class="wi wi-time-1"></i> wi wi-time-1
                                        </div>
                                        <div class="col-sm-6 col-md-4 col-xl-3">
                                            <i class="wi wi-time-2"></i> wi wi-time-2
                                        </div>
                                        <div class="col-sm-6 col-md-4 col-xl-3">
                                            <i class="wi wi-time-3"></i> wi wi-time-3
                                        </div>
                                        <div class="col-sm-6 col-md-4 col-xl-3">
                                            <i class="wi wi-time-4"></i> wi wi-time-4
                                        </div>
                                        <div class="col-sm-6 col-md-4 col-xl-3">
                                            <i class="wi wi-time-5"></i> wi wi-time-5
                                        </div>
                                        <div class="col-sm-6 col-md-4 col-xl-3">
                                            <i class="wi wi-time-6"></i> wi wi-time-6
                                        </div>
                                        <div class="col-sm-6 col-md-4 col-xl-3">
                                            <i class="wi wi-time-7"></i> wi wi-time-7
                                        </div>
                                        <div class="col-sm-6 col-md-4 col-xl-3">
                                            <i class="wi wi-time-8"></i> wi wi-time-8
                                        </div>
                                        <div class="col-sm-6 col-md-4 col-xl-3">
                                            <i class="wi wi-time-9"></i> wi wi-time-9
                                        </div>
                                        <div class="col-sm-6 col-md-4 col-xl-3">
                                            <i class="wi wi-time-10"></i> wi wi-time-10
                                        </div>
                                        <div class="col-sm-6 col-md-4 col-xl-3">
                                            <i class="wi wi-time-11"></i> wi wi-time-11
                                        </div>
                                        <div class="col-sm-6 col-md-4 col-xl-3">
                                            <i class="wi wi-time-12"></i> wi wi-time-12
                                        </div>

                                    </div>
                                    <!-- End row -->

                                    <h4 class="header-title my-3">Directional Arrows</h4>

                                    <div class="row icons-list-demo">
                                        <div class="col-sm-6 col-md-4 col-xl-3">
                                            <i class="wi wi-direction-up"></i> wi wi-direction-up
                                        </div>
                                        <div class="col-sm-6 col-md-4 col-xl-3">
                                            <i class="wi wi-direction-up-right"></i> wi wi-direction-up-right
                                        </div>
                                        <div class="col-sm-6 col-md-4 col-xl-3">
                                            <i class="wi wi-direction-right"></i> wi wi-direction-right
                                        </div>
                                        <div class="col-sm-6 col-md-4 col-xl-3">
                                            <i class="wi wi-direction-down-right"></i> wi wi-direction-down-right
                                        </div>
                                        <div class="col-sm-6 col-md-4 col-xl-3">
                                            <i class="wi wi-direction-down"></i> wi wi-direction-down
                                        </div>
                                        <div class="col-sm-6 col-md-4 col-xl-3">
                                            <i class="wi wi-direction-down-left"></i> wi wi-direction-down-left
                                        </div>
                                        <div class="col-sm-6 col-md-4 col-xl-3">
                                            <i class="wi wi-direction-left"></i> wi wi-direction-left
                                        </div>
                                        <div class="col-sm-6 col-md-4 col-xl-3">
                                            <i class="wi wi-direction-up-left"></i> wi wi-direction-up-left
                                        </div>
                                    </div>
                                    <!-- End row -->

                                    <h4 class="header-title my-3">Utility Classes</h4>
                                    <div class="alert alert-success">
                                        Use these special, built-in utility classes to flip, rotate, or assign a fixed width to any icon.
                                    </div>
                                    <div class="row">

                                        <div class="col-sm-4">
                                            <h5>Flip</h5>
                                            <p>
                                                <code>
                                                    wi-flip-horizontal</code>
                                            </p>
                                            <p>
                                                <code>
                                                    wi-flip-vertical</code>
                                            </p>
                                        </div>

                                        <div class="col-sm-4">
                                            <h5>Rotate</h5>
                                            <p>
                                                <code>
                                                    wi-rotate-90</code>
                                            </p>
                                            <p>
                                                <code>
                                                    wi-rotate-180</code>
                                            </p>
                                            <p>
                                                <code>
                                                    wi-rotate-270</code>
                                            </p>
                                        </div>

                                        <div class="col-sm-4">
                                            <h5>Fixed Width</h5>
                                            <p>
                                                <code>
                                                    wi-fw</code>
                                            </p>
                                        </div>

                                    </div>
                                    <!-- End row -->
                                </div> <!-- end card-box-->
                            </div> <!-- end col-->
                        </div>
                        <!-- end row-->
                        
                    </div> <!-- container -->

                </div> <!-- content -->

                <!-- Footer Start -->
                <footer class="footer">
                    <div class="container-fluid">
                        <div class="row">
                            <div class="col-md-6">
                                2015 - <script>document.write(new Date().getFullYear())</script> &copy; UBold theme by <a href="">Coderthemes</a> 
                            </div>
                            <div class="col-md-6">
                                <div class="text-md-right footer-links d-none d-sm-block">
                                    <a href="javascript:void(0);">About Us</a>
                                    <a href="javascript:void(0);">Help</a>
                                    <a href="javascript:void(0);">Contact Us</a>
                                </div>
                            </div>
                        </div>
                    </div>
                </footer>
                <!-- end Footer -->

            </div>

            <!-- ============================================================== -->
            <!-- End Page content -->
            <!-- ============================================================== -->


        </div>
        <!-- END wrapper -->

        <!-- Right Sidebar -->
        <div class="right-bar">
            <div data-simplebar class="h-100">
    
                <!-- Nav tabs -->
                <ul class="nav nav-tabs nav-bordered nav-justified" role="tablist">
                    <li class="nav-item">
                        <a class="nav-link py-2" data-toggle="tab" href="#chat-tab" role="tab">
                            <i class="mdi mdi-message-text d-block font-22 my-1"></i>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link py-2" data-toggle="tab" href="#tasks-tab" role="tab">
                            <i class="mdi mdi-format-list-checkbox d-block font-22 my-1"></i>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link py-2 active" data-toggle="tab" href="#settings-tab" role="tab">
                            <i class="mdi mdi-cog-outline d-block font-22 my-1"></i>
                        </a>
                    </li>
                </ul>

                <!-- Tab panes -->
                <div class="tab-content pt-0">
                    <div class="tab-pane" id="chat-tab" role="tabpanel">
                
                        <form class="search-bar p-3">
                            <div class="position-relative">
                                <input type="text" class="form-control" placeholder="Search...">
                                <span class="mdi mdi-magnify"></span>
                            </div>
                        </form>

                        <h6 class="font-weight-medium px-3 mt-2 text-uppercase">Group Chats</h6>

                        <div class="p-2">
                            <a href="javascript: void(0);" class="text-reset notification-item pl-3 mb-2 d-block">
                                <i class="mdi mdi-checkbox-blank-circle-outline mr-1 text-success"></i>
                                <span class="mb-0 mt-1">App Development</span>
                            </a>

                            <a href="javascript: void(0);" class="text-reset notification-item pl-3 mb-2 d-block">
                                <i class="mdi mdi-checkbox-blank-circle-outline mr-1 text-warning"></i>
                                <span class="mb-0 mt-1">Office Work</span>
                            </a>

                            <a href="javascript: void(0);" class="text-reset notification-item pl-3 mb-2 d-block">
                                <i class="mdi mdi-checkbox-blank-circle-outline mr-1 text-danger"></i>
                                <span class="mb-0 mt-1">Personal Group</span>
                            </a>

                            <a href="javascript: void(0);" class="text-reset notification-item pl-3 d-block">
                                <i class="mdi mdi-checkbox-blank-circle-outline mr-1"></i>
                                <span class="mb-0 mt-1">Freelance</span>
                            </a>
                        </div>

                        <h6 class="font-weight-medium px-3 mt-3 text-uppercase">Favourites <a href="javascript: void(0);" class="font-18 text-danger"><i class="float-right mdi mdi-plus-circle"></i></a></h6>

                        <div class="p-2">
                            <a href="javascript: void(0);" class="text-reset notification-item">
                                <div class="media">
                                    <div class="position-relative mr-2">
                                        <img src="../assets/images/users/user-10.jpg" class="rounded-circle avatar-sm" alt="user-pic">
                                        <i class="mdi mdi-circle user-status online"></i>
                                    </div>
                                    <div class="media-body overflow-hidden">
                                        <h6 class="mt-0 mb-1 font-14">Andrew Mackie</h6>
                                        <div class="font-13 text-muted">
                                            <p class="mb-0 text-truncate">It will seem like simplified English.</p>
                                        </div>
                                    </div>
                                </div>
                            </a>

                            <a href="javascript: void(0);" class="text-reset notification-item">
                                <div class="media">
                                    <div class="position-relative mr-2">
                                        <img src="../assets/images/users/user-1.jpg" class="rounded-circle avatar-sm" alt="user-pic">
                                        <i class="mdi mdi-circle user-status away"></i>
                                    </div>
                                    <div class="media-body overflow-hidden">
                                        <h6 class="mt-0 mb-1 font-14">Rory Dalyell</h6>
                                        <div class="font-13 text-muted">
                                            <p class="mb-0 text-truncate">To an English person, it will seem like simplified</p>
                                        </div>
                                    </div>
                                </div>
                            </a>

                            <a href="javascript: void(0);" class="text-reset notification-item">
                                <div class="media">
                                    <div class="position-relative mr-2">
                                        <img src="../assets/images/users/user-9.jpg" class="rounded-circle avatar-sm" alt="user-pic">
                                        <i class="mdi mdi-circle user-status busy"></i>
                                    </div>
                                    <div class="media-body overflow-hidden">
                                        <h6 class="mt-0 mb-1 font-14">Jaxon Dunhill</h6>
                                        <div class="font-13 text-muted">
                                            <p class="mb-0 text-truncate">To achieve this, it would be necessary.</p>
                                        </div>
                                    </div>
                                </div>
                            </a>
                        </div>

                        <h6 class="font-weight-medium px-3 mt-3 text-uppercase">Other Chats <a href="javascript: void(0);" class="font-18 text-danger"><i class="float-right mdi mdi-plus-circle"></i></a></h6>

                        <div class="p-2 pb-4">
                            <a href="javascript: void(0);" class="text-reset notification-item">
                                <div class="media">
                                    <div class="position-relative mr-2">
                                        <img src="../assets/images/users/user-2.jpg" class="rounded-circle avatar-sm" alt="user-pic">
                                        <i class="mdi mdi-circle user-status online"></i>
                                    </div>
                                    <div class="media-body overflow-hidden">
                                        <h6 class="mt-0 mb-1 font-14">Jackson Therry</h6>
                                        <div class="font-13 text-muted">
                                            <p class="mb-0 text-truncate">Everyone realizes why a new common language.</p>
                                        </div>
                                    </div>
                                </div>
                            </a>

                            <a href="javascript: void(0);" class="text-reset notification-item">
                                <div class="media">
                                    <div class="position-relative mr-2">
                                        <img src="../assets/images/users/user-4.jpg" class="rounded-circle avatar-sm" alt="user-pic">
                                        <i class="mdi mdi-circle user-status away"></i>
                                    </div>
                                    <div class="media-body overflow-hidden">
                                        <h6 class="mt-0 mb-1 font-14">Charles Deakin</h6>
                                        <div class="font-13 text-muted">
                                            <p class="mb-0 text-truncate">The languages only differ in their grammar.</p>
                                        </div>
                                    </div>
                                </div>
                            </a>

                            <a href="javascript: void(0);" class="text-reset notification-item">
                                <div class="media">
                                    <div class="position-relative mr-2">
                                        <img src="../assets/images/users/user-5.jpg" class="rounded-circle avatar-sm" alt="user-pic">
                                        <i class="mdi mdi-circle user-status online"></i>
                                    </div>
                                    <div class="media-body overflow-hidden">
                                        <h6 class="mt-0 mb-1 font-14">Ryan Salting</h6>
                                        <div class="font-13 text-muted">
                                            <p class="mb-0 text-truncate">If several languages coalesce the grammar of the resulting.</p>
                                        </div>
                                    </div>
                                </div>
                            </a>

                            <a href="javascript: void(0);" class="text-reset notification-item">
                                <div class="media">
                                    <div class="position-relative mr-2">
                                        <img src="../assets/images/users/user-6.jpg" class="rounded-circle avatar-sm" alt="user-pic">
                                        <i class="mdi mdi-circle user-status online"></i>
                                    </div>
                                    <div class="media-body overflow-hidden">
                                        <h6 class="mt-0 mb-1 font-14">Sean Howse</h6>
                                        <div class="font-13 text-muted">
                                            <p class="mb-0 text-truncate">It will seem like simplified English.</p>
                                        </div>
                                    </div>
                                </div>
                            </a>

                            <a href="javascript: void(0);" class="text-reset notification-item">
                                <div class="media">
                                    <div class="position-relative mr-2">
                                        <img src="../assets/images/users/user-7.jpg" class="rounded-circle avatar-sm" alt="user-pic">
                                        <i class="mdi mdi-circle user-status busy"></i>
                                    </div>
                                    <div class="media-body overflow-hidden">
                                        <h6 class="mt-0 mb-1 font-14">Dean Coward</h6>
                                        <div class="font-13 text-muted">
                                            <p class="mb-0 text-truncate">The new common language will be more simple.</p>
                                        </div>
                                    </div>
                                </div>
                            </a>

                            <a href="javascript: void(0);" class="text-reset notification-item">
                                <div class="media">
                                    <div class="position-relative mr-2">
                                        <img src="../assets/images/users/user-8.jpg" class="rounded-circle avatar-sm" alt="user-pic">
                                        <i class="mdi mdi-circle user-status away"></i>
                                    </div>
                                    <div class="media-body overflow-hidden">
                                        <h6 class="mt-0 mb-1 font-14">Hayley East</h6>
                                        <div class="font-13 text-muted">
                                            <p class="mb-0 text-truncate">One could refuse to pay expensive translators.</p>
                                        </div>
                                    </div>
                                </div>
                            </a>

                            <div class="text-center mt-3">
                                <a href="javascript:void(0);" class="btn btn-sm btn-white">
                                    <i class="mdi mdi-spin mdi-loading mr-2"></i>
                                    Load more
                                </a>
                            </div>
                        </div>

                    </div>

                    <div class="tab-pane" id="tasks-tab" role="tabpanel">
                        <h6 class="font-weight-medium p-3 m-0 text-uppercase">Working Tasks</h6>
                        <div class="px-2">
                            <a href="javascript: void(0);" class="text-reset item-hovered d-block p-2">
                                <p class="text-muted mb-0">App Development<span class="float-right">75%</span></p>
                                <div class="progress mt-2" style="height: 4px;">
                                    <div class="progress-bar bg-success" role="progressbar" style="width: 75%" aria-valuenow="75" aria-valuemin="0" aria-valuemax="100"></div>
                                </div>
                            </a>

                            <a href="javascript: void(0);" class="text-reset item-hovered d-block p-2">
                                <p class="text-muted mb-0">Database Repair<span class="float-right">37%</span></p>
                                <div class="progress mt-2" style="height: 4px;">
                                    <div class="progress-bar bg-info" role="progressbar" style="width: 37%" aria-valuenow="37" aria-valuemin="0" aria-valuemax="100"></div>
                                </div>
                            </a>

                            <a href="javascript: void(0);" class="text-reset item-hovered d-block p-2">
                                <p class="text-muted mb-0">Backup Create<span class="float-right">52%</span></p>
                                <div class="progress mt-2" style="height: 4px;">
                                    <div class="progress-bar bg-warning" role="progressbar" style="width: 52%" aria-valuenow="52" aria-valuemin="0" aria-valuemax="100"></div>
                                </div>
                            </a>
                        </div>

                        <h6 class="font-weight-medium px-3 mb-0 mt-4 text-uppercase">Upcoming Tasks</h6>

                        <div class="p-2">
                            <a href="javascript: void(0);" class="text-reset item-hovered d-block p-2">
                                <p class="text-muted mb-0">Sales Reporting<span class="float-right">12%</span></p>
                                <div class="progress mt-2" style="height: 4px;">
                                    <div class="progress-bar bg-danger" role="progressbar" style="width: 12%" aria-valuenow="12" aria-valuemin="0" aria-valuemax="100"></div>
                                </div>
                            </a>

                            <a href="javascript: void(0);" class="text-reset item-hovered d-block p-2">
                                <p class="text-muted mb-0">Redesign Website<span class="float-right">67%</span></p>
                                <div class="progress mt-2" style="height: 4px;">
                                    <div class="progress-bar bg-primary" role="progressbar" style="width: 67%" aria-valuenow="67" aria-valuemin="0" aria-valuemax="100"></div>
                                </div>
                            </a>

                            <a href="javascript: void(0);" class="text-reset item-hovered d-block p-2">
                                <p class="text-muted mb-0">New Admin Design<span class="float-right">84%</span></p>
                                <div class="progress mt-2" style="height: 4px;">
                                    <div class="progress-bar bg-success" role="progressbar" style="width: 84%" aria-valuenow="84" aria-valuemin="0" aria-valuemax="100"></div>
                                </div>
                            </a>
                        </div>

                        <div class="p-3 mt-2">
                            <a href="javascript: void(0);" class="btn btn-success btn-block waves-effect waves-light">Create Task</a>
                        </div>

                    </div>
                    <div class="tab-pane active" id="settings-tab" role="tabpanel">
                        <h6 class="font-weight-medium px-3 m-0 py-2 font-13 text-uppercase bg-light">
                            <span class="d-block py-1">Theme Settings</span>
                        </h6>

                        <div class="p-3">
                            <div class="alert alert-warning" role="alert">
                                <strong>Customize </strong> the overall color scheme, sidebar menu, etc.
                            </div>

                            <h6 class="font-weight-medium font-14 mt-4 mb-2 pb-1">Color Scheme</h6>
                            <div class="custom-control custom-switch mb-1">
                                <input type="radio" class="custom-control-input" name="color-scheme-mode" value="light"
                                    id="light-mode-check" checked />
                                <label class="custom-control-label" for="light-mode-check">Light Mode</label>
                            </div>

                            <div class="custom-control custom-switch mb-1">
                                <input type="radio" class="custom-control-input" name="color-scheme-mode" value="dark"
                                    id="dark-mode-check" />
                                <label class="custom-control-label" for="dark-mode-check">Dark Mode</label>
                            </div>

                            <!-- Width -->
                            <h6 class="font-weight-medium font-14 mt-4 mb-2 pb-1">Width</h6>
                            <div class="custom-control custom-switch mb-1">
                                <input type="radio" class="custom-control-input" name="width" value="fluid" id="fluid-check" checked />
                                <label class="custom-control-label" for="fluid-check">Fluid</label>
                            </div>
                            <div class="custom-control custom-switch mb-1">
                                <input type="radio" class="custom-control-input" name="width" value="boxed" id="boxed-check" />
                                <label class="custom-control-label" for="boxed-check">Boxed</label>
                            </div>

                            <!-- Menu positions -->
                            <h6 class="font-weight-medium font-14 mt-4 mb-2 pb-1">Menus (Leftsidebar and Topbar) Positon</h6>

                            <div class="custom-control custom-switch mb-1">
                                <input type="radio" class="custom-control-input" name="menus-position" value="fixed" id="fixed-check"
                                    checked />
                                <label class="custom-control-label" for="fixed-check">Fixed</label>
                            </div>

                            <div class="custom-control custom-switch mb-1">
                                <input type="radio" class="custom-control-input" name="menus-position" value="scrollable"
                                    id="scrollable-check" />
                                <label class="custom-control-label" for="scrollable-check">Scrollable</label>
                            </div>

                            <!-- Left Sidebar-->
                            <h6 class="font-weight-medium font-14 mt-4 mb-2 pb-1">Left Sidebar Color</h6>

                            <div class="custom-control custom-switch mb-1">
                                <input type="radio" class="custom-control-input" name="leftsidebar-color" value="light" id="light-check" checked />
                                <label class="custom-control-label" for="light-check">Light</label>
                            </div>

                            <div class="custom-control custom-switch mb-1">
                                <input type="radio" class="custom-control-input" name="leftsidebar-color" value="dark" id="dark-check" />
                                <label class="custom-control-label" for="dark-check">Dark</label>
                            </div>

                            <div class="custom-control custom-switch mb-1">
                                <input type="radio" class="custom-control-input" name="leftsidebar-color" value="brand" id="brand-check" />
                                <label class="custom-control-label" for="brand-check">Brand</label>
                            </div>

                            <div class="custom-control custom-switch mb-3">
                                <input type="radio" class="custom-control-input" name="leftsidebar-color" value="gradient" id="gradient-check" />
                                <label class="custom-control-label" for="gradient-check">Gradient</label>
                            </div>

                            <!-- size -->
                            <h6 class="font-weight-medium font-14 mt-4 mb-2 pb-1">Left Sidebar Size</h6>

                            <div class="custom-control custom-switch mb-1">
                                <input type="radio" class="custom-control-input" name="leftsidebar-size" value="default"
                                    id="default-size-check" checked />
                                <label class="custom-control-label" for="default-size-check">Default</label>
                            </div>

                            <div class="custom-control custom-switch mb-1">
                                <input type="radio" class="custom-control-input" name="leftsidebar-size" value="condensed"
                                    id="condensed-check" />
                                <label class="custom-control-label" for="condensed-check">Condensed <small>(Extra Small size)</small></label>
                            </div>

                            <div class="custom-control custom-switch mb-1">
                                <input type="radio" class="custom-control-input" name="leftsidebar-size" value="compact"
                                    id="compact-check" />
                                <label class="custom-control-label" for="compact-check">Compact <small>(Small size)</small></label>
                            </div>

                            <!-- User info -->
                            <h6 class="font-weight-medium font-14 mt-4 mb-2 pb-1">Sidebar User Info</h6>

                            <div class="custom-control custom-switch mb-1">
                                <input type="checkbox" class="custom-control-input" name="leftsidebar-user" value="fixed" id="sidebaruser-check" />
                                <label class="custom-control-label" for="sidebaruser-check">Enable</label>
                            </div>


                            <!-- Topbar -->
                            <h6 class="font-weight-medium font-14 mt-4 mb-2 pb-1">Topbar</h6>

                            <div class="custom-control custom-switch mb-1">
                                <input type="radio" class="custom-control-input" name="topbar-color" value="dark" id="darktopbar-check"
                                    checked />
                                <label class="custom-control-label" for="darktopbar-check">Dark</label>
                            </div>

                            <div class="custom-control custom-switch mb-1">
                                <input type="radio" class="custom-control-input" name="topbar-color" value="light" id="lighttopbar-check" />
                                <label class="custom-control-label" for="lighttopbar-check">Light</label>
                            </div>


                            <button class="btn btn-primary btn-block mt-4" id="resetBtn">Reset to Default</button>

                            <a href="https://1.envato.market/uboldadmin"
                                class="btn btn-danger btn-block mt-3" target="_blank"><i class="mdi mdi-basket mr-1"></i> Purchase Now</a>

                        </div>

                    </div>
                </div>

            </div> <!-- end slimscroll-menu-->
        </div>
        <!-- /Right-bar -->

        <!-- Right bar overlay-->
        <div class="rightbar-overlay"></div>

        <!-- App js -->
        <script src="../assets/js/vendor.min.js"></script>
        <script src="../assets/js/app.min.js"></script>
        
    </body>
</html>