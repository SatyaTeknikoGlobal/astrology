@include('admin.common.header')
<?php



$back_url = (request()->has('back_url'))?request()->input('back_url'):'';
if(empty($back_url)){
  $back_url = 'admin/categories';
}

$id = isset($settings->id) ? $settings->id : '';
$refer_earn_amount = isset($settings->refer_earn_amount) ? $settings->refer_earn_amount : '';
$about_us = isset($settings->about_us) ? $settings->about_us : '';
$privacypolicy = isset($settings->privacypolicy) ? $settings->privacypolicy : '';
$contact_email = isset($settings->contact_email) ? $settings->contact_email : '';
$contact_phone = isset($settings->contact_phone) ? $settings->contact_phone : '';
$app_name = isset($settings->app_name) ? $settings->app_name : '';
$terms = (isset($settings->terms))?$settings->terms:'';

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
          <form method="POST" action="" accept-charset="UTF-8" role="form" class="mt-4">
            {{ csrf_field() }}

            <input type="hidden" name="id" value="{{$id}}">             

               <div class="form-group">
                <label for="exampleInputEmail1" class="form-label">Referal Amount</label>
                <input type="number"  name="refer_earn_amount" id="refer_earn_amount" class="form-control" value="{{ old('refer_earn_amount',$refer_earn_amount) }}">               
              </div>  

               <div class="form-group">
                <label for="exampleInputEmail1" class="form-label">About Us</label>
                <textarea type="text"  name="about_us" id="about_us" class="form-control" value="{{ old('about_us',$about_us) }}"></textarea>             
              </div>  

                <div class="form-group">
                <label for="exampleInputEmail1" class="form-label">Privacy Policy</label>
                <textarea type="text"  name="privacypolicy" id="privacypolicy" class="form-control" value="{{ old('privacypolicy',$privacypolicy) }}"></textarea>             
              </div>  

               <div class="form-group">
                <label for="exampleInputEmail1" class="form-label">Contact Email</label>
                <input type="email"  name="contact_email" id="contact_email" class="form-control" value="{{ old('contact_email',$contact_email) }}">               
              </div>  

               <div class="form-group">
                <label for="exampleInputEmail1" class="form-label">Contact Phone</label>
                <input type="number"  name="contact_phone" id="contact_phone" class="form-control" value="{{ old('contact_phone',$contact_phone) }}">               
              </div>  

               <div class="form-group">
                <label for="exampleInputEmail1" class="form-label">AppName</label>
                <input type="text"  name="app_name" id="app_name" class="form-control" value="{{ old('app_name',$app_name) }}">               
              </div>  

              <div class="form-group">
                <label for="exampleInputEmail1" class="form-label">Terms&Conditions</label>
                <textarea type="text"  name="terms" id="terms" class="form-control" value="{{ old('terms',$terms) }}"></textarea>               
              </div>  

            

              <button type="submit" class="btn btn-primary text-white">Submit</button>
            </form>
          </div>

        </div>
      </div>
    </div>



@include('admin.common.footer')

