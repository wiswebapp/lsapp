<?php

namespace App;

use Illuminate\Notifications\Notifiable;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable
{
    use Notifiable, SoftDeletes;

    //Table name
    protected  $table = 'users';
    
    //Primary Key
    protected $primaryKey = 'iUserId';
    
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

    // public function post(){
    //     return $this->hasMany('App\Post','iUserId');
    // }
}
