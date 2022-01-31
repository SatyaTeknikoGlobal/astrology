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
            <h4 class="mb-0">Categories</h4>
            <div class="page-title-right">
                <ol class="breadcrumb m-0">
                    <a href="{{ route($routeName.'.categories.add',['back_url'=>$BackUrl]) }}"><button type="button" class="btn btn-info  m-l-15 text-white"><i
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
                     <th class="">Name</th>                    
                     <th class="">Status</th>                  
                     <th class="">Action</th>

                   </tr>
                 </thead>
                 <tbody>

                   <?php if(!empty($categories) && $categories->count() > 0){
                    $i = 1;
                    foreach ($categories as $category){

                     ?>
                     <tr>
                      <td>{{$i++}}</td>                      
                      <td>{{$category->name}}</td>                    
                       <td>
                       <select id='change_category_status{{$category->id}}' onchange='change_category_status({{$category->id}})' class="form-control">
                        <option value='1' <?php if($category->status ==1)echo "selected";?> >Active</option>
                        <option value='0' <?php if($category->status ==0)echo "selected";?>>InActive</option>
                      </select> 

                    </td>
                      
                      <td>
                        <a href="{{route($routeName.'.categories.edit', ['id'=>$category->id,'back_url'=>$BackUrl])}}" title="Edit"><i class="fas fa-edit"></i></a>&nbsp;&nbsp;
                        <a href="{{route($routeName.'.categories.delete', ['id'=>$category->id,'back_url'=>$BackUrl])}}" title="Delete" onclick="confirm('Are You Want To Delete ?')"><i class="fas fa-trash"></i></a>
                      </td>

                    </tr>

                  <?php }}?>

                </tbody>

              </table>

               {{ $categories->appends(request()->input())->links('admin.pagination') }}
            </div>
          </div>
        </div>
      </div>
    </div>




@include('admin.common.footer')

<script>

 function change_category_status(id)
 {  
  var status = $('#change_category_status'+id).val();
  var _token = '{{ csrf_token() }}';
  $.ajax({
    url: "{{ route($routeName.'.categories.change_category_status') }}",
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