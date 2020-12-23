<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Category extends Model
{ 
    //Table name
    protected  $table = 'categories';
    
    //Primary Key
    protected $primaryKey = 'id';

    public function post(){
        return $this->belongsToMany(Post::class);
    }
}
