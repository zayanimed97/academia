<!DOCTYPE html>
<!--[if IE 8]> <html lang="en" class="ie8"> <![endif]-->
<!--[if !IE]><!-->
<html lang="en">
<!--<![endif]-->
<head>
	<meta charset="utf-8" />
	<title>ERRORE | <?php echo $settings['meta_title']?></title>
	<meta content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no" name="viewport" />
	<meta content="" name="description" />
	<meta content="" name="author" />
	
	<!-- ================== BEGIN BASE CSS STYLE ================== -->
	<link href="http://fonts.googleapis.com/css?family=Nunito:400,300,700" rel="stylesheet" id="fontFamilySrc" />
	<link href="<?php echo base_url()?>/temp_admin/assets/plugins/jquery-ui/jquery-ui.min.css" rel="stylesheet" />
	<link href="<?php echo base_url()?>/temp_admin/assets/plugins/bootstrap/bootstrap-4.1.1/css/bootstrap.min.css" rel="stylesheet" />
	<link href="<?php echo base_url()?>/temp_admin/assets/plugins/font-awesome/5.1/css/all.css" rel="stylesheet" />
	<link href="<?php echo base_url()?>/temp_admin/assets/css/animate.min.css" rel="stylesheet" />
	<link href="<?php echo base_url()?>/temp_admin/assets/css/style.min.css" rel="stylesheet" />
	<!-- ================== END BASE CSS STYLE ================== -->
    
	<!-- ================== BEGIN BASE JS ================== -->
	<script src="<?php echo base_url()?>/temp_admin/assets/plugins/pace/pace.min.js"></script>
	<!-- ================== END BASE JS ================== -->
	
	<!--[if lt IE 9]>
	    <script src="<?php echo base_url()?>/temp_admin/assets/crossbrowserjs/excanvas.min.js"></script>
	<![endif]-->
</head>
<body class="pace-top">
	<!-- begin #page-loader -->
	<div id="page-loader" class="page-loader fade in"><span class="spinner"><?php echo  lang('app.loading')?></span></div>
	<!-- end #page-loader -->

	<!-- begin #page-container -->
	<div id="page-container" class="fade page-container">
	    <!-- begin login -->
		<div class="login">
		    <!-- begin login-brand -->
            <div class="login-brand bg-inverse text-white">
                <img src="<?php echo base_url()?>/temp_admin/assets/img/logo-white.png" height="36" class="pull-right" alt="" /> <?php echo  lang('app.title_page_error')?>
            </div>
		    <!-- end login-brand -->
		    <!-- begin login-content -->
            <div class="login-content">
                <!--h4 class="text-center m-t-0 m-b-20"><?php echo  lang('app.welcome')?></h4-->
				
             <?php //echo $validation->listErrors()
			 if(isset($validation)){?>
			 <div class="alert alert-danger" role="alert">
				 <?php echo $validation->listErrors()?>
				</div>
			 <?php }?>
			 <?php //echo $validation->listErrors()
			 if(isset($error)){?>
			 <div class="alert alert-danger" role="alert">
				 <?php echo $error?>
				</div>
			 <?php }?>
				
                  
                    <div class="text-center">
                      <a href="<?php echo base_url()?>" class="text-muted"><?php echo  lang('app.btn_login')?></a>
                    </div>
             
            </div>
		    <!-- end login-content -->
		</div>
		<!-- end login -->
	</div>
	<!-- end page container -->
	
    <!-- begin theme-panel -->
  
    <!-- end theme-panel -->
	
	<!-- ================== BEGIN BASE JS ================== -->
	<script src="<?php echo base_url()?>/temp_admin/assets/plugins/jquery/jquery-3.3.1.min.js"></script>
	<script src="<?php echo base_url()?>/temp_admin/assets/plugins/jquery-ui/jquery-ui.min.js"></script>
	<script src="<?php echo base_url()?>/temp_admin/assets/plugins/bootstrap/bootstrap-4.1.1/js/bootstrap.bundle.min.js"></script>
	<!--[if lt IE 9]>
		<script src="<?php echo base_url()?>/temp_admin/assets/crossbrowserjs/html5shiv.js"></script>
		<script src="<?php echo base_url()?>/temp_admin/assets/crossbrowserjs/respond.min.js"></script>
	<![endif]-->
	<script src="<?php echo base_url()?>/temp_admin/assets/plugins/slimscroll/jquery.slimscroll.min.js"></script>
	<script src="<?php echo base_url()?>/temp_admin/assets/plugins/jquery-cookie/jquery.cookie.js"></script>
	<!-- ================== END BASE JS ================== -->
	
	<!-- ================== BEGIN PAGE LEVEL JS ================== -->
    <script src="<?php echo base_url()?>/temp_admin/assets/js/demo.min.js"></script>
    <script src="<?php echo base_url()?>/temp_admin/assets/js/apps.min.js"></script>
	<!-- ================== END PAGE LEVEL JS ================== -->
	
	<script>
		$(document).ready(function() {
		    App.init();
		    Demo.initThemePanel();
		});
	</script>
</body>
</html>
