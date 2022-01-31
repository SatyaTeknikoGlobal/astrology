@include('admin.common.header')
<style>

  .text span{
   border: 1px solid darkred;
   padding: 2px 9px;
   border-radius: 21px;
   margin: 0px 1px;
   line-height: 30px;
   background-color: #8b00004a;
   color: #000;

 }
 .blk-flx{
  display: flex;
 }
 ul h6{
 	    line-height: 23px;
    font-size: 14px;
    font-weight: 500;
 }

.pro-div{
	       height: 50px;
    width: 88px;
    background: aqua;
    border-radius: 100%;
    text-align: center;
}

.pro-div h5{
	    line-height: 46px;
}
.language{
	line-height: 30px;
  font-weight: bold;
    color: darkred;
}
.about-me{
  line-height: 26px;
}

.card_info {
    width: 472px;
    margin-left: auto;
    margin-right: auto;
    border: 1px solid rgb(218 218 253 / 65%);
}




.close{
  border: none;
    outline: 0;
    border-radius: 100%;
    width: 40px;
    height: 40px;
    font-size: 28px;
    align-items: baseline;
    line-height: 30px;
    box-shadow: 0 2px 6px 0 rgb(218 218 253 / 65%), 0 2px 6px 0 rgb(206 206 238 / 54%);
    background-color: #8b0000ab;

}
.modal{
    transition: all 0.3s ease-in-out;
    transform: scale(1.3);
}
.gen-btn {
    position: absolute;
    /* display: block; */
    color: #FB7112;
    right: 18px;
    border: 1px solid;
    margin: 8px 2px;
    width: fit-content;
    padding: 6px 9px;
    border-radius: 5px;
}
.repotr-- {
    color: #FB7112;
    padding: 6px 9px;
    margin: 8px 2px;
    font-weight: 600;
    text-align: center;
}
.card-title b {
    color: #7f6755;
    margin-right: 8px;
    font-weight: 400;
}

.card-title {
    font-weight: 400;
}

.accordion-item .sn {
    font-weight: 700;
    color: #FB7112;
    line-height: 25px;
    overflow: hidden;
    font-size: 15px;
    text-overflow: ellipsis;
    -webkit-box-orient: vertical;
    display: -webkit-box;
    -webkit-line-clamp: 1;
}
.view_detail{
  display: none;
}

.status {
    position: relative;
    right: 2%;
    margin-left: auto;
    background-color: #fa6374;
    color: #fff;
}
#more {
    display: none;
}
#myBtn {
    color: #FB7112;
}


.show{
  transform: scale(1);
}
@media screen and (max-width: 767px){
	.pro-div{
		width: 209px;

		
	}
.gen-btn {
    /* width: 100%; */
    right: 0;
    left: auto;
    position: absolute;
}
  .repotr--{
    font-size: 16px
  }

   .blk-flx{
  display: flex;
 }
}




