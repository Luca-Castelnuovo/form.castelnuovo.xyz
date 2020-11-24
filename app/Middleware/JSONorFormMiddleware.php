<?php

namespace App\Middleware;

use CQ\Middleware\Middleware;
use CQ\Helpers\Request;
use CQ\Response\Json;

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
        if (Request::isJson($request)) {
            // TODO: CQ\Middleware\JSON
        }

        if (Request::isForm($request)) {
            // TODO: CQ\Middleware\Form
        }

        return new Json([
            'success' => false,
            'message' => 'Invalid Content-Type',
            'data' => [
                'details' => "Content-Type should be 'application/json' or 'application/x-www-form-urlencoded'",
            ],
        ], 415);
    }
}
