<?php

namespace App\Controllers;

use CQ\Controllers\Controller;
use CQ\DB\DB;

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

        // validate domain

        // subject, email, redirect

        // create email
        // TODO: ignore multipart form, ignore input file

        // send email

        // if ($request->data->redirect) {
        //     return $this->redirect($request->data->redirect);
        // }

        // return $this->redirect('https://example.com/thank_you');

        return $this->respondJson('Email sent', $site);
    }
}
