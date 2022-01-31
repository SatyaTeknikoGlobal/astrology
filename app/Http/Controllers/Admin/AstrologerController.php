<?php
namespace App\Http\Controllers\Admin;

use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Support\Facades\File;
use Illuminate\Http\Request;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Routing\Controller as BaseController;
use App\Http\Controllers\Controller;
use App\Helpers\CustomHelper;
use Auth;
use Validator;
use App\User;
use App\Admin;
use App\Astrologer;
use App\Country;
use App\State;
use App\City;
use App\Expertise;
use PDF;
use App\Language;
use App\Report_Type;
use Maatwebsite\Excel\Facades\Excel;
use App\Exports\AstroExport;
use Rap2hpoutre\FastExcel\FastExcel;

use Yajra\DataTables\DataTables;


use Storage;
use DB;
use Hash;

use PhpOffice\PhpWord\IOFactory;




Class AstrologerController extends Controller
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
        $astrologers = Astrologer::where('is_delete','0')->orderBy('id','desc');
        if(!empty($search))
        {
            $astrologers->where('name','like','%'.$search.'%');
            $astrologers->orWhere('number','like','%'.$search.'%');
            $astrologers->orWhere('email','like','%'.$search.'%');
            $astrologers->orWhere('real_name','like','%'.$search.'%');
        }
        $astrologers = $astrologers->paginate(12);
        $data['astrologers']= $astrologers;   
        return view('admin.astrologer.index',$data);
    }   

    public function add(Request $request)
    {
        //prd($request->toArray());
        $details = [];    
        $id = isset($request->id) ? $request->id : 0;
        $astrologers = '';

        if(is_numeric($id) && $id > 0)
        {
          $astrologers = Astrologer::find($id);
          if(empty($astrologers))
          {
            return redirect($this->ADMIN_ROUTE_NAME.'/astrologer');
        }
    } 
    if($request->method() == "POST" || $request->method() == "post")
    {
        if(empty($back_url))
        {
         $back_url = $this->ADMIN_ROUTE_NAME.'/astrologer';
     }
     if(is_numeric($request->id) && $request->id > 0)
     {
      $details['name'] = 'required';
      $details['email'] = 'required';
      $details['number'] = 'required';
      $details['experience'] = 'required';
      $details['state_id'] = 'required';
      $details['city_id'] = 'required';
      $details['locality_id'] = 'required';
      $details['address'] = 'required';
      $details['language'] = 'required';
      $details['type'] = 'required';  
       $details['report_id'] = 'required';           

  }else{

      $details['name'] = 'required';
      $details['email'] = 'required';
      $details['number'] = 'required';
      $details['experience'] = 'required';
      $details['state_id'] = 'required';
      $details['city_id'] = 'required';
      $details['locality_id'] = 'required';
      $details['address'] = 'required';
      $details['language'] = 'required';
      $details['type'] = 'required';   
       $details['report_id'] = 'required';                               
  }
  $this->validate($request , $details); 
  $createdDetails = $this->save($request , $id);
  if($createdDetails)
  {
      $alert_msg = "Astrologer Created Successfully";
      if(is_numeric($id) & $id > 0)
      {
        $alert_msg = "Astrologer Updated Successfully";
    } 
    return redirect(url($back_url))->with('alert-success',$alert_msg);
}else{
    return back()->with('alert-danger', 'something went wrong, please try again or contact the administrator.');
}
}
$page_Heading = "Add Astrologer";
if(isset($astrologers->id))
{
    $astrologer_name = $astrologers->name;
    $page_Heading = 'Update -'.$astrologer_name;
}

$report_type = Report_Type::where(['status'=>1,'is_delete'=>0])->get();

$categories = DB::table('categories')->where('status',1)->get();
$country = Country::where(['is_delete'=>0, 'status'=>1])->get();
$states = [];
$cities = [];

if(is_numeric($id) && $id > 0){
    $states = State::where('country_id',$astrologers->country_id)->get();
    $cities = City::where('state_id',$astrologers->state_id)->get();

}


$expertise = Expertise::where(['is_delete'=>0, 'status'=>1])->get();
$languages = Language::where(['is_delete'=>0, 'status'=>1])->get();

$details['page_Heading'] = $page_Heading;
$details['id'] = $id;
$details['states'] = $states;
$details['cities'] = $cities;
$details['country'] = $country;
$details['categories'] = $categories;
$details['astrologers'] = $astrologers;
$details['expertise'] = $expertise;
$details['languages'] = $languages;
$details['report_type'] = $report_type;
return view('admin.astrologer.form',$details);
}

