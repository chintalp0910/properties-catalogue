<?php

namespace App\Http\Controllers;

use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Routing\Controller as BaseController;
use Illuminate\Support\Str;

class Controller extends BaseController
{
    use AuthorizesRequests, DispatchesJobs, ValidatesRequests;


    public static function formatUSAPhone($val):?string
    {
        if( !$val ) return null;
        $v = Str::of(strval( $val ));
        if( $v->length() < 7 ) return (string)$v;
        return sprintf( "%s-%s-%s", $v->substr(0,3), $v->substr(3,3),
            $v->substr(6)
        );
    }
}
