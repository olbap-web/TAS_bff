<?php

use Slim\Routing\RouteCollectorProxy;
use App\Controllers\UserController;

use App\Middleware\FirebaseAuthMiddleware;


$app->group('/api', function (RouteCollectorProxy $group) {

    // $group->get('',[api])

    $group->post('/login', [UserController::class, 'login']); // opcional

    // 🔐 Ruta protegida con Firebase
    $group->group('', function (RouteCollectorProxy $auth) {
        $auth->get('/user', [UserController::class, 'getUserByEmail']);
    })->add(new FirebaseAuthMiddleware());
});