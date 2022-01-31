@include('admin.common.header')

<?php
$BackUrl = CustomHelper::BackUrl();
$routeName = CustomHelper::getAdminRouteName();
//$old_name = (request()->has('name'))?request()->name:'';


?>

<div class="row">
    <div class="col-12">
        <div class="page-title-box d-flex align-items-center justify-content-between">
            <h4 class="mb-0">Transactions</h4>
            <div class="page-title-right">
                <ol class="breadcrumb m-0">

                </ol>
            </div>

        </div>
    </div>
</div>

<?php 
$role = isset($_GET['role']) ? $_GET['role'] :'';

?>

<div class="row">
    <div class="col-lg-12">
        <div class="card">
            <div class="card-header">
                <h4 class="card-title">Filters</h4>
            </div>
            <div class="card-body">
                <div class="mt-6">
                    <form method="get" action="" class="row row-cols-lg-auto gx-3 gy-2 align-items-center">
                        <div class="col-12">
                            <label class="form-label" for="formrow-password-input">Role</label>
                          <select class="form-control" name="role" id="role">
                           <option value="" disabled selected>Select Role</option>
                           <option value="user" <?php if($role == 'user'){echo "selected";}?>>User</option>
                           <option value="astrologer" <?php if($role == 'astrologer'){echo "selected";}?>>Astrologer</option>
                       </select>
                   </div>
                   <div class="col-12">
                      <label class="form-label" for="formrow-password-input">Start Date</label>
                     <!--  <input type="text" name="start_date" class="form-control flatpickr-input" id="datepicker-basic" readonly="readonly"> -->
                      <input type="date" name="start_date" class="form-control" value="">
                  </div>
                  <div class="col-12">
                      <div class="form-check56">
                        <label class="form-label" for="formrow-password-input">End Date</label>
                      <!--   <input type="text" name="start_date" class="form-control flatpickr-input" id="datepicker-basic" readonly="readonly"> -->
                        <input type="date" name="end_date" class="form-control" value="">
                    </div>
                </div>
                <div class="col-12" style="margin-top: 35px;">
                      <label class="form-label" for="formrow-password-input">&nbsp;&nbsp;</label>

                  <button type="submit" class="btn btn-primary">Submit</button>
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
          <div class="table-responsive mt-4" id="table_list">

            <table id="transaction_list" class="table display table-striped border no-wrap">
              <thead>
                <tr>
                   <th class="">S.No</th>
                   <th class="">Name</th>
                   <th class="">Role</th>
                   <th class="">Amount</th>
                   <th class="">Amount Type</th>  
                   <th class="">Amount Type For</th> 
                   <th class="">Description</th>  
                    <th class="">Created On</th>

               </tr>
           </thead>
           <tbody>
            <?php $count = 1;?>
            @foreach($transactions as $transact)
            <?php

            $user_id = $transact->user_id;
            $astrologer_id = $transact->astrologer_id;

            ?>
            <tr>
                <td>{{$transact->id}}</td>
                <td>
                    <?php
                    if(!empty($user_id))
                    {
                        $user_data = App\User::select('id','name')->where('id',$user_id)->first();
                        echo $user_data->name ?? '';
                    }

                    if(!empty($astrologer_id))
                    {
                        $astrologer_data = App\Astrologer::select('id','name')->where('id',$astrologer_id)->first();
                        echo $astrologer_data->name ?? '';
                    }

                    ?>
                </td>
                <td>
                    <?php
                    if(!empty($user_id))
                    {                                
                        echo "User";
                    }

                    if(!empty($astrologer_id))
                    {                                
                      echo "Astrologer";
                  }

                  ?>
              </td>
              <td>{{$transact->amount}}</td>
              <td>{{$transact->amount_type}}</td>
              <td>{{$transact->amount_type_for}}</td>
              <td>{{$transact->description}}</td>
              <td>{{$transact->created_at}}</td>
          </tr>
          @endforeach             

      </tbody>
  </table>  

  {{ $transactions->appends(request()->input())->links('admin.pagination') }}           
</div>
</div>
</div>
</div>
</div>


@include('admin.common.footer')
