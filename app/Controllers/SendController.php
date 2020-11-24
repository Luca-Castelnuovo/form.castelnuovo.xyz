<?php

namespace App\Controllers;

use CQ\Controllers\Controller;
use CQ\DB\DB;
use CQ\Helpers\Request;
use CQ\Response\Twig;
use CQ\Helpers\Session;
use App\Helpers\MailHelper;
use CQ\Config\Config;
use Exception;

class SendController extends Controller
{
    /**
     * Show mail sent successfully page
     *
     * @return Html`
     */
    public function success()
    {
        $redirect = Session::get('redirect');
        Session::unset('redirect');

        return $this->respond('success.twig', [
            'redirect' => $redirect,
        ]);
    }

    /**
     * Send mail from FormData.
     *
     * @param object $request
     *
     * @return Json|Redirect
     */
    public function form($request, $id)
    {
        return $this->handleSubmission($request, $id);
    }

    /**
     * Send mail from JSON data.
     *
     * @param object $request
     *
     * @return Json
     */
    public function api($request, $id)
    {
        return $this->handleSubmission($request, $id);
    }

    /**
     * Handle submission for both types of data
     *
     * @param object $request
     * @param string $id
     *
     * @return void
     */
    private function handleSubmission($request, $id)
    {
        $site = DB::get('sites', ['name', 'user_email', 'domain'], [
            'id' => $id,
        ]);

        if (!$site) {
            return $this->respondJson(
                'Invalid sitekey',
                [],
                401
            );
        }

        // TODO: find a method of authenticating the origin
        // maybe only set CORS headers if domain is allowed

        // if (Request::origin() !== $site['domain']) {
        //     return $this->respondJson(
        //         'Submitting data from ' . Request::origin() . ' is not supported.',
        //         [],
        //         400
        //     );
        // }

        $app_name = Config::get('app.name');
        $template_data = (array) $request->data;
        unset($template_data['redirect']);

        try {
            MailHelper::send(
                $site['user_email'],
                "[{$app_name}] {$request->data->subject}",
                Twig::renderFromText(Config::get('smtp.template'), [
                    'name' => $site['name'],
                    'data' => $template_data,
                ]),
                Config::get('app.name'),
                $request->data->email
            );
        } catch (Exception $e) {
            return $this->respondJson(
                'Mail Error',
                $e->getMessage(),
                400
            );
        }

        if (Request::isForm($request)) {
            if ($request->data->redirect) {
                Session::set('redirect', $request->data->redirect);
            }

            return $this->redirect('/form/success');
        }

        return $this->respondJson(
            'Mail sent',
        );
    }
}
