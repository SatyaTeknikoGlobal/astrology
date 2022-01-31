<?php
namespace App\Http\Controllers\Admin;

use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Http\Request;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Routing\Controller as BaseController;
use App\Http\Controllers\Controller;
use App\Helpers\CustomHelper;
use Auth;
use Validator;
use App\User;
use App\Admin;
use App\Report_Type;
use Yajra\DataTables\DataTables;
use Storage;
use DB;
use Hash;

use PhpOffice\PhpWord\IOFactory;




Class ReportHistoryController extends Controller
{

    private $ADMIN_ROUTE_NAME;

    public function __construct()
    {
        $this->ADMIN_ROUTE_NAME = CustomHelper::getAdminRouteName();
    }

	public function index(Request $request)
    {
        $role = isset($request->role)? $request->role:'';
        $report_history = DB::table('report_intake_form')->paginate(10);

        $data['report_history'] = $report_history;
        return view('admin.report_history.index',$data);
    }

    public function add(Request $request)
    {
         $details = [];    
        $id = isset($request->id) ? $request->id : 0;
        $report_type = '';
        if(is_numeric($id) && $id > 0)
        {
            $report_type = Report_Type::find($id);
            if(empty($report_type))
            {
                return redirect($this->ADMIN_ROUTE_NAME.'/report_type');
            }
        }     

        if($request->method() == "POST" || $request->method() == "post")
        {
            if(empty($back_url))
            {
                 $back_url = $this->ADMIN_ROUTE_NAME.'/report_type';
            }
            if(is_numeric($request->id) && $request->id > 0)
            {                 
                $details['type'] = 'required';           
             
            }else{                
                $details['type'] = 'required';              
             
            }
          $this->validate($request , $details);
           $createdDetails = $this->save($request , $id);
           if($createdDetails)
           {
                $alert_msg = "Report Type Created Successfully";
                if(is_numeric($id) & $id > 0)
                {
                    $alert_msg = "Report Type Updated Successfully";
                } 
                return redirect(url($back_url))->with('alert-success',$alert_msg);
           }else{
            return back()->with('alert-danger', 'something went wrong, please try again or contact the administrator.');
           }
        }
        $page_Heading = "Add New";     
        if(is_numeric($id) && $id > 0){
            $page_Heading = 'Update Type';
        }
        $details['page_Heading'] = $page_Heading;       
        $details['report_type'] = $report_type; 
       return view('admin.report_type.form',$details);
    }

    public function save(Request $request, $id = 0)
    {
        $details = $request->except(['_token', 'back_url']);
        $report_type = new Report_Type;
        if(is_numeric($id) && $id > 0)
        {
            $exist = Report_Type::find($id);
            if(isset($exist->id) && $exist->id == $id)
            {   
                $report_type = $exist;
            }
        }
        foreach($details as $key => $val)
        {
            $report_type->$key = $val;
        }
        $isSaved = $report_type->save();        
        return $isSaved;
    }  

public function change_reporttype_status(Request $request)
{ 
  //  prd($request->toArray());
  $id = isset($request->id) ? $request->id :'';
  $status = isset($request->status) ? $request->status :'';
  $type = Report_Type::where('id',$id)->first();
  if(!empty($type)){

   Report_Type::where('id',$id)->update(['status'=>$status]);
   $response['success'] = true;
   $response['message'] = 'Status updated';


   return response()->json($response);
}else{
   $response['success'] = false;
   $response['message'] = 'Not  Found';
   return response()->json($response);  
}

}

public function delete(Request $request)
{
     $id = isset($request->id) ? $request->id : 0;
     $is_delete = 0;
     if(empty($back_url))
    {
        $back_url = $this->ADMIN_ROUTE_NAME.'/report_type';
    }
     if(is_numeric($id) && $id > 0)
     {
        $is_delete = Report_Type::where('id', $id)->update(['is_delete'=> '1']);
     }     
     if(!empty($is_delete))
     {
        return back()->with('alert-success', 'Report Type Deleted Successfully');
     }else{

        return back()->with('alert-danger', 'something went wrong, please try again...');
     }    
}

   
}




