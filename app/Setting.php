<?php
namespace App;

use Illuminate\Database\Eloquent\Model;
class Setting extends Model{

    protected $table = 'settings';

    protected $guarded = ['id'];

    public $timestamps = false;

    protected $fillable = [];


}