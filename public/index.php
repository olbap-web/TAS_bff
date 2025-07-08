<?php

use Slim\Factory\AppFactory;

require __DIR__ . '/../vendor/autoload.php'; // ← Esto es esencial

$app = AppFactory::create();
$app->addBodyParsingMiddleware();

require __DIR__ . '/../src/Dependencies.php';
require __DIR__ . '/../src/Routes/web.php';

$app->run();
