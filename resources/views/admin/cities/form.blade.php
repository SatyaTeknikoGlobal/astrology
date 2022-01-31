@include('admin.common.header')
<?php



$back_url = (request()->has('back_url'))?request()->input('back_url'):'';
if(empty($back_url)){
  $back_url = 'admin/cities';
}

$id = isset($cities->id) ? $cities->id : '';
$name = (isset($cities->name))?$cities->name:'';
$country_id=(isset($cities->country_id))?$cities->country_id:'';
$state_id=(isset($cities->state_id))?$cities->state_id:'';

$status = (isset($cities->status))?$cities->status:1;


?>

<?php //print_r($cities);?>


<div class="row">
    <div class="col-12">
        <div class="page-title-box d-flex align-items-center justify-content-between">
            <h4 class="mb-0">{{ $page_Heading }} <?php echo $country_id; ?></h4>
            <div class="page-title-right">
                <ol class="breadcrumb m-0">
                    <?php if(request()->has('back_url')){ $back_url= request('back_url');  ?>
                    <a href="{{ url($back_url)}}"><button type="button" class="btn btn-info m-l-15 text-white"><i
                        class="fa fa-arrow-left"></i>  Back</button></a>
                        <?php } ?>
            </ol>
    </div>

</div>
</div>
</div>

    <div class="row">
      <div class="col-12">
        @include('snippets.errors')
        @include('snippets.flash')
        <!-- table responsive -->
        <div class="card">
         <div class="card-body">
        <!--   <h4 class="card-title">{{ $page_Heading }}</h4> -->
          <form method="POST" action="" accept-charset="UTF-8" enctype="multipart/form-data" role="form" class="mt-4">
            {{ csrf_field() }}

            <input type="hidden" name="id" value="{{$id}}">
            
             <div class="form-group">
              <label for="exampleInputEmail1" class="form-label">Country Name</label>
              <select class="form-control select2-single" name="country_id" id="country_id">
               <option value="" selected disabled>Select Country Name</option>
               <?php 

                 
               if(!empty($countries)){
                foreach($countries as $c) 
                  {

                    ?>
                    <option value="{{$c->id}}" <?php if($country_id == $c->id) echo 'selected'; ?>>{{$c->name}}</option>
                  <?php  } }  ?>
                </select>
                @include('snippets.errors_first', ['param' => 'country_id'])
              </div>

              <?php //print_r($states); ?>

            <div class="form-group">
              <label for="exampleInputEmail1" class="form-label">State Name</label>
              <select class="form-control select2-single" name="state_id" id="state_id">
               <option value="" selected disabled>Select State Name</option>
               <?php 

               if(!empty($states)){
                foreach($states as $state) 
                  {?>
                    <option value="{{$state->id}}" <?php if($state_id == $state->id) echo 'selected'; ?>>{{$state->name}}</option>
                  <?php  } }  ?>
                </select>
                @include('snippets.errors_first', ['param' => 'state_id'])
              </div>


              <div class="form-group">
                <label for="exampleInputEmail1" class="form-label">City Name</label>
                <input type="text" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp" placeholder="Enter City Name" name="name" value="{{ old('name', $name) }}">
                @include('snippets.errors_first', ['param' => 'name'])
              </div>





              <div class="form-group">
                <label for="exampleInputPassword1" class="form-label">Status</label>
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
      url: "{{ route('admin.cities.get_state') }}",
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
      url: "{{ route('admin.cities.get_city') }}",
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
