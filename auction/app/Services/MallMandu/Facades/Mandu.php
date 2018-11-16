<?php

namespace App\Services\MallMandu\Facades;

use Illuminate\Support\Facades\Facade;

/**
 * Class Mandu
 * @package App\Services\MallMandu\Facades
 * @author Krishna Prasad Timilsina <bikranshu.t@gmail.com>
 */
class Mandu extends Facade
{

    /**
     * Get the registered name of the component.
     *
     * @return string
     */
    protected static function getFacadeAccessor()
    {
        return 'mandu';
    }

}
