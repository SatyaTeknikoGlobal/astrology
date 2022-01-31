@include('admin.common.header')


<style>
  .btn-soft-primary:hover{
    color: #3980c0;
    background-color: rgba(57,128,192,.1);
  }
  .bx-dots-horizontal-rounded,
  .astro-name{
    color: #FB7112 !important;
  }


  .text span {
      border: 1px solid #FB7112;
    padding: 0px 9px;
    border-radius: 21px;
    margin: 0px 1px;
    white-space: nowrap;
    line-height: 13px;
    background-color: #fb711226;
    color: #000;
    font-size: 13px;
  }
  .text b{
    color: #FB7112;
    font-weight: 500;
    font-size: 14px;

  }

  .text-muted{

    overflow: hidden;
    text-overflow: ellipsis;
    -webkit-box-orient: vertical;
    display: -webkit-box;
    -webkit-line-clamp: 1;
  }

  .btn-primary{
    height: fit-content;
  }

  .switch {
    position: relative;
    display: inline-block;
    width: 43px;
    height: 20px;
  }

  .switch input { 
    opacity: 0;
    width: 0;
    height: 0;
  }

  .slider {
    position: absolute;
    cursor: pointer;
    top: 0;
    left: 0;
    right: 0;
    bottom: 0;
    background-color: #ccc;
    -webkit-transition: .4s;
    transition: .4s;
  }
  .rating i{
    color:#e4bf4c;
  }

  .user i{
    color: #FB7112
  }




  .slider:before {
   position: absolute;
   content: "";
   height: 15px;
   width: 15px;
   left: 0px;
   top: 2px;
   bottom: 4px;
   background-color: white;
   -webkit-transition: .4s;
   transition: .4s;

 }

 input:checked + .slider {
  background-color: #FB7112;
}

input:focus + .slider {
  box-shadow: 0 0 1px #2196F3;
}

input:checked + .slider:before {
  -webkit-transform: translateX(26px);
  -ms-transform: translateX(26px);
  transform: translateX(26px);
}

/* Rounded sliders */
.slider.round {
  border-radius: 34px;
}

.slider.round:before {
  border-radius: 50%;
}


.btn-soft-danger{
  border: 1px solid #FB7112;
  color: #000;
  background-color: #fb711226;


}



.btn-primary{
  background-color: #FB7112;
  border-color:#FB7112;
}
.btn-soft-primary {
  color: #020202;
  background-color: rgb(57 128 192 / 65%);
  border-color: transparent;
}
.score {
  display: flex;
  font-size: 16px;
  position: relative;
  overflow: hidden;
}

.score-wrap {
  display: flex;
  position: relative;
  height: fit-content;
  margin: 3px 1px;
}

.score .stars-active {
  color: #EEBD01;
  position: relative;
  z-index: 10;
  display: inline-block;
  overflow: hidden;
  white-space: nowrap;
}

.score .stars-inactive {
  color: grey;
  position: absolute;
  top: 0;
  left: 0;
  -webkit-text-stroke: initial;
  /* overflow: hidden; */
}

</style>

<?php
$BackUrl = CustomHelper::BackUrl();
$routeName = CustomHelper::getAdminRouteName();
//$old_name = (request()->has('name'))?request()->name:'';

$search = isset($search) ? $search :'';
?>

<div class="row">
  <div class="col-12">
   <div class="page-title-box d-flex align-items-center justify-content-between">
    <h4 class="mb-0">Astrologers</h4>
    <div class="page-title-right">
      <ol class="breadcrumb m-0">
        <a href="{{ route($routeName.'.astrologer.export', ['back_url' => $BackUrl]) }}" class="btn btn-info d-none d-lg-block m-l-15 text-white" id="is_export"><i class="fas fa-file-export" aria-hidden="true"></i>&nbsp;&nbsp;Export</a>&nbsp;&nbsp;&nbsp;
        <a href="{{ route('admin.astrologer.add',['back_url'=>$BackUrl]) }}"><button type="button" class="btn btn-info d-none d-lg-block m-l-15 text-white"><i
          class="fa fa-plus-circle"></i> Create New</button></a>
        </ol>
      </div>

    </div>
  </div>
</div>



<div class="row">
  <div class="col-12">
   <div class="card">
    <div class="card-body">
      <div class="mb-3">
        <label class="form-label">Search By Name,Email,Phone</label>

        <form id="filter_form">
          <div class="input-group">
            <input type="text" name="search" value="{{old('search',$search)}}" placeholder="Search..." class="form-control">
            <!--  <input type="hidden" name="is_export" id="is_export_value" value="0"> -->

            <button class="btn btn-primary" type="submit">Search</button>
          </div>
        </form>

      </div>
    </div>
  </div>
