@include('admin.common.header')

<?php
$BackUrl = CustomHelper::BackUrl();
$routeName = CustomHelper::getAdminRouteName();


$storage = Storage::disk('public');
$path = 'live_class/';
// $roleId = Auth::guard('admin')->user()->role_id; 
$name = isset($user->name) ? $user->name : '';
$email = isset($user->email) ? $user->email : '';
$phone = isset($user->phone) ? $user->phone : '';
$image = isset($user->image) ? $user->image : '';
$education = isset($user->education) ? $user->education : '';
$total_exp = isset($user->total_exp) ? $user->total_exp : '';
$speciality = isset($user->speciality) ? $user->speciality : '';
$status = isset($user->status) ? $user->status : '1';
$is_approve = isset($user->is_approve) ? $user->is_approve : '0';
$about = isset($user->about) ? $user->about : '';
$username = isset($user->username) ? $user->username : '';


?>

<!-- start page title -->
<div class="row">
    <div class="col-12">
        <div class="page-title-box d-flex align-items-center justify-content-between">
            <h4 class="mb-0">Profile</h4>
            <div class="page-title-right">
    </div>

</div>
</div>
</div>
<!-- end page title -->


@include('snippets.errors')
@include('snippets.flash')


<div class="row">
    <div class="col-lg-6">
        <div class="card">
            <div class="card-body">
                <h4 class="mb-3 header-title">Profile Update</h4>

                <form action="" method="post" enctype="multipart/form-data">
                    {{ csrf_field() }}
                    <div class="mb-3">
                        <label for="fullname" class="form-label">Name</label>
                        <input type="text" class="form-control mb-3" name="name" id="exampleInputName"  value="{{Auth::guard('admin')->user()->name ?? ''}}" placeholder="Enter Name" aria-label="default input example">
                    </div>
<!-- 
                    <div class="mb-3">
                        <label for="fullname" class="form-label">UserName</label>
                        <input type="text" class="form-control mb-3" name="username" id="exampleInputName"  value="{{ old('username',$username) }}" placeholder="Enter UserName For Login" aria-label="default input example">
                    </div> -->


                    <div class="mb-3">
                        <label for="fullname" class="form-label">Contact No.</label>
                        <input type="number" class="form-control mb-3" name="phone" id="exampleInputNumber"  value="{{ old('phone',$phone) }}" placeholder="Enter Name" aria-label="default input example">
                    </div>

                    <div class="mb-3">
                        <label for="fullname" class="form-label">Email address</label>
                        <input type="email" class="form-control mb-3" name="email" id="email"  value="{{ old('email',$email) }}" placeholder="Enter Email" aria-label="default input example"></div>

                        <div class="mb-3">
                            <label for="fullname" class="form-label">Upload Image</label>
                            <input type="file" class="form-control mb-3" name="image" id="image"   aria-label="default input example">
                        </div>
                        <button type="submit" class="btn btn-primary waves-effect waves-light">Submit</button>
                    </form>

                </div> <!-- end card-body-->
            </div> <!-- end card-->
        </div>
        <!-- end col -->

        <div class="col-lg-6">
            <div class="card">
                <div class="card-body">

                    <h4 class="mb-3 header-title">Change Password</h4>

                    <form class="form-horizontal" method="POST" action="{{route('admin.change_password')}}">
                        @csrf
                        <div class="row mb-3">
                            <label for="inputEmail3" class="col-4 col-xl-3 col-form-label">Old Password</label>
                            <div class="col-8 col-xl-9">
                                <input type="password" class="form-control" name="old_password" id="inputEmail3" placeholder="Old Password">
                            </div>
                        </div>
                        <div class="row mb-3">
                            <label for="inputPassword3" class="col-4 col-xl-3 col-form-label">New Password</label>
                            <div class="col-8 col-xl-9">
                                <input type="password" class="form-control" name="new_password" id="inputPassword3" placeholder="New Password">
                            </div>
                        </div>
                        <div class="row mb-3">
                            <label for="inputPassword5" class="col-4 col-xl-3 col-form-label">Confirm Password</label>
                            <div class="col-8 col-xl-9">
                                <input type="password" class="form-control" name="confirm_password" id="inputPassword5" placeholder="Confirm Password">
                            </div>
                        </div>
                        <div class="justify-content-end row">
                            <div class="col-8 col-xl-9">
                                <button type="submit" class="btn btn-info waves-effect waves-light">Update Password</button>
                            </div>
                        </div>
                    </form>

                </div>  <!-- end card-body -->
            </div>  <!-- end card -->
        </div>  <!-- end col -->

    </div>



@include('admin.common.footer')
