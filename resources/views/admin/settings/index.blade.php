@include('admin.common.header')

<?php
$BackUrl = CustomHelper::BackUrl();
$routeName = CustomHelper::getAdminRouteName();
//$old_name = (request()->has('name'))?request()->name:'';


?>
<!-- start page title -->
<div class="row">
    <div class="col-12">
        <div class="page-title-box d-flex align-items-center justify-content-between">
            <h4 class="mb-0">Setting</h4>
            <div class="page-title-right">
                <ol class="breadcrumb m-0">
                    <a href="{{ route($routeName.'.settings.add',['back_url'=>$BackUrl]) }}"><button type="button" class="btn btn-info  m-l-15 text-white"><i
            class="fa fa-plus-circle"></i> Create New</button></a>
            </ol>
    </div>

</div>
</div>
</div>
<!-- end page title -->


      <div class="row">
        <div class="col-12">
          <!-- table responsive -->

          @include('snippets.errors')
          @include('snippets.flash')
          <div class="card">
            <div class="card-body">
              <h4 class="card-title"></h4>
              <div class="table-responsive m-t-40">
                <table id="examplestate" class="table display table-striped border no-wrap">
                  <thead>
                    <tr>
                     <th class="">S.No</th>
                     <th class="">Refer Amount</th>                    
                     <th class="">About Us</th>
                     <th class="">Privacy Policy</th>
                     <th class="">Email</th>                  
                     <th class="">Phone</th>
                     <th class="">App Name</th>
                     <th class="">Terms & Conditions</th>
                    <!--  <th>Action</th> -->

                   </tr>
                 </thead>
                 <tbody>

                  @foreach($settings as $set)
                  <tr>
                    <td>{{$set->id}}</td>
                    <td>{{$set->refer_earn_amount}}</td>
                    <td>{{$set->about_us}}</td>
                    <td>{{$set->privacypolicy}}></td>
                    <td>{{$set->contact_email}}</td>
                    <td>{{$set->contact_phone}}</td>
                    <td>{{$set->app_name}}</td>
                    <td>{{$set->terms}}</td>
                  </tr>
                  @endforeach

                   

                </tbody>

              </table>

              
            </div>
          </div>
        </div>
      </div>
    </div>




@include('admin.common.footer')

<script>




</script>