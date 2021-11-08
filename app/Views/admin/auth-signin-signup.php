<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8" />
        <title>Auth Pages | Create Account | Sign In | UBold - Responsive Admin Dashboard Template</title>
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

    <body class="loading authentication-bg authentication-bg-pattern">

        <div class="account-pages mt-5 mb-5">
            <div class="container">
                <div class="row justify-content-center">
                    <div class="col-xl-10">
                        <div class="card bg-pattern">

                            <div class="card-body p-4">
                                
                                <div class="text-center mb-4">
                                    <div class="auth-logo">
                                        <a href="index.html" class="logo logo-dark text-center">
                                            <span class="logo-lg">
                                                <img src="../assets/images/logo-dark.png" alt="" height="22">
                                            </span>
                                        </a>
                    
                                        <a href="index.html" class="logo logo-light text-center">
                                            <span class="logo-lg">
                                                <img src="../assets/images/logo-light.png" alt="" height="22">
                                            </span>
                                        </a>
                                    </div>
                                </div>

                                <div class="row">
                                    <div class="col-lg-6">
                                        <div class="p-sm-3">
                                            <!-- title-->
                                            <h4 class="mt-0">Sign In</h4>
                                            <p class="text-muted mb-4">Enter your email address and password to access account.</p>
                                            <form action="#">
                                                <div class="form-group mb-3">
                                                    <label for="emailaddress">Email address</label>
                                                    <input class="form-control" type="email" id="emailaddress" required="" placeholder="Enter your email">
                                                </div>
            
                                                <div class="form-group mb-3">
                                                    <a href="auth-recoverpw.html" class="text-muted font-13 float-right">Forgot your password?</a>
                                                    <label for="password">Password</label>
                                                    <input class="form-control" type="password" required="" id="password" placeholder="Enter your password">
                                                </div>
            
                                                <div class="form-group mb-3">
                                                    <button class="btn btn-primary btn-sm float-sm-right" type="submit"> Log In </button>
                                                    <div class="custom-control custom-checkbox pt-1">
                                                        <input type="checkbox" class="custom-control-input" id="checkbox-signin" checked>
                                                        <label class="custom-control-label" for="checkbox-signin">Remember me</label>
                                                    </div>
                                                </div>
    
                                            </form>
                                        </div>
                                    </div> <!-- end col -->

                                    <div class="col-lg-6">
                                        <div class="p-sm-3">
                                            <h4 class="mt-3 mt-lg-0">Free Sign Up</h4>
                                            <p class="text-muted mb-4">Don't have an account? Create your account, it takes less than a minute</p>

                                            <form action="#">
                                                <div class="form-group mb-3">
                                                    <label for="fullname">Full Name</label>
                                                    <input class="form-control" type="text" id="fullname" placeholder="Enter your name" required>
                                                </div>
                                                <div class="form-group mb-3">
                                                    <label for="emailaddress2">Email address</label>
                                                    <input class="form-control" type="email" id="emailaddress2" required placeholder="Enter your email">
                                                </div>
                                                <div class="form-group mb-3">
                                                    <label for="password2">Password</label>
                                                    <input class="form-control" type="password" required id="password2" placeholder="Enter your password">
                                                </div>
                                                <div class="form-group mb-0">
                                                    <button class="btn btn-success btn-sm float-sm-right" type="submit"> Sign Up </button>
                                                    <div class="custom-control custom-checkbox pt-1">
                                                        <input type="checkbox" class="custom-control-input" id="checkbox-signup">
                                                        <label class="custom-control-label" for="checkbox-signup">I accept <a href="javascript: void(0);" class="text-dark">Terms and Conditions</a></label>
                                                    </div>
                                                </div>
                                            </form>
                                        </div>
                                        
                                    </div> <!-- end col -->
                                </div>
                                <!-- end row-->

                            </div> <!-- end card-body -->
                        </div>
                        <!-- end card -->

                    </div> <!-- end col -->
                </div>
                <!-- end row -->
            </div>
            <!-- end container -->
        </div>
        <!-- end page -->

        <footer class="footer footer-alt">
            2015 - <script>document.write(new Date().getFullYear())</script> &copy; UBold theme by <a href="" class="text-white-50">Coderthemes</a> 
        </footer>

        <!-- Vendor js -->
        <script src="../assets/js/vendor.min.js"></script>

        <!-- App js -->
        <script src="../assets/js/app.min.js"></script>
        
    </body>
</html>