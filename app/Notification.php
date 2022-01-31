<?php
namespace App;
use DB;
use Illuminate\Database\Eloquent\Model;

class Notification extends Model{
    protected $table = 'notifications';

    protected $guarded = ['id'];

    public $timestamps = false;

    protected $fillable = 
    [
        
        //'name',
        
    ];

   


   

}