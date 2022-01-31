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




Class ReportTypeController extends Controller
{

    private $ADMIN_ROUTE_NAME;

    public function __construct()
    {
        $this->ADMIN_ROUTE_NAME = CustomHelper::getAdminRouteName();
    }

	public function index(Request $request)
    {
        $report_type = Report_Type::where('is_delete',0)->paginate(10);
        $data['report_type'] = $report_type;
        return view('admin.report_type.index',$data);
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
                $details['description'] = 'required';  
                $details['price'] = 'required';
                $details['image'] = '';       
             
            }else{                
                $details['type'] = 'required';
                $details['description'] = '';  
                $details['price'] = '';
                $details['image'] = '';                
             
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
         $old_img = '';
        $report_type = new Report_Type;
        if(is_numeric($id) && $id > 0)
        {
            $exist = Report_Type::find($id);
            if(isset($exist->id) && $exist->id == $id)
            {   
                $report_type = $exist;
                 $old_img = $exist->banner;
            }
        }

        // print_r($details);
        // die;
        foreach($details as $key => $val)
        {
            $report_type->$key = $val;
        }
        $isSaved = $report_type->save(); 
         if($isSaved)
        {
            $this->saveImage($request , $report_type , $old_img);
        }       
        return $isSaved;
    } 


 private function saveImage($request, $report_type, $oldImg=''){

    $file = $request->file('banner');

    if ($file) {
        $path = 'report_type_banners/';        
        $thumb_path = 'report_type_banners/thumb/';
        $storage = Storage::disk('public');
            //prd($storage);
        $IMG_WIDTH = 768;
        $IMG_HEIGHT = 768;
        $THUMB_WIDTH = 336;
        $THUMB_HEIGHT = 336;

        $uploaded_data = CustomHelper::UploadImage($file, $path, $ext='', $IMG_WIDTH, $IMG_HEIGHT, $is_thumb=true,$thumb_path, $THUMB_WIDTH, $THUMB_HEIGHT);

            // prd($uploaded_data);
        if($uploaded_data['success']){

            if(!empty($oldImg)){
                if($storage->exists($path.$oldImg)){
                    $storage->delete($path.$oldImg);
                }
                if($storage->exists($thumb_path.$oldImg)){
                    $storage->delete($thumb_path.$oldImg);
                }
            }
            $image = $uploaded_data['file_name'];

           // prd($image);
            $report_type->banner = $image;
            $report_type->save();         
        }

        if(!empty($uploaded_data)){   
            return  $uploaded_data;
        }  

    }

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




