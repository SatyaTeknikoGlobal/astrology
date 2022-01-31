  <?php 
  $settings = DB::table('settings')->where('id',1)->first();

  $title = $settings->app_name ?? '';

  ?>

<!doctype html>
  
<html lang="en">
<head>

    <meta charset="utf-8" />
    <title>Dashboard | {{$title}}</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta content="Premium Multipurpose Admin & Dashboard Template" name="description" />
    <meta content="Themesbrand" name="author" />
    <!-- App favicon -->
    <link rel="shortcut icon" href="{{ asset('public/assets/images/logo-sm.png')}}">

        <!-- choices css -->
    <link href="{{ asset('public/assets/libs/choices.js/public/assets/styles/choices.min.css')}}" rel="stylesheet" type="text/css" />

       <link rel="stylesheet" href="{{ asset('public/assets/libs/flatpickr/flatpickr.min.css')}}">

    <!-- Bootstrap Css -->
    <link href="{{ asset('public/assets/css/bootstrap.min.css')}}" id="bootstrap-style" rel="stylesheet" type="text/css" />
    <!-- Icons Css -->
    <link href="{{ asset('public/assets/css/icons.min.css')}}" rel="stylesheet" type="text/css" />
    <!-- App Css-->
    <link href="{{ asset('public/assets/css/app.min.css')}}" id="app-style" rel="stylesheet" type="text/css" />
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>

      <script src="https://cdn.jsdelivr.net/npm/jquery@3.5.1/dist/jquery.slim.min.js"></script>
  <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.1/dist/umd/popper.min.js"></script>
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.1/dist/js/bootstrap.bundle.min.js"></script>
    
    <link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />
<script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">



</head>
<style type="text/css">
        body[data-layout=horizontal] .page-content {
            margin-top: 17px;
            /* margin-bottom: 16px; */
            padding: 20px 0 0 0;
            padding: 20px 0 60px 0;
    }
    .pager {
        padding-left: 0;
        margin: 20px 0;
        text-align: center;
        list-style: none;
    }
    .pager li {
        display: inline;
    }.pager li>a, .pager li>span {
        display: inline-block;
        padding: 5px 14px;
        background-color: #fff;
        border: 1px solid #ddd;
        border-radius: 15px;
    }

    a {
        color: #337ab7;
        text-decoration: none;
    }
</style>


<?php
$storage = Storage::disk('public');


$path = 'user/';

$imageUrl = asset('public/assets/images/avatars/avatar.png');
$image_name = Auth::guard('admin')->user()->image;
 if($storage->exists($path.$image_name)){
    $imageUrl =  url('public/storage/'.$path.'/'.$image_name);
 }

?>
     

<body data-layout="horizontal" data-topbar="dark" class="">

<!-- Begin page -->
<div id="layout-wrapper">


        <header id="page-topbar" class="ishorizontal-topbar" style="display: block;">
                <div class="navbar-header">
                    <div class="d-flex active">
                        <!-- LOGO -->
                        <div class="navbar-brand-box">
                            <a href="{{url('/admin')}}" class="logo logo-dark">
                                <span class="logo-sm">
                                    <img src="{{ asset('public/assets/images/logo-sm.png')}}" alt="" height="50">
                            </span>
                            <span class="logo-lg">
                                    <img src="{{ asset('public/assets/images/logo-sm.png')}}" alt="" height="50"> <span class="logo-txt">{{$title}}</span>
                            </span>
                    </a>

                    <a href="{{url('/admin')}}" class="logo logo-light">
                        <span class="logo-sm">
                            <img src="{{ asset('public/assets/images/logo-sm.png')}}" alt="" height="50">
                    </span>
                    <span class="logo-lg">
                            <img src="{{ asset('public/assets/images/logo-sm.png')}}" alt="" height="50"> <span class="logo-txt">{{$title}}</span>
                    </span>
            </a>
    </div>

@include('admin.common.sidebar')