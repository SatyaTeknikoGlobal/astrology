<?php
namespace App;
use DB;
use Illuminate\Database\Eloquent\Model;

class Language extends Model{
    protected $table = 'languages';

    protected $guarded = ['id'];

    public $timestamps = false;

    protected $fillable = 
    [
        
        'name',
        
    ];


   

}