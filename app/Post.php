<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Post extends Model
{
    //Table name
    protected  $table = 'posts';
    
    //Primary Key
    protected $primaryKey = 'iPostId';

    //Timestamps
    public $timestamps = true;

}
