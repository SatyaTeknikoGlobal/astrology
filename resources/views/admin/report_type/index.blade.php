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
            <h4 class="mb-0">Report Types</h4>
            <div class="page-title-right">
                <ol class="breadcrumb m-0">
                    <a href="{{ route($routeName.'.report_type.add',['back_url'=>$BackUrl]) }}"><button type="button" class="btn btn-info  m-l-15 text-white"><i
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
                     <th class="">Banner</th>
                     <th class="">Description</th>
                      <th class="">Price</th>  
                     <th class="">Status</th>                  
                     <th class="">Action</th>

                   </tr>
                 </thead>
                 <tbody>

                   <?php if(!empty($report_type) && $report_type->count() > 0){
                    $i = 1;
                    foreach ($report_type as $rt){

                     ?>
                     <tr>
                      <td>{{$i++}}</td>                      
                      <td>{{$rt->type}}</td>

                       <td>                          
                        <?php
                          $image = isset($rt->banner) ? $rt->banner : '';
                          $storage = Storage::disk('public');
                          $path = 'report_type_banners';
                          if(!empty($image))
                          {
                            
                        ?>
                         <a href="{{ url('public/storage/'.$path.'/'.$image) }}" target='_blank'><img src="{{ url('public/storage/'.$path.'/'.$image) }}" style="width:200px;height:100px;"></a>
                    <?php }else{ ?>

                             <a href="{{ url('public/storage/'.$path.'/default-banner.jpg') }}" target='_blank'><img src="{{ url('public/storage/'.$path.'/default-banner.jpg') }}" style="width:200px;height:100px;"></a>

                        <?php } ?>
                        
                      </td>

                      <td>{{$rt->description}}</td>
                      <td>{{$rt->price}}</td>
                       <td>
                       <select id='change_reporttype_status{{$rt->id}}' onchange='change_reporttype_status({{$rt->id}})' class="form-control">
                        <option value='1' <?php if($rt->status ==1)echo "selected";?> >Active</option>
                        <option value='0' <?php if($rt->status ==0)echo "selected";?>>InActive</option>
                      </select> 

                    </td>
                      
                      <td>
                        <a href="{{route($routeName.'.report_type.edit', ['id'=>$rt->id,'back_url'=>$BackUrl])}}" title="Edit"><i class="fas fa-edit"></i></a>&nbsp;&nbsp;
                        <a href="{{route($routeName.'.report_type.delete', ['id'=>$rt->id,'back_url'=>$BackUrl])}}" title="Delete" onclick="confirm('Are You Want To Delete ?')"><i class="fas fa-trash"></i></a>
                      </td>

                    </tr>

                  <?php }}?>

                </tbody>

              </table>

               {{ $report_type->appends(request()->input())->links('admin.pagination') }}
            </div>
          </div>
        </div>
      </div>
    </div>




@include('admin.common.footer')

<script>

 function change_reporttype_status(id)
 {  
  var status = $('#change_reporttype_status'+id).val();
  var _token = '{{ csrf_token() }}';
  $.ajax({
    url: "{{ route($routeName.'.report_type.change_reporttype_status') }}",
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