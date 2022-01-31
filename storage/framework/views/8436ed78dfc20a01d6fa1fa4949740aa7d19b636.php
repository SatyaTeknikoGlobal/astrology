<?php echo $__env->make('admin.common.header', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>

<?php
$BackUrl = CustomHelper::BackUrl();
$routeName = CustomHelper::getAdminRouteName();


$storage = Storage::disk('public');
$path = 'influencer/thumb/';
// $roleId = Auth::guard('admin')->user()->role_id; 

?>

<div class="content-page">
  <div class="content">

    <!-- Start Content-->
    <div class="container-fluid">

      <!-- start page title -->
      <div class="row">
        <div class="col-12">
          <div class="page-title-box">
            <div class="page-title-right">
              <ol class="breadcrumb m-0">
                <a href="" class="btn btn-primary"><i class="fas fa-file-export" aria-hidden="true"></i>Export</a>
                &nbsp;&nbsp;&nbsp;
                <a href="" class="btn btn-primary"><i class="fa fa-plus" aria-hidden="true"></i> Add User</a>
              </ol>
            </div>
            <h4 class="page-title">fdg</h4>
          </div>
        </div>
      </div>

      <div class="row">
        <div class="col-12">
          <div class="card">
            <div class="card-body">
              <div class="mb-3">
                <label class="form-label">Search By Name,Email,Phone</label>
                <form>
                  <div class="input-group">
                    <input type="text" name="search" value="" class="form-control" placeholder="Search...." aria-label="Recipient's username">
                    <button class="btn input-group-text btn-dark waves-effect waves-light" type="submit">Search</button>
                  </div>
                </form>
              </div>




            </div>
          </div>
        </div>
      </div>


      <?php echo $__env->make('snippets.errors', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
      <?php echo $__env->make('snippets.flash', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
      

      <!-- end page title --> 
      <div class="row">
        <div class="col-12">
          <div class="card">
            <div class="card-body">
              <h4 class="header-title">Users</h4>
              <table id="basic-datatable" class="table dt-responsive nowrap w-100">
                <thead>
                  <tr>

                    <th>#ID</th>
                    <th>Name</th>
                    <th>Email</th>                   
                    <th>Phone</th>
                    <th>Wallet</th>
                    <th>Dob</th>
                    <th>Gender</th>
                    <th>Image</th>                           
                    <th>Action</th>
                  </tr>
                </thead>
                <tbody>
               

                </tbody>


              </table>
            

            </div> <!-- end card body-->
          </div> <!-- end card -->
        </div><!-- end col-->
      </div>


    </div>
  </div>
</div>


<?php echo $__env->make('admin.common.footer', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>


<?php /**PATH /home/appmantr/public_html/astro.appmantra.live/resources/views/admin/user/index.blade.php ENDPATH**/ ?>