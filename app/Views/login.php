<?= view('admin/templates/meta.php'); ?>
<body class="authentication-bg">

        <div class="account-pages pt-2 my-2">
            <div class="container">
                <div class="row justify-content-center">
                    <div class="col-md-8 col-lg-6 col-xl-5">
                        <div class="account-card-box">
                            <div class="card mb-0">
                                <div class="card-body p-4">
                                    
                                    <div class="text-center">
                                        <div class="my-3">
                                            <a href="">
                                                <span><img src="<?= base_url() ?>/public/admin/assets\images\logo.png" alt="" height="28"></span>
                                            </a>
                                        </div>
                                        <h5 class="text-muted text-uppercase py-3 font-16">Sign In</h5>
                                    </div>
    
                                    <form  class="mt-2" id="admin_login">
    
                                        <div class="form-group mb-3">
                                            <input class="form-control" type="text"  placeholder="Enter your username" id="username">
                                        </div>
    
                                        <div class="form-group mb-3">
                                            <input class="form-control" type="password"  id="password" placeholder="Enter your password">
                                        </div>
    
                                        <div class="form-group mb-3">
                                            <div class="custom-control custom-checkbox">
                                                <input type="checkbox" class="custom-control-input" id="checkbox-signin" checked="">
                                                <label class="custom-control-label" for="checkbox-signin">Remember me</label>
                                            </div>
                                        </div>
                                        
                                        <div class="form-group text-center">
                                            <button class="btn btn-success btn-block waves-effect waves-light" type="submit" id="submit"> Log In </button>
                                        </div>
                                        <p class="text-center">Chưa có tài khoản vui lòng<a href="registration" class="text-danger"> Đăng Kí</a> </p>
                                        <div class="alert " role="alert" id="error"></div>
                                    </form>
                                    <div class="text-center ">
                                        <h5 class="text-muted py-2"><b>Sign in with</b></h5>

                                        <div class="row">
                                            <div class="col-12">
                                                <a href="<?=$loginfb; ?>" class="btn btn-facebook waves-effect font-14 waves-light mt-3">
                                                    <i class="fab fa-facebook-f mr-1"></i> Facebook
                                                </a>
            
                                                <button type="button" class="btn btn-twitter waves-effect font-14 waves-light mt-3">
                                                    <i class="fab fa-twitter mr-1"></i> Twitter
                                                </button>
            
                                                <a href="<?= $logingg; ?>" class="btn btn-googleplus waves-effect font-14 waves-light mt-3">
                                                    <i class="fab fa-google-plus-g mr-1"></i> Google+
                                                </a>
                                            </div>
                                        </div>
                                    </div>
                                    
    
                                </div> <!-- end card-body -->
                            </div>
                            <!-- end card -->
                        </div>

                        
                        <!-- end row -->

                    </div> <!-- end col -->
                </div>
                <!-- end row -->
            </div>
            <!-- end container -->
        </div>
        <!-- end page -->
<?= view('admin/templates/footer.php'); ?>

