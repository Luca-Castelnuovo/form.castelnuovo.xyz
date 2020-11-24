<?php

namespace App\Middleware;

use CQ\Middleware\Middleware;

class JSONorFormMiddleware extends Middleware
{
    /**
     * Check if request is JSON, Form or neither.
     *
     * @param $request
     * @param $next
     *
     * @return mixed
     */
    public function handle($request, $next)
    {
        //
    }
}
