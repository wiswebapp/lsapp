<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Foundation\Auth\User as Authenticatable;

class Admin extends Authenticatable
{
    //Table name
    protected  $table = 'admin';
    
    //Primary Key
    protected $primaryKey = 'id';
    
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'vName', 'vEmail', 'vPassword',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'vPassword', 'vPassword_confirmation',
    ];
    
    public function getAuthPassword(){
        return $this->vPassword;
    }
}
