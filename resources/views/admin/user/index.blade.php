@include('admin.common.header')

<?php
$BackUrl = CustomHelper::BackUrl();
$routeName = CustomHelper::getAdminRouteName();
//$old_name = (request()->has('name'))?request()->name:'';

$search = isset($search) ? $search :'';
?>



<!-- start page title -->
<div class="row">
    <div class="col-12">
        <div class="page-title-box d-flex align-items-center justify-content-between">
            <h4 class="mb-0">Users</h4>
            <div class="page-title-right">
                <ol class="breadcrumb m-0">
                  <a href="{{ route($routeName.'.user.export', ['back_url' => $BackUrl]) }}" class="btn btn-info d-none d-lg-block m-l-15 text-white" id="is_export"><i class="fas fa-file-export" aria-hidden="true"></i>&nbsp;&nbsp;Export</a>&nbsp;&nbsp;&nbsp;
                    <a href="{{ route('admin.user.add',['back_url'=>$BackUrl])}}"><button type="button" class="btn btn-info  m-l-15 text-white"><i
          class="fa fa-plus-circle"></i> Create New</button></a>
            </ol>
    </div>

</div>
</div>
</div>
<!-- end page title -->


<div class="row">
  <div class="col-12">
   <div class="card">
    <div class="card-body">
      <div class="mb-3">
        <label class="form-label">Search By Name,Email,Phone</label>

        <form id="filter_form">
          <div class="input-group">
            <input type="text" name="search" value="{{old('search',$search)}}" placeholder="Search..." class="form-control">
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
        <div class="card">
          <div class="card-body">
            <h4 class="card-title"></h4>
            <div class="table-responsive m-t-40">
              <table id="examplestate" class="table display table-striped border no-wrap">
                <thead>
                  <tr>
                   <th class="">S.No</th>
                   <th class="">Name</th>  
                   <th class="">Email</th>  
                   <th class="">Phone</th> 
                   <th class="">Wallet</th>
                   <th class="">Image</th>                       
                   <th class="">Status</th>                  
                   <th class="">Action</th>

                 </tr>
               </thead>
               <tbody>

                 <?php if(!empty($users) && $users->count() > 0){
                  $i = 1;
                  foreach ($users as $user){                 

                    ?>
                    <tr>
                      <td>{{$i++}}</td>                      
                      <td>{{$user->name}}</td>
                      <td>{{$user->email}}</td>
                      <td>{{$user->phone }}</td>
                      <td>{{$user->wallet }}</td> 
                      <td>                          
                        <?php

                        $image = isset($user->image) ? $user->image : '';
                        $storage = Storage::disk('public');
                        $path = 'user/';
                        $imageUrl = asset('public/assets/images/avatars/avatar.png');
                        if(!empty($image) && $storage->exists($path.$image)){
                          $imageUrl =  url('public/storage/'.$path.'/'.$image);
                        }?>
                          <a href="{{ $imageUrl }}" target='_blank'><img src="{{ $imageUrl }}" style="width:50px;height:50px;"></a>
                        
                      </td>                      

                      <td>
                       <select id='change_user_status{{$user->id}}' onchange='change_user_status({{$user->id}})' class="form-control">
                        <option value='1' <?php if($user->status ==1)echo "selected";?> >Active</option>
                        <option value='0' <?php if($user->status ==0)echo "selected";?>>InActive</option>
                      </select> 

                    </td>


                    <td>
                      <a class="btn btn-info" href="{{route($routeName.'.user.info', ['id'=>$user->id,'back_url'=>$BackUrl])}}" title="Info"><i class="fas fa-info"></i></a>&nbsp;&nbsp;
                      <a class="btn btn-success" href="{{route($routeName.'.user.edit', ['id'=>$user->id,'back_url'=>$BackUrl])}}" title="Edit"><i class="fas fa-edit"></i></a>&nbsp;&nbsp;
                      <a class="btn btn-danger" href="{{route($routeName.'.user.delete', ['id'=>$user->id,'back_url'=>$BackUrl])}}" title="Delete" onclick="return confirm('Are You Want To Delete ?')"><i class="fas fa-trash"></i></a>
                    </td>

                  </tr>

                <?php }}?>



              </tbody>

            </table>
            {{ $users->appends(request()->input())->links('admin.pagination') }}

          </div>
        </div>
      </div>
    </div>
  </div>







@include('admin.common.footer')
<script>

   $("#is_export").on('click',function() {
    $('#is_export_value').val(1);
    $('#filter_form').submit();

  });

 function change_user_status(id){
  var status = $('#change_user_status'+id).val();


  var _token = '{{ csrf_token() }}';

  $.ajax({
    url: "{{ route($routeName.'.user.change_user_status') }}",
    type: "POST",
    data: {id:id, status:status},
    dataType:"JSON",
    headers:{'X-CSRF-TOKEN': _token},
    cache: false,
    success: function(resp){
      if(resp.success){
        alert(resp.message);
      }else{
        alert(resp.message);

      }
    }
  });


}


</script>

