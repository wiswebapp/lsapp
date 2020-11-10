<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Post extends Model
{

    use SoftDeletes; 

    //Table name
    protected  $table = 'posts';
    
    //Primary Key
    protected $primaryKey = 'iPostId';

    //Timestamps
    public $timestamps = true;

    public function user(){
        return $this->belongsTo('App\User','iUserId');
    }
     
}
