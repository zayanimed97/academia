<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8" />
        <title>Form Components | UBold - Responsive Admin Dashboard Template</title>
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
                                            <li class="breadcrumb-item"><a href="javascript: void(0);">Forms</a></li>
                                            <li class="breadcrumb-item active">Elements</li>
                                        </ol>
                                    </div>
                                    <h4 class="page-title">Basic Elements</h4>
                                </div>
                            </div>
                        </div>     
                        <!-- end page title --> 

                        <div class="row">
                            <div class="col-12">
                                <div class="card">
                                    <div class="card-body">
                                        <h4 class="header-title">Input Types</h4>
                                        <p class="sub-header">
                                            Most common form control, text-based input fields. Includes support for all HTML5 types: <code>text</code>, <code>password</code>, <code>datetime</code>, <code>datetime-local</code>, <code>date</code>, <code>month</code>, <code>time</code>, <code>week</code>, <code>number</code>, <code>email</code>, <code>url</code>, <code>search</code>, <code>tel</code>, and <code>color</code>.
                                        </p>

                                        <div class="row">
                                            <div class="col-lg-6">
                                                <form>

                                                    <div class="form-group mb-3">
                                                        <label for="simpleinput">Text</label>
                                                        <input type="text" id="simpleinput" class="form-control">
                                                    </div>

                                                    <div class="form-group mb-3">
                                                        <label for="example-email">Email</label>
                                                        <input type="email" id="example-email" name="example-email" class="form-control" placeholder="Email">
                                                    </div>

                                                    <div class="form-group mb-3">
                                                        <label for="example-password">Password</label>
                                                        <input type="password" id="example-password" class="form-control" value="password">
                                                    </div>

                                                    <div class="form-group mb-3">
                                                        <label for="password">Show/Hide Password</label>
                                                        <div class="input-group input-group-merge">
                                                            <input type="password" id="password" class="form-control" placeholder="Enter your password">
                                                            <div class="input-group-append" data-password="false">
                                                                <div class="input-group-text">
                                                                    <span class="password-eye"></span>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
        
                                                    <div class="form-group mb-3">
                                                        <label for="example-palaceholder">Placeholder</label>
                                                        <input type="text" id="example-palaceholder" class="form-control" placeholder="placeholder">
                                                    </div>

                                                    <div class="form-group mb-3">
                                                        <label for="example-textarea">Text area</label>
                                                        <textarea class="form-control" id="example-textarea" rows="5"></textarea>
                                                    </div>
        
                                                    <div class="form-group mb-3">
                                                        <label for="example-readonly">Readonly</label>
                                                        <input type="text" id="example-readonly" class="form-control" readonly="" value="Readonly value">
                                                    </div>

                                                    <div class="form-group mb-3">
                                                        <label for="example-disable">Disabled</label>
                                                        <input type="text" class="form-control" id="example-disable" disabled="" value="Disabled value">
                                                    </div>
    
                                                    <div class="form-group mb-3">
                                                        <label for="example-static">Static control</label>
                                                        <input type="text" readonly class="form-control-plaintext" id="example-static" value="email@example.com">
                                                    </div>

                                                    <div class="form-group mb-0">
                                                        <label for="example-helping">Helping text</label>
                                                        <input type="text" id="example-helping" class="form-control" placeholder="Helping text">
                                                        <span class="help-block"><small>A block of help text that breaks onto a new line and may extend beyond one line.</small></span>
                                                    </div>
        
                                                </form>
                                            </div> <!-- end col -->

                                            <div class="col-lg-6">
                                                <form>
        
                                                    <div class="form-group mb-3">
                                                        <label for="example-select">Input Select</label>
                                                        <select class="form-control" id="example-select">
                                                            <option>1</option>
                                                            <option>2</option>
                                                            <option>3</option>
                                                            <option>4</option>
                                                            <option>5</option>
                                                        </select>
                                                    </div>

                                                    <div class="form-group mb-3">
                                                        <label for="example-multiselect">Multiple Select</label>
                                                        <select id="example-multiselect" multiple class="form-control">
                                                            <option>1</option>
                                                            <option>2</option>
                                                            <option>3</option>
                                                            <option>4</option>
                                                            <option>5</option>
                                                        </select>
                                                    </div>
        
                                                    <div class="form-group mb-3">
                                                        <label for="example-fileinput">Default file input</label>
                                                        <input type="file" id="example-fileinput" class="form-control-file">
                                                    </div>
        
                                                    <div class="form-group mb-3">
                                                        <label for="example-date">Date</label>
                                                        <input class="form-control" id="example-date" type="date" name="date">
                                                    </div>
        
                                                    <div class="form-group mb-3">
                                                        <label for="example-month">Month</label>
                                                        <input class="form-control" id="example-month" type="month" name="month">
                                                    </div>
        
                                                    <div class="form-group mb-3">
                                                        <label for="example-time">Time</label>
                                                        <input class="form-control" id="example-time" type="time" name="time">
                                                    </div>
        
                                                    <div class="form-group mb-3">
                                                        <label for="example-week">Week</label>
                                                        <input class="form-control" id="example-week" type="week" name="week">
                                                    </div>
        
                                                    <div class="form-group mb-3">
                                                        <label for="example-number">Number</label>
                                                        <input class="form-control" id="example-number" type="number" name="number">
                                                    </div>
        
                                                    <div class="form-group mb-3">
                                                        <label for="example-color">Color</label>
                                                        <input class="form-control" id="example-color" type="color" name="color" value="#727cf5">
                                                    </div>
        
                                                    <div class="form-group mb-0">
                                                        <label for="example-range">Range</label>
                                                        <input class="custom-range" id="example-range" type="range" name="range" min="0" max="100">
                                                    </div>
        
                                                </form>
                                            </div> <!-- end col -->
                                        </div>
                                        <!-- end row-->

                                    </div> <!-- end card-body -->
                                </div> <!-- end card -->
                            </div><!-- end col -->
                        </div>
                        <!-- end row -->

                        <div class="row">
                            <div class="col-12">
                                <div class="card">
                                    <div class="card-body">
                                        <div class="row">
                                            <div class="col-md-6">
                                                <h4 class="header-title">Select menu</h4>
                                                <p class="sub-header">
                                                    Custom <code>&lt;select&gt;</code> menus need only a custom class, <code>.custom-select</code> to trigger the custom styles.
                                                </p>
    
                                                <select class="custom-select ">
                                                    <option selected>Open this select menu</option>
                                                    <option value="1">One</option>
                                                    <option value="2">Two</option>
                                                    <option value="3">Three</option>
                                                </select>

                                                <h4 class="header-title mt-4">Switches</h4>
                                                <p class="sub-header">
                                                    A switch has the markup of a custom checkbox but uses the <code>.custom-switch</code> class to render a toggle switch. Switches also support the <code>disabled</code> attribute.
                                                </p>

                                                <div class="custom-control custom-switch">
                                                    <input type="checkbox" class="custom-control-input" id="customSwitch1">
                                                    <label class="custom-control-label" for="customSwitch1">Toggle this switch element</label>
                                                </div>
                                                <div class="custom-control custom-switch mt-1">
                                                    <input type="checkbox" class="custom-control-input" disabled id="customSwitch2">
                                                    <label class="custom-control-label" for="customSwitch2">Disabled switch element</label>
                                                </div>

                                            </div> <!-- end col -->
    
                                            <div class="col-md-6">
                                                <h4 class="header-title mt-5 mt-sm-0">Checkboxes and radios</h4>
                                                <div class="mt-3">
                                                    <div class="custom-control custom-checkbox">
                                                        <input type="checkbox" class="custom-control-input" id="customCheck1">
                                                        <label class="custom-control-label" for="customCheck1">Check this custom checkbox</label>
                                                    </div>
                                                    <div class="custom-control custom-checkbox">
                                                        <input type="checkbox" class="custom-control-input" id="customCheck2">
                                                        <label class="custom-control-label" for="customCheck2">Check this custom checkbox</label>
                                                    </div>
                                                </div>
                                                <div class="mt-3">
                                                    <div class="custom-control custom-radio">
                                                        <input type="radio" id="customRadio1" name="customRadio" class="custom-control-input">
                                                        <label class="custom-control-label" for="customRadio1">Toggle this custom radio</label>
                                                    </div>
                                                    <div class="custom-control custom-radio">
                                                        <input type="radio" id="customRadio2" name="customRadio" class="custom-control-input">
                                                        <label class="custom-control-label" for="customRadio2">Or toggle this other custom radio</label>
                                                    </div>
                                                </div>
                                            </div> <!-- end col -->
                                        </div> <!-- end row -->

                                    </div> <!-- end card-body-->
                                </div> <!-- end card -->
                            </div> <!-- end col -->
                        </div>
                        <!-- end row -->


                        <div class="row">
                            <div class="col-lg-6">
                                <div class="card">
                                    <div class="card-body">

                                        <h4 class="header-title">Input Sizes</h4>
                                        <p class="sub-header">
                                            Set heights using classes like <code>.input-lg</code>, and set widths using grid column classes like <code>.col-lg-*</code>.
                                        </p>

                                        <form>
                                            <div class="form-group mb-3">
                                                <label for="example-input-small">Small</label>
                                                <input type="text" id="example-input-small" name="example-input-small" class="form-control form-control-sm" placeholder=".input-sm">
                                            </div>

                                            <div class="form-group mb-3">
                                                <label for="example-input-normal">Normal</label>
                                                <input type="text" id="example-input-normal" name="example-input-normal" class="form-control" placeholder="Normal">
                                            </div>

                                            <div class="form-group mb-3">
                                                <label for="example-input-large">Large</label>
                                                <input type="text" id="example-input-large" name="example-input-large" class="form-control form-control-lg" placeholder=".input-lg">
                                            </div>

                                            <div class="form-group mb-2">
                                                <label for="example-gridsize">Grid Sizes</label>
                                                <div class="row">
                                                    <div class="col-sm-4">
                                                        <input type="text" id="example-gridsize" class="form-control" placeholder=".col-sm-4">
                                                    </div>
                                                </div>
                                            </div>
                                        </form>

                                    </div> <!-- end card-body -->
                                </div> <!-- end card -->
                            </div> <!-- end col -->

                            <div class="col-lg-6">
                                <div class="card">
                                    <div class="card-body">

                                        <h4 class="header-title">Input Group</h4>
                                        <p class="sub-header">
                                            Easily extend form controls by adding text, buttons, or button groups on either side of textual inputs, custom selects, and custom file inputs
                                        </p>

                                        <form>
                                            
                                            <div class="form-group mb-3">
                                                <label>Static</label>
                                                <div class="input-group">
                                                    <div class="input-group-prepend">
                                                        <span class="input-group-text" id="basic-addon1">@</span>
                                                    </div>
                                                    <input type="text" class="form-control" placeholder="Username" aria-label="Username" aria-describedby="basic-addon1">
                                                </div>
                                            </div>

                                            <div class="form-group mb-3">
                                                <label>Dropdowns</label>
                                                <div class="input-group">
                                                    <div class="input-group-prepend">
                                                        <button class="btn btn-primary waves-effect waves-light dropdown-toggle" type="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">Dropdown</button>
                                                        <div class="dropdown-menu">
                                                            <a class="dropdown-item" href="#">Action</a>
                                                            <a class="dropdown-item" href="#">Another action</a>
                                                            <a class="dropdown-item" href="#">Something else here</a>
                                                        </div>
                                                    </div>
                                                    <input type="text" class="form-control" placeholder="" aria-label="" aria-describedby="basic-addon1">
                                                </div>
                                            </div>

                                            <div class="form-group mb-3">
                                                <label>Buttons</label>
                                                <div class="input-group">
                                                    <input type="text" class="form-control" placeholder="Recipient's username" aria-label="Recipient's username">
                                                    <div class="input-group-append">
                                                        <button class="btn btn-dark waves-effect waves-light" type="button">Button</button>
                                                    </div>
                                                </div>
                                            </div>

                                            <div class="form-group mb-0">
                                                <label>Custom file input</label>
                                                <div class="input-group">
                                                    <div class="custom-file">
                                                        <input type="file" class="custom-file-input" id="inputGroupFile04">
                                                        <label class="custom-file-label" for="inputGroupFile04">Choose file</label>
                                                    </div>
                                                </div>
                                            </div>
                                        </form>

                                    </div> <!-- end card-body -->
                                </div> <!-- end card -->
                            </div> <!-- end col -->
                        </div>
                        <!-- end row -->


                        <div class="row">
                            <div class="col-lg-6">
                                <div class="card">
                                    <div class="card-body">
                                        <h4 class="mb-3 header-title">Basic Example</h4>

                                        <form>
                                            <div class="form-group">
                                                <label for="exampleInputEmail1">Email address</label>
                                                <input type="email" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp" placeholder="Enter email">
                                                <small id="emailHelp" class="form-text text-muted">We'll never share your email with anyone else.</small>
                                            </div>
                                            <div class="form-group">
                                                <label for="exampleInputPassword1">Password</label>
                                                <input type="password" class="form-control" id="exampleInputPassword1" placeholder="Password">
                                            </div>
                                            <div class="form-group mb-3">
                                                <div class="custom-control custom-checkbox">
                                                    <input type="checkbox" class="custom-control-input" id="checkmeout0">
                                                    <label class="custom-control-label" for="checkmeout0">Check me out !</label>
                                                </div>
                                            </div>
                                            <button type="submit" class="btn btn-primary waves-effect waves-light">Submit</button>
                                        </form>

                                    </div> <!-- end card-body-->
                                </div> <!-- end card-->
                            </div>
                            <!-- end col -->

                            <div class="col-lg-6">
                                <div class="card">
                                    <div class="card-body">

                                        <h4 class="mb-3 header-title">Horizontal form</h4>

                                        <form class="form-horizontal">
                                            <div class="form-group row mb-3">
                                                <label for="inputEmail3" class="col-3 col-form-label">Email</label>
                                                <div class="col-9">
                                                    <input type="email" class="form-control" id="inputEmail3" placeholder="Email">
                                                </div>
                                            </div>
                                            <div class="form-group row mb-3">
                                                <label for="inputPassword3" class="col-3 col-form-label">Password</label>
                                                <div class="col-9">
                                                    <input type="password" class="form-control" id="inputPassword3" placeholder="Password">
                                                </div>
                                            </div>
                                            <div class="form-group row mb-3">
                                                <label for="inputPassword5" class="col-3 col-form-label">Re Password</label>
                                                <div class="col-9">
                                                    <input type="password" class="form-control" id="inputPassword5" placeholder="Retype Password">
                                                </div>
                                            </div>
                                            <div class="form-group row mb-3 justify-content-end">
                                                <div class="col-9">
                                                    <div class="custom-control custom-checkbox">
                                                        <input type="checkbox" class="custom-control-input" id="checkmeout">
                                                        <label class="custom-control-label" for="checkmeout">Check me out !</label>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="form-group mb-0 justify-content-end row">
                                                <div class="col-9">
                                                    <button type="submit" class="btn btn-info waves-effect waves-light">Sign in</button>
                                                </div>
                                            </div>
                                        </form>

                                    </div>  <!-- end card-body -->
                                </div>  <!-- end card -->
                            </div>  <!-- end col -->

                        </div>
                        <!-- end row -->


                        <!-- Inline Form -->
                        <div class="row">
                            <div class="col-md-12">
                                <div class="card">
                                    <div class="card-body">

                                        <h4 class="header-title">Inline Form</h4>

                                        <p class="sub-header">
                                            Use the <code>.form-inline</code> class to display a series of labels, form controls, and buttons on a single horizontal row. Form controls within inline forms vary slightly from their default states. Controls only appear inline in viewports that are at least 576px wide to account for narrow viewports on mobile devices.
                                        </p>

                                        <form class="form-inline">
                                            <div class="form-group">
                                                <label for="staticEmail2" class="sr-only">Email</label>
                                                <input type="text" readonly class="form-control-plaintext" id="staticEmail2" value="email@example.com">
                                            </div>
                                            <div class="form-group mx-sm-3">
                                                <label for="inputPassword2" class="sr-only">Password</label>
                                                <input type="password" class="form-control" id="inputPassword2" placeholder="Password">
                                            </div>
                                            <button type="submit" class="btn btn-primary waves-effect waves-light">Confirm identity</button>
                                        </form>
    
                                        <h6 class="font-13 mt-3">Auto-sizing</h6>
    
                                        <form>
                                            <div class="form-row align-items-center">
                                                <div class="col-auto">
                                                    <label class="sr-only" for="inlineFormInput">Name</label>
                                                    <input type="text" class="form-control mb-2" id="inlineFormInput" placeholder="Jane Doe">
                                                </div>
                                                <div class="col-auto">
                                                    <label class="sr-only" for="inlineFormInputGroup">Username</label>
                                                    <div class="input-group mb-2">
                                                        <div class="input-group-prepend">
                                                            <div class="input-group-text">@</div>
                                                        </div>
                                                        <input type="text" class="form-control" id="inlineFormInputGroup" placeholder="Username">
                                                    </div>
                                                </div>
                                                <div class="col-auto">
                                                    <div class="custom-control custom-checkbox mb-2">
                                                        <input type="checkbox" class="custom-control-input" id="autoSizingCheck">
                                                        <label class="custom-control-label" for="autoSizingCheck">Remember me</label>
                                                    </div>
                                                </div>
                                                <div class="col-auto">
                                                    <button type="submit" class="btn btn-primary waves-effect waves-light mb-2">Submit</button>
                                                </div>
                                            </div>
                                        </form>

                                    </div> <!-- end card-body -->
                                </div> <!-- end card -->
                            </div> <!-- end col -->
                        </div>
                        <!-- end row -->



                        <!-- Form row -->
                        <div class="row">
                            <div class="col-12">
                                <div class="card">
                                    <div class="card-body">
                                        <h4 class="header-title">Form row</h4>
                                        <p class="text-muted font-13">
                                            You may also swap <code class="highlighter-rouge">.row</code> for <code class="highlighter-rouge">.form-row</code>, a variation of our standard grid row that overrides the default column gutters for tighter and more compact layouts.
                                        </p>

                                        <form>
                                            <div class="form-row">
                                                <div class="form-group col-md-6">
                                                    <label for="inputEmail4" class="col-form-label">Email</label>
                                                    <input type="email" class="form-control" id="inputEmail4" placeholder="Email">
                                                </div>
                                                <div class="form-group col-md-6">
                                                    <label for="inputPassword4" class="col-form-label">Password</label>
                                                    <input type="password" class="form-control" id="inputPassword4" placeholder="Password">
                                                </div>
                                            </div>

                                            <div class="form-group">
                                                <label for="inputAddress" class="col-form-label">Address</label>
                                                <input type="text" class="form-control" id="inputAddress" placeholder="1234 Main St">
                                            </div>

                                            <div class="form-group">
                                                <label for="inputAddress2" class="col-form-label">Address 2</label>
                                                <input type="text" class="form-control" id="inputAddress2" placeholder="Apartment, studio, or floor">
                                            </div>

                                            <div class="form-row">
                                                <div class="form-group col-md-6">
                                                    <label for="inputCity" class="col-form-label">City</label>
                                                    <input type="text" class="form-control" id="inputCity">
                                                </div>
                                                <div class="form-group col-md-4">
                                                    <label for="inputState" class="col-form-label">State</label>
                                                    <select id="inputState" class="form-control">
                                                        <option>Choose</option>
                                                        <option>Option 1</option>
                                                        <option>Option 2</option>
                                                        <option>Option 3</option>
                                                    </select>
                                                </div>
                                                <div class="form-group col-md-2">
                                                    <label for="inputZip" class="col-form-label">Zip</label>
                                                    <input type="text" class="form-control" id="inputZip">
                                                </div>
                                            </div>

                                            <div class="form-group">
                                                <div class="custom-control custom-checkbox">
                                                    <input type="checkbox" class="custom-control-input" id="customCheck11">
                                                    <label class="custom-control-label" for="customCheck11">Check this custom checkbox</label>
                                                </div>
                                            </div>

                                            <button type="submit" class="btn btn-primary waves-effect waves-light">Sign in</button>

                                        </form>

                                    </div> <!-- end card-body -->
                                </div> <!-- end card-->
                            </div> <!-- end col -->
                        </div>
                        <!-- end row -->


                        <div class="row">
                            <div class="col-12">
                                <div class="card-box">
                                    <div class="row">
                                        <div class="col-md-4">
                                            <h4 class="header-title">Custom checkbox - Basic</h4>

                                            <p class="sub-header">
                                                Supports bootstrap brand colors: <code>.checkbox-primary</code>, <code>.checkbox-info</code> etc.
                                            </p>
                                            
                                            <div class="checkbox mb-2">
                                                <input id="checkbox0" type="checkbox">
                                                <label for="checkbox0">
                                                    Default
                                                </label>
                                            </div>

                                            <div class="checkbox checkbox-primary mb-2">
                                                <input id="checkbox2" type="checkbox" checked>
                                                <label for="checkbox2">
                                                    Primary
                                                </label>
                                            </div>
                                            <div class="checkbox checkbox-success mb-2">
                                                <input id="checkbox3" type="checkbox">
                                                <label for="checkbox3">
                                                    Success
                                                </label>
                                            </div>
                                            <div class="checkbox checkbox-info mb-2">
                                                <input id="checkbox4" type="checkbox">
                                                <label for="checkbox4">
                                                    Info
                                                </label>
                                            </div>
                                            <div class="checkbox checkbox-warning mb-2">
                                                <input id="checkbox5" type="checkbox" checked>
                                                <label for="checkbox5">
                                                    Warning
                                                </label>
                                            </div>
                                            <div class="checkbox checkbox-danger mb-2">
                                                <input id="checkbox6" type="checkbox" checked>
                                                <label for="checkbox6">
                                                    Danger
                                                </label>
                                            </div>
                                            <div class="checkbox checkbox-blue mb-2">
                                                <input id="checkbox6a" type="checkbox">
                                                <label for="checkbox6a">
                                                    Blue
                                                </label>
                                            </div>

                                            <div class="checkbox checkbox-pink mb-2">
                                                <input id="checkbox6b" type="checkbox" checked>
                                                <label for="checkbox6b">
                                                    Pink
                                                </label>
                                            </div>

                                            <div class="checkbox checkbox-dark mb-2">
                                                <input id="checkbox6c" type="checkbox">
                                                <label for="checkbox6c">
                                                    Dark
                                                </label>
                                            </div>

                                            <p class="text-muted mt-3 mb-2">Checkboxes without label text <code>.checkbox-single</code></p>
                                            <div class="checkbox checkbox-single">
                                                <input type="checkbox" id="singleCheckbox1" value="option1" aria-label="Single checkbox One">
                                                <label></label>
                                            </div>
                                            <div class="checkbox checkbox-primary checkbox-single">
                                                <input type="checkbox" id="singleCheckbox2" value="option2" checked aria-label="Single checkbox Two">
                                                <label></label>
                                            </div>

                                            <p class="text-muted font-13 mt-3 mb-2">Inline checkboxes</p>
                                            <div class="checkbox form-check-inline">
                                                <input type="checkbox" id="inlineCheckbox1" value="option1">
                                                <label for="inlineCheckbox1"> Inline One </label>
                                            </div>
                                            <div class="checkbox checkbox-success form-check-inline">
                                                <input type="checkbox" id="inlineCheckbox2" value="option1" checked>
                                                <label for="inlineCheckbox2"> Inline Two </label>
                                            </div>
                                            <div class="checkbox checkbox-pink form-check-inline">
                                                <input type="checkbox" id="inlineCheckbox3" value="option1">
                                                <label for="inlineCheckbox3"> Inline Three </label>
                                            </div>
                                        </div>


                                        <div class="col-md-4">
                                            <h4 class="header-title mt-3 mt-md-0">Custom checkbox - Circled</h4>

                                            <p class="sub-header">
                                                <code>.checkbox-circle</code> for roundness.
                                            </p>
                                            <div class="checkbox checkbox-circle mb-2">
                                                <input id="checkbox7" type="checkbox">
                                                <label for="checkbox7">
                                                    Simply Rounded
                                                </label>
                                            </div>

                                            <div class="checkbox checkbox-info checkbox-circle mb-2">
                                                <input id="checkbox8" type="checkbox" checked>
                                                <label for="checkbox8">
                                                    Info
                                                </label>
                                            </div>
                                            <div class="checkbox checkbox-primary checkbox-circle mb-2">
                                                <input id="checkbox-9" type="checkbox">
                                                <label for="checkbox-9">
                                                    Primary
                                                </label>
                                            </div>
                                            <div class="checkbox checkbox-success checkbox-circle mb-2">
                                                <input id="checkbox-10" type="checkbox" checked>
                                                <label for="checkbox-10">
                                                    Success
                                                </label>
                                            </div>
                                            <div class="checkbox checkbox-warning checkbox-circle mb-2">
                                                <input id="checkbox-11" type="checkbox">
                                                <label for="checkbox-11">
                                                    Warning
                                                </label>
                                            </div>
                                            <div class="checkbox checkbox-danger checkbox-circle mb-2">
                                                <input id="checkbox-12" type="checkbox" checked>
                                                <label for="checkbox-12">
                                                    Danger
                                                </label>
                                            </div>

                                            <div class="checkbox checkbox-blue checkbox-circle mb-2">
                                                <input id="checkbox-13" type="checkbox" checked>
                                                <label for="checkbox-13">
                                                    Blue
                                                </label>
                                            </div>

                                            <div class="checkbox checkbox-pink checkbox-circle mb-2">
                                                <input id="checkbox-14" type="checkbox">
                                                <label for="checkbox-14">
                                                    Pink
                                                </label>
                                            </div>

                                            <div class="checkbox checkbox-dark checkbox-circle mb-2">
                                                <input id="checkbox-15" type="checkbox">
                                                <label for="checkbox-15">
                                                    Dark
                                                </label>
                                            </div>
                                        </div>


                                        <div class="col-md-4">
                                            <h4 class="header-title mt-3 mt-md-0">Custom checkbox - Disabled</h4>

                                            <p class="sub-header">
                                                Disabled state also supported.
                                            </p>

                                            <div class="checkbox mb-2">
                                                <input id="checkbox9" type="checkbox" disabled>
                                                <label for="checkbox9">
                                                    Can't check this
                                                </label>
                                            </div>
                                            <div class="checkbox checkbox-primary mb-2">
                                                <input id="checkbox10" type="checkbox" disabled checked>
                                                <label for="checkbox10">
                                                    This too
                                                </label>
                                            </div>
                                            <div class="checkbox checkbox-warning checkbox-circle mb-2">
                                                <input id="checkbox110" type="checkbox" disabled checked>
                                                <label for="checkbox110">
                                                    And this
                                                </label>
                                            </div>
                                            <div class="checkbox checkbox-info mb-2">
                                                <input id="checkbox12" type="checkbox" disabled checked>
                                                <label for="checkbox12">
                                                    Can't check this
                                                </label>
                                            </div>
                                            <div class="checkbox checkbox-pink mb-2">
                                                <input id="checkbox13" type="checkbox" disabled checked>
                                                <label for="checkbox13">
                                                    This too
                                                </label>
                                            </div>
                                            <div class="checkbox checkbox-blue checkbox-circle mb-2">
                                                <input id="checkbox14" type="checkbox" disabled checked>
                                                <label for="checkbox14">
                                                    And this
                                                </label>
                                            </div>
                                        </div>


                                    </div> <!-- end row-->
                                </div> <!-- end card-box-->
                            </div> <!-- end col-->
                        </div> <!-- end row -->


                        <!-- RADIOS -->

                        <div class="row">
                            <div class="col-12">
                                <div class="card-box">
                                    <div class="row">
                                        <div class="col-md-4">
                                            <h4 class="header-title">Custom radio - Basic</h4>

                                            <p class="sub-header">
                                                Supports bootstrap brand colors: <code>.radio-primary</code>, <code>.radio-danger</code> etc.
                                            </p>
                                            
                                            <div class="row">
                                                <div class="col-sm-6">
                                                    <div class="radio mb-2">
                                                        <input type="radio" name="radio" id="radio1" value="option1" checked>
                                                        <label for="radio1">
                                                            Default
                                                        </label>
                                                    </div>

                                                    <div class="radio radio-primary mb-2">
                                                        <input type="radio" name="radio" id="radio3" value="option3">
                                                        <label for="radio3">
                                                            Primary
                                                        </label>
                                                    </div>
                                                    <div class="radio radio-success mb-2">
                                                        <input type="radio" name="radio" id="radio4" value="option4">
                                                        <label for="radio4">
                                                            Success
                                                        </label>
                                                    </div>
                                                    <div class="radio radio-info mb-2">
                                                        <input type="radio" name="radio" id="radio5" value="option5">
                                                        <label for="radio5">
                                                            Info
                                                        </label>
                                                    </div>
                                                    <div class="radio radio-danger mb-2">
                                                        <input type="radio" name="radio" id="radio6" value="option6">
                                                        <label for="radio6">
                                                            Danger
                                                        </label>
                                                    </div>
                                                    <div class="radio radio-warning mb-2">
                                                        <input type="radio" name="radio" id="radio7" value="option7">
                                                        <label for="radio7">
                                                            Warning
                                                        </label>
                                                    </div>
                                                    <div class="radio radio-blue mb-2">
                                                        <input type="radio" name="radio" id="radio8" value="option8">
                                                        <label for="radio8">
                                                            Blue
                                                        </label>
                                                    </div>
                                                    <div class="radio radio-pink mb-2">
                                                        <input type="radio" name="radio" id="radio9" value="option9">
                                                        <label for="radio9">
                                                            Pink
                                                        </label>
                                                    </div>
                                                    <div class="radio radio-dark mb-2">
                                                        <input type="radio" name="radio" id="radio2" value="option2">
                                                        <label for="radio2">
                                                            Dark
                                                        </label>
                                                    </div>

                                                </div> <!-- end col -->

                                                <div class="col-sm-6">
                                                    <div class="radio mb-2">
                                                        <input type="radio" name="radio1" id="radio11" value="option1" checked>
                                                        <label for="radio11">
                                                            Default
                                                        </label>
                                                    </div>
                                                    
                                                    <div class="radio radio-primary mb-2">
                                                        <input type="radio" name="radio3" id="radio13" value="option3">
                                                        <label for="radio13">
                                                            Primary
                                                        </label>
                                                    </div>
                                                    <div class="radio radio-success mb-2">
                                                        <input type="radio" name="radio4" id="radio14" value="option4" checked>
                                                        <label for="radio14">
                                                            Success
                                                        </label>
                                                    </div>
                                                    <div class="radio radio-info mb-2">
                                                        <input type="radio" name="radio5" id="radio15" value="option5" checked>
                                                        <label for="radio15">
                                                            Info
                                                        </label>
                                                    </div>
                                                    <div class="radio radio-danger mb-2">
                                                        <input type="radio" name="radio6" id="radio16" value="option6">
                                                        <label for="radio16">
                                                            Danger
                                                        </label>
                                                    </div>
                                                    <div class="radio radio-warning mb-2">
                                                        <input type="radio" name="radio7" id="radio17" value="option7" checked>
                                                        <label for="radio17">
                                                            Warning
                                                        </label>
                                                    </div>
                                                    <div class="radio radio-blue mb-2">
                                                        <input type="radio" name="radio8" id="radio18" value="option8">
                                                        <label for="radio18">
                                                            Blue
                                                        </label>
                                                    </div>
                                                    <div class="radio radio-pink mb-2">
                                                        <input type="radio" name="radio9" id="radio19" value="option9" checked>
                                                        <label for="radio19">
                                                            Pink
                                                        </label>
                                                    </div>
                                                    <div class="radio radio-dark mb-2">
                                                        <input type="radio" name="radio2" id="radio12" value="option2">
                                                        <label for="radio12">
                                                            Dark
                                                        </label>
                                                    </div>

                                                </div><!-- end col -->
                                            </div> <!-- end row-->


                                            <p class="text-muted mt-3 mb-2">Radios without label text <code>.radio-single</code></p>
                                            <div class="radio radio-single">
                                                <input type="radio" id="singleRadio1" value="option1.1" name="radioSingle1" aria-label="Single radio One">
                                                <label for="singleRadio1"></label>
                                            </div>
                                            <div class="radio radio-success radio-single">
                                                <input type="radio" id="singleRadio2" value="option2.1" name="radioSingle1" checked aria-label="Single radio Two">
                                                <label for="singleRadio2"></label>
                                            </div>


                                            <p class="text-muted mt-3 mb-2">Inline radios</p>
                                            <div class="radio radio-info form-check-inline">
                                                <input type="radio" id="inlineRadio1" value="option1" name="radioInline" checked>
                                                <label for="inlineRadio1"> Inline One </label>
                                            </div>
                                            <div class="radio form-check-inline">
                                                <input type="radio" id="inlineRadio2" value="option2" name="radioInline">
                                                <label for="inlineRadio2"> Inline Two </label>
                                            </div>
                                        </div>
                                        <!-- end col -->

                                        <div class="col-md-4">
                                            <h4 class="header-title mt-3 mt-md-0">Custom radio - Disabled</h4>
                                            <p class="sub-header">
                                                Disabled state also supported.
                                            </p>

                                            <div class="radio radio-danger mb-2">
                                                <input type="radio" name="radio31" id="radio51" value="option1" checked disabled>
                                                <label for="radio51">
                                                    Zero
                                                </label>
                                            </div>
                                            <div class="radio mb-2">
                                                <input type="radio" name="radio41" id="radio61" value="option2" checked disabled>
                                                <label for="radio61">
                                                    One
                                                </label>
                                            </div>
                                            <div class="radio radio-blue mb-2">
                                                <input type="radio" name="radio51" id="radio71" value="option3" checked disabled>
                                                <label for="radio71">
                                                    Two
                                                </label>
                                            </div>
                                            <div class="radio radio-pink mb-2">
                                                <input type="radio" name="radio61" id="radio81" value="option4" checked disabled>
                                                <label for="radio81">
                                                    Three
                                                </label>
                                            </div>
                                        </div> <!-- end col -->

                                    </div> <!-- end row-->
                                </div> <!-- end card-box-->
                            </div> <!-- end col-->
                        </div><!-- end row -->
                        
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

        <!-- Vendor js -->
        <script src="../assets/js/vendor.min.js"></script>

        <!-- App js-->
        <script src="../assets/js/app.min.js"></script>
        
    </body>
</html>