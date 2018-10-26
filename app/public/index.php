<?php
require_once '../vendor/autoload.php';

$app = new App\Kernel;
$response = $app->handle();
$response->send();
