<!doctype html>
<html lang="en">

  
<!-- Mirrored from creatantech.com/demos/codervent/rocker/vertical/authentication-signin by HTTrack Website Copier/3.x [XR&CO'2014], Fri, 17 Dec 2021 06:35:51 GMT -->
<!-- Added by HTTrack --><meta http-equiv="content-type" content="text/html;charset=UTF-8" /><!-- /Added by HTTrack -->
<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!--favicon-->
    <link rel="icon" href="<?php echo e(asset('public/assets/images/logo/logo.png')); ?>" type="image/png" />
    <!-- loader-->
   <!--  <link href="<?php echo e(asset('public/assets/css/pace.min.css')); ?>" rel="stylesheet" />
  <script src="<?php echo e(asset('public/assets/js/pace.min.js')); ?>"></script> -->
    <!-- Bootstrap CSS -->
    <link href="<?php echo e(asset('public/assets/css/bootstrap.min.css')); ?>" rel="stylesheet">
  <link href="https://fonts.googleapis.com/css2?family=Roboto:wght@400;500&amp;display=swap" rel="stylesheet">
     <link href="<?php echo e(asset('public/assets/css/app.min.css')); ?>" rel="stylesheet">
  <link href="<?php echo e(asset('public/assets/css/icons.min.css')); ?>" rel="stylesheet">
    <title>Sign In</title>
  </head>

<body class="bg-login">
  <!--wrapper-->
    <div class="wrapper">
        <div class="section-authentication-signin d-flex align-items-center justify-content-center my-5 my-lg-0">
            <div class="container-fluid">
                <div class="row row-cols-1 row-cols-lg-2 row-cols-xl-3">
                    <div class="col mx-auto">
                        <div class="mb-4 text-center d-flex">
                          <!-- <center><img class="logo-img" src="<?php echo e(asset('public/assets/images/logo/logo.png')); ?>" alt="logo" width="{conf.logoWidth}" height="100" width="100"><span class="splash-description"></center> -->
                          <!-- <img class="logo-img" src="<?php echo e(asset('public/assets/images/logo/text.png')); ?>" alt="logo" width="{conf.logoWidth}" height="100" width="100"> -->

                        </div>
                        <div class="card">
                            <div class="card-body">
                               <!--  <img class="logo-img" src="<?php echo e(asset('public/assets/images/logo-sm.png')); ?>" alt="logo" width="{conf.logoWidth}" style="width: 100%;height: auto;"> -->
                                <div class="border p-4 rounded">
                                    
                                    <div class="d-grid">
                                    </div>
                                    <div class="login-separater text-center mb-4"> <span>SIGN IN WITH EMAIL</span>
                                        <hr/>
                                    </div>
                                    <div class="form-body">
                                        <form class="row g-3" action="<?php echo e(url('admin/login')); ?>" method="post">

                                            <?php echo e(csrf_field()); ?>

                                            <div class="col-12">
                                                <label for="email" class="form-label">Email Address</label>
                                                <input type="email" class="form-control" name="email" id="email" placeholder="Email Address">
                                            </div>
                                            <div class="col-12">
                                                <label for="password" class="form-label">Enter Password</label>
                                                <div class="input-group" id="show_hide_password">
                                                    <input type="password" class="form-control border-end-0"  name="password" id="password" placeholder="Enter Password"> <a href="javascript:;" class="input-group-text bg-transparent"><i class='bx bx-hide'></i></a>
                                                </div>
                                            </div>
                                            <div class="col-md-6 text-end"> <a href="<?php echo e(route('admin.forgot')); ?>">Forgot Password ?</a>
                                            </div>
                                            <div class="col-12">
                                                <div class="d-grid">
                                                    <button type="submit" class="btn btn-primary"><i class="bx bxs-lock-open"></i>Sign in</button>
                                                </div>
                                            </div>
                                        </form>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <!--end row-->
            </div>
        </div>
    </div>
  <!--end wrapper-->

  <!--plugins-->
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>

    <script>
        $(document).ready(function () {
            $("#show_hide_password a").on('click', function (event) {
                event.preventDefault();
                if ($('#show_hide_password input').attr("type") == "text") {
                    $('#show_hide_password input').attr('type', 'password');
                    $('#show_hide_password i').addClass("bx-hide");
                    $('#show_hide_password i').removeClass("bx-show");
                } else if ($('#show_hide_password input').attr("type") == "password") {
                    $('#show_hide_password input').attr('type', 'text');
                    $('#show_hide_password i').removeClass("bx-hide");
                    $('#show_hide_password i').addClass("bx-show");
                }
            });
        });
    </script>
</body>


<!-- Mirrored from creatantech.com/demos/codervent/rocker/vertical/authentication-signin by HTTrack Website Copier/3.x [XR&CO'2014], Fri, 17 Dec 2021 06:35:52 GMT -->
</html>
<?php /**PATH /home/appmantr/public_html/astro.appmantra.live/resources/views/admin/login/index.blade.php ENDPATH**/ ?>