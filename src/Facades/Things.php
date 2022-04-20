<?php

namespace TypiCMS\Modules\Things\Facades;

use Illuminate\Support\Facades\Facade;

class Things extends Facade
{
    /**
     * Get the registered name of the component.
     *
     * @return string
     */
    protected static function getFacadeAccessor()
    {
        return 'Things';
    }
}
