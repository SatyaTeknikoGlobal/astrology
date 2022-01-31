 @include('admin.common.header') 

 <style>
 input[type=file]::file-selector-button {
  border: 1px solid darkred;
  color: black;

  border-radius: .2em;
  background-color: #8b00009c  !important;
  transition: 1s;
}

 .select2-selection--multiple,
.select2-container--default .select2-selection--single,
.form-control{
    border: 1px solid #8b000052 !important;
    height: 41px;
    overflow: hidden;
   white-space: nowrap;
   overflow-x: auto;

}
textarea.form-control {
    min-height: calc(1.6em + 0.94rem + 2px);
      white-space: normal;
}


.form-label{
  color: darkred;
  font-weight: 500;
}

.form-group{
  margin: 8px 0px;
}
/*.card{
  width: 730px;
  margin-left: auto;
  margin-right: auto;
  border-radius: 10px;
}*/
 </style>

 <?php

 $back_url = (request()->has('back_url'))?request()->input('back_url'):'';
 if(empty($back_url)){
  $back_url = 'admin/astrologers';
}

$id = isset($astrologers->id) ? $astrologers->id : '';
$name = (isset($astrologers->name))?$astrologers->name:'';
$real_name = (isset($astrologers->real_name))?$astrologers->real_name:'';
$dob = (isset($astrologers->dob))?$astrologers->dob:'';

$pan_card = (isset($astrologers->pan_card))?$astrologers->pan_card:'';
$account_type = (isset($astrologers->account_type))?$astrologers->account_type:'';
$account_holder_name = (isset($astrologers->account_holder_name))?$astrologers->account_holder_name:'';
$account_no = (isset($astrologers->account_no))?$astrologers->account_no:'';
$bank = (isset($astrologers->bank))?$astrologers->bank:'';
$ifsc = (isset($astrologers->ifsc))?$astrologers->ifsc:'';
$aadhar_card_no = (isset($astrologers->aadhar_card_no))?$astrologers->aadhar_card_no:'';
$email = (isset($astrologers->email))?$astrologers->email:'';
$degree = (isset($astrologers->degree))?$astrologers->degree:'';
$number = (isset($astrologers->number))?$astrologers->number:'';
$experience = (isset($astrologers->experience))?$astrologers->experience:'';
$about = (isset($astrologers->about))?$astrologers->about:'';
$country_id = (isset($astrologers->country_id))?$astrologers->country_id:'';
$category_id = (isset($astrologers->category))?$astrologers->category:'';
$state_id = (isset($astrologers->state_id))?$astrologers->state_id:'';
$city_id = (isset($astrologers->city_id))?$astrologers->city_id:'';
$locality_id = (isset($astrologers->locality_id))?$astrologers->locality_id:'';
$address = (isset($astrologers->address))?$astrologers->address:'';
$report_id = (isset($astrologers->report_id))?$astrologers->report_id:'';
$language = (isset($astrologers->language))?$astrologers->language:'';
$type = (isset($astrologers->type))?$astrologers->type:'';
$type = explode(',',$type);
$status = (isset($astrologers->status))?$astrologers->status:1;
$language = explode(",", $language);
$report_id = explode(",", $report_id);
?>

<div class="row">
  <div class="col-12">
    <div class="page-title-box d-flex align-items-center justify-content-between">

     <h4 class="mb-0">{{ $page_Heading }}</h4>
     <div class="page-title-right">

      <ol class="breadcrumb m-0">
        <?php if(request()->has('back_url')){ $back_url= request('back_url');  ?>
        <a href="{{ url($back_url)}}" style="float:right"><button type="button" class="btn btn-info d-lg-block m-l-15 text-white"><i
          class="fa fa-arrow-left"></i>  Back</button></a>
        <?php } ?>
      </ol>
    </div>

  </div>
</div>
</div>

