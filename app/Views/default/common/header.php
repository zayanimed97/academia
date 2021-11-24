<!DOCTYPE html>
<html lang="en">

<head> 

    <!-- Basic Page Needs
    ================================================== -->
    <title>Courseplus Template</title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="Courseplus is - Professional A unique and beautiful collection of UI elements">

    <!-- Favicon -->
    <link href="<?= base_url('front') ?>/assets/images/favicon.png" rel="icon" type="image/png">

    <!-- icons
    ================================================== -->
    <link rel="stylesheet" href="<?= base_url('front') ?>/assets/css/icons.css">

    <!-- CSS
    ================================================== -->
    <link rel="stylesheet" href="<?= base_url('front') ?>/assets/css/uikit.min.css">
    <link rel="stylesheet" href="<?= base_url('front') ?>/assets/css/style.css">
    <link href="https://unpkg.com/tailwindcss@^2/dist/tailwind.min.css" rel="stylesheet">
</head>

<body class="bg-white">


    <div id="wrapper" class="horizontal">
        
        <!--  Header  -->
        <header class="is-transparent border-b backdrop-filter backdrop-blur-2xl" uk-sticky="cls-inactive: is-transparent border-b">
            <div class="header_inner">
                <div class="left-side">
    
                    <!-- Logo -->
                    <div id="logo">
                        <a href="home.html">
                            <img src="<?= base_url('front') ?>/assets/images/logo.png" alt="">
                            <img src="<?= base_url('front') ?>/assets/images/logo-light.png" class="logo_inverse" alt="">
                            <img src="<?= base_url('front') ?>/assets/images/logo-mobile.png" class="logo_mobile" alt="">
                        </a>
                    </div>
    
                    <!-- icon menu for mobile -->
                    <div class="triger" uk-toggle="target: .header_menu ; cls: is-visible">
                    </div>
    
                    <!-- menu bar for mobile -->
                    <nav class="header_menu">
                        <ul> 
                            <li> 
                                <a href="#"> Courses</a> 
                                <div uk-drop="mode: click" class="category-dropdown">
                                    <ul>
                                        <li> <a href="courses.html">  <ion-icon name="newspaper-outline" class="is-icon"></ion-icon> Web Development </a></li>
                                        <li> <a href="courses.html">  <ion-icon name="leaf-outline" class="is-icon"></ion-icon> Mobile App </a> </li>
                                        <li> <a href="courses.html">  <ion-icon name="briefcase-outline" class="is-icon"></ion-icon> Business </a> </li>
                                        <li> <a href="courses.html">  <ion-icon name="color-palette-outline" class="is-icon"></ion-icon> Desings </a></li>
                                        <li> <a href="courses.html">  <ion-icon name="megaphone-outline" class="is-icon"></ion-icon> Marketing </a></li>
                                        <li> <a href="courses.html">  <ion-icon name="camera-outline" class="is-icon"></ion-icon> Photography </a> </li>
                                        <li> <a href="courses.html">  <ion-icon name="accessibility-outline" class="is-icon"></ion-icon> Life Style </a> </li>
                                    </ul>
                                </div>
                          
                            </li>
                           <li> <a href="categories.html" class="active"> Categories </a></li>
                            <li> <a href="episodes.html"> Episode  </a></li>
                            <li> <a href="books.html"> Book  </a></li>
                            <li> <a href="blog.html"> Blog</a></li>
                            <li> <a href="#">Pages</a>
                                <div uk-drop="mode: click" class="menu-dropdown">
                                    <ul>
                                        <li> <a href="pages-pricing.html"> Pricing</a></li>
                                        <li> <a href="pages-faq.html"> Faq </a></li>
                                       <li> <a href="pages-help.html"> Help </a></li>
                                        <li> <a href="pages-terms.html"> Terms </a></li>
                                        <li> <a href="pages-setting.html"> Setting </a></li>
                                        <li> <a href="#"> Development </a>
                                            <div class="menu-dropdown" uk-drop="mode: click;pos:right-top;animation: uk-animation-slide-right-small">
                                                <ul> 
                                                    <li><a href="development-elements.html"> Elements  </a></li>
                                                    <li><a href="development-components.html"> Compounents </a></li>
                                                    <li><a href="development-plugins.html"> Plugins </a></li>
                                                    <li><a href="development-icons.html"> Icons </a></li>
                                                </ul>
                                            </div>  
                                        </li>
                                        <li> <a href="course-intro.html"> Course intro 1 </a>
                                            <div uk-drop="mode: click;pos:right-center" class="menu-dropdown">
                                        <ul>
                                            <li> <a href="pages-pricing.html"> Pricing</a></li>
                                            <li> <a href="pages-faq.html"> Faq </a></li>
                                           <li> <a href="pages-help.html"> Help </a></li>
                                            <li> <a href="pages-terms.html"> Terms </a></li>
                                            <li> <a href="pages-setting.html"> Setting </a></li>
                                        <li> <a href="#"> Development </a>
                                            <div class="menu-dropdown" uk-drop="mode: click;pos:right-top;animation: uk-animation-slide-right-small">
                                                <ul> 
                                                    <li><a href="development-elements.html"> Elements  </a></li>
                                                    <li><a href="development-components.html"> Compounents </a></li>
                                                    <li><a href="development-plugins.html"> Plugins </a></li>
                                                    <li><a href="development-icons.html"> Icons </a></li>
                                                </ul>
                                            </div>  
                                        </li>
                                            <li> <a href="course-intro.html"> Course intro 1 </a></li>
                                            <li> <a href="course-intro-2.html"> Course intro 2 </a></li>
                                        </ul>
                                    </div>
                                </li>
                                        <li> <a href="course-intro-2.html"> Course intro 2 </a></li>
                                    </ul>
                                </div>
                            </li>
                        </ul>
                    </nav>
    
                    <!-- overly for small devices -->
                    <div class="overly" uk-toggle="target: .header_menu ; cls: is-visible"></div>
    
                </div>
                <div class="right-side">
    
                    <!-- cart -->
                    <a href="#" class="header_widgets">
                        <ion-icon name="cart-outline" class="is-icon"></ion-icon>
                    </a>
                    <div uk-drop="mode: click" class="dropdown_cart">
                        <div class="cart-headline"> My Cart 
                            <a href="#" class="checkout">Checkout</a>
                        </div>
                        <ul class="dropdown_cart_scrollbar" data-simplebar>
                            <li>
                                <div class="cart_avatar">
                                    <img src="<?= base_url('front') ?>/assets/images/courses/img-1.jpg" alt="">
                                </div>
                                <div class="cart_text">
                                    <h4> Learn Angular Beginner to Advanced Fundamentals </h4>
                                </div>
                                <div class="cart_price">
                                    <span> $12.99 </span>
                                    <button class="type"> Remove</button>
                                </div>
                            </li>
                            <li>
                                <div class="cart_avatar">
                                    <img src="<?= base_url('front') ?>/assets/images/courses/img-1.jpg" alt="">
                                </div>
                                <div class="cart_text">
                                    <h4>  Become a Web Developer from Scratch to Advanced </h4>
                                </div>
                                <div class="cart_price">
                                    <span> $19.99 </span>
                                    <button class="type"> Remove</button>
                                </div>
                            </li>
                            <li>
                                <div class="cart_avatar">
                                    <img src="<?= base_url('front') ?>/assets/images/courses/img-2.jpg" alt="">
                                </div>
                                <div class="cart_text">
                                    <h4> Angular Fundamentals for Beginner to advance </h4>
                                </div>
                                <div class="cart_price">
                                    <span> $12.99 </span>
                                    <button class="type"> Remove</button>
                                </div>
                            </li>
                            <li>
                                <div class="cart_avatar">
                                    <img src="<?= base_url('front') ?>/assets/images/courses/img-3.jpg" alt="">
                                </div>
                                <div class="cart_text">
                                    <h4> Ultimate Web Developer Course for Beginners 2020</h4>
                                </div>
                                <div class="cart_price">
                                    <span> $14.99 </span>
                                    <button class="type"> Remove</button>
                                </div>
                            </li>
                            <li>
                                <div class="cart_avatar">
                                    <img src="<?= base_url('front') ?>/assets/images/courses/img-4.jpg" alt="">
                                </div>
                                <div class="cart_text">
                                    <h4> The Complete JavaScript From beginning to advance </h4>
                                </div>
                                <div class="cart_price">
                                    <span> $16.99 </span>
                                    <button class="type"> Remove</button>
                                </div>
                            </li>
                            <li>
                                <div class="cart_avatar">
                                    <img src="<?= base_url('front') ?>/assets/images/courses/img-5.jpg" alt="">
                                </div>
                                <div class="cart_text">
                                    <h4> Become a Web Developer from Scratch to Advanced</h4>
                                </div>
                                <div class="cart_price">
                                    <span> $12.99 </span>
                                    <button class="type"> Remove</button>
                                </div>
                            </li>
                        </ul>
    
                        <div class="cart_footer">
                            <p> Subtotal : $ 320 </p>
                            <h1> Total :  <strong> $ 320</strong> </h1>
                        </div>
                    </div>
    
                    <!-- notification -->
                    <a href="#" class="header_widgets">
                        <ion-icon name="mail-outline" class="is-icon"></ion-icon>
                    </a>
                    <div uk-drop="mode: click" class="header_dropdown"> 
                        <div class="drop_headline">
                            <h4>Notifications </h4>
                            <div class="btn_action">
                                <div class="btn_action">
                                    <a href="#">
                                        <ion-icon name="settings-outline" uk-tooltip="title: Notifications settings ; pos: left"></ion-icon>
                                    </a>
                                    <a href="#">
                                        <ion-icon name="checkbox-outline" uk-tooltip="title: Mark as read all ; pos: left"></ion-icon>
                                    </a>
                                </div>
                            </div>
                        </div>
    
                        <ul class="dropdown_scrollbar" data-simplebar>
                            <li>
                                <a href="#">
                                    <div class="drop_avatar"> <img src="<?= base_url('front') ?>/assets/images/avatars/avatar-1.jpg" alt="">
                                    </div>
                                    <div class="drop_content">
                                        <p> <strong>Adrian Mohani</strong> Like Your Comment On Course
                                            <span class="text-link">Javascript Introduction </span>
                                        </p>
                                        <span class="time-ago"> 2 hours ago </span>
                                    </div>
                                </a>
                            </li>
                            <li>
                                <a href="#">
                                    <div class="drop_avatar"> <img src="<?= base_url('front') ?>/assets/images/avatars/avatar-2.jpg" alt="">
                                    </div>
                                    <div class="drop_content">
                                        <p>
                                            <strong>Stella Johnson</strong> Replay Your Comments in
                                            <span class="text-link">Programming for Games</span>
                                        </p>
                                        <span class="time-ago"> 9 hours ago </span>
                                    </div>
                                </a>
                            </li>
                            <li>
                                <a href="#">
                                    <div class="drop_avatar"> <img src="<?= base_url('front') ?>/assets/images/avatars/avatar-3.jpg" alt="">
                                    </div>
                                    <div class="drop_content">
                                        <p>
                                            <strong>Alex Dolgove</strong> Added New Review In Course
                                            <span class="text-link">Full Stack PHP Developer</span>
                                        </p>
                                        <span class="time-ago"> 12 hours ago </span>
                                    </div>
                                </a>
                            </li>
                            <li>
                                <a href="#">
                                    <div class="drop_avatar"> <img src="<?= base_url('front') ?>/assets/images/avatars/avatar-1.jpg" alt="">
                                    </div>
                                    <div class="drop_content">
                                        <p>
                                            <strong>Jonathan Madano</strong> Shared Your Discussion On Course
                                            <span class="text-link">Css Flex Box </span>
                                        </p>
                                        <span class="time-ago"> Yesterday </span>
                                    </div>
                                </a>
                            </li>
                        </ul>
                        <a href="#" class="see-all">See all</a>
                    </div>
    
                    <!-- messages -->
                    <a href="#" class="header_widgets">
                        <ion-icon name="notifications-outline" class="is-icon"></ion-icon>
                        <span> 2 </span>
                    </a>
                    <div uk-drop="mode: click" class="header_dropdown">
                        <div class="drop_headline">
                            <h4>Messages </h4>
                            <div class="btn_action">
                                <a href="#">
                                    <ion-icon name="settings-outline" uk-tooltip="title: Message settings ; pos: left"></ion-icon>
                                </a>
                                <a href="#">
                                    <ion-icon name="checkbox-outline" uk-tooltip="title: Mark as read all ; pos: left"></ion-icon>
                                </a>
                            </div>
                        </div>
                        <ul class="dropdown_scrollbar" data-simplebar>
                            <li>
                                <a href="#">
                                    <div class="drop_avatar"> <img src="<?= base_url('front') ?>/assets/images/avatars/avatar-1.jpg" alt="">
                                    </div>
                                    <div class="drop_content">
                                        <strong> John menathon </strong> <span class="time"> 6:43 PM</span>
                                        <p> Lorem ipsum dolor sit amet, consectetur </p>
                                    </div>
                                </a>
                            </li>
                            <li>
                                <a href="#">
                                    <div class="drop_avatar"> <img src="<?= base_url('front') ?>/assets/images/avatars/avatar-2.jpg" alt="">
                                    </div>
                                    <div class="drop_content">
                                        <strong> Zara Ali </strong> <span class="time">12:43 PM</span>
                                        <p> Lorem ipsum dolor sit amet, consectetur </p>
                                    </div>
                                </a>
                            </li>
                            <li>
                                <a href="#">
                                    <div class="drop_avatar"> <img src="<?= base_url('front') ?>/assets/images/avatars/avatar-3.jpg" alt="">
                                    </div>
                                    <div class="drop_content">
                                        <strong> Mohamed Ali </strong> <span class="time"> Wed</span>
                                        <p> Lorem ipsum dolor sit amet, consectetur </p>
                                    </div>
                                </a>
                            </li>
                            <li>
                                <a href="#">
                                    <div class="drop_avatar"> <img src="<?= base_url('front') ?>/assets/images/avatars/avatar-1.jpg" alt="">
                                    </div>
                                    <div class="drop_content">
                                        <strong> John menathon </strong> <span class="time"> Sun </span>
                                        <p> Lorem ipsum dolor sit amet, consectetur </p>
                                    </div>
                                </a>
                            </li>
                            <li>
                                <a href="#">
                                    <div class="drop_avatar"> <img src="<?= base_url('front') ?>/assets/images/avatars/avatar-2.jpg" alt="">
                                    </div>
                                    <div class="drop_content">
                                        <strong> Zara Ali </strong> <span class="time"> Fri </span>
                                        <p> Lorem ipsum dolor sit amet, consectetur </p>
                                    </div>
                                </a>
                            </li>
                            <li>
                                <a href="#">
                                    <div class="drop_avatar"> <img src="<?= base_url('front') ?>/assets/images/avatars/avatar-3.jpg" alt="">
                                    </div>
                                    <div class="drop_content">
                                        <strong> Mohamed Ali </strong> <span class="time">1 Week ago</span>
                                        <p> Lorem ipsum dolor sit amet, consectetur </p>
                                    </div>
                                </a>
                            </li>
                        </ul>
                        <a href="#" class="see-all">See all</a>
                    </div>
    
                     <!-- profile -->
                    <a href="#">
                        <img src="<?= base_url('front') ?>/assets/images/avatars/placeholder.png" class="header_widgets_avatar" alt="">
                    </a>
                    <div uk-drop="mode: click;offset:5" class="header_dropdown profile_dropdown">
                        <ul>   
                            <li>
                                <a href="#" class="user">
                                    <div class="user_avatar">
                                        <img src="<?= base_url('front') ?>/assets/images/avatars/avatar-2.jpg" alt="">
                                    </div>
                                    <div class="user_name">
                                        <div> Stella Johnson </div>
                                        <span> @Johnson </span>
                                    </div>
                                </a>
                            </li>
                            <li> 
                                <hr>
                            </li>
                            <li> 
                                <a href="#" class="is-link">
                                    <ion-icon name="rocket-outline" class="is-icon"></ion-icon> <span>  Upgrade Membership  </span>
                                </a>
                            </li> 
                            <li> 
                                <hr>
                            </li>
                            <li> 
                                <a href="#">
                                    <ion-icon name="person-circle-outline" class="is-icon"></ion-icon>
                                     My Account 
                                </a>
                            </li>
                            <li> 
                                <a href="#">
                                    <ion-icon name="card-outline" class="is-icon"></ion-icon>
                                    Subscriptions
                                </a>
                            </li>
                            <li> 
                                <a href="#">
                                    <ion-icon name="color-wand-outline" class="is-icon"></ion-icon>
                                    My Billing 
                                </a>
                            </li>
                            <li>
                                <a href="#">
                                    <ion-icon name="settings-outline" class="is-icon"></ion-icon>
                                    Account Settings  
                                </a>
                            </li>
                            <li> 
                                <hr>
                            </li>
                            <li> 
                                <a href="#" id="night-mode" class="btn-night-mode" onclick="UIkit.notification({ message: 'Hmm...  <strong> Night mode </strong> feature is not available yet. ' , pos: 'bottom-right'  })">
                                    <ion-icon name="moon-outline" class="is-icon"></ion-icon>
                                     Night mode
                                    <span class="btn-night-mode-switch">
                                        <span class="uk-switch-button"></span>
                                    </span>
                                </a>
                            </li>
                            <li> 
                                <a href="#">
                                    <ion-icon name="log-out-outline" class="is-icon"></ion-icon>
                                    Log Out 
                                </a>
                            </li>
                        </ul>
                    </div>
    
                </div> 
            </div>
        </header>