/*.show_complete{
    display:none;
}

.show_more{
    background:lightblue;
    color:navy;
    font-size:13px;
    padding:3px;
    cursor:pointer;
}*/
</style>

      <div class="row">
        <div class="col-12">
          <div class="page-title-box d-flex align-items-center justify-content-between">
            <h4 class="mb-0">User Profile</h4>

            <div class="page-title-right">
              <ol class="breadcrumb m-0">
                <?php if(request()->has('back_url')){ $back_url= request('back_url');  ?>
            <a href="{{ url($back_url)}}" style="float:right"><button type="button" class="btn btn-info d-lg-block m-l-15 text-white"><i
              class="fa fa-arrow-left"></i>  Back</button></a>
            <?php } ?>
              </ol>
            </div>

          </div>
        </div>
      </div>    
      <div class="row mb-4">
        <div class="col-xl-4">
          <div class="card overflow-hidden">
            <div class="profile-user"></div>
            <div class="card-body">
              <div class="profile-content ">
                <div class="profile-user-img text-center">


                <?php

                    $image = isset($user->image) ? $user->image : '';
                    $storage = Storage::disk('public');
                    $path = 'user';

                    if(!empty($image))
                    {
                ?>

                <a href="{{ url('public/storage/'.$path.'/'.$image) }}" target='_blank'><img src="{{ url('public/storage/'.$path.'/'.$image) }}" class="avatar-lg rounded-circle img-thumbnail"></a>
                
                <?php }else{ ?>
                  <a href="{{ url('public/assets/images/avatars/avatar.png') }}" target='_blank'><img src="{{ url('public/assets/images/avatars/avatar.png') }}" class="avatar-lg rounded-circle img-thumbnail"></a>
                <?php } ?>

               

                </div>
                <h5 class="mt-3 mb-3">{{$user->name}}</h5>                
                <p class="text"> <b><i class="fas fa-envelope"></i> Email: </b> 
                    {{$user->email}}
                
                </p>
                <p class="text"><b><i class="fas fa-phone"></i> Phone: </b>{{$user->phone}}</p>

                <p class="text language"><b><i class="fas fa-wallet"></i> Wallet:</b>
                  {{$user->wallet}}&nbsp;&nbsp;&nbsp;<a href="" class="btn btn-primary btn-sm" id="add_wallet" data-toggle="modal" data-target="#myModal">+ Add</a>
                 </p>

                 
              <!-- The Modal -->
              <div class="modal" id="myModal" data-aos="zoom-in-up">
                <div class="modal-dialog">
                  <div class="modal-content">
                  
                  
                    <!-- Modal Header -->
                    <div class="modal-header">
                      <h4 class="modal-title">Add Money to Wallet</h4>
                      <button type="button" class="close" data-dismiss="modal">&times;</button>
                    </div>
                    
                    <!-- Modal body -->
                     <form action='{{route("admin.user.add_wallet")}}' id="wallet_form" method='post'>
                       <div class="modal-body">                    
                          @csrf
                        <input type="hidden" value="{{$user->id}}" name="user_id">
                        <div>
                          <select class="form-control" id="amount_type" name="amount_type">
                            <option value='' selected disabled>Select Type</option>
                          <option value='DEBIT'>Debit</option>
                          <option value='CREDIT'>Credit</option>
                        </select>
                        </div>
                        <div class="form-group d-flex" style="position: relative;">
                         <input type="number" class="form-control" id="wallet_amount" aria-describedby="emailHelp" placeholder="Enter Amount" name="amount">                       
                        </div>                        
                         <div class="form-group d-flex" style="position: relative;">
                         <textarea class="form-control" id="wallet_description" aria-describedby="emailHelp" placeholder="Enter Description" name="description"></textarea>                    
                        </div>
                      </div>
                      <div class="modal-footer">
                        <button type="submit" class="btn btn-info btn-sm">Submit</button>
                        <button type="button" class="btn btn-danger btn-sm" data-dismiss="modal">Close</button>
                      </div>
                    </form>
                    
                  
                  </div>
                </div>
              </div>
  
                        
              </div>
            </div>
          </div>
        </div>
        <div class="col-xl-8">
          <div class="card mb-0">
            <!-- Nav tabs -->
            <ul class="nav nav-tabs nav-tabs-custom nav-justified" role="tablist">
              <li class="nav-item">
                <a class="nav-link <?php if($tabs == 'members') echo 'active';?>" data-bs-toggle="tab" href="#about" role="tab" aria-selected="true">
                  <i class="bx bx-user-circle font-size-20"></i>
                  <span class="d-none d-sm-block">Family Members</span> 
                </a>
              </li>
              <li class="nav-item">
                <a class="nav-link <?php if($tabs == 'transactions') echo 'active';?>" data-bs-toggle="tab" href="#transactions" role="tab" aria-selected="false">
                  <i class="fas fa-credit-card"></i>
                  
                  <span class="d-none d-sm-block">Transaction History</span> 
                </a>
              </li>
              <li class="nav-item">
                <a class="nav-link <?php if($tabs == 'report') echo 'active';?>" data-bs-toggle="tab" href="#report" role="tab" aria-selected="false">
                  <i class="fa fa-file font-size-20"></i>
                  <span class="d-none d-sm-block">Report History</span>   
                </a>
              </li>
               <li class="nav-item">
                <a class="nav-link <?php if($tabs == 'faqs')  echo 'active';?>" data-bs-toggle="tab" href="#faqs" role="tab" aria-selected="false">
                  <i class="fa fa-question font-size-20"></i>
                  <span class="d-none d-sm-block">Asked Question</span>   
                </a>
              </li>
             
              
            </ul>
            <!-- Tab content -->
            <div class="tab-content p-4">
              <div class="tab-pane <?php if($tabs == 'members') echo 'active';?>" id="about" role="tabpanel">
                <div>
                  <div>
                    <h5 class="font-size-16 mb-4">About Me</h5>
                    <p class="about-me">
                    
                    </p>

                  
                  </div>           

                </div>
              </div>

          <!------------------ TRANSACTION ------------------------------------>



              <div class="tab-pane <?php if($tabs == 'transactions') echo 'active';?>" id="transactions" role="tabpanel">
                <div>   
                          
                  <div class="table-responsive">
                      <table id="examplestate" class="table display table-striped border no-wrap">
                        <thead>
                          <tr>                                                    
                            <th>Amount</th>
                            <th>Amount Type</th>
                            <th>Description</th>
                          </tr>
                        </thead>
                        <tbody>
                       
                        @foreach($transactions as $transact)
                          <tr>                           
                            <td>{{$transact->amount}}</td>
                            <td>{{$transact->amount_type}}</td>
                            <td>{{$transact->description}}</td>
                           
                         @endforeach                               
                          </tr>
                       
                        </tbody>
                          
                      </table>


                  </div>

                </div>
              </div>
            <!-------------------------- REPORT HISTORY ------------------------------>

               <div class="tab-pane <?php if($tabs == 'report') echo 'active';?>" id="report" role="tabpanel">
                <div>
          <?php
            foreach($user_report as $rp)
            {
              $report_name = App\Report_Type::select('type')->where('id',$rp->report_type)->first();

         ?>
          <p class="about-me">
            Read Your {{$report_name->type}}<span style="float: right;color: #FB7112;" role="button" onclick="view_report(<?php echo $rp->id; ?>)"><b>View</b></span>
          </p>  

          <div class="card card_info view_detail" id="view_detail<?php echo $rp->id; ?>"> 

              <h4 class="repotr--"> <b>{{$report_name->type}}</b> </h4>
              
          <div class="card-body">
            <div class="d-flex"><h4 class="card-title mb-3" style="color: #FB7112;">{{$rp->first_name ?? ''}} {{$rp->last_name ?? ''}}</h4>
              </div>
              <div style="float: right56">
                <h4 class="card-title mb-3"> <b>marital status</b> {{$rp->marital_status ?? ''}} </h4>
                <h4 class="card-title mb-3"> <b>occupation</b> {{$rp->occupation ?? ''}} </h4>
                <h4 class="card-title mb-3"><b>amount:</b> 800 </h4>
                <h4 class="card-title mb-3"> <b>Payment Status:</b> Pending </h4>
              </div>
              <h4 class="card-title mb-3"> <b>Mobile no:</b>{{$rp->number ?? ''}}
                </h4><h4 class="card-title mb-3"> <b>Gender:</b> {{$rp->gender ?? ''}}</h4>
                <h4 class="card-title mb-3">  <b>Date Of Birth:</b> {{$rp->dob ?? ''}}</h4>
                <h4 class="card-title mb-3"> <b>Place Of Birth: </b> {{$rp->pob ?? ''}} </h4>
                <h4 class="card-title mb-3"><b>Time Of Birth: </b> {{$rp->tob ?? ''}}</h4>
                <p class="card-title mb-3"> <b>Address</b> {{$rp->address ?? ''}}</p>

                <p class="card-title mb-3">
                  <b>Description:</b>
                 {{$rp->any_comments ?? ''}}
                </p>
              </div>
        </div>
      <?php } ?>
      <hr>
      </div>
              
              </div>

               <!-------------------------- QUESTION HISTORY ------------------------------>

               <div class="tab-pane <?php if($tabs == 'faqs') echo 'active';?>" id="faqs" role="tabpanel">

                <div>
        <h5 class="font-size-16 mb-4">Asked Questions</h5>

        <div class="card-body p-0">
          <div class="accordion accordion-flush" id="accordionFlushExample">
          @foreach($user_faqs as $faq)
            <div class="accordion-item mb-2">

              <div style="display: flex;padding: 0px 1.25rem;" class="my-2">

               <?php if(!empty($faq->astrologer_id)){ 

                 $astro =  App\Astrologer::select('id','name','real_name')->where('id',$faq->astrologer_id)->first();

                ?>
                <span><a href="" class="sn">{{$astro->real_name}}  ({{$astro->name}})</a></span>
              <?php } ?>

                <?php if($faq->status == 1){ ?>
                    <span class=" btn-soft-danger status btn-sm text-truncate"> <b>Active</b></span>
                  <?php }  if($faq->status == 0){ ?>
                    <span class=" btn-soft-danger status btn-sm text-truncate"> <b>Inactive</b></span>
                  <?php } ?>

              
              </div>
              <div class="w-100">
                <h2 class="accordion-header d-flex" id="flush-headingOne">
                  <span class="accordion-button fw-medium" type="button" data-bs-toggle="collapse" data-bs-target="#flush-collapseOne{{$faq->id}}" aria-expanded="true" aria-controls="flush-collapseOne"> 
                   {!! $faq->question !!}
                  </span>
                </h2>
                <div id="flush-collapseOne{{$faq->id}}" class="accordion-collapse active collapse" aria-labelledby="flush-headingOne" data-bs-parent="#accordionFlushExample" style="">
                  <div class="accordion-body text-muted">
                    {!! $faq->ans !!}
                  
                </div>
              </div>
            </div>
          </div>
        @endforeach
         
      </div><!-- end accordion -->
    </div>

  </div>               
              </div>
             
            </div>
          </div>
        </div>

      </div>

