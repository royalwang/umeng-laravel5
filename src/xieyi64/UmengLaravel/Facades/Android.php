<?php
/**
 * Created by PhpStorm.
 * User: xutao
 * Date: 15/6/23
 * Time: 09:21
 */

namespace JasonXt\UmengLaravel\Facades;

use Illuminate\Support\Facades\Facade;

class Android extends Facade
{

    protected static function getFacadeAccessor()
    {
        return 'umeng.android';
    }
}