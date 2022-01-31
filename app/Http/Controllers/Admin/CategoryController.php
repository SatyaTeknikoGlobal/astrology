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
use App\Category;
use Yajra\DataTables\DataTables;
use Storage;
use DB;
use Hash;

use PhpOffice\PhpWord\IOFactory;




Class CategoryController extends Controller
{

    private $ADMIN_ROUTE_NAME;

    public function __construct()
    {
        $this->ADMIN_ROUTE_NAME = CustomHelper::getAdminRouteName();
    }

	public function index(Request $request)
    {
        $categories = Category::where('is_delete',0)->orderBy('id','desc')->paginate(10);
        $data['categories'] = $categories;
        return view('admin.categories.index',$data);
    }

    public function add(Request $request)
    {
         $details = [];    
        $id = isset($request->id) ? $request->id : 0;
        $categories = '';
        if(is_numeric($id) && $id > 0)
        {
            $categories = Category::find($id);
            if(empty($categories))
            {
                return redirect($this->ADMIN_ROUTE_NAME.'/categories');
            }
        }     

        if($request->method() == "POST" || $request->method() == "post")
        {
            if(empty($back_url))
            {
                 $back_url = $this->ADMIN_ROUTE_NAME.'/categories';
            }
            if(is_numeric($request->id) && $request->id > 0)
            {                 
                $details['name'] = 'required';           
             
            }else{                
                $details['name'] = 'required';              
             
            }
          $this->validate($request , $details);
           $createdDetails = $this->save($request , $id);
           if($createdDetails)
           {
                $alert_msg = "Category Created Successfully";
                if(is_numeric($id) & $id > 0)
                {
                    $alert_msg = "Category Updated Successfully";
                } 
                return redirect(url($back_url))->with('alert-success',$alert_msg);
           }else{
            return back()->with('alert-danger', 'something went wrong, please try again or contact the administrator.');
           }
        }
        $page_Heading = "Add New";     
        if(is_numeric($id) && $id > 0){
            $page_Heading = 'Update Category';
        }
        $details['page_Heading'] = $page_Heading;       
        $details['categories'] = $categories; 
       return view('admin.categories.form',$details);
    }

     public function save(Request $request, $id = 0)
    {
        $details = $request->except(['_token', 'back_url']);
        $category = new Category;
        if(is_numeric($id) && $id > 0)
        {
            $exist = Category::find($id);
            if(isset($exist->id) && $exist->id == $id)
            {   
                $category = $exist;
            }
        }
        foreach($details as $key => $val)
        {
            $category->$key = $val;
        }
        $isSaved = $category->save();        
        return $isSaved;
    }  

public function change_category_status(Request $request)
{ 
  $id = isset($request->id) ? $request->id :'';
  $status = isset($request->status) ? $request->status :'';
  $type = Category::where('id',$id)->first();
  if(!empty($type)){

   Category::where('id',$id)->update(['status'=>$status]);
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
        $back_url = $this->ADMIN_ROUTE_NAME.'/categories';
    }
     if(is_numeric($id) && $id > 0)
     {
        $is_delete = Category::where('id', $id)->update(['is_delete'=> '1']);
     }     
     if(!empty($is_delete))
     {
        return back()->with('alert-success', 'Category Deleted Successfully');
     }else{

        return back()->with('alert-danger', 'something went wrong, please try again...');
     }    
}

   
}




