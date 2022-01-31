<!doctype html>
<html lang="en">

<?php

$title = 'Astro';
?>

<head>
        
        <meta charset="utf-8" />
        <title>Dashboard | <?php echo e($title); ?></title>
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <meta content="Premium Multipurpose Admin & Dashboard Template" name="description" />
        <meta content="Themesbrand" name="author" />
        <!-- App favicon -->
        <link rel="shortcut icon" href="<?php echo e(asset('public/assets/images/favicon.ico')); ?>">

        <!-- Bootstrap Css -->
           <link href="<?php echo e(asset('public/assets/css/bootstrap.min.css')); ?>" rel="stylesheet" type="text/css" />
        <!-- Icons Css -->
        <link href="<?php echo e(asset('public/assets/css/icons.min.css')); ?>" rel="stylesheet" type="text/css" />
        <!-- App Css-->
        <link href="<?php echo e(asset('public/assets/css/app.min.css')); ?>" id="app-style" rel="stylesheet" type="text/css" />

    </head>

<style>
    
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

    //pr($storage);

$path = 'user/';

$imageUrl = asset('public/assets/images/avatars/avatar.png');
$image_name = Auth::guard('admin')->user()->image;
 if($storage->exists($path.$image_name)){

        $imageUrl =  url('storage/app/public/'.$path.'thumb/'.$image_name);

 }

?>

    <body data-layout="horizontal" data-topbar="dark">

        <!-- Begin page -->
        <div id="layout-wrapper">
            
     

<?php echo $__env->make('admin.common.sidebar', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /home/appmantr/public_html/astro.appmantra.live/resources/views/admin/common/header.blade.php ENDPATH**/ ?>