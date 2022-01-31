<?php echo $__env->make('admin.common.header', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
<?php
$back_url = (request()->has('back_url'))?request()->input('back_url'):'';
if(empty($back_url)){
    $back_url = 'admin/states';
}

$name = (isset($rec->name))?$rec->name:'';
$country_id = (isset($rec->country_id))?$rec->country_id:'';

$state_id = (isset($rec->id))?$rec->id:'';
$image = (isset($rec->img))?$rec->img:'';
$status = (isset($rec->status))?$rec->status:1;

$storage = Storage::disk('public');

    //pr($storage);

$path = 'states/';
?>


<div class="page-wrapper">
    <div class="container-fluid">
        <div class="row page-titles">
            <div class="col-md-5 align-self-center">
                <h4 class="text-themecolor"><?php echo e($page_heading); ?></h4>
            </div>
            <div class="col-md-7 align-self-center text-end">
                <div class="d-flex justify-content-end align-items-center">
                    <ol class="breadcrumb justify-content-end">
                        <li class="breadcrumb-item"><a href="javascript:void(0)">Home</a></li>
                        <li class="breadcrumb-item active"><?php echo e($page_heading); ?></li>
                    </ol>
                    <?php if(request()->has('back_url')){ $back_url= request('back_url');  ?>
                    <a href="<?php echo e(url($back_url)); ?>"><button type="button" class="btn btn-info d-none d-lg-block m-l-15 text-white"><i
                        class="fa fa-arrow-left"></i>  Back</button></a>
                        <?php } ?>
                    </div>
                </div>
            </div>

            <div class="row">
                <div class="col-12">
                      <?php echo $__env->make('snippets.errors', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
                    <?php echo $__env->make('snippets.flash', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
                    <!-- table responsive -->
                    <div class="card">
                       <div class="card-body">
                                <h4 class="card-title"><?php echo e($page_heading); ?></h4>
                                 <form method="POST" action="" accept-charset="UTF-8" enctype="multipart/form-data" role="form" class="mt-4">
                                <?php echo e(csrf_field()); ?>


                                <div class="form-group">
                                     <label for="exampleInputEmail1" class="form-label">Country Name</label>
                                     <select name="country_id" id="country_id" class="form-control select2">
                                         
                                         <?php                                           

                                            foreach($countries as $country)
                                            {

                                         ?>

                                         <option value="<?php echo e($country->id); ?>"><?php echo e($country->name); ?></option>

                                     <?php } ?>
                                     </select>
                                </div>

                               <input type="hidden" name="id" value="<?php echo e($state_id); ?>">
                                    <div class="form-group">
                                        <label for="exampleInputEmail1" class="form-label">State Name</label>
                                        <input type="text" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp" placeholder="Enter State Name" name="name" value="<?php echo e(old('name', $name)); ?>">
                                         <?php echo $__env->make('snippets.errors_first', ['param' => 'name'], \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
                                    </div>
                                    <div class="form-group">
                                        <label for="exampleInputPassword1" class="form-label">Status</label>
                                        Active: <input type="radio" name="status" value="1" <?php echo ($status == '1')?'checked':''; ?> checked>
                                        &nbsp;
                                        Inactive: <input type="radio" name="status" value="0" <?php echo ( strlen($status) > 0 && $status == '0')?'checked':''; ?> >

                                        <?php echo $__env->make('snippets.errors_first', ['param' => 'status'], \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
                                    </div>
                                   
                                    <button type="submit" class="btn btn-primary text-white">Submit</button>
                                </form>
                            </div>

                    </div>
                </div>
            </div>


        </div>
    </div>



<?php echo $__env->make('admin.common.footer', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
<?php /**PATH /home/appmantr/public_html/astro.appmantra.live/resources/views/admin/states/form.blade.php ENDPATH**/ ?>