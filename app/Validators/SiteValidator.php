<?php

namespace App\Validators;

use CQ\Validators\Validator;
use Respect\Validation\Validator as v;

class SiteValidator extends Validator
{
    /**
     * Validate json submission.
     *
     * @param object $data
     */
    public static function create($data)
    {
        $v = v::attribute('name', v::alnum(' ', '-', '.')->length(1, 2048))
        ->attribute('domain', v::domain()->length(1, 2048));

        self::validate($v, $data);
    }
}
