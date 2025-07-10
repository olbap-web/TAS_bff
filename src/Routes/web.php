<?php

use Slim\Routing\RouteCollectorProxy;
use App\Controllers\UserController;
use App\Controllers\ErrorController;


use App\Middleware\FirebaseAuthMiddleware;


$app->group('', function (RouteCollectorProxy $group) {

    // $group->get('',[api])

    $group->post('/', [ErrorController::class, 'notAuth']); // opcional

    // 🔐 Ruta protegida con Firebase
    $group->group('/api', function (RouteCollectorProxy $auth) {
        $auth->get('/user', [UserController::class, 'getUserByEmail']);
        $auth->get('/reminder', [UserController::class, 'getReminderByUser']);

        
    })->add(new FirebaseAuthMiddleware());
});