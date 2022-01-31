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
use App\Language;

use Yajra\DataTables\DataTables;


use Storage;
use DB;
use Hash;

use PhpOffice\PhpWord\IOFactory;




Class LanguageController extends Controller
{

    private $ADMIN_ROUTE_NAME;

    public function __construct()
    {
        $this->ADMIN_ROUTE_NAME = CustomHelper::getAdminRouteName();
    }

	public function index(Request $request)
    {
		$languages = Language::where('is_delete','0')->orderBy('id','desc')->paginate(10);
        $data['languages'] = $languages;

        return view('admin.languages.index',$data);
    }

    
    public function add(Request $request)
    {
        $details = [];    
        $id = isset($request->id) ? $request->id : 0;
        $languages = '';
        if(is_numeric($id) && $id > 0)
        {
             $languages = Language::find($id);
            if(empty($languages))
            {
                return redirect($this->ADMIN_ROUTE_NAME.'/languages');
            }
        } 
        if($request->method() == "POST" || $request->method() == "post")
        {
            if(empty($back_url))
            {
                 $back_url = $this->ADMIN_ROUTE_NAME.'/languages';
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
              $alert_msg = "Language Created Successfully";
                if(is_numeric($id) & $id > 0)
                {
                    $alert_msg = "Language Updated Successfully";
                } 
                return redirect(url($back_url))->with('alert-success',$alert_msg);
           }else{
            return back()->with('alert-danger', 'something went wrong, please try again or contact the administrator.');
           }
        }
        $page_Heading = "Add Language";
        if(isset($languages->id))
        {
            $language_name = $languages->name;
            $page_Heading = 'Update -'.$language_name;
        }
        $details['page_Heading'] = $page_Heading;
        $details['id'] = $id;
        $details['languages'] = $languages;
        return view('admin.languages.form',$details);
    }


    public function save(Request $request, $id = 0)
    {
        $details = $request->except(['_token', 'back_url']);
        $languages = new Language;

        if(is_numeric($id) && $id > 0)
        {
            $exist = Language::find($id);

            if(isset($exist->id) && $exist->id == $id)
            {   
                $languages = $exist;
            }
        }
        foreach($details as $key => $val)
        {
            $languages->$key = $val;
        }
        $isSaved = $languages->save();
        return $isSaved;
    }

    

// public function change_category_status(Request $request){
//   $id = isset($request->id) ? $request->id :'';
//   $status = isset($request->status) ? $request->status :'';

//   $categories = Category::where('id',$id)->first();
//   if(!empty($categories)){

//    Category::where('id',$id)->update(['status'=>$status]);
//    $response['success'] = true;
//    $response['message'] = 'Status updated';


//    return response()->json($response);
// }else{
//    $response['success'] = false;
//    $response['message'] = 'Not  Found';
//    return response()->json($response);  
// }

// }

public function delete(Request $request)
{
     $id = isset($request->id) ? $request->id : 0;

     $is_delete = 0;
     if(empty($back_url))
    {
        $back_url = $this->ADMIN_ROUTE_NAME.'/languages';
    }

     if(is_numeric($id) && $id > 0)
     {
        $is_delete = Language::where('id', $id)->update(['is_delete'=> '1']);
     }

     if(!empty($is_delete))
     {
        return back()->with('alert-success', 'Language Deleted Successfully');
     }else{

        return back()->with('alert-danger', 'something went wrong, please try again...');
     }    
}

   
}




