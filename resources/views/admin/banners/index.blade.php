@include('admin.common.header')

<?php
$BackUrl = CustomHelper::BackUrl();
$routeName = CustomHelper::getAdminRouteName();
//$old_name = (request()->has('name'))?request()->name:'';


?>

<div class="row">
    <div class="col-12">
        <div class="page-title-box d-flex align-items-center justify-content-between">
            <h4 class="mb-0">Banners</h4>
            <div class="page-title-right">
                <ol class="breadcrumb m-0">
                    <a href="{{ route($routeName.'.banners.add',['back_url'=>$BackUrl]) }}"><button type="button" class="btn btn-info m-l-15 text-white"><i
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
                     <th class="">Banner</th>
                     <th class="">Link</th>
                     <th class="">Type</th>  
                     <th class="">Status</th>                  
                     <th class="">Action</th>

                   </tr>
                 </thead>
                 <tbody>

                   <?php 

                   if(!empty($banners) && $banners->count() > 0){
                    $i = 1;
                    foreach ($banners as $banner){                   
                     
                     ?>
                     <tr>
                      <td>{{$i++}}</td> 
                     <td>                          
                        <?php
                          $image = isset($banner->img) ? $banner->img : '';
                          $storage = Storage::disk('public');
                          $path = 'banners';
                          if(!empty($image))
                          {
                            
                        ?>
                         <a href="{{ url('public/storage/'.$path.'/'.$image) }}" target='_blank'><img src="{{ url('public/storage/'.$path.'/'.$image) }}" style="width:200px;height:100px;"></a>
                    <?php }else{ ?>

                             <a href="{{ url('public/storage/'.$path.'/default-banner.jpg') }}" target='_blank'><img src="{{ url('public/storage/'.$path.'/default-banner.jpg') }}" style="width:200px;height:100px;"></a>

                        <?php } ?>
                        
                      </td>                      
                      <td>{{$banner->link}}</td>
                      <td>{{$banner->type}}</td>
                      <td><?php  echo ($banner->status==1)?'Active':'Inactive';  ?></td>
                      <td>
                        <a href="{{route($routeName.'.banners.edit', ['id'=>$banner->id,'back_url'=>$BackUrl])}}" title="Edit"><i class="fas fa-edit"></i></a>&nbsp;&nbsp;
                        <a href="{{route($routeName.'.banners.delete', ['id'=>$banner->id,'back_url'=>$BackUrl])}}" title="Delete" onclick="confirm('Are You Want To Delete ?')"><i class="fas fa-trash"></i></a>
                      </td>

                    </tr>

                  <?php }}?>

                </tbody>

              </table>

               {{ $banners->appends(request()->input())->links('admin.pagination') }}
            </div>
          </div>
        </div>
      </div>
    </div>


@include('admin.common.footer')

