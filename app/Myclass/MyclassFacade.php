<?php
namespace App\Myclass;

use Illuminate\Support\Facades\Facade;

class MyclassFacade extends Facade{

    protected static function getFacadeAccessor()
    {
        return 'generalData';
    }
}