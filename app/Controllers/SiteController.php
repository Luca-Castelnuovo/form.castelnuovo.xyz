<?php

namespace App\Controllers;

use App\Validators\SiteValidator;
use CQ\Controllers\Controller;
use CQ\DB\DB;
use CQ\Helpers\UUID;
use CQ\Helpers\User;
use Exception;

class SiteController extends Controller
{
    /**
     * Create site.
     *
     * @param object $request
     *
     * @return Json
     */
    public function create($request)
    {
        try {
            SiteValidator::create($request->data);
        } catch (Exception $e) {
            return $this->respondJson(
                'Provided data was malformed',
                json_decode($e->getMessage()),
                422
            );
        }

        $data = [
            'id' => UUID::v6(),
            'user_id' => User::getId(),
            'user_email' => User::getEmail(),
            'name' => $request->data->name,
            'domain' => $request->data->domain,
        ];

        DB::create('sites', $data);

        return $this->respondJson(
            'Site Created',
            [
                'reload' => true,
                $data,
            ]
        );
    }

    /**
     * Delete site.
     *
     * @param string $id
     *
     * @return Json
     */
    public function delete($id)
    {
        DB::delete('sites', ['id' => $id]);

        return $this->respondJson('Site Deleted', [
            'reload' => true,
        ]);
    }
}
