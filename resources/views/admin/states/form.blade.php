@include('admin.common.header')
<?php
$back_url = (request()->has('back_url'))?request()->input('back_url'):'';
if(empty($back_url)){
    $back_url = 'admin/states';
}

$name = (isset($states->name))?$states->name:'';
$country_id = (isset($states->country_id))?$states->country_id:'';

$id = (isset($states->id))?$states->id:'';

$status = (isset($states->status))?$states->status:1;

$storage = Storage::disk('public');

    //pr($storage);

$path = 'states/';
?>
<?php //print_r($states); ?>
<!-- start page title -->
<div class="row">
    <div class="col-12">
        <div class="page-title-box d-flex align-items-center justify-content-between">
            <h4 class="mb-0">{{ $page_Heading }}</h4>
            <div class="page-title-right">
                <ol class="breadcrumb m-0">
                    <?php if(request()->has('back_url')){ $back_url= request('back_url');  ?>
                    <a href="{{ url($back_url)}}"><button type="button" class="btn btn-info  m-l-15 text-white"><i
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
                               <!--  <h4 class="card-title">{{ $page_Heading }}</h4> -->
                                 <form method="POST" action="" accept-charset="UTF-8" enctype="multipart/form-data" role="form" class="mt-4">
                                {{ csrf_field() }}

                                <div class="form-group">
                                     <label for="exampleInputEmail1" class="form-label">Country Name</label>
                                     <select name="country_id" id="country_id" class="form-control select2-single">                                        
                                         <?php                                   
                                            foreach($countries as $country)
                                            {
                                         ?>
                                         <option value="{{$country->id}}" <?php if($country_id == $country->id) echo 'selected'; ?>>{{$country->name}}</option>
                                     <?php } ?>
                                     </select>
                                </div>

                               <input type="hidden" name="id" value="{{$id}}">
                                    <div class="form-group">
                                        <label for="exampleInputEmail1" class="form-label">State Name</label>
                                        <input type="text" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp" placeholder="Enter State Name" name="name" value="{{ old('name', $name) }}">
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
<script type="text/javascript">
  $(document).ready(function() {
    $('.select2-single').select2();
  });
</script>