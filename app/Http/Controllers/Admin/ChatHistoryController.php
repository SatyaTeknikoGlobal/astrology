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
use App\UserLogin;
use App\Astrologer;
use App\Admin;
use App\Report_Type;
use Yajra\DataTables\DataTables;
use Storage;
use DB;
use Hash;

use PhpOffice\PhpWord\IOFactory;




Class ChatHistoryController extends Controller
{

    private $ADMIN_ROUTE_NAME;

    public function __construct()
    {
        $this->ADMIN_ROUTE_NAME = CustomHelper::getAdminRouteName();
    }

	public function index(Request $request)
    {
        $data = [];
        $users = User::where(['status'=>1,'is_delete'=>0])->get();
        $astrologers = Astrologer::where(['status'=>1,'is_delete'=>0])->get();
        $method = $request->method();
       if($method == 'POST' || $method == 'post')
       {
            $details = [];
            $details['user_id']='';
            $details['astro_id']='';
            $details['title']='required';
            $details['text']='required';
            $details['type']='required';
            $this->validate($request,$details);
            $image = '';
            $file = $request->file('image');
            if(!empty($file))
            {
               $image =  $this->saveImage($request);
            }
            $title = $request->title;
            $text = $request->text;
            $type = $request->type;
            $image = $request->image;
            if(!empty($type))
            {
                if($request->type == 'user')
                {
                    $user_id = implode(",",$request->user_id); 
                    if($user_id == 0)
                    {
                        $userIds = User::where(['status'=>1,'is_delete'=>0])->pluck('id')->toArray();
                        $users =  UserLogin::whereIn('user_id',$userIds)->get();
                    }

                    if($user_id > 0)
                    {                       
                        $userIds = User::select('id')->whereIn('id',$request->user_id)->get(); 
                        $users =  UserLogin::whereIn('user_id',$userIds)->get();   
                    }
                    foreach($users as $key)
                    {
                        $deviceToken = $key->deviceToken;
                        if(!empty($deviceToken))
                        {
                            $title = $title;
                            $body = $text;                          
                            $imageUrl = '';
                            if(!empty($image))
                            {   
                                $imageUrl = url('public/storage/notification/'.$image);
                            }
                           $success = $this->send_notification($title,$body,$deviceToken,$imageUrl);
                            if($success)
                            {
                                $dbArray = [];
                                $dbArray['user_id']=$key->user_id;
                                $dbArray['type']=$request->type;
                                $dbArray['title']=$request->title ?? '';
                                $dbArray['text']=$request->text ?? '';
                                $dbArray['is_send']=1; 
                                $dbArray['image']=$imageUrl;
                               DB::table('notifications')->insert($dbArray);
                            }
                        }
                    }
                }

                if($request->type == 'astrologer')
                {
                    $astro_id = implode(",",$request->astro_id); 
                    if($astro_id == 0)
                    {
                        $astroIds = Astrologer::where(['status'=>1,'is_delete'=>0])->pluck('id')->toArray();
                        $astros =  DB::table('astro_logins')->whereIn('user_id',$astroIds)->get();
                    }

                    if($astro_id > 0)
                    {                       
                        $astroIds = Astrologer::select('id')->whereIn('id',$request->astro_id)->get(); 
                        $astros =  DB::table('astro_logins')->whereIn('user_id',$astroIds)->get();   
                    }
                    foreach($astros as $key)
                    {
                        $deviceToken = $key->deviceToken;
                        if(!empty($deviceToken))
                        {
                            $title = $title;
                            $body = $text;                          
                            $imageUrl = '';
                            if(!empty($image))
                            {   
                                $imageUrl = url('public/storage/notification/'.$image);
                            }
                           $success = $this->send_notification($title,$body,$deviceToken,$imageUrl);
                            if($success)
                            {
                                $dbArray = [];
                                $dbArray['user_id']=$key->user_id;
                                $dbArray['type']=$request->type;
                                $dbArray['title']=$request->title ?? '';
                                $dbArray['text']=$request->text ?? '';
                                $dbArray['is_send']=1; 
                                $dbArray['image']=$imageUrl;
                               DB::table('notifications')->insert($dbArray);
                            }
                        }
                    }
                }  
            }                   
         }

    $data['users'] = $users;
    $data['astrologers'] = $astrologers;
    return view('admin.notifications.index',$data);
 }


private function saveImage($request)
{
    $file = $request->file('image');
    if ($file) {
        $path = 'notification/';
        $thumb_path = 'notification/thumb/';
        $storage = Storage::disk('public');
            //prd($storage);
        $IMG_WIDTH = 768;
        $IMG_HEIGHT = 768;
        $THUMB_WIDTH = 336;
        $THUMB_HEIGHT = 336;
        $uploaded_data = CustomHelper::UploadImage($file, $path, $ext='', $IMG_WIDTH, $IMG_HEIGHT, $is_thumb=true, $thumb_path, $THUMB_WIDTH, $THUMB_HEIGHT);
        if($uploaded_data['success']){
            $image = $uploaded_data['file_name'];
            return $image;
        }
    }
}

public function send_notification($title, $body, $deviceToken,$image){
    $sendData = array(
        'body' => !empty($body) ? $body : '',
        'title' => !empty($title) ? $title : '',
        'image' => !empty($image) ? $image : '',
        'sound' => 'Default'
    );

    return $this->fcmNotification($deviceToken,$sendData);
}

public function fcmNotification($device_id, $sendData)
{
        #API access key from Google API's Console
    if (!defined('API_ACCESS_KEY')){
        define('API_ACCESS_KEY', 'AAAA-ub9LE8:APA91bFxQB0OiVLwiAhK0YtrnVdAObaX5HG8nRxe-n88lrgK0Cqn-6cxmr9xsrfcSmW2beyq8mtyrbOqPzWEYGmhqFYC7ggl4e1ec-AeKE66MRFBvKvR0HGqY6ftSXRID89LOuBb64yd');
    }


    $fields = array
    (
        'to'    => $device_id,
        'data'  => $sendData,
        'notification'  => $sendData,
        // "click_action"=> "FLUTTER_NOTIFICATION_CLICK",
    );

    $headers = array
    (
        'Authorization: key=' . API_ACCESS_KEY,
        'Content-Type: application/json'
    );
        #Send Reponse To FireBase Server
    $ch = curl_init();
    curl_setopt( $ch,CURLOPT_URL, 'https://fcm.googleapis.com/fcm/send' );
    curl_setopt( $ch,CURLOPT_POST, true );
    curl_setopt( $ch,CURLOPT_HTTPHEADER, $headers );
    curl_setopt( $ch,CURLOPT_RETURNTRANSFER, true );
    curl_setopt( $ch,CURLOPT_SSL_VERIFYPEER, false );
    curl_setopt( $ch,CURLOPT_POSTFIELDS, json_encode( $fields ) );
    $result = curl_exec($ch);
    if($result === false){
        die('Curl failed ' . curl_error($ch));
    }
    curl_close($ch);
    return $result;
}
    





   
}




