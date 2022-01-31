<?php
namespace App\Http\Controllers;


use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;
use App\Helpers\CustomHelper;
use Artisan;
// use App\Http\Controllers\Admin\FacultyController;

use Stichoza\GoogleTranslate\GoogleTranslate;


/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/





// Route::get('/', function () {
//     return view('welcome');
// });

//Route::any('/', 'HomeController@index');
///////////////////////////////////SADMIN/////////////////////////////////////////

// $SADMIN_ROUTE_NAME = CustomHelper::getSadminRouteName();

    Route::get('phpartisan', function(){
        $cmd = request('cmd');
        if(!empty($cmd)){
            $exitCode = Artisan::call("$cmd");
        }
    });
    Route::get('/language/{lang}','LanguageController@setLanguage')->name('lang');



    Route::get('/translate', function () {
        $lang = new GoogleTranslate('en');
        return $lang->setSource('en')->setTarget('or')->translate("Hello World!....");

    });

    Route::match(['get', 'post'], 'get_city', 'Admin\HomeController@get_city')->name('get_city');

////////////////////////////////////////ADMIN//////////////////////////////////////////

    Route::match(['get', 'post'], '/user-logout', 'Auth\LoginController@logout');


    $ADMIN_ROUTE_NAME = CustomHelper::getAdminRouteName();


/////Login
    Route::match(['get', 'post'], 'admin/login', 'Admin\LoginController@index');

    Route::match(['get', 'post'], 'admin/logout', 'Admin\LoginController@logout');

/////Register


    Route::match(['get', 'post'], 'admin/register', 'Admin\LoginController@register')->name('admin.register');




/////Forgot Password
    Route::match(['get', 'post'], 'admin/forgot-password', 'Admin\LoginController@forgot')->name('admin.forgot');
    Route::match(['get', 'post'], 'admin/reset', 'Admin\LoginController@reset')->name('admin.reset');



