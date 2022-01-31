@include('admin.common.header')
<?php



$back_url = (request()->has('back_url'))?request()->input('back_url'):'';
if(empty($back_url)){
  $back_url = 'admin/notifications';
}



?>



    <div class="row">
      <div class="col-12">
        @include('snippets.errors')
        @include('snippets.flash')
        <!-- table responsive -->
        <div class="card">
         <div class="card-body">
           <h4 class="mb-3 header-title">Send Notification</h4>
               
          <form method="POST" action="{{route('admin.notifications.index')}}" accept-charset="UTF-8" role="form" class="mt-4">
            {{ csrf_field() }}

               <div class="form-group">
                <label for="exampleInputEmail1" class="form-label">Title</label>
                <input type="text"  name="name" id="name" class="form-control" value="">               
              </div>  

                <div class="form-group">
                <label for="exampleInputEmail1" class="form-label">Message</label>
                <textarea type="text"  name="text" id="text" class="form-control" value=""></textarea>          
              </div> 

              <div class="form-group">
                <label for="exampleInputEmail1" class="form-label">Type</label>
                <select name="type" id="type" class="form-control">
                  <option value="" disabled selected>Select Type</option>
                  <option value="user">User</option>
                  <option value="astrologer">Astrologer</option>
                </select>               
              </div> 

               <div class="form-group">
                <label for="exampleInputEmail1" class="form-label">Upload Image</label>
                <input type="file"  name="image" id="image" class="form-control" value="">               
              </div>        

              <button type="submit" class="btn btn-primary text-white">Submit</button>
            </form>
          </div>

        </div>
      </div>

       


    </div>



@include('admin.common.footer')

