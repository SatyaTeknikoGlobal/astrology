<?php echo $__env->make('admin.common.header', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>

<?php
$BackUrl = CustomHelper::BackUrl();
$routeName = CustomHelper::getAdminRouteName();
$old_name = (request()->has('name'))?request()->name:'';


?>

<div class="page-wrapper">
  <div class="container-fluid">
    <div class="row page-titles">
      <div class="col-md-5 align-self-center">
        <h4 class="text-themecolor">City List</h4>
      </div>
      <div class="col-md-7 align-self-center text-end">
        <div class="d-flex justify-content-end align-items-center">
          <ol class="breadcrumb justify-content-end">
            <li class="breadcrumb-item"><a href="javascript:void(0)">Home</a></li>
            <li class="breadcrumb-item active">City List</li>
          </ol>
          <a href="<?php echo e(url($routeName.'/cities/save')); ?>"><button type="button" class="btn btn-info d-none d-lg-block m-l-15 text-white"><i
            class="fa fa-plus-circle"></i> Create New</button></a>
          </div>
        </div>
      </div>

      <div class="row">
        <div class="col-12">
          <!-- table responsive -->

          <?php echo $__env->make('snippets.errors', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
          <?php echo $__env->make('snippets.flash', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
          <div class="card">
            <div class="card-body">
              <h4 class="card-title">City List</h4>
              <div class="table-responsive m-t-40">
                <table id="examplestate" class="table display table-striped border no-wrap">
                  <thead>
                    <tr>
                     <th class="">S.No</th>

                     <th class="">Name</th>
                     <th class="">Country Name </th>
                     <th class="">StateName </th>
                     <th class="">Status</th>
                     <th class="">Action</th>

                   </tr>
                 </thead>
                 <tbody>

                   <?php if(!empty($cities) && $cities->count() > 0){
                    $i = 1;
                    foreach ($cities as $city){

                       $countryname = $city->cityCountry->name;

                     $cityState = (isset($city->cityState))?$city->cityState:'';
                     $stateName = (isset($cityState->name))?$cityState->name:'';


                     ?>
                     <tr>
                      <td><?php echo e($i++); ?></td>
                      <td><?php echo e($countryname); ?></td>
                      <td><?php echo e($city->name); ?></td>
                      <td><?php echo e($stateName); ?></td>
                      <td><?php  echo ($city->status==1)?'Active':'Inactive';  ?></td>
                      <td>
                        <a href="<?php echo e(route($routeName.'.cities.save', ['id'=>$city->id,'back_url'=>$BackUrl])); ?>" title="Edit"><i class="fas fa-edit"></i></a>
                      </td>

                    </tr>

                  <?php }}?>

                </tbody>

              </table>

               <?php echo e($cities->appends(request()->input())->links('admin.pagination')); ?>

            </div>
          </div>
        </div>
      </div>
    </div>


  </div>
</div>




<?php echo $__env->make('admin.common.footer', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>

<?php /**PATH /home/appmantr/public_html/astro.appmantra.live/resources/views/admin/cities/index.blade.php ENDPATH**/ ?>