@include('admin.common.footer');

<script>

  $("#wallet_form").submit(function() {
 
  var amount_type = $("#amount_type").val();
  var wallet_amount = $("#wallet_amount").val();
  var wallet_description = $("#wallet_description").val();  
  if((amount_type && wallet_amount && wallet_description) == '')
  {
    alert("Please Fill All Details !!!!");
    return false;

  }else if((amount_type == '') || (wallet_amount == '') || (wallet_description == ''))
  {
    alert("Please Fill All Details !!!!");
    return false;

  }else{
    document.getElementById("wallet_form").submit();  
    
  }

});


  $(".show_more").toggle(function(){
    $(this).text("less..").siblings(".show_complete").show();    
}, function(){
    $(this).text("more..").siblings(".show_complete").hide();    
});
</script>



<script>




  $("'#").show();
  function edit_comment(rate_id){
    $('#comment'+rate_id).toggle(1000);
    $('#hide5'+rate_id).hide();
  }




  function view_report(id){
    $('#view_detail'+id).toggle(1000);


  }

function myFunction() {
  var dots = document.getElementById("dots");
  var moreText = document.getElementById("more");
  var btnText = document.getElementById("myBtn");

  if (dots.style.display === "none") {
    dots.style.display = "inline";
    moreText.style.display = "none";

  } else {
    dots.style.display = "none";
    btnText.style.display = "none";


    moreText.style.display = "inline";
  }
}
</script>