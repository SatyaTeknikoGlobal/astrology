@include('admin.common.header')

<?php
$BackUrl = CustomHelper::BackUrl();
$routeName = CustomHelper::getAdminRouteName();
$old_name = (request()->has('name'))?request()->name:'';


?>

<!-- start page title -->
<div class="row">
    <div class="col-12">
        <div class="page-title-box d-flex align-items-center justify-content-between">
            <h4 class="mb-0">City List</h4>
            <div class="page-title-right">
                <ol class="breadcrumb m-0">
                    <a href="{{ route($routeName.'.cities.add',['back_url'=>$BackUrl]) }}"><button type="button" class="btn btn-info m-l-15 text-white"><i
            class="fa fa-plus-circle"></i> Create City</button></a>
            </ol>
    </div>

</div>
</div>
</div>

      <div class="row">
        <div class="col-12">
          <!-- table responsive -->

          @include('snippets.errors')
          @include('snippets.flash')
          <div class="card">
            <div class="card-body">
              <h4 class="card-title">City List</h4>
              <div class="table-responsive m-t-40">
                <table id="examplestate" class="table display table-striped border no-wrap">
                  <thead>
                    <tr>
                     <th class="">S.No</th>

                     <th class="">Country</th>                     
                     <th class="">State </th>
                     <th class="">City </th>
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
                      <td>{{$i++}}</td>
                      <td>{{$countryname}}</td>
                       <td>{{$stateName}}</td>
                      <td>{{$city->name}}</td>
                     
                      <td><?php  echo ($city->status==1)?'Active':'Inactive';  ?></td>
                      <td>
                        <a class="btn btn-success" href="{{route($routeName.'.cities.edit', ['id'=>$city->id,'back_url'=>$BackUrl])}}" title="Edit"><i class="fas fa-edit"></i></a>
                         <a href="{{route($routeName.'.cities.delete', ['id'=>$city->id,'back_url'=>$BackUrl])}}" title="Delete" class="btn btn-danger" onclick="return confirm('Are You Want To Delete ?')"><i class="fas fa-trash"></i></a>
                      </td>

                    </tr>

                  <?php }}?>

                </tbody>

              </table>

               {{ $cities->appends(request()->input())->links('admin.pagination') }}
            </div>
          </div>
        </div>
      </div>
    </div>


@include('admin.common.footer')

