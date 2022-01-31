 <?php 
 $settings = DB::table('settings')->where('id',1)->first();

 $title = $settings->app_name ?? '';

 ?>
 <!doctype html>
    <html lang="en">
    <head>
        
        <meta charset="utf-8" />
        <title>Login | {{$title}} - Admin</title>
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <meta content="Premium Multipurpose Admin & Dashboard Template" name="description" />
        <meta content="Themesbrand" name="author" />
        <!-- App favicon -->
        <link rel="shortcut icon" href="{{asset('public/assets/images/logo-sm.png')}}">

        <!-- Bootstrap Css -->
        <link href="{{asset('public/assets/css/bootstrap.min.css')}}" id="bootstrap-style" rel="stylesheet" type="text/css" />
        <!-- Icons Css -->
        <link href="{{asset('public/assets/css/icons.min.css')}}" rel="stylesheet" type="text/css" />
        <!-- App Css-->
        <link href="{{asset('public/assets/css/app.min.css')}}" id="app-style" rel="stylesheet" type="text/css" />

    </head>

    <body data-layout="horizontal" data-topbar="dark">

        <div class="authentication-bg min-vh-100">
            <div class="bg-overlay"></div>
            <div class="container">
                <div class="d-flex flex-column min-vh-100 px-3 pt-4">
                    <div class="row justify-content-center my-auto">
                        <div class="col-md-8 col-lg-6 col-xl-5">

                         <div class="text-center mb-4">
                            <a href="{{url('/admin')}}">
                                <img src="{{asset('public/assets/images/logo-sm.png')}}" alt="" height="50"> <span class="logo-txt">{{$title}}</span>
                            </a>
                        </div>

                        <div class="card">
                            <div class="card-body p-4"> 
                                <div class="text-center mt-2">
                                    <h5 class="text-primary">Welcome Back !</h5>
                                    <p class="text-muted">Sign in to continue to {{$title}}.</p>
                                </div>
                                <div class="p-2 mt-4">
                                 <form class="row g-3" action="{{url('admin/login')}}" method="post">
                                  {{ csrf_field() }}
                                  <div class="mb-3">
                                    <label class="form-label" for="email">Email</label>
                                    <input type="text" class="form-control" id="email" name="email" placeholder="Enter Email">
                                </div>
                                
                                <div class="mb-3">
                                    <div class="float-end">
                                        <a href="{{route('admin.forgot')}}" class="text-muted">Forgot password?</a>
                                    </div>
                                    <label class="form-label" for="password">Password</label>
                                    <input type="password" class="form-control" name="password" id="password" placeholder="Enter password">
                                </div>
                                
                                <div class="form-check">
                                    <input type="checkbox" class="form-check-input" id="auth-remember-check">
                                    <label class="form-check-label" for="auth-remember-check">Remember me</label>
                                </div>
                                
                                <div class="mt-3 text-end">
                                    <button class="btn btn-primary w-sm waves-effect waves-light" type="submit">Log In</button>
                                </div>

                                
                            </form>
                        </div>
                        
                    </div>
                </div>

            </div><!-- end col -->
        </div><!-- end row -->


    </div>
</div><!-- end container -->
</div>

<!-- JAVASCRIPT -->
<script src="{{asset('public/assets/libs/bootstrap/js/bootstrap.bundle.min.js')}}"></script>
<script src="{{asset('public/assets/libs/metismenujs/metismenujs.min.js')}}"></script>
<script src="{{asset('public/assets/libs/simplebar/simplebar.min.js')}}"></script>
<script src="{{asset('public/assets/libs/feather-icons/feather.min.js')}}"></script>

</body>

</html>
