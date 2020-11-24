<?php

// TODO: fix twig template, add site name to the template, make loop for all variables

return [
    'host' => env('SMTP_HOST'),
    'port' => env('SMTP_PORT'),
    'username' => env('SMTP_USER'),
    'password' => env('SMTP_PASSWORD'),
    'template' => <<<Twig

    Hello there2

Twig,
];
