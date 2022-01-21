<?php 
    $category = $CategorieModel ->where('c.id_ente', $selected_ente['id'])
                                ->where('categorie.banned', 'no')
                                ->where('categorie.status', 'enable')
                                ->join('corsi c', 'find_in_set(categorie.id,c.id_categorie) > 0')
                                ->groupBy('categorie.id')
                                ->select('  categorie.*, 
                                            c.tipologia_corsi, 
                                            SUM(case when c.tipologia_corsi = "aula" then 1 else 0 end) as sum_aula, 
                                            SUM(case when c.tipologia_corsi = "webinar" then 1 else 0 end) as sum_webinar, 
                                            SUM(case when c.tipologia_corsi = "online" then 1 else 0 end) as sum_online')
                                ->find();

    $argomenti = $ArgomentiModel->where('c.id_ente', $selected_ente['id'])
                                ->where('argomenti.banned', 'no')
                                ->join('corsi c', 'c.id_argomenti = argomenti.idargomenti')
                                ->groupBy('argomenti.idargomenti')
                                ->select('  argomenti.*, 
                                            c.tipologia_corsi, 
                                            argomenti.idargomenti as arg_id, 
                                            SUM(case when c.tipologia_corsi = "aula" then 1 else 0 end) as sum_aula, 
                                            SUM(case when c.tipologia_corsi = "webinar" then 1 else 0 end) as sum_webinar, 
                                            SUM(case when c.tipologia_corsi = "online" then 1 else 0 end) as sum_online')
                                ->find();
    //      echo '<pre>';
    //      print_r($argomenti);
    //      echo '</pre>';
    //      exit;
    $filter = function($tipologia, $type, $argomenti = null){return array_filter($type, function($el) use ($tipologia){ return $el['sum_'.$tipologia] > 0 ;});};
?>
<!DOCTYPE html>
<html lang="it">

<head> 

    <!-- Basic Page Needs
    ================================================== -->
    <title><?php echo $seo_title ?? 'AuleDigitale'?></title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="<?php echo $seo_description ?? 'AuleDigitale Corso plateform'?>">

<link rel="canonical" href="<?php echo current_url()?>"> 
<meta property="og:site_name" content="<?php echo $_SERVER['SERVER_NAME']?>">
<meta property="og:type" content="website">
<meta property="og:url" content="<?php echo current_url()?>"> 
<meta property="og:title" content="<?php echo $seo_title ?? 'AuleDigitale'?>">
<meta property="og:description" content="<?php echo $seo_description ?? 'AuleDigitale Corso plateform'?>">
<?php if(($seo_image ?? '')!=""){?>
<meta property="og:image" content="<?php echo $seo_image?>"> 
<meta property="og:image:type" content="<?php echo $seo_image_info['mime_type'] ?? 'image/jpeg'?>"> 
<meta property="og:image:width" content="<?php echo $seo_image_info['width'] ?? ''?>"> 
<meta property="og:image:height" content="<?php echo $seo_image_info['height'] ?? ''?>">
<?php } ?>
<?php if(isset($settings['fb_app_ID']) && $settings['fb_app_ID']!=""){?>
<meta property="fb:app_id" content="<?php echo $settings['fb_app_ID'] ?? ''?>">
<?php } ?>
<?php if(isset($settings['google_analytic']) && $settings['google_analytic']!=""){?>
<script async src="https://www.googletagmanager.com/gtag/js?id=<?php echo $settings['google_analytic']?>"></script>
<script>
  window.dataLayer = window.dataLayer || [];
  function gtag(){dataLayer.push(arguments);}
  gtag('js', new Date());

  gtag('config', '<?php echo $settings["google_analytic"]?>');
</script>
<?php } ?>
<?php if(isset($settings['facebook_pixel']) && $settings['facebook_pixel']!=""){?>
<!-- Facebook Pixel Code -->
<script>
    !function(f,b,e,v,n,t,s)
    {if(f.fbq)return;n=f.fbq=function(){n.callMethod?
    n.callMethod.apply(n,arguments):n.queue.push(arguments)};
    if(!f._fbq)f._fbq=n;n.push=n;n.loaded=!0;n.version='2.0';
    n.queue=[];t=b.createElement(e);t.async=!0;
    t.src=v;s=b.getElementsByTagName(e)[0];
    s.parentNode.insertBefore(t,s)}(window,document,'script','https://connect.facebook.net/en_US/fbevents.js');
    fbq('init', '<?php echo $settings["facebook_pixel"]?>'); 
    fbq('track', 'PageView');
</script>


<noscript>
    <img height="1" width="1" src="https://www.facebook.com/tr?id=<?php echo $settings['facebook_pixel']?>&ev=PageView&noscript=1"/>
</noscript>
<!-- End Facebook Pixel Code -->
<!-- Load Facebook SDK for JavaScript -->
<div id="fb-root"></div>
<?php } ?>
<meta name="author" content="auledigitali">


    <!-- Favicon -->
	<?php if(($settings['faveicon_website'] ?? null)!==null){?>
	 <link href="<?= base_url('uploads/'.$settings['faveicon_website']) ?>" rel="icon" type="image/png">
	<?php }else{?>
    <link href="<?= base_url('front') ?>/assets/images/favicon.png" rel="icon" type="image/png">
	<?php } ?>
    <!-- icons
    ================================================== -->
    <link rel="stylesheet" href="<?= base_url('front') ?>/assets/css/icons.css">

    <!-- CSS
    ================================================== -->
    <link rel="stylesheet" href="<?= base_url('front') ?>/assets/css/uikit.min.css">
    <link rel="stylesheet" href="<?= base_url('front') ?>/assets/css/style.css">
    <!-- <link href="https://unpkg.com/tailwindcss@^2/dist/tailwind.min.css" rel="stylesheet"> -->
    <link href="https://unpkg.com/tailwindcss@^2/dist/tailwind.min.css" rel="stylesheet">
    <style>
        .discounted{ 
            position: relative;
            color: red !important;
            font-size: .75rem !important;
        }
        .discounted::after{
            content: "";
            width: 100%;
            height: 1px;
            background: red;
            position: absolute;
            bottom: 7px;
            left: 0;
            transform: skewY(-11deg);
        } 
        .uk-accordion-title::before {
            font-size: 20px;
            width: 1.4em;
            margin-right: -12px;
            float: right;
            font-family: "Feather-Icons";
            content: "\e92e";
            color: rgba(0, 0, 0, 0.54);
            background-image: none;
        }

    /* .header_menu ul ul li a:after{
        content: "" !important;
    } */
    .ellipsize{
        /* height: 18px; */
        width: 100%;
        padding: 0;
        overflow: hidden;
        position: relative;
        display: inline-block !important;
        text-overflow: ellipsis;
        white-space: nowrap;
    }

    header{
        background-color: <?= json_decode($settings['css'] ?? '', true)['headerBackground'] ?? '#000000' ?> !important
    }

    .header_menu > ul > li > a{
        color: <?= json_decode($settings['css'] ?? '', true)['headerText'] ?? '#9C9C9C' ?> !important
    }

    .bg-blue-600{
        background-color: <?= json_decode($settings['css'] ?? '', true)['buttonBackground'] ?? '#FF7700' ?> !important;
        color: <?= json_decode($settings['css'] ?? '', true)['buttonText'] ?? '#FFFFFF' ?> !important
    }
</style>
</head>

<body class="bg-white"  x-data="headerData($watch)">


    <div id="wrapper" class="horizontal flex flex-col relative min-h-screen">
        
        <!--  Header  -->
        <header class="border-b backdrop-filter backdrop-blur-2xl" uk-sticky="cls-inactive: border-b">
            <div class="header_inner">
                <div class="left-side">
    
                    <!-- Logo -->
                    <div id="logo">
                        <a href="<?= base_url() ?>">
						<?php if(($settings['logo_website'] ?? null)!==null){?>
                            <img src="<?= base_url('uploads/'.$settings['logo_website']) ?>" alt="">
                            <img src="<?= base_url('uploads/'.$settings['logo_website']) ?>" class="logo_inverse" alt="">
							 <img src="<?= base_url('uploads/'.$settings['logo_website']) ?>" class="logo_mobile" alt="">
						<?php }else{?>
                            <img src="<?= base_url('front') ?>/assets/images/logo-mobile.png" alt="">
							 <img src="<?= base_url('front') ?>/assets/images/logo-mobile.png" class="logo_inverse" alt="">
							  <img src="<?= base_url('front') ?>/assets/images/logo-mobile.png" class="logo_mobile" alt="">
						<?php } ?>
                        </a>
                    </div>
    
                    <!-- icon menu for mobile -->
                    <div class="triger" uk-toggle="target: .header_menu ; cls: is-visible">
                    </div>
    
                    <!-- menu bar for mobile -->
                    <nav class="header_menu">
                        <ul> 
                            <!-- <li> 
                                <a href="#"> Aule </a> 
                                <div uk-drop="mode: click" class="menu-dropdown">
                                    <ul>
                                        <li> 
                                            <a href="#">  <ion-icon name="newspaper-outline" class="is-icon"></ion-icon> Categories </a>
                                            <div uk-drop="mode: click; pos: right-top" class="menu-dropdown">
                                                <ul>
                                                    <?php foreach($filter('aula', $category) as $cat) { ?>
                                                    <li>
                                                        <a href="<?= base_url('corsi') ?>?categories=<?= $cat['url'] ?>&tipo=aula"><?= $cat['titolo'] ?> (<?= $cat['sum_aula'] ?>)</a>
                                                    </li>

                                                    <?php } ?>
                                                </ul>
                                            </div>
                                        </li>
                                        <li> 
                                            <a href="#">  <ion-icon name="newspaper-outline" class="is-icon"></ion-icon> Argomenti </a>
                                            <div uk-drop="mode: click; pos: right-top" class="menu-dropdown">
                                                <ul>
                                                    <?php foreach($filter('aula', $argomenti) as $arg) { ?>
                                                        <li>
                                                            <a href="<?= base_url('corsi') ?>?argomenti=<?= $arg['url'] ?>&tipo=aula"><?= $arg['nomeargomento'] ?> (<?= $arg['sum_aula'] ?>)</a>
                                                        </li>

                                                    <?php } ?>
                                                </ul>
                                            </div>
                                        </li>
                                    </ul>
                                </div>
                          
                            </li> -->
							<?php 
								$type_cours=json_decode($settings['type_cours'] ?? '',true);
								
								if(in_array('online',$ente_package['type_cours'])){?>
                            <li> 
                                <a href="<?= base_url('corsi') ?>?tipo=online"> <?php echo $type_cours['online'] ?? 'Online'?> </a> 
                                <!-- <div uk-drop="mode: click" class="menu-dropdown">
                                    <ul>
                                        <li> 
                                            <a href="#">  <ion-icon name="newspaper-outline" class="is-icon"></ion-icon> Categories </a>
                                            <div uk-drop="mode: click; pos: right-top" class="menu-dropdown">
                                                <ul>
                                                    <?php foreach($filter('online', $category) as $cat) { ?>
                                                        <li>
                                                            <a href="<?= base_url('corsi') ?>?categories=<?= $cat['url'] ?>&tipo=online"><?= $cat['titolo'] ?> (<?= $cat['sum_online'] ?>)</a>
                                                        </li>

                                                    <?php } ?>
                                                </ul>
                                            </div>
                                        </li>
                                        <li> 
                                            <a href="#">  <ion-icon name="newspaper-outline" class="is-icon"></ion-icon> Argomenti </a>
                                            <div uk-drop="mode: click; pos: right-top" class="menu-dropdown">
                                                <ul>
                                                <?php foreach($filter('online', $argomenti) as $arg) { ?>
                                                        <li>
                                                            <a href="<?= base_url('corsi') ?>?argomenti=<?= $arg['url'] ?>&tipo=online"><?= $arg['nomeargomento'] ?> (<?= $arg['sum_online'] ?>)</a>
                                                        </li>

                                                    <?php } ?>
                                                </ul>
                                            </div>
                                        </li>
                                    </ul>
                                </div> -->
                          
                            </li>
								<?php } 
							
								if(in_array('webinar',$ente_package['type_cours'])){?>
                            <li> 
                                <a href="<?= base_url('corsi') ?>?tipo=webinar"> <?php echo $type_cours['webinar'] ?? 'Webinar'?> </a> 
                                <!-- <div uk-drop="mode: click" class="menu-dropdown">
                                    <ul>
                                        <li> 
                                            <a href="#">  <ion-icon name="newspaper-outline" class="is-icon"></ion-icon> Categories </a>
                                            <div uk-drop="mode: click; pos: right-top" class="menu-dropdown">
                                                <ul>
                                                    <?php foreach($filter('webinar', $category) as $cat) { ?>
                                                        <li>
                                                            <a href="<?= base_url('corsi') ?>?categories=<?= $cat['url'] ?>&tipo=webinar"><?= $cat['titolo'] ?> (<?= $cat['sum_webinar'] ?>)</a>
                                                        </li>

                                                    <?php } ?>
                                                    
                                                </ul>
                                            </div>
                                        </li>
                                        <li> 
                                            <a href="#">  <ion-icon name="newspaper-outline" class="is-icon"></ion-icon> Argomenti </a>
                                            <div uk-drop="mode: click; pos: right-top" class="menu-dropdown">
                                                <ul>
                                                <?php foreach($filter('webinar', $argomenti) as $arg) { ?>
                                                        <li>
                                                            <a href="<?= base_url('corsi') ?>?argomenti=<?= $arg['url'] ?>&tipo=webinar"><?= $arg['nomeargomento'] ?> (<?= $arg['sum_webinar'] ?>)</a>
                                                        </li>

                                                    <?php } ?>
                                                </ul>
                                            </div>
                                        </li>
                                    </ul>
                                </div> -->
                          
                            </li>
							<?php } 
							
								if(in_array('aula',$ente_package['type_cours'])){?>
								  <li> 
                                <a href="<?= base_url('corsi') ?>?tipo=aula"> <?php echo $type_cours['aula'] ?? 'Aula'?> </a> 
								</li>
								<?php } ?>
                           <!-- <li> <a href="categories.html" class="active"> Categories </a></li>
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


                            <li> 
                                <a href="<?= base_url('blog') ?>"> Blog  </a> 
                            </li>
-->
<?php if(!empty($contact_page)){?>
                            <li> 
                                <a href="<?php echo base_url($contact_page['url'])?>"> <?php echo $contact_page['menu_title']?>  </a> 
                            </li>
<?php } ?>
<?php if(!empty($list_static_pages)){
					foreach($list_static_pages as $k=>$one_page){
						if(($one_page['menu_position'] ?? 'header')=='header'){
							if($one_page['is_externel']=='no') $url=base_url('page/'.$one_page['url']); else $url=$one_page['url'];?>
							  <li> <a href="<?php echo $url?>" <?php if($one_page['is_externel']=='yes') echo "target='_blank'";?> ><?php echo $one_page['menu_title']?></a></li>
						<?php } 
					} 
				}?>
                        </ul>
                    </nav>
    
                    <!-- overly for small devices -->
                    <div class="overly" uk-toggle="target: .header_menu ; cls: is-visible"></div>
    
                </div>
                <div class="right-side">
    
                    <!-- cart -->
                    <a href="#" class="header_widgets">
                        <ion-icon name="cart-outline" class="is-icon"></ion-icon>
                        <span x-text="items"> </span>

                    </a>
                    <div uk-drop="mode: click" class="dropdown_cart">
                        <div class="cart-headline"> <?php echo lang('front.title_my_cart')?> 
                            <a href="<?= base_url('/order/checkout') ?>" class="bg-blue-600 text-white flex font-medium items-center justify-center py-1 rounded-md hover:text-white w-1/3" class="checkout"><?php echo lang('front.title_checkout')?></a>
                        </div>
                        <ul class="dropdown_cart_scrollbar" data-simplebar>
                            <template x-for="item in cartItems" :key="item.id">
                                
                                <li>
                                    <div class="cart_avatar">
                                        <img :src="item.options.image ? item.options.image : '<?= base_url('front/assets/images/courses/img-1.jpg') ?>'" alt="">
                                    </div>
                                    <div class="cart_text">
                                        <h4 x-text="item.name">  </h4>
                                    </div>
                                    <div class="cart_price">
                                        <template x-if="item.price != item.originalPrice">
                                            <span class="font-bold mt-0.5 discounted" x-text="formatter.format(item.originalPrice)"></span>
                                        </template>
                                        <span x-text="formatter.format(item.price)"> </span>
                                        <button type="button" @click="removeFromCart(item.rowid)" class="type"> <?php echo lang('front.btn_delete')?></button>
                                    </div>
                                </li>
                            </template>
                        </ul>
    
                        <div class="cart_footer">
                            <!-- <p> Subtotal : $ 320 </p> -->
                            <h1> <?php echo lang('front.title_total')?> provvisorio :  <strong x-text="formatter.format(total)">  </strong> </h1>
                        </div>
                    </div>
    
                  
    
                     <!-- profile -->
                    <?php if((session('user_data')['role'] ?? '') == 'participant'){ ?>
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
                                        <div> <?php echo session('user_data')['display_name']?> </div>
                                        <span> <?php echo session('user_data')['email']?></span>
										<?php if(in_array('wallet',$ente_package['extra'])){?>
										<span><i class="icon-feather-gift"></i>&nbsp;<b id="user_menu_wallet"><?php echo number_format(session('user_data')['wallet'],2)?></b> €</span>
										<?php } ?>
								   </div>
                                </a>
                            </li>
                            
                            <li> 
                                <hr>
                            </li>
                            <li> 
                                <a href="<?php echo base_url('user/profile')?>">
                                    <ion-icon name="person-circle-outline" class="is-icon"></ion-icon>
                                     <?php echo lang('front.menu_profile')?>
                                </a>
                            </li>
                            <li> 
                                <a href="<?php echo base_url('user/participation')?>">
                                    <ion-icon name="card-outline" class="is-icon"></ion-icon>
                                     <?php echo lang('front.menu_participation')?>
                                </a>
                            </li>
                             <li> 
                                <a href="<?php echo base_url('user/cart')?>">
                                    <ion-icon name="cart-outline" class="is-icon"></ion-icon>
                                     <?php echo lang('front.menu_cart')?>
                                </a>
                            </li>
							<?php if(in_array('wallet',$ente_package['extra'])){?>
							 <li> 
                                <a href="<?php echo base_url('user/wallet')?>">
                                    <ion-icon name="gift-outline" class="is-icon"></ion-icon>
                                     <?php echo lang('front.menu_wallet')?>
                                </a>
                            </li>
							<?php } ?>
                            <li>
                                <a href="<?php echo base_url('user/settings')?>">
                                    <ion-icon name="settings-outline" class="is-icon"></ion-icon>
                                   <?php echo lang('front.menu_account_settings')?>
                                </a>
                            </li>
                            <li> 
                                <hr>
                            </li>
                           	<?php if(isset($is_admin) && $is_admin==true){?>
							<li> 
                                <a href="<?= $redirect_admin ?>">
                                    <ion-icon name="log-out-outline" class="is-icon"></ion-icon>
                                    <?php echo lang('app.admin')?>
                                </a>
                            </li>
							<?php } ?>
                            <li> 
                                <a href="<?= base_url('logout') ?>">
                                    <ion-icon name="log-out-outline" class="is-icon"></ion-icon>
                                    <?php echo lang('front.btn_logout')?>
                                </a>
                            </li>
                        </ul>
                    </div>
                    <?php } else { ?>
                    <a class="bg-blue-600 flex justify-center items-center rounded-md text-white text-center ml-4 text-base h-8 p-4 hover:text-white hover:bg-blue-700" href="<?= base_url('user/login') ?>"> <?php echo lang('front.btn_login')?></a>
                    <?php } ?>
                </div> 
            </div>
        </header>