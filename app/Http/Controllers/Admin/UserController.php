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
use App\Course;
use App\Country;
use App\State;
use App\City;

use Yajra\DataTables\DataTables;
use Maatwebsite\Excel\Facades\Excel;
use App\Exports\UserExport;
use Rap2hpoutre\FastExcel\FastExcel;
use Storage;
use DB;
use Hash;

use PhpOffice\PhpWord\IOFactory;




Class UserController extends Controller
{

    private $ADMIN_ROUTE_NAME;

    public function __construct()
    {
        $this->ADMIN_ROUTE_NAME = CustomHelper::getAdminRouteName();
    }

    public function index(Request $request)
    {
       
        $search = isset($request->search)?$request->search:'';
         $data['search'] = $search;
          $users = User::where(['is_delete'=>0,'parent_id'=>0])->orderBy('id','desc');
        if(!empty($search))
        {
            $users->where('name','like','%'.$search.'%');
            $users->orWhere('email','like','%'.$search.'%');
            $users->orWhere('phone','like','%'.$search.'%');
        }

        $users = $users->paginate(10);
        $title = 'Users';
       
        $data['title'] = $title;       
        $data['users'] = $users;
        return view('admin.user.index',$data);
    }

    public function add(Request $request)
    {
       $details = [];

       $id = isset($request->id) ? $request->id : 0;
       $users = '';
       if(is_numeric($id) && $id > 0)
       {
        $users = User::find($id);
        if(empty($users))
        {
            return redirect($this->ADMIN_ROUTE_NAME.'/user');
        }
    }
    if($request->method() == "POST" || $request->method() == "post")
    {
        if(empty($back_url))
        {
           $back_url = $this->ADMIN_ROUTE_NAME.'/user';
       }
       
       $details['name'] = 'required';
       $details['email'] = 'required';
       $details['phone'] = 'required';
       $details['status'] = 'required';
       
       $this->validate($request , $details); 
       $createdDetails = $this->save($request , $id);
       if($createdDetails)
       {
        $alert_msg = "User Created Successfully";

        if(is_numeric($id) & $id > 0)
        {
            $alert_msg = "User Updated Successfully";
        } 
        return redirect(url($back_url))->with('alert-success',$alert_msg);
    }else{

        return back()->with('alert-danger', 'something went wrong, please try again or contact the administrator.');
    }
}
$page_Heading = "Add User";
if(isset($users->id))
{
    $name = $users->name;
    $page_Heading = 'Update User -'.$name;
}
$country = Country::where(['is_delete'=>0, 'status'=>1])->get();
$details['page_Heading'] = $page_Heading;
$details['country'] = $country;       
$details['users'] = $users;
return view('admin.user.form',$details);
}


public function save(Request $request, $id = 0)
{
    $details = $request->except(['_token', 'back_url']);

    $details['password'] =bcrypt($request->password);
    $old_img = '';

    $user = new User;
    if(is_numeric($id) && $id > 0)
    {
        $exist = User::find($id);

        if(isset($exist->id) && $exist->id == $id)
        {   
            $user = $exist;
            $old_img = $exist->image;
        }
    }
    foreach($details as $key => $val)
    {
        $user->$key = $val;
    }
    $isSaved = $user->save();
    if($isSaved)
    {
        $this->saveImage($request , $user , $old_img);
    }
    return $isSaved;
}

private function saveImage($request, $user, $oldImg='')
{
    $file = $request->file('image');
    if ($file) {
        $path = 'user/';
        $thumb_path = 'user/thumb/';
        $storage = Storage::disk('public');             
        $IMG_WIDTH = 768;
        $IMG_HEIGHT = 768;
        $THUMB_WIDTH = 336;
        $THUMB_HEIGHT = 336;

        $uploaded_data = CustomHelper::UploadImage($file, $path, $ext='', $IMG_WIDTH, $IMG_HEIGHT, $is_thumb=true, $thumb_path, $THUMB_WIDTH, $THUMB_HEIGHT);

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
            $user->image = $image;
            $user->save();     
        }

        if(!empty($uploaded_data)){   
            return  $uploaded_data;
        }  

    }

}