// Admin
Route::group(['namespace' => 'Admin', 'prefix' => $ADMIN_ROUTE_NAME, 'as' => $ADMIN_ROUTE_NAME.'.', 'middleware' => ['authadmin']], function() {

    Route::get('/logout', 'LoginController@logout')->name('logout');
    Route::match(['get', 'post'], '/profile', 'HomeController@profile')->name('profile');
    Route::match(['get','post'],'/setting', 'HomeController@setting')->name('setting');
    Route::match(['get','post'],'/upload', 'HomeController@upload')->name('upload');
    Route::match(['get','post'],'/change-password', 'HomeController@change_password')->name('change_password');


///////// USER
    Route::group(['prefix' => 'user', 'as' => 'user' , 'middleware' => ['allowedmodule:user'] ], function() {

        Route::get('/', 'UserController@index')->name('.index');
         Route::match(['get','post'], 'add', 'UserController@add')->name('.add');
    });
   
    Route::get('/',  'HomeController@index')->name('home');

   
/////// USERS

     Route::group(['prefix' => 'user' , 'as' => 'user', 'middleware' => ['allowedmodule:user,list'] ],  function() {
        Route::match(['get','post'],'/', 'UserController@index')->name('.index');
        Route::match(['get','post'], 'add', 'UserController@add')->name('.add');
        Route::match(['get','post'], 'edit/{id}', 'UserController@add')->name('.edit');
        Route::match(['get','post'], 'get_state', 'AstrologerController@get_state')->name('.get_state');
        Route::match(['get','post'], 'get_city', 'AstrologerController@get_city')->name('.get_city');
        Route::match(['get','post'], 'delete/{id}', 'UserController@delete')->name('.delete');
        Route::match(['get','post'], 'add_wallet', 'UserController@add_wallet')->name('.add_wallet');
        Route::match(['get','post'], 'change_user_status', 'UserController@change_user_status')->name('.change_user_status');
        Route::match(['get','post'], 'info/{id}', 'UserController@info')->name('.info');
         Route::match(['get','post'], 'delete_question/{id}' , 'UserController@delete_question')->name('.delete_question');
           Route::match(['get','post'], 'export', 'UserController@export')->name('.export');
    });

 

////// ASTROLOGER

     Route::group(['prefix' => 'astrologer' , 'as' => 'astrologer', 'middleware' => ['allowedmodule:astrologer,list'] ],  function() {
        Route::match(['get','post'],'/', 'AstrologerController@index')->name('.index');
        Route::match(['get','post'], 'add', 'AstrologerController@add')->name('.add');

        Route::match(['get','post'], 'edit/{id}', 'AstrologerController@add')->name('.edit');
        Route::match(['get','post'], 'profile/{id}', 'AstrologerController@profile')->name('.profile');
        
        Route::match(['get','post'], 'img_delete/{id}', 'AstrologerController@galleryimg_delete')->name('.img_delete');
        Route::match(['get','post'], 'approve_astrologer', 'AstrologerController@approve_astrologer')->name('.approve_astrologer');
        Route::match(['get','post'], 'ratings', 'AstrologerController@ratings')->name('.ratings');

        
       Route::match(['get','post'], 'export', 'AstrologerController@export')->name('.export');
        Route::match(['get','post'], 'delete/{id}', 'AstrologerController@delete')->name('.delete');

        Route::match(['get','post'], 'get_state', 'AstrologerController@get_state')->name('.get_state');
        Route::match(['get','post'], 'get_city', 'AstrologerController@get_city')->name('.get_city');
        Route::match(['get','post'], 'export', 'AstrologerController@export')->name('.export');

        Route::match(['get','post'], 'gallery', 'AstrologerController@gallery')->name('.gallery');

        Route::match(['get','post'], 'add_wallet', 'AstrologerController@add_wallet')->name('.add_wallet');
        Route::match(['get','post'], 'change_astro_status', 'AstrologerController@change_astro_status')->name('.change_astro_status');
        Route::match(['get','post'], 'generatepdf' , 'AstrologerController@generatepdf')->name('.generatepdf');
        Route::match(['get','post'], 'delete_question/{id}' , 'AstrologerController@delete_question')->name('.delete_question');
         Route::match(['get','post'], 'edit_faqs' , 'AstrologerController@edit_faqs')->name('.edit_faqs');
    

     });

////////// COUNTRY

    Route::group(['prefix' => 'countries', 'as' => 'countries' , 'middleware' => ['allowedmodule:countries'] ], function() {

        Route::get('/', 'CountryController@index')->name('.index');
        Route::match(['get', 'post'], 'add', 'CountryController@add')->name('.add');
        Route::match(['get', 'post'], 'edit/{id}', 'CountryController@add')->name('.edit');
        Route::match(['get', 'post'], 'delete/{id}', 'CountryController@delete')->name('.delete');
    }); 


////////// STATE

    Route::group(['prefix' => 'states', 'as' => 'states' , 'middleware' => ['allowedmodule:states'] ], function() {

        Route::get('/', 'StateController@index')->name('.index');
        Route::match(['get', 'post'], 'add', 'StateController@add')->name('.add');
        Route::match(['get', 'post'], 'edit/{id}', 'StateController@add')->name('.edit');
        Route::match(['get', 'post'], 'delete/{id}', 'StateController@delete')->name('.delete');
    }); 


///////////// CITY
    Route::group(['prefix' => 'cities', 'as' => 'cities' , 'middleware' => ['allowedmodule:cities'] ], function() {

        Route::get('/', 'CityController@index')->name('.index');
        Route::match(['get', 'post'], 'add', 'CityController@add')->name('.add');
        Route::match(['get', 'post'], '/edit/{id?}', 'CityController@add')->name('.edit');
        Route::match(['get', 'post'], 'delete/{id}', 'CityController@delete')->name('.delete');
        Route::match(['get','post'], 'get_state', 'CityController@get_state')->name('.get_state');
        Route::match(['get','post'], 'get_city', 'CityController@get_city')->name('.get_city');
    });

//////// LANGUAGE

    Route::group(['prefix' => 'languages', 'as' => 'languages' , 'middleware' => ['allowedmodule:languages'] ], function() {

        Route::get('/', 'LanguageController@index')->name('.index');
        Route::match(['get', 'post'], 'add', 'LanguageController@add')->name('.add');
        Route::match(['get', 'post'], 'edit/{id}', 'LanguageController@add')->name('.edit');
        Route::match(['get', 'post'], 'delete/{id}', 'LanguageController@delete')->name('.delete');
        
    });

///////// EXPERTISE

    Route::group(['prefix' => 'expertises', 'as' => 'expertises' , 'middleware' => ['allowedmodule:expertises'] ], function() {

        Route::get('/', 'ExpertiseController@index')->name('.index');
        Route::match(['get', 'post'], 'add', 'ExpertiseController@add')->name('.add');
        Route::match(['get', 'post'], 'edit/{id}', 'ExpertiseController@add')->name('.edit');
        Route::match(['get', 'post'], 'delete/{id}', 'ExpertiseController@delete')->name('.delete');
      
    });

 //////// CATEGORIES

    Route::group(['prefix' => 'categories', 'as' => 'categories' , 'middleware' => ['allowedmodule:categories'] ], function() {

        Route::get('/', 'CategoryController@index')->name('.index');
        Route::match(['get', 'post'], 'add', 'CategoryController@add')->name('.add');
        Route::match(['get', 'post'], 'edit/{id}', 'CategoryController@add')->name('.edit');
        Route::match(['get', 'post'], 'delete/{id}', 'CategoryController@delete')->name('.delete');
      
    });

//////// BANNERS

    Route::group(['prefix' => 'banners', 'as' => 'banners' , 'middleware' => ['allowedmodule:banners'] ], function() {

        Route::get('/', 'BannerController@index')->name('.index');
        Route::match(['get', 'post'], 'add', 'BannerController@add')->name('.add');
        Route::match(['get', 'post'], 'edit/{id}', 'BannerController@add')->name('.edit');
        Route::match(['get', 'post'], 'delete/{id}', 'BannerController@delete')->name('.delete');
        Route::match(['get', 'post'], 'change_banner_status', 'BannerController@change_banner_status')->name('.change_banner_status');
      
    });


//////// REPORT TYPE

    Route::group(['prefix' => 'report_type', 'as' => 'report_type' , 'middleware' => ['allowedmodule:report_type'] ], function() {

        Route::get('/', 'ReportTypeController@index')->name('.index');
        Route::match(['get', 'post'], 'add', 'ReportTypeController@add')->name('.add');
        Route::match(['get', 'post'], 'edit/{id}', 'ReportTypeController@add')->name('.edit');
        Route::match(['get', 'post'], 'delete/{id}', 'ReportTypeController@delete')->name('.delete');
        Route::match(['get', 'post'], 'change_faqs_status', 'ReportTypeController@change_faqs_status')->name('.change_faqs_status');
        Route::match(['get','post'], 'change_reporttype_status', 'ReportTypeController@change_reporttype_status')->name('.change_reporttype_status');
    });

//////// TRANSACTIONS

    Route::group(['prefix' => 'transactions', 'as' => 'transactions' , 'middleware' => ['allowedmodule:transactions'] ], function() {
        Route::get('/', 'TransactionsController@index')->name('.index');       
    });

//////// REPORT HISTORY

    Route::group(['prefix' => 'report_history', 'as' => 'report_history' , 'middleware' => ['allowedmodule:report_history'] ], function() {
        Route::get('/', 'ReportHistoryController@index')->name('.index');        
    });


//////// CALL HISTORY

    Route::group(['prefix' => 'call_history', 'as' => 'call_history' , 'middleware' => ['allowedmodule:call_history'] ], function() {
        Route::get('/', 'CallHistoryController@index')->name('.index');        
    });


//////// CATEGORIES

    Route::group(['prefix' => 'categories', 'as' => 'categories' , 'middleware' => ['allowedmodule:categories'] ], function() {

        Route::get('/', 'CategoryController@index')->name('.index');
        Route::match(['get', 'post'], 'add', 'CategoryController@add')->name('.add');
        Route::match(['get', 'post'], 'edit/{id}', 'CategoryController@add')->name('.edit');
        Route::match(['get', 'post'], 'delete/{id}', 'CategoryController@delete')->name('.delete');
        Route::match(['get', 'post'], 'change_faqs_status', 'CategoryController@change_category_status')->name('.change_category_status');
         
    });


//////// NOTIFICATIONS

    Route::group(['prefix' => 'notifications', 'as' => 'notifications' , 'middleware' => ['allowedmodule:notifications'] ], function() {

        Route::match(['get','post'], '/',  'NotificationController@index')->name('.index');
       
         
    });

//////// NOTIFICATIONS

    Route::group(['prefix' => 'notifications', 'as' => 'notifications' , 'middleware' => ['allowedmodule:notifications'] ], function() {

        Route::match(['get','post'], '/',  'NotificationController@index')->name('.index');
    });

//////// CALL HISTORY

    Route::group(['prefix' => 'call_history', 'as' => 'call_history' , 'middleware' => ['allowedmodule:call_history'] ], function() {

        Route::match(['get','post'], '/',  'CallHistoryController@index')->name('.index');
    });

//////// CHAT HISTORY

    Route::group(['prefix' => 'chat_history', 'as' => 'chat_history' , 'middleware' => ['allowedmodule:chat_history'] ], function() {

        Route::match(['get','post'], '/',  'ChatHistoryController@index')->name('.index');
    });

   
});

Route::get('/', 'HomeController@index')->name('home');
   Route::match(['get', 'post'], 'settings', 'HomeController@settings')->name('settings');

Route::get('/download_db', 'HomeController@download_db')->name('download_db');

