<?php

namespace App\Exceptions;

use Exception;

class GetCacheNotArrayException extends Exception
{
    public function render()
    {
        return view('errors.get_cache_not_array');
    }
}