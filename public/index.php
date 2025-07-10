<?php

use Slim\Factory\AppFactory;

require __DIR__ . '/../vendor/autoload.php';

$app = AppFactory::create();
$app->addBodyParsingMiddleware();


// ✅ Middleware global para CORS
$app->add(function ($request, $handler) {
    $response = $handler->handle($request);
    return $response
        ->withHeader('Access-Control-Allow-Origin', '*') // ← cámbialo por tu dominio en prod
        ->withHeader('Access-Control-Allow-Headers', 'Authorization, Content-Type, Accept, Origin')
        ->withHeader('Access-Control-Allow-Methods', 'GET, POST, PUT, DELETE, OPTIONS')
        ->withHeader('Access-Control-Allow-Credentials', 'true');
});

// ✅ Ruta de preflight (OPTIONS)
$app->options('/{routes:.+}', function ($request, $response) {
    return $response;
});


require __DIR__ . '/../src/Dependencies.php';
require __DIR__ . '/../src/Routes/web.php';

$app->run();