</div>
</div>




<div class="row">
  <div class="col-12">
    <!-- table responsive -->

    @include('snippets.errors')
    @include('snippets.flash')


    <?php  
    // $rates = $rate->rating;
    // for($i=0;$i<$rates;$i++){ 

    ?>
    <!--  <i class="fa fa-star"></i> -->
    <?php //} ?>


    <div class="row" >
      @foreach($astrologers as $astro)

      <div class="col-xl-4 col-sm-6">
        <div class="card">
          <div class="card-body">
            <div class="dropdown float-end">
              <a class="text-muted dropdown-toggle font-size-16" href="#" role="button" data-bs-toggle="dropdown" aria-haspopup="true">
                <i class="bx bx-dots-horizontal-rounded"></i>
              </a>
              <div class="dropdown-menu dropdown-menu-end">
                <a class="dropdown-item" href="{{route($routeName.'.astrologer.edit', ['id'=>$astro->id,'back_url'=>$BackUrl])}}">Edit</a>
                <a class="dropdown-item" href="{{route($routeName.'.astrologer.delete', ['id'=>$astro->id,'back_url'=>$BackUrl])}}" onclick="return confirm('Are You Want To Delete ?')">Remove</a>
              </div>

            </div>
            <div class="d-flex">

              <div>
                <?php

                $image = isset($astro->image) ? $astro->image : '';
                $storage = Storage::disk('public');
                $path = 'astrologers';
                $avg_rate = 0;
                $avg_rate1 = 0;
                if(!empty($image))
                {
                  ?>
                  <a href="{{ url('public/storage/'.$path.'/'.$image) }}" target='_blank'><img src="{{ url('public/storage/'.$path.'/'.$image) }}" style="width:70px;height:70px;border-radius: 8px;"></a>

                <?php }else{ ?>
                  <a href="{{ url('public/storage/'.$path.'/default.png') }}" target='_blank'><img src="{{ url('public/storage/'.$path.'/default.png') }}" style="width:70px;height:70px;border-radius: 8px;"></a>
                  <!--  <img src="assets/images/users/avatar-5.jpg" alt="" class="avatar-md rounded-circle img-thumbnail"> -->
                <?php } ?>
                <?php  

                $rates = DB::table('ratings')->where('astro_id',$astro->id)->get();
                $astro_rating = [];
                foreach($rates as $rate)
                {
                  $astro_rating[] = $rate->rating;
                }
                $astro_count = count($astro_rating);
                $rate_sum =  array_sum($astro_rating);
                if($astro_count != 0)
                {
                 $avg_rate = $rate_sum/$astro_count;  

                 $avg_rate1 = $avg_rate*20;
               }
               ?>

               <span class="score " title="{{$avg_rate}}"> 
                 <span style="    /* margin-left: auto; */
                 line-height: 31px;
                 font-size: 14px;
                 margin-right: 4px;">({{$astro_count}})</span>
                 <div class="score-wrap">
                  <span class="stars-active" style="width:{{$avg_rate1}}%">
                    <i class="fa fa-star" aria-hidden="true"></i>
                    <i class="fa fa-star" aria-hidden="true"></i>
                    <i class="fa fa-star" aria-hidden="true"></i>
                    <i class="fa fa-star" aria-hidden="true"></i>
                    <i class="fa fa-star" aria-hidden="true"></i>
                  </span>
                  <span class="stars-inactive">
                    <i class="fa fa-star-o" aria-hidden="true"></i>
                    <i class="fa fa-star-o" aria-hidden="true"></i>
                    <i class="fa fa-star-o" aria-hidden="true"></i>
                    <i class="fa fa-star-o" aria-hidden="true"></i>
                    <i class="fa fa-star-o" aria-hidden="true"></i>
                  </span>

                </div>

              </span>





            </div>
            <div class="flex-1 ms-5">
              <h5 class="font-size-16 mb-1 text-dark mb-3 astro-name">{{$astro->real_name}} ({{$astro->name}})</h5>

              <p class="text-muted text mb-1"> <b>Phone: </b>{{$astro->number}}</p>
              <p class="text-muted text mb-1"> <b>Experience: </b>{{$astro->experience}} Years </p>



            </div>
          </div>
          <div>
            <p class="text-muted text mb-1"> <b>Email: </b>{{$astro->email}}</p>
            <p class="text-muted text mb-1"> <b>Language: </b> 
              <?php 

              $language = isset($astro->language) ? $astro->language:'';
              if(!empty($language)){
                $language = explode(",", $language);
                if(!empty($language)){
                  foreach ($language as $key => $value) {
                    $languages = \App\Language::where('id',$value)->first();
                    if(!empty($languages)){
                      ?>                
                      <span>{{$languages->name ?? ''}}</span>

                      <?php
                    }
                  }
                }
              }
              ?>   

            </p>
            <p class="text-muted text mb-2"> <b>Expertise: </b>

              <?php 
              $expertise = isset($astro->type) ? $astro->type: '';
              if(!empty($expertise))
                {$expertiss = explode(',',$expertise);
              if(!empty($expertiss))
                {foreach($expertiss as $key => $value)
                  {                              
                    $expeetises = \App\Expertise::where('id',$value)->first();
                    if(!empty($expeetises))
                    {
                      ?>
                      <span>{{$expeetises->name ?? ''}}</span>                  
                      <?php             
                    }
                  }
                }
              }
              ?> 

            </p>
            <p class="text-muted text mb-2"><b>Wallet : </b>{{$astro->wallet}}</p>
          </div>


          <div class="w-100 d-flex">
            <div>
              <label class="switch">
                <input type="checkbox" <?php if($astro->is_approve == 1){ echo 'checked';}?>  class="switch-input" onclick="approve_astro('{{$astro->id}}',this)" id="checkboxlist{{$astro->id}}">

                <span class="slider round"></span>

              </label>
              <b class="ms-2 text-truncate">Approved</b>

            </div>

            <div style="margin-left: auto;">
             <label class="switch">
              <input type="checkbox" <?php if($astro->status == 1){ echo 'checked';}?>  class="switch-input" onclick="change_astro_status('{{$astro->id}}',this)"id="checkboxlist{{$astro->id}}">

              <span class="slider round"></span>

            </label>
            <b class="ms-2 text-truncate">Status</b>
          </div>

        </div>

        <div class="w-100">
          <a href="{{ route($routeName.'.astrologer.profile', ['id'=>$astro->id,'back_url'=>$BackUrl])}}" class="btn btn-primary btn-sm text-truncate w-100 mt-2" > <i class="bx bx-user me-1"></i> View Profile</a>
        </div>
















      </div>
    </div>
  </div>

  @endforeach
