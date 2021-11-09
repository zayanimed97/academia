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
        <link rel="shortcut icon" href="<?php echo base_url('UBold_v4.1.0')?>/assets/images/favicon.ico">
		<link href="<?php echo base_url('UBold_v4.1.0')?>/assets/css/bootstrap.min.css" rel="stylesheet" type="text/css" id="bs-default-stylesheet" />
		<link href="<?php echo base_url('UBold_v4.1.0')?>/assets/css/app.min.css" rel="stylesheet" type="text/css" id="app-default-stylesheet" />
		<link href="<?php echo base_url('UBold_v4.1.0')?>/assets/css/bootstrap-dark.min.css" rel="stylesheet" type="text/css" id="bs-dark-stylesheet" />
		<link href="<?php echo base_url('UBold_v4.1.0')?>/assets/css/app-dark.min.css" rel="stylesheet" type="text/css" id="app-dark-stylesheet" />
		<link href="<?php echo base_url('UBold_v4.1.0')?>/assets/css/icons.min.css" rel="stylesheet" type="text/css" />
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
                        <h4 class="mt-0">Sign In Superadmin</h4>
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
                        

<?php $attributes = ['class' => 'form-input-flat', 'id' => 'myform','method'=>'post'];
					echo form_open( base_url('superadmin/login'), $attributes);?>


                                    <div class="form-group mb-3">
                                        <label for="emailaddress"><?php echo lang('app.field_email')?></label>
										<?php 
					$data = [
							'type'  => 'text',
							'name'  => 'email',
							'id'    => 'email',
							'placeholder' =>'Email',
							'class' => 'form-control'
					];

					echo form_input($data);
					?>
                                       
                                    </div>

                                    <div class="form-group mb-3">
										<a href="<?php echo base_url('forgotPassword')?>" class="text-muted float-right"><small><?php echo lang('app.help_forgot_password')?></small></a>
                                        <label for="password"><?php echo lang('app.field_password')?></label>
                                        <div class="input-group input-group-merge">
                                            <?php 
												$data = [
														'type'  => 'password',
														'name'  => 'password',
														'id'    => 'password',
														'placeholder' =>lang('app.field_password'),
														'class' => 'form-control input-lg'
												];

												echo form_input($data);
												?>
                                            <div class="input-group-append" data-password="false">
                                                <div class="input-group-text">
                                                    <span class="password-eye"></span>
                                                </div>
                                            </div>
                                        </div>
                                    </div>

                                   

                                    <div class="form-group mb-0 text-center">
									<?php $data = [
								'name'    => 'login',
								'id'      => 'login',
								'value'   => lang('app.btn_login'),
								'type'    => 'submit',
								'class' => 'btn btn-primary btn-block'
						];
							echo form_submit($data);?>
                                      
                                    </div>

                                <?php echo form_close();?>






















                        <!--form action="#">
                            <div class="form-group">
                                <label for="emailaddress">Email address</label>
                                <input class="form-control" type="email" id="emailaddress" required="" placeholder="Enter your email">
                            </div>
                            <div class="form-group">
                                <a href="auth-recoverpw-2.html" class="text-muted float-right"><small>Forgot your password?</small></a>
                                <label for="password">Password</label>
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
                                <div class="custom-control custom-checkbox">
                                    <input type="checkbox" class="custom-control-input" id="checkbox-signin">
                                    <label class="custom-control-label" for="checkbox-signin">Remember me</label>
                                </div>
                            </div>
                            <div class="form-group mb-0 text-center">
                                <button class="btn btn-primary btn-block" type="submit">Log In </button>
                            </div>
                        </form-->
                        
                        <footer class="footer footer-alt">
                            <?php echo view('admin/copyright')?>
                        </footer>

                    </div> <!-- end .card-body -->
                </div> <!-- end .align-items-center.d-flex.h-100-->
            </div>
            <!-- end auth-fluid-form-box-->

            <!-- Auth fluid right content -->
            <div class="auth-fluid-right text-center">
                <div class="auth-user-testimonial">
                    <!--h2 class="mb-3 text-white">I love the color!</h2>
                    <p class="lead"><i class="mdi mdi-format-quote-open"></i> I've been using your theme from the previous developer for our web app, once I knew new version is out, I immediately bought with no hesitation. Great themes, good documentation with lots of customization available and sample app that really fit our need. <i class="mdi mdi-format-quote-close"></i>
                    </p>
                    <h5 class="text-white">
                        - Fadlisaad (Ubold Admin User)
                    </h5-->
                </div> <!-- end auth-user-testimonial-->
            </div>
            <!-- end Auth fluid right content -->
        </div>
        <!-- end auth-fluid-->

        <!-- Vendor js -->
        <script src="<?php echo base_url('UBold_v4.1.0')?>/assets/js/vendor.min.js"></script>

        <!-- App js -->
        <script src="<?php echo base_url('UBold_v4.1.0')?>/assets/js/app.min.js"></script>
        
    </body>
</html>