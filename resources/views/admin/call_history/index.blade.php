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
            <h4 class="mb-0">Report History</h4>
            <div class="page-title-right">
                <ol class="breadcrumb m-0">
                    
            </ol>
    </div>

</div>
</div>
</div>
<!-- end page title -->

<?php

$role = isset($_GET['role']) ? $_GET['role'] : '';


?>


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
                     <th class="">Report Type</th> 
                     <th class="">Name</th> 
                      <th class="">Number</th>
                      <th class="">Gender</th>  
                      <th class="">Date/Time</th>  
                      <th class="">Place</th>  
                      <th class="">Marital Status</th>  
                      <th class="">Occupation</th> 
                      <th class="">Amount</th>  
                      <th class="">Payment Status</th>  
                      

                   </tr>
                 </thead>
                 <tbody>

                   <?php if(!empty($report_history) && $report_history->count() > 0){
                    $i = 1;
                    foreach ($report_history as $rh){
                      $type= $rh->report_type;
                      $report_name = App\Report_Type::select('id','type')->where('id',$type)->first();

                     ?>
                     <tr>
                      <td>{{$i++}}</td>                      
                      <td>{{$report_name->type ?? ''}}</td>
                      <td>{{$rh->first_name}}&nbsp;&nbsp;{{$rh->last_name}}</td>
                      <td>{{$rh->number}}</td>
                      <td>
                        <?php
                          if($rh->gender == 'M')
                          {
                            echo 'Male';
                          }
                          if($rh->gender == 'F')
                          {
                            echo 'Female';
                          }
                        ?>
                      </td>
                      <td>{{$rh->dob}}&nbsp;&nbsp;{{$rh->tob}}</td>
                      <td>{{$rh->pob}}&nbsp;&nbsp;{{$rh->address}}</td>
                      <td>{{$rh->marital_status}}</td>
                      <td>{{$rh->occupation}}</td>
                       <td>{{$rh->amount}}</td>
                      <td>
                        <?php

                        if($rh->is_payment_done == 1)
                        {
                          echo "Paid";
                        }
                        if($rh->is_payment_done == 0)
                        {
                          echo "Unpaid";
                        }
                        
                        ?>
                      </td>
                    </tr>

                  <?php }}?>

                </tbody>
              </table>  

               {{ $call_history->appends(request()->input())->links('admin.pagination') }}            
            </div>
          </div>
        </div>
      </div>
    </div>

</div>



@include('admin.common.footer')
