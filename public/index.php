<?php

require __DIR__ . '/../vendor/autoload.php';

require __DIR__ . '/../helpers/functions.php';

use App\Application;
use App\Core\Request;

const __projectRoot__ = __DIR__ .  "/.."; 

$app = new Application();

$request = Request::get();

$app->handle($request);


