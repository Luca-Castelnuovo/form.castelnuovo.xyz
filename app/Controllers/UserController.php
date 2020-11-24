<?php

namespace App\Controllers;

use CQ\Controllers\Controller;
use CQ\Helpers\User;
use CQ\DB\DB;

class UserController extends Controller
{
    /**
     * Dashboard screen.
     *
     * @return Html
     */
    public function dashboard()
    {
        $sites = DB::select('sites', ['id', 'user_id', 'user_email', 'name', 'domains'], [
            'user_id' => User::getId(),
            'ORDER' => ['name' => 'ASC'],
        ]);

        return $this->respond('dashboard.twig', ['sites' => $sites]);

        // return $this->respondJson('Data', [
        //     'sites' => $sites,
        //     'session' => $_SESSION,
        // ]);
    }
}
