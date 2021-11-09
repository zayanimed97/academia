<!DOCTYPE html>
<html lang="it">
    <head>
        <meta charset="utf-8" />
        <title>Log In | <?php echo $settings['meta_title']?></title>
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <meta content="" name="description" />
        <meta content="Sam Benia" name="author" />
        <meta http-equiv="X-UA-Compatible" content="IE=edge" />
        <?= csrf_meta() ?>
        <link rel="shortcut icon" href="<?php echo base_url('UBold_v4.1.0/Admin/dist')?>/assets/images/favicon.ico">
		<link href="<?php echo base_url('UBold_v4.1.0/Admin/dist')?>/assets/css/bootstrap.min.css" rel="stylesheet" type="text/css" id="bs-default-stylesheet" />
		<link href="<?php echo base_url('UBold_v4.1.0/Admin/dist')?>/assets/css/app.min.css" rel="stylesheet" type="text/css" id="app-default-stylesheet" />
		<link href="<?php echo base_url('UBold_v4.1.0/Admin/dist')?>/assets/css/bootstrap-dark.min.css" rel="stylesheet" type="text/css" id="bs-dark-stylesheet" />
		<link href="<?php echo base_url('UBold_v4.1.0/Admin/dist')?>/assets/css/app-dark.min.css" rel="stylesheet" type="text/css" id="app-dark-stylesheet" />
		<link href="<?php echo base_url('UBold_v4.1.0/Admin/dist')?>/assets/css/icons.min.css" rel="stylesheet" type="text/css" />
    </head>

    <body class="loading auth-fluid-pages pb-0">

        <div class="auth-fluid">
            <div class="auth-fluid-form-box">
                <div class="align-items-center d-flex h-100">
                    <div class="card-body">
                        <div class="auth-brand text-center text-lg-left">
                            <div class="auth-logo">
                                <a href="<?php echo base_url()?>" class="logo logo-dark text-center">
                                    <span class="logo-lg">
                                        <img src="<?php echo base_url('uploads/'.$settings['logo'])?>" alt="" height="80" style="margin-left: -20px;">
                                    </span>
                                    <?php //echo  lang('app.welcome')?>
                                </a>
            
                                <a href="<?php echo base_url()?>" class="logo logo-light text-center">
                                    <?php echo  lang('app.welcome')?>
                                </a>
                            </div>
                        </div>
                        <h4 class="mt-0"><?php echo lang('app.title_page_forgot')?></h4>
                        <!--p class="text-muted mb-4">Enter your email address and password to access account.</p-->

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
<?php //echo $validation->listErrors()
    if(isset($success)){?>
    <div class="alert alert-success" role="alert">
        <?php echo $success?>
    </div>
<?php }?>
				<?php $attributes = ['class' => 'form-input-flat', 'id' => 'myform','method'=>'post'];
					echo form_open( base_url().'/forgotPassword', $attributes);?>

                    <div class="form-group mb-3">
                       <label for="emailaddress"><?php echo lang('app.field_email')?></label>
					<?php 
					$data = [
							'type'  => 'text',
							'name'  => 'email',
							'id'    => 'email',
							'placeholder' =>'Email',
							'class' => 'form-control input-lg'
					];

					echo form_input($data);
					?>
                      
                    </div>
                     <div class="form-group mb-0 text-center">
					<?php $data = [
								'name'    => 'recuperate',
								'id'      => 'recuperate',
								'value'   => lang('app.btn_recover'),
								'type'    => 'submit',
								'class' => 'btn btn-primary btn-block'
						];
							echo form_submit($data);?>
                         
                        
                      <a href="<?php echo base_url('login')?>" ><?php echo  lang('app.btn_login')?></a>
                    </div>
               <?php echo form_close();?>
           <footer class="footer footer-alt">
                            <?php echo view('copyright')?>
                        </footer>

                    </div> <!-- end .card-body -->
                </div> <!-- end .align-items-center.d-flex.h-100-->
            </div>
            <!-- end auth-fluid-form-box-->

            <!-- Auth fluid right content -->
            <div class="auth-fluid-right text-center">
                <div class="auth-user-testimonial">
                    <h2 class="mb-3 text-white">I love the color!</h2>
                    <p class="lead"><i class="mdi mdi-format-quote-open"></i> I've been using your theme from the previous developer for our web app, once I knew new version is out, I immediately bought with no hesitation. Great themes, good documentation with lots of customization available and sample app that really fit our need. <i class="mdi mdi-format-quote-close"></i>
                    </p>
                    <h5 class="text-white">
                        - Fadlisaad (Ubold Admin User)
                    </h5>
                </div> <!-- end auth-user-testimonial-->
            </div>
            <!-- end Auth fluid right content -->
        </div>
        <!-- end auth-fluid-->

        <!-- Vendor js -->
        <script src="<?php echo base_url('UBold_v4.1.0/Admin/dist')?>/assets/js/vendor.min.js"></script>

        <!-- App js -->
        <script src="<?php echo base_url('UBold_v4.1.0/Admin/dist')?>/assets/js/app.min.js"></script>
        
    </body>
</html>