public function change_user_status(Request $request){
  $id = isset($request->id) ? $request->id :'';
  $status = isset($request->status) ? $request->status :'';

  $user = User::where('id',$id)->first();
  if(!empty($user)){

     User::where('id',$id)->update(['status'=>$status]);
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
   if(is_numeric($id) && $id > 0)
   {       
        $is_delete = User::where('id', $id)->update(['is_delete'=> '1']);
   }
    if(!empty($is_delete))
    {
        return back()->with('alert-success', 'User Deleted Successfully');
    }else{
        return back()->with('alert-danger', 'something went wrong, please try again...');
    }    
}




public function get_state(Request $request)
{
  $country_id = isset($request->country_id) ? $request->country_id :0;

  $html = '<option value="" selected disabled>Select State</option>';
  if($country_id !=0){
    $states = State::where('country_id',$country_id)->get();

    if(!empty($states)){
      foreach($states as $state){
        $html.='<option value='.$state->id.'>'.$state->name.'</option>';
    }
}
} 
echo $html;
}

public function get_city(Request $request)
{
  $state_id = isset($request->state_id) ? $request->state_id :0;
  $html = '<option value="" selected disabled>Select City</option>';
  if($state_id !=0){
    $cities = DB::table('cities')->where('state_id',$state_id)->get();


    if(!empty($cities)){
      foreach($cities as $city){
        $html.='<option value='.$city->id.'>'.$city->name.'</option>';
    }
}
} 
echo $html;
}

public function export(Request $request)
{
    //prd($request->toArray());
    $search = isset($request->search)?$request->search:'';


    $users = User::select('id','name','phone','email','wallet');
    if(!empty($search))
    {
        $users->where('name','like','%'.$search.'%');
        $users->orWhere('phone','like','%'.$search.'%');
        $users->orWhere('email','like','%'.$search.'%');
        
    }
    $users = $users->get();
    if(!empty($users) && $users->count() > 0)
    {
        foreach($users as $user)
        {   
            $userArr = [];
            $userArr['ID'] = $user->id;
            $userArr['NAME'] = $user->name ?? '';
            $userArr['PHONE'] = $user->phone ?? '';
            $userArr['EMAIL'] = $user->email ?? '';
             $userArr['WALLET'] = $user->wallet ?? '';
           
            $exportArr[] = $userArr;
        }

        $fileNames = array_keys($exportArr[0]);
         $fileName = 'users'.date('Y-m-d-H-i-s').'.xlsx';
     return Excel::download(new UserExport($exportArr, $fileNames), $fileName);

    }
  

}

public function info(Request $request)
{
    $details= [];
    $tabs = 'members';
       
        if(isset($_GET['transactions']))
        {
            $tabs = 'transactions';
        }        

        if(isset($_GET['faqs']))
        {
            $tabs = 'faqs';
        }
        if(isset($_GET['report']))
        {
            $tabs = 'report';
        }

    $user = User::where('id',$request->id)->first();
    $transactions = DB::table('wallet_transaction')->where('user_id',$request->id)->get();
    $user_faqs = DB::table('user_question')->where('user_id',$request->id)->paginate(3);
    $user_report = DB::table('report_intake_form')->where('user_id',$request->id)->get();
   
    $details['user'] = $user;
    $details['transactions'] = $transactions;
    $details['user_faqs'] = $user_faqs; 
     $details['user_report'] = $user_report;
    $details['tabs'] = $tabs;  
    return view('admin.user.info',$details);
}

public function add_wallet(Request $request)
{  
    $details=[];
    $id = isset($request->user_id)?$request->user_id:'';
    $wallet=isset($request->amount)?$request->amount:'';  
    $type=isset($request->amount_type)?$request->amount_type:'';
    $amount_type_for=isset($request->amount_type_for)?$request->amount_type_for:'';
    $description=isset($request->description)?$request->description:'';  
    if(!empty($wallet))
    {        
        $details['user_id']=$id;
        $details['amount']=$wallet;
        $details['amount_type']=$type;
        $details['amount_type_for']='admin';
        $details['description']=$description;   
     
        $user = User::where('id',$id)->first();       
        $user_wallet = $user->wallet;

        if($type == 'CREDIT')
        {
            $total_amt = $user_wallet+$wallet; 
        }
        if($type == 'DEBIT')
        {
             if($user_wallet >= $wallet)
             {           
                 $total_amt = $user_wallet-$wallet; 
             }else{
                 return back()->with('alert-danger', "Wallet doesn't have Sufficient Amount");
             } 
        } 
       
        $saved = User::where('id',$id)->update(['wallet'=>$total_amt]);
        $wallet_amt = DB::table('wallet_transaction')->insert($details);  
      
        if($saved)
        {
            $alert_msg = 'Wallet Amount Added Successfully';
            return back()->with('alert-success',$alert_msg);
        }else{
            return back()->with('alert-danger','Somthing Went Wrong');
        }
    }
}




}




