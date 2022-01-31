@include('admin.common.header')
<?php



$back_url = (request()->has('back_url'))?request()->input('back_url'):'';
if(empty($back_url)){
  $back_url = 'admin/user';
}

$id = isset($users->id) ? $users->id : '';
$name = (isset($users->name))?$users->name:'';
$email = (isset($users->email))?$users->email:'';
$phone = (isset($users->phone))?$users->phone:'';
$dob = (isset($users->dob))?$users->dob:'';
// $country_id = (isset($users->country_id))?$users->country_id:'';
// $state_id = (isset($users->state_id))?$users->state_id:'';
// $city_id = (isset($users->city_id))?$users->city_id:'';
// $locality_id = (isset($users->locality_id))?$users->locality_id:'';
// $address = (isset($users->address))?$users->address:'';
$gender = (isset($users->gender))?$users->gender:'';
$status = (isset($users->status))?$users->status:1;

?>

<!-- start page title -->
<div class="row">
    <div class="col-12">
        <div class="page-title-box d-flex align-items-center justify-content-between">
            <h4 class="mb-0">{{ $page_Heading }}</h4>
            <div class="page-title-right">
                <ol class="breadcrumb m-0">
                    <?php if(request()->has('back_url')){ $back_url= request('back_url');  ?>
          <a href="{{ url($back_url)}}"><button type="button" class="btn btn-info  m-l-15 text-black"><i
            class="fa fa-arrow-left"></i>  Back</button></a>
          <?php } ?>
            </ol>
    </div>

</div>
</div>
</div>
<!-- end page title -->



    <div class="row">
      <div class="col-12 form-view">
        @include('snippets.errors')
        @include('snippets.flash')
        <!-- table responsive -->
        <div class="card">
         <div class="card-body">
         <!--  <h4 class="card-title">{{ $page_Heading }}</h4> -->
          <form method="POST" action="" accept-charset="UTF-8" enctype="multipart/form-data" role="form" class="mt-4">
            {{ csrf_field() }}

            <input type="hidden" name="id" value="{{$id}}">

              <div class="form-group">
                <label for="exampleInputEmail1" class="form-label">Name:</label>
                <input type="text" class="form-control" id="name" placeholder="Enter Name" name="name" value="{{ old('name', $name) }}">
                @include('snippets.errors_first', ['param' => 'name'])
              </div>

              <div class="row">
                    <div class="col-md-6 form-group">
                      <label for="exampleInputEmail1" class="form-label">Email:</label>
                      <input type="email" class="form-control" id="email" placeholder="Enter Email" name="email" value="{{ old('email', $email) }}">
                      @include('snippets.errors_first', ['param' => 'email'])
                    </div>

                    <div class="col-md-6 form-group">
                      <label for="exampleInputEmail1" class="form-label">Password:</label>
                      <input type="password" class="form-control" id="password" placeholder="Enter Password" name="password" value="">
                      @include('snippets.errors_first', ['param' => 'password'])
                    </div>

                    

              </div> 

              <div class="col-md-12 form-group">
                      <label for="exampleInputEmail1" class="form-label">Phone:</label>
                      <input type="number" class="form-control" id="phone" placeholder="Enter Phone" name="phone" value="{{ old('phone', $phone) }}">
                      @include('snippets.errors_first', ['param' => 'phone'])
              </div>

              <div class="row">
                    <div class="col-md-6 form-group">
                      <label for="exampleInputEmail1" class="form-label">Date of Birth:</label>
                      <input type="date" class="form-control" id="dob" placeholder="Enter dob" name="dob" value="{{ old('dob', $dob) }}">
                      @include('snippets.errors_first', ['param' => 'dob'])
                    </div>

                    <div class="col-md-6 form-group">
                      <label for="exampleInputEmail1" class="form-label">Gender:</label>
                      <select name="gender" id="gender" class="form-control">
                          <option value="" selected disabled>Select Gender</option>
                          <option value="Male" <?php if($gender == 'Male') echo 'selected';?>>Male</option>
                           <option value="Female" <?php if($gender == 'Female') echo 'selected';?>>Female</option>
                      </select>
                      @include('snippets.errors_first', ['param' => 'gender'])
                    </div>

              </div>            

             

              <div class="col-md-12 form-group">
                      <label for="exampleInputEmail1" class="form-label">Upload Image:</label>
                      <input type="file" class="form-control" id="image"  name="image">
                      @include('snippets.errors_first', ['param' => 'image'])
              </div>            
        
              <div class="form-group">
                <label for="exampleInputPassword1" class="form-label">Status:</label>&nbsp;&nbsp;
                <br>
                Active: <input type="radio" name="status" value="1" <?php echo ($status == '1')?'checked':''; ?> checked>
                &nbsp;
                Inactive: <input type="radio" name="status" value="0" <?php echo ( strlen($status) > 0 && $status == '0')?'checked':''; ?> >

                @include('snippets.errors_first', ['param' => 'status'])
              </div>
              <br>
              <button type="submit" class="btn btn-primary text-white">Submit</button>
            </form>
          </div>

        </div>
      </div>
    </div>



@include('admin.common.footer')

<script>

  $('#country_id').change( function()
 {

    var _token = '{{ csrf_token() }}';
    var country_id = $('#country_id').val();
    $.ajax({
      url: "{{ route('admin.user.get_state') }}",
      type: "POST",
      data: {country_id:country_id},
      dataType:"HTML",
      headers:{'X-CSRF-TOKEN': _token},
      cache: false,
      success: function(resp){

         $('#state_id').html(resp);
     }
 });
});

  
$('#state_id').change( function()
 {

    var _token = '{{ csrf_token() }}';
    var state_id = $('#state_id').val();
    $.ajax({
      url: "{{ route('admin.user.get_city') }}",
      type: "POST",
      data: {state_id:state_id},
      dataType:"HTML",
      headers:{'X-CSRF-TOKEN': _token},
      cache: false,
      success: function(resp){
         $('#city_id').html(resp);
     }
 });
});




</script>