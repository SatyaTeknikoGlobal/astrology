<?php
namespace App;
use DB;
use Illuminate\Database\Eloquent\Model;

class Expertise extends Model{
    protected $table = 'expertises';

    protected $guarded = ['id'];

    public $timestamps = false;

    protected $fillable = 
    [
        
        'name',
        
    ];


   

}