<div class="row">
  <div class="col-12" style="text-align: left">
    @include('snippets.errors')
    @include('snippets.flash')
    <div class="card">
     <!--  <div class="card-header">
        <h4 class="card-title">{{ $page_Heading }}</h4>

      </div> -->
      <div class="card-body">

           <form method="POST" action="" accept-charset="UTF-8" enctype="multipart/form-data" role="form" class="mt-4">
          {{ csrf_field() }}

          <input type="hidden" name="id" value="{{$id}}">

          <div class="row">
                
              <div class="col-md-6 form-group">
                <label for="exampleInputEmail1" class="form-label">Display Name : </label>
                <input type="text" class="form-control" id="name" placeholder="Enter Name" name="name" value="{{ old('name', $name) }}">
                @include('snippets.errors_first', ['param' => 'name'])
              </div>

               <div class="col-md-6 form-group">
                <label for="exampleInputEmail1" class="form-label">Real Name : </label>
                <input type="text" class="form-control" id="real_name" placeholder="Enter Real Name" name="real_name" value="{{ old('real_name', $real_name) }}">
                @include('snippets.errors_first', ['param' => 'real_name'])
              </div>

          </div>

         

          <div class="row">
            <div class="col-md-6 form-group">
              <label for="exampleInputEmail1" class="form-label">Email : </label>
              <input type="email" class="form-control" id="email" placeholder="Enter Email" name="email" value="{{ old('email', $email) }}">
              @include('snippets.errors_first', ['param' => 'email'])
            </div>

            <div class="col-md-6 form-group">
              <label for="exampleInputEmail1" class="form-label">Phone : </label>
              <input type="number" class="form-control" id="number" placeholder="Enter phone" name="number" value="{{ old('number', $number) }}">
              @include('snippets.errors_first', ['param' => 'number'])
            </div>

          </div> 

          <div class="row">
            <div class="col-md-4 form-group">
              <label for="exampleInputEmail1" class="form-label">Category : </label>
              <select class="form-control">
                <option value='' selected disabled>Select Category : </option>
              @foreach($categories as $cat)
              <option value="{{$cat->id}}" <?php if($category_id == $cat->id) echo 'selected';?>>{{$cat->name}}</option>
              @endforeach
              </select>
             
            </div>

            <div class="col-md-4 form-group">
              <label for="exampleInputEmail1" class="form-label">Date of Birth : </label>
              <input type="date" class="form-control" id="dob" placeholder="Enter DOB " name="dob" value="{{ old('dob', $dob) }}">
              @include('snippets.errors_first', ['param' => 'number'])
            </div>

             <div class="col-md-4 form-group">
              <label for="exampleInputEmail1" class="form-label">Adhaar Card : </label>
              <input type="text" class="form-control" id="aadhar_card_no" placeholder="Enter Adhaar Card Number " name="aadhar_card_no" value="{{ old('aadhar_card_no', $aadhar_card_no) }}">
              @include('snippets.errors_first', ['param' => 'aadhar_card_no'])
            </div>

          </div>  

          <div class="row">
            <div class="col-md-4 form-group">
              <label for="exampleInputEmail1" class="form-label">Gender : </label>
              <select class="form-control"> 
                <option value='' selected disabled>Select Gender : </option>
              <option value="Male">Male</option>
              <option value="Female">Female</option>
              </select>
             
            </div>

           

             <div class="col-md-4 form-group">
              <label for="exampleInputEmail1" class="form-label">Report Type : </label>
              <select class="form-control select2-single" multiple name="report_id[]" id="report_id"> 
              
              @foreach($report_type as $rt)
              <option value="{{$rt->id}}" <?php if(in_array($rt->id, $report_id)) {echo "selected";}?>>{{$rt->type}}</option>
              @endforeach
              </select>
             
            </div>

            <div class="col-md-4 form-group">
              <label for="exampleInputEmail1" class="form-label">About : </label>
              <textarea class="form-control" id="about" placeholder="" name="about">{{ old('about', $about) }}</textarea>
              @include('snippets.errors_first', ['param' => 'number'])
            </div>

          </div>             


          <div class="row">

            <div class="col-md-4 form-group">
            <label for="exampleInputEmail1" class="form-label">Country : </label>
            <select  class="form-control select2-single" id="country_id"  name="country_id">
              <option value=''selected disabled>Select Country : </option>
              @foreach($country as $cout)
              <option value='{{$cout->id}}' <?php if($country_id == $cout->id) echo 'selected'; ?>>{{$cout->name}}</option>
              @endforeach
            </select>
            @include('snippets.errors_first', ['param' => 'country_id'])
          </div>
           <div class="col-md-4 form-group">
            <label for="exampleInputEmail1" class="form-label">State : </label>
            <select  class="form-control select2-single" id="state_id"  name="state_id" placeholder="Select State">     
              <option value="" selected disabled>Select State : </option>                
                <?php if(!empty($states)){
                  foreach($states as $state){
                  ?>
                  <option value="{{$state->id}}" <?php if($state_id == $state->id) echo "selected"?>>{{$state->name}}</option>

                <?php }}?>
            </select>
            @include('snippets.errors_first', ['param' => 'state_id'])
          </div>

          <div class="col-md-4 form-group">
            <label for="exampleInputEmail1" class="form-label">City : </label>
            <select  class="form-control select2-single" id="city_id"  name="city_id" placeholder="Select City">

              <option value="" selected disabled>Select City : </option>                
                <?php if(!empty($cities)){
                  foreach($cities as $city){
                  ?>
                  <option value="{{$city->id}}" <?php if($city_id == $city->id) echo "selected"?>>{{$city->name}}</option>

                <?php }}?>
            </select>
            @include('snippets.errors_first', ['param' => 'city_id'])
          </div>

        </div>



        <div class="row">
         <div class="col-md-6 form-group">
          <label for="exampleInputEmail1" class="form-label">Pincode : </label>
          <input type="number" class="form-control" id="locality_id"  placeholder="Enter Pincode" name="locality_id" value="{{ old('locality_id', $locality_id) }}">
          @include('snippets.errors_first', ['param' => 'locality_id'])
        </div>

        <div class="col-md-6 form-group">
          <label for="exampleInputEmail1" class="form-label">Address : </label>
          <textarea class="form-control" id="address"  placeholder="" name="address">{{ old('address', $address) }}</textarea>
          @include('snippets.errors_first', ['param' => 'address'])
        </div>

      </div>   

      <div class="row">
          
          <div class="col-md-6 form-group">  
          <label for="exampleInputEmail1" class="form-label">Experience (in years) : </label>
          <input type="number" class="form-control" id="experience"  placeholder="Enter Your Experience" name="experience" value="{{ old('experience', $experience) }}">
          @include('snippets.errors_first', ['param' => 'experience'])
        </div>

         <div class="col-md-6 form-group">
          <label for="exampleInputEmail1" class="form-label">Highest Degree : </label>
          <input type="text" class="form-control" id="degree"  placeholder="Enter Your Degree" name="degree" value="{{ old('degree', $degree) }}">
          @include('snippets.errors_first', ['param' => 'degree'])
        </div>

      </div>  

        <div class="row">
          
          <div class="col-md-4 form-group">
          <label for="exampleInputEmail1" class="form-label">Pan Card : </label>
          <input type="text" class="form-control" id="pan_card"  placeholder="Enter Your PAN Card Number" name="pan_card" value="{{ old('pan_card', $pan_card) }}">
          @include('snippets.errors_first', ['param' => 'pan_card'])
        </div>

         <div class="col-md-4 form-group">
          <label for="exampleInputEmail1" class="form-label">Account Type : </label>
          <select value="" class="form-control">Select Account Type
            <option value="saving">Saving</option>
            <option value="current">Current</option>
          </select>
          @include('snippets.errors_first', ['param' => 'degree'])
        </div>

        <div class="col-md-4 form-group">
          <label for="exampleInputEmail1" class="form-label">Account Number : </label>
          <input type="text" class="form-control" id="account_no"  placeholder="Enter Your Account Number" name="account_no" value="{{ old('account_no', $account_no) }}">
          @include('snippets.errors_first', ['param' => 'account_no'])
        </div>

      </div>

       <div class="row">
          
          <div class="col-md-4 form-group">
          <label for="exampleInputEmail1" class="form-label">Account Holder Name : </label>
          <input type="text" class="form-control" id="account_holder_name"  placeholder="Enter Your Account Holder Name" name="account_holder_name" value="{{ old('account_holder_name', $account_holder_name) }}">
          @include('snippets.errors_first', ['param' => 'account_holder_name'])
        </div>

         <div class="col-md-4 form-group">
          <label for="exampleInputEmail1" class="form-label">Bank : </label>
          <input type="text" class="form-control" id="bank"  placeholder="Enter Your bank" name="bank" value="{{ old('bank', $bank) }}">
          @include('snippets.errors_first', ['param' => 'bank'])
        </div>

        <div class="col-md-4 form-group">
          <label for="exampleInputEmail1" class="form-label">IFSC Code : </label>
          <input type="text" class="form-control" id="ifsc"  placeholder="Enter IFSC" name="ifsc" value="{{ old('ifsc', $ifsc) }}">
          @include('snippets.errors_first', ['param' => 'ifsc'])
        </div>

      </div>          

                   

      <div class="row">
        <div class="col-md-6 form-group">
          <label for="exampleInputEmail1" class="form-label">Language : </label>
          <select class="form-control select2-single" name="language[]" multiple>

            @foreach($languages as $lang)
            <option value="{{$lang->id}}" <?php if(in_array($lang->id, $language)){echo "selected";}?>>{{$lang->name}}</option>
            @endforeach
          </select>
          @include('snippets.errors_first', ['param' => 'language'])
        </div>

        <div class="col-md-6 form-group">
          <label for="exampleInputEmail1" class="form-label">Expertise : </label>
          <select  class="form-control select2-single" id="type"  multiple name="type[]">

            @foreach($expertise as $expert)
            <option value='{{$expert->id}}' <?php if(in_array($expert->id,$type)) {echo 'selected';}?>>{{$expert->name}}</option>
            @endforeach
          </select>
          @include('snippets.errors_first', ['param' => 'type'])
        </div>

        <div class="row">
          <div class="col-md-12 form-group">
            <label for="exampleInputEmail1" class="form-label">Upload Image : </label>
            <input type="file" class="form-control" id="image" name="image">

          </div>
        </div>

      </div>

      <div class="form-group">
        <label for="exampleInputPassword1" class="form-label">Status : </label>&nbsp;&nbsp;
        <br>
        Active: <input type="radio" name="status" value="1" <?php echo ($status == '1')?'checked':''; ?> checked>
        &nbsp;
        Inactive: <input type="radio" name="status" value="0" <?php echo ( strlen($status) > 0 && $status == '0')?'checked':''; ?> >

        @include('snippets.errors_first', ['param' => 'status'])
      </div><div class="col-md-12 text-center">

      <button type="submit" class="btn btn-primary text-white">Submit</button></div>
    </form>




  </div>
</div>
</div> <!-- end col -->
</div>
<!-- end row -->


<!-- end page title -->

@include('admin.common.footer')
<script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>


<script>

  $('#country_id').change( function()
  {

    var _token = '{{ csrf_token() }}';
    var country_id = $('#country_id').val();
    $.ajax({
      url: "{{ route('admin.astrologer.get_state') }}",
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
      url: "{{ route('admin.astrologer.get_city') }}",
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
<script type="text/javascript">
  $(document).ready(function() {
    $('.select2-single').select2();
  });
</script>