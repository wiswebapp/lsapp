<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Pages extends Model
{
    //Table name
    protected  $table = 'pages';
    
    //Primary Key
    protected $primaryKey = 'iPageId';

    //Timestamps
    public $timestamps = true;

    protected $fillable = [
        'vPageName', 'vTitle', 'vSlug', 'tMetaKeyword', 'tMetaDescription', 'tDescription', 'vImage', 'eStatus', 'eStatus', 'updated_at'
    ];
}
