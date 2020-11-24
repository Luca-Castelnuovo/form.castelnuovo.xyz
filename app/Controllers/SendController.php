<?php

namespace App\Controllers;

use CQ\Controllers\Controller;
use CQ\DB\DB;
use CQ\Helpers\Request;

class SendController extends Controller
{
    /**
     * Send mail.
     *
     * @param object $request
     *
     * @return Json|Redirect
     */
    public function form($request, $id)
    {
        $site = DB::get('sites', ['user_email', 'domain'], [
            'id' => $id,
        ]);

        if (Request::origin() !== $site['domain']) {
            return $this->respondJson(
                'Submitting data from ' . Request::origin() . ' is not supported.',
                [],
                400
            );
        }

        // subject, email, redirect

        // create email

        // send email

        if ($request->data->redirect) {
            return $this->redirect($request->data->redirect);
        }

        return $this->redirect('https://example.com');
    }
}
