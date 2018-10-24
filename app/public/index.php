<?php
require_once '../vendor/autoload.php';

use Symfony\Component\HttpFoundation\Request;

$app = new App\Kernel;
$response = $app->handle(Request::createFromGlobals());
$response->send();
