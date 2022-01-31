@include('admin.common.header')
<?php



$back_url = (request()->has('back_url'))?request()->input('back_url'):'';
if(empty($back_url)){
  $back_url = 'admin/notifications';
}

?>



    <div class="row">
      <div class="col-6">
        @include('snippets.errors')
        @include('snippets.flash')
        <!-- table responsive -->
        <div class="card">

         <div class="card-body">
           
          <h4 class="mb-3 header-title">Send Notification To User</h4>
             <!-- <h6>Note:</h6>
           <p></p> -->
               
          <form method="POST" action="{{route('admin.notifications.index')}}" role="form" class="mt-4">
            {{ csrf_field() }}

             <input type="hidden" name="type" value="user">

            <div class="form-group">
                <label for="exampleInputEmail1" class="form-label">Select User</label>
                <select multiple name="user_id[]" id="user_id" class="form-control basic-single">
                  <option value="0" selected>Select All</option>
                @foreach($users as $user)
                  <option value="{{$user->id}}">{{$user->name}}</option>
                @endforeach
                 
                </select>               
              </div> 

               <div class="form-group">
                <label for="exampleInputEmail1" class="form-label">Title</label>
                <input type="text"  name="title" id="title" class="form-control" value="">               
              </div>  

                <div class="form-group">
                <label for="exampleInputEmail1" class="form-label">Message</label>
                <textarea type="text"  name="text" id="text" class="form-control" value=""></textarea>          
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

      <div class="col-6">
        @include('snippets.errors')
        @include('snippets.flash')
        <!-- table responsive -->
        <div class="card">
         <div class="card-body">
           <h4 class="mb-3 header-title">Send Notification To Astrologer</h4>
               
          <form method="POST" action="{{route('admin.notifications.index')}}" role="form" class="mt-4">
            {{ csrf_field() }}

            <input type="hidden" name="type" value="astrologer">

             <div class="form-group">
                <label for="exampleInputEmail1" class="form-label">Select Astrologer</label>
                <select multiple name="astro_id[]" id="astro_id" class="form-control basic-single">
                  <option value="0" selected>Select All</option>
                @foreach($astrologers as $astrologer)
                  <option value="{{$astrologer->id}}">{{$astrologer->name}}</option>
                @endforeach
                 
                </select>               
            </div> 

               <div class="form-group">
                <label for="exampleInputEmail1" class="form-label">Title</label>
                <input type="text"  name="title" id="title" class="form-control" value="">               
              </div>  

                <div class="form-group">
                <label for="exampleInputEmail1" class="form-label">Message</label>
                <textarea type="text"  name="text" id="text" class="form-control" value=""></textarea>          
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

<script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>
