@include('admin.common.header')

<?php
$BackUrl = CustomHelper::BackUrl();
$routeName = CustomHelper::getAdminRouteName();
//$old_name = (request()->has('name'))?request()->name:'';


?>

<div class="row">
    <div class="col-12">
        <div class="page-title-box d-flex align-items-center justify-content-between">
            <h4 class="mb-0">Expertises</h4>
            <div class="page-title-right">
                <ol class="breadcrumb m-0">
                    <a href="{{ route($routeName.'.expertises.add',['back_url'=>$BackUrl]) }}"><button type="button" class="btn btn-info m-l-15 text-white"><i
            class="fa fa-plus-circle"></i> Create new</button></a>
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
              <h4 class="card-title"></h4>
              <div class="table-responsive m-t-40">
                <table id="examplestate" class="table display table-striped border no-wrap">
                  <thead>
                    <tr>
                     <th class="">S.No</th>
                     <th class="">Name</th>  
                     <th class="">Status</th>                  
                     <th class="">Action</th>

                   </tr>
                 </thead>
                 <tbody>

                   <?php if(!empty($expertises) && $expertises->count() > 0){
                    $i = 1;
                    foreach ($expertises as $expert){

                     $expert_name = (isset($expert->name))?$expert->name:'';
                     
                     ?>
                     <tr>
                      <td>{{$i++}}</td>                      
                      <td>{{$expert_name}}</td>
                      <td><?php  echo ($expert->status==1)?'Active':'Inactive';  ?></td>
                      <td>
                        <a href="{{route($routeName.'.expertises.edit', ['id'=>$expert->id,'back_url'=>$BackUrl])}}" title="Edit"><i class="fas fa-edit"></i></a>&nbsp;&nbsp;
                        <a href="{{route($routeName.'.expertises.delete', ['id'=>$expert->id,'back_url'=>$BackUrl])}}" title="Delete" onclick="confirm('Are You Want To Delete ?')"><i class="fas fa-trash"></i></a>
                      </td>

                    </tr>

                  <?php }}?>

                </tbody>

              </table>

               {{ $expertises->appends(request()->input())->links('admin.pagination') }}
            </div>
          </div>
        </div>
      </div>
    </div>


@include('admin.common.footer')

