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
            <h4 class="mb-0">State List</h4>
            <div class="page-title-right">
                <ol class="breadcrumb m-0">
                    <a href="{{ route($routeName.'.states.add',['back_url'=>$BackUrl]) }}"><button type="button" class="btn btn-info  m-l-15 text-white"><i
            class="fa fa-plus-circle"></i> Create State</button></a>
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
              <h4 class="card-title">State List</h4>
              <div class="table-responsive m-t-40">
                <table id="examplestate" class="table display table-striped border no-wrap">
                  <thead>
                    <tr>
                     <th scope="col">#ID</th>
                     <th scope="col">Country</th>
                     <th scope="col">Name</th>
                     <th scope="col">Status</th>
                     <th scope="col">Date Created</th>
                     <th scope="col">Action</th>

                   </tr>
                 </thead>
                 <tbody>

                  <?php if(!empty($states) && $states->count() > 0){
                    $i = 1;   


                    foreach ($states as $state){

                       $country = $state->country->name;

                      

                      ?>
                      <tr>
                        <td>{{$i++}}</td>
                        <td>{{$country}}</td>
                        <td>{{$state->name}}</td>
                        <td><?php  echo ($state->status==1)?'Active':'Inactive';  ?></td>
                        <td>{{date('d M Y',strtotime($state->created_at))}}</td>

                        <td>
                          <a class="btn btn-success" href="{{route($routeName.'.states.edit', ['id'=>$state->id,'back_url'=>$BackUrl])}}" title="Edit"><i class="fas fa-edit"></i></a>
                          <a href="{{route($routeName.'.states.delete', ['id'=>$state->id,'back_url'=>$BackUrl])}}" onclick="return confirm('Are You Want To delete?')" title="Delete" class="btn btn-danger"><i class="fas fa-trash"></i></a>
                        </td>
                        
                      </tr>

                    <?php }}?>

                  </tbody>

                </table>

                {{ $states->appends(request()->input())->links('admin.pagination') }}

              </div>
            </div>
          </div>
        </div>
      </div>

  @include('admin.common.footer')
