<?php
namespace App;
use DB;
use Illuminate\Database\Eloquent\Model;

class Astrologer extends Model{
    protected $table = 'astrologer';

    protected $guarded = ['id'];

    public $timestamps = false;

    protected $fillable = 
    [
        
        //'name',
        
    ];

    public function getLanguage()
    {
        return $this->belongsTo('App\Language','language');
    }

    public function getExpertise()
    {
        return $this->belongsTo('App\Expertise','type');
    }


   

}