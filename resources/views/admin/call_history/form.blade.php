@include('admin.common.header')
<?php



$back_url = (request()->has('back_url'))?request()->input('back_url'):'';
if(empty($back_url)){
  $back_url = 'admin/report_type';
}

$id = isset($report_type->id) ? $report_type->id : '';
$type = isset($report_type->type) ? $report_type->type : '';
$status = (isset($report_type->status))?$report_type->status:1;

?>

<div class="row">
  <div class="col-12">
    <div class="page-title-box d-flex align-items-center justify-content-between">

     <h4 class="mb-0">{{ $page_Heading }}</h4>
     <div class="page-title-right">

      <ol class="breadcrumb m-0">
        <?php if(request()->has('back_url')){
           $back_url= request('back_url');  ?>
        <a href="{{ url($back_url)}}" style="float:right"><button type="button" class="btn btn-info  m-l-15 text-white"><i
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
          <h4 class="card-title">{{ $page_Heading }}</h4>
          <form method="POST" action="" accept-charset="UTF-8" enctype="multipart/form-data" role="form" class="mt-4">
            {{ csrf_field() }}

            <?php //print_r($report_type); ?>

            <input type="hidden" name="id" value="{{$id}}">             

               <div class="form-group">
                <label for="exampleInputEmail1" class="form-label">Type</label>
                <input type="text"  name="type" id="type" class="form-control" value="{{ old('type',$type) }}">               
              </div>        

              <div class="form-group">
                <label for="exampleInputPassword1" class="form-label">Status</label>
                Active: <input type="radio" name="status" value="1" <?php echo ($status == '1')?'checked':''; ?> checked>
                &nbsp;
                Inactive: <input type="radio" name="status" value="0" <?php echo ( strlen($status) > 0 && $status == '0')?'checked':''; ?> >

                @include('snippets.errors_first', ['param' => 'status'])
              </div>

              <button type="submit" class="btn btn-primary text-white">Submit</button>
            </form>
          </div>

        </div>
      </div>
    </div>



@include('admin.common.footer')

