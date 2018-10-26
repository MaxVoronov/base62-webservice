<?php declare(strict_types=1);

namespace App\Factory;

use Symfony\Component\HttpFoundation\Request;

class HttpRequestFactory
{
    public static function create()
    {
        return Request::createFromGlobals();
    }
}
