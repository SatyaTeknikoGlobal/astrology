<?php
namespace App;
use DB;
use Illuminate\Database\Eloquent\Model;

class Report_Type extends Model{
    protected $table = 'report_type';

    protected $guarded = ['id'];

    public $timestamps = false;

    protected $fillable = 
    [
        
        //'name',
        
    ];

   


   

}