</div>

{{ $astrologers->appends(request()->input())->links('admin.pagination') }}

</div>
</div>

<!--- end row -->

<input type="hidden" name="page" id="page" value="1">

</div>
</div>
</div>
</div>

</div>

@include('admin.common.footer')
<!-- <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.1.1/jquery.min.js"></script> -->
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>

<script>
  $("#is_export").on('click',function() {
    $('#is_export_value').val(1);
    $('#filter_form').submit();

  });

// $(document).ready(function() {  
//     get_astro_data(1);
//   });

//   function load_page()
//   {
//     var page = $('#page').val();
//     page++; 
//     $('#page').val(page);
//     get_astro_data(page); 
//   }


//   function get_astro_data(page)
//   {
//     var _token = '{{ csrf_token() }}';
//     $.ajax({
//       url: "",
//       type: "get",
//       data: {page:page},
//       dataType:"HTML",
//       headers:{'X-CSRF-TOKEN': _token},
//       cache: false,
//       success: function(resp){ 
//         $('#astro_list').append(resp);
//       }
//     });
//   }

function change_astro_status(astro_id,status)
{


 var is_status = 0;
 if(status.checked)
 {
   is_status = 1;
 }else{
  is_status=0;
}
var _token = '{{ csrf_token() }}';


$.ajax({
  url: "{{ route($routeName.'.astrologer.change_astro_status') }}",
  type: "POST",
  data: {astro_id:astro_id,status:is_status},
  dataType:"JSON",
  headers:{'X-CSRF-TOKEN': _token},
  cache: false,
  success: function(resp){
    if(resp.success)
    {
      alert(resp.message);
    }else{
      alert(resp.message);
    }
    
  }
});





}



function approve_astro(astro_id,is_approve)
{
//   if(confirm('Are You Want TO Approve ?') == return true)
// {

 var approve = 0;
 if(is_approve.checked)
 {
   approve = 1;
 }else{
  approve=0;
}
var _token = '{{ csrf_token() }}';

$.ajax({
  url: "{{ route($routeName.'.astrologer.approve_astrologer') }}",
  type: "POST",
  data: {astro_id:astro_id,is_approve:approve},
  dataType:"JSON",
  headers:{'X-CSRF-TOKEN': _token},
  cache: false,
  success: function(resp){
    if(resp.message)
    {
      alert(resp.message);
    }else{
      alert(resp.message);
    }

    
  }
});
}







</script>
