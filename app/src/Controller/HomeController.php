<?php declare(strict_types=1);

namespace App\Controller;

use Symfony\Component\HttpFoundation\Response;

class HomeController
{
    public function execute()
    {
        return new Response('Home page');
    }
}
