<?php echo $__env->make('admin.common.header', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>

<?php
$BackUrl = CustomHelper::BackUrl();
// $SADMIN_ROUTE_NAME = CustomHelper::getAdminRouteName();

$routeName = CustomHelper::getAdminRouteName();
$storage = Storage::disk('public');
$path = 'influencer/';

$batch_id = isset($batches->id) ? $batches->id : '';
$course_id = isset($batches->course_id) ? $batches->course_id : '';
$category_id = isset($batches->category_id) ? $batches->category_id : '';
$batch = isset($batches->batch) ? $batches->batch : '';



?>


<div class="page-wrapper">
  <div class="page-content">
    <!--breadcrumb-->
    <div class="page-breadcrumb d-none d-sm-flex align-items-center mb-3">
      <div class="breadcrumb-title pe-3"><?php echo e($page_Heading); ?></div>
      <div class="ps-3">
        <nav aria-label="breadcrumb">
          <ol class="breadcrumb mb-0 p-0">
            <li class="breadcrumb-item"><a href="javascript:;"><i class="bx bx-home-alt"></i></a>
            </li>
            <li class="breadcrumb-item active" aria-current="page"><?php echo e($page_Heading); ?></li>
          </ol>
        </nav>
      </div>
      <div class="ms-auto">
        <div class="btn-group">

          <?php if(request()->has('back_url')){ $back_url= request('back_url');  ?>
                            <a href="<?php echo e(url($back_url)); ?>" class="btn btn-info btn-sm" style='float: right;'>Back</a><?php } ?>
        </div>


      </div>
    </div>
  </div>
  <!--end breadcrumb-->
  <div class="row">
    <div class="col-xl-9 mx-auto">
      <h6 class="mb-0 text-uppercase"><?php echo e($page_Heading); ?></h6>
      <hr/>
        <?php echo $__env->make('snippets.errors', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
            <?php echo $__env->make('snippets.flash', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>

      <form class="card-body" action="" method="post" accept-chartset="UTF-8" enctype="multipart/form-data" role="form">

        <?php echo e(csrf_field()); ?>


        <input type="hidden" id="batch_id" value="<?php echo e($batch_id); ?>">

        <div class="card">
          <div class="card-body"> 

            <div class="form-group row">
            <label class="col-md-3 col-form-label">Category <span class="text-danger">*</span></label>
            <div class="col-md-7">
              <select id="category_id" name="category_id" class="form-control mb-3">
                <option value="" selected disabled>Select Category</option>
                <?php foreach($category as $cat){ ?>
                <option value="<?php echo e($cat->id); ?>"><?php echo e($cat->category_name); ?></option>
                <?php } ?>
               
              </select>
            </div>
        </div>         
           

            <div class="form-group row">
              <label class="col-md-3 col-form-label">Course</label>
              <div class="col-md-7">
                <select class="form-control mb-3" name="course_id" id="course_id">

                    <option value="" selected disabled>Select Course</option>                  
                  <option value=""></option>
                
                </select>
              </div>
          </div>



            <div class="form-group row">
            <label class="col-md-3 col-form-label">Batch<span class="text-danger">*</span></label>
            <div class="col-md-7"><input type="text" class="form-control mb-3" name="batch" value="<?php echo e(old('batch',$batch)); ?>" id="batch" placeholder="Enter Batch" aria-label="default input example"></div>
        </div>

          

           <div class="form-group row">
            <label class="col-md-3 col-form-label">Upload Image<span class="text-danger">*</span></label>
            <div class="col-md-7"><input type="file" class="form-control mb-3" name="image" value="" id="image" placeholder="Course Duration" aria-label="default input example"></div>
         </div>

        

           
         </div>
         <button type="submit" class="btn btn-success btn-md">Submit</button>
       </div>
     </form>
   </div>
 </div>
 <!--end row-->
</div>
</div>



<?php echo $__env->make('admin.common.footer', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>

<script type="text/javascript">
    $(document).ready(function() {
       $('.ckeditor').ckeditor();
    });

    $('#category_id').on('change',function() {
        
        var _token = '<?php echo e(csrf_token()); ?>';
        var category_id = this.value;
        // alert("category_id = "+category_id);

        $.ajax({
          url: "<?php echo e(route($routeName.'.batch.get_courses')); ?>",
            type: "POST",
            data: {category_id:category_id},
            dataType:"HTML",
            headers:{'X-CSRF-TOKEN': _token},
            cache: false,
            success: function(resp){

               $('#course_id').html(resp);
           }
       });

    })




</script>


<?php /**PATH /home/appmantr/public_html/nayaeducation/resources/views/admin/batch/form.blade.php ENDPATH**/ ?>