public function save(Request $request, $id = 0)
{
    $details = $request->except(['_token', 'back_url']);

    $details['language'] = implode(',',$request->language);
    $details['type'] = implode(',',$request->type);
    $details['report_id'] = implode(',',$request->report_id);
    $old_img = '';

    $astrologers= new Astrologer;
    if(is_numeric($id) && $id > 0)
    {
        $exist = Astrologer::find($id);

        if(isset($exist->id) && $exist->id == $id)
        {   
            $astrologers = $exist;
            $old_img = $exist->image;
        }
    }
    foreach($details as $key => $val)
    {
        $astrologers->$key = $val;
    }
    $isSaved = $astrologers->save();
    if($isSaved)
    {
        $this->saveImage($request , $astrologers , $old_img);
    }
    return $isSaved;
}

private function saveImage($request, $astrologers, $oldImg='')
{
    $file = $request->file('image');
    if ($file) {
        $path = 'astrologers/';
        $thumb_path = 'astrologers/thumb/';
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
            $astrologers->image = $image;
            $astrologers->save();     
        }

        if(!empty($uploaded_data)){   
            return  $uploaded_data;
        }  

    }

}

public function export(Request $request)
{
    //prd($request->toArray());
    $search = isset($request->search)?$request->search:'';


    $astros = Astrologer::select('id','name','number','email','real_name');
    if(!empty($search))
    {
        $astros->where('name','like','%'.$search.'%');
        $astros->orWhere('number','like','%'.$search.'%');
        $astros->orWhere('email','like','%'.$search.'%');
        $astros->orWhere('real_name','like','%'.$search.'%');
    }
    $astros = $astros->get();
    if(!empty($astros) && $astros->count() > 0)
    {
        foreach($astros as $astro)
        {   
            $astroArr = [];
            $astroArr['ID'] = $astro->id;
            $astroArr['NAME'] = $astro->name ?? '';
            $astroArr['NUMBER'] = $astro->number ?? '';
            $astroArr['EMAIL'] = $astro->email ?? '';
            $astroArr['REAL NAME'] = $astro->real_name ?? '';
            $exportArr[] = $astroArr;
        }

        $fileNames = array_keys($exportArr[0]);
         $fileName = 'astrologers_'.date('Y-m-d-H-i-s').'.xlsx';
     return Excel::download(new AstroExport($exportArr, $fileNames), $fileName);

    }
  

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

public function profile($id)
{
   
    $data = [];
    $tabs = 'about';
       
        if(isset($_GET['transaction']))
        {
            $tabs = 'transaction';
        }

         if(isset($_GET['rating']))
        {
           $tabs = 'rating';
        }

         if(isset($_GET['gallery']))
        {
           $tabs = 'gallery';
        }

        if(isset($_GET['faqs']))
        {
            $tabs = 'faqs';
        }
        if(isset($_GET['report_list']))
        {
            $tabs = 'report_list';
        }


    $astro = '';
   
    if(!empty($id))
    {
        $astro_details = Astrologer::where('id',$id)->first();
        $transactions = DB::table('wallet_transaction')->where('astrologer_id',$id)->paginate(5, ['*'], 'transaction');
        $astro_faqs = DB::table('user_question')->where(['astrologer_id'=>$id,'is_delete'=>0])->paginate(3,['*'], 'faqs');
        $astrologer_gallery = DB::table('astrologer_gallery')->where('astro_id',$id)->paginate(9,['*'], 'gallery');
        $rating = DB::table('ratings')->where('astro_id',$id)->get();
        $report = DB::table('report_intake_form')->where('astro_id',$id)->get();

        
   }
    $data['rating'] = $rating;
    $data['astro_details'] = $astro_details;
    $data['transactions'] = $transactions;
    $data['astro_faqs'] = $astro_faqs;
   $data['report'] = $report;
    $data['tabs'] = $tabs;

    $data['astrologer_gallery'] = $astrologer_gallery;

    return view('admin.astrologer.profile',$data);

}

public function ratings(Request $request)
{
    $data = [];
      $details['user_id'] = 'required';
      $details['astro_id'] = 'required';
      $details['rating'] = 'required';
      $details['review'] = '';                                   
      
    $this->validate($request , $details); 
    if(empty($back_url))
    {
       $back_url = $this->ADMIN_ROUTE_NAME.'/astrologer/profile/'.$request->astro_id;
    }
    $id = isset($request->id)?$request->id: '';
    $user_id = isset($request->user_id)?$request->user_id: '';
    $astro_id = isset($request->astro_id)?$request->astro_id:'';
    $rating = isset($request->rating)?$request->rating:0;
    $review = isset($request->review)?$request->review:'';
    $data['user_id'] = $user_id;
    $data['astro_id'] = $astro_id;
    $data['rating'] = $rating;
    $data['review'] = $review; 
    if(!empty($id))
    {
        $success = DB::table('ratings')->where('id',$id)->update(['user_id'=>$user_id,'astro_id'=>$astro_id,'rating'=>$rating,'review'=>$review]);       
    }
    if($success)
    {
        $alert_msg = 'Ratings Update Successfully';
        return redirect(url($back_url))->with('alert-success',$alert_msg);
    }else{

        return back()->with('alert-danger','Somthing Went Wrong');
    }

}

public function edit_faqs(Request $request)
{
   // prd($request->toArray());
    $id = isset($request->id)?$request->id:'';
    if(!empty($id))
    {
        $data['question'] = 'required';
        $data['ans'] = 'required';
        $this->validate($request,$data);
        $success = DB::table("user_question")->where('id',$id)->update(['question'=>$request->question,'ans'=>$request->ans]);
        if($success)
        {
            $alert_msg = "Updated Successfully";
            return back()->with('alert-success',$alert_msg);

        }else{
            return back()->with('alert-danger',"PLease Try Again !!");

        }





    }
}

// public function generatepdf(Request $request)
// {
    
//     $astro_id = isset($request->astro_id)?$request->astro_id:'';
//      $id = isset($request->id)?$request->id:'';
//     echo "astro_id =".$astro_id;
//     echo "id =".$id;
//     echo "test";
//    //  $data = DB::table('report_intake_form')->where(['astro_id'=>$astro_id, 'id'=>$id])->get();


    
//     // $pdf = PDF::loadView('admin.astrologer.generatePDF', $data);    
//     // return $pdf->download('astro.pdf');

// }

public function delete_question(Request $request)
{
     $id = isset($request->id)?$request->id : '';
     $is_delete = 0;     
        if(is_numeric($id) && $id > 0)
        {
            $is_delete = DB::table('user_question')->where('id', $id)->update(['is_delete'=> '1']);
        }
        if(!empty($is_delete))
        {
            return back()->with('alert-success', 'Question Deleted Successfully');
        }else{
            return back()->with('alert-danger', 'something went wrong, please try again...');
        } 
}



public function delete(Request $request)
{
   $id = isset($request->id) ? $request->id : 0;

   $is_delete = 0;
   if(empty($back_url))
   {
    $back_url = $this->ADMIN_ROUTE_NAME.'/astrologer';
    }

    if(is_numeric($id) && $id > 0)
    {
        $is_delete = Astrologer::where('id', $id)->update(['is_delete'=> '1']);
    }

    if(!empty($is_delete))
    {
        return back()->with('alert-success', 'Astrologer Deleted Successfully');
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

public function add_wallet(Request $request)
{ 
    //prd($request->toArray());
    $details=[];
    $data['astro_id'] = 'required';
    $data['amount_type'] = 'required';
    $data['amount'] = 'required';
    $data['description'] = 'required';
    $this->validate($request,$data);
    $id = isset($request->astro_id)?$request->astro_id:'';
    $wallet=isset($request->amount)?$request->amount:'';  
    $type=isset($request->amount_type)?$request->amount_type:'';
    $amount_type_for=isset($request->amount_type_for)?$request->amount_type_for:'';
    $description=isset($request->description)?$request->description:'';
    if(!empty($wallet))
    {
        $details['astrologer_id']=$id;
        $details['amount']=$wallet;
        $details['amount_type']=$type;
        $details['amount_type_for']='admin';
        $details['description']=$description; 

        $astro = Astrologer::where('id',$id)->first();       
        $astro_wallet = $astro->wallet;     
        if($type == 'CREDIT')
        {
          $total_amt = $astro_wallet+$wallet;
        }
        if($type == 'DEBIT')
        {
             if($astro_wallet >= $wallet)
             {
               $total_amt = $astro_wallet-$wallet; 
             }else{
                 return back()->with('alert-danger', "Wallet doesn't have Sufficient Amount");
             }  
           
        }      

   $saved = Astrologer::where('id',$id)->update(['wallet'=>$total_amt]);
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


public function change_astro_status(Request $request)
{
  $id = isset($request->astro_id) ? $request->astro_id :'';
  $status = isset($request->status) ? $request->status :'';

  $detail = Astrologer::where('id',$id)->first();
  if(!empty($detail)){

     Astrologer::where('id',$id)->update(['status'=>$status]);
     $response['success'] = true;
     $response['message'] = 'Status updated';


     return response()->json($response);
     }else{
         $response['success'] = false;
         $response['message'] = 'Not  Found';
         return response()->json($response);  
     }

}

public function approve_astrologer(Request $request)
{

    $astro_id = isset($request->astro_id)?$request->astro_id:'';
    $is_approve = isset($request->is_approve)?$request->is_approve:'';
    if($is_approve == 1)
    {
        $astro = Astrologer::where('id',$astro_id)->first();
        $astro_password = $astro->name.$astro->number;
        if(!empty($astro_password))
        {
            $saved = Astrologer::where('id',$astro_id)->update(['password'=>bcrypt($astro_password)]);
            if($saved)
            {
             $to_email = $astro->email;
             $from_email = env('ADMIN_EMAIL');
             $subject = 'Approval of Your Account'.env('APP_NAME');
             $email_data = [];

             $email_data['name'] = $astro->name;
             $email_data['email'] = $astro->email ?? '';
             $email_data['password'] = $astro_password ?? '';
             $send_email = CustomHelper::sendEmail('emails.account_approval', $email_data, $to=$to_email, $from_email, $replyTo = $from_email, $subject);
             $response['success'] = true;
             $response['message'] = 'Approved Successfully';
             return response()->json($response);
         }else{
            $response['success'] = false;
            $response['message'] = 'Not Approved';
            return response()->json($response);                
        }
    }
}

}


public function gallery(Request $request,$ext='jpg,jpeg,png')
{
    $dbArray = [];
    $id = isset($request->astro_id)?$request->astro_id:0;       
    $files = $request->file('images');
    $path = 'astro_gallery/';
    $thumb_path = 'astro_gallery/thumb/';
    $storage = Storage::disk('public');
    $IMG_WIDTH = 768;
    $IMG_HEIGHT = 768;
    $THUMB_WIDTH = 336;
    $THUMB_HEIGHT = 336;



    if ($files && count($files) > 0) {
        foreach($files as $file){
          $uploaded_data = CustomHelper::UploadImage($file, $path, $ext='', $width=768, $height=768, $is_thumb=false, $thumb_path, $thumb_width=300, $thumb_height=300);
          if($uploaded_data['success']){
            $image = $uploaded_data['file_name'];
            $dbArray['images'] = $image;
            $dbArray['astro_id'] = $request->astro_id;
            $dbArray['type'] = $uploaded_data['extension'];
            $success = DB::table('astrologer_gallery')->insert($dbArray);
        }
    }
    if($success)
    {
        $alert_msg = 'Images Upload Successfully';
        return back()->with('alert-success',$alert_msg);
    }else{
        return back()->with('alert-danger','Somthing Went Wrong');
    }       
  } 
}

public function galleryimg_delete(Request $request)
{
    $image = DB::table('astrologer_gallery')->find($request->id);
    if(!empty($image))
    {
        $images = isset($image->images) ? $image->images : '';
        $storage = Storage::disk('public');
        $path = 'astro_gallery';
        $image_path = url('public/storage/'.$path.'/'.$image->images);
        if(File::exists($image_path))
        {
            File::delete($image_path);
        }        

        DB::table('astrologer_gallery')->where('id',$request->id)->delete();
        return back()->with('success','Image Deleted Successfully');
    }else{

        return back()->with('alert-danger','Not Found');
    }


}


// private function saveImageMultiple($request,$id)
// {
//     $images = $request->file('images'); 

//     $storage = Storage::disk('public');
//     $path = 'astro_gallery';
//     $thumb_path = 'astro_gallery/thumb';

//             prd($storage);
//     $IMG_WIDTH = 768;
//     $IMG_HEIGHT = 768;
//     $THUMB_WIDTH = 336;
//     $THUMB_HEIGHT = 336;
//     $dbArray = [];

//     if (!empty($images)) {

//         foreach($images as $file){
//             $uploaded_data = CustomHelper::UploadImage($file, $path, $ext='', $width=768, $height=768, $is_thumb=false, $thumb_path, $thumb_width=300, $thumb_height=300);
//             if($uploaded_data['success']){
//                 $image = $uploaded_data['file_name'];

//                 $dbArray['images'] = $file;
//                 $dbArray['astro_id'] = $id;

//                // print_r($dbArray);

//                 $success = DB::table('astrologer_gallery')->insert($dbArray);
//             }
//         }
//         return true;
//     }else{
//         return false;
//     }
// }




}




