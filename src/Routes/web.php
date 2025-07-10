<?php

use Slim\Routing\RouteCollectorProxy;
use App\Controllers\UserController;
use App\Controllers\ReminderController;
use App\Controllers\FamilyGroupController;


use App\Controllers\ErrorController;
use App\Middleware\FirebaseAuthMiddleware;

$app->group('', function (RouteCollectorProxy $group) {

    // Rutas protegidas dentro de /api
    $group->group('/api', function (RouteCollectorProxy $auth) {
        $auth->get('/user', [UserController::class, 'getUserByEmail']);
        $auth->get('/reminder/family-group', [ReminderController::class, 'getReminderByFammilyGroup']);
        $auth->get('/family-group/persona', [FamilyGroupController::class, 'getFamilyGroupByPersona']);

    })->add(new FirebaseAuthMiddleware());


    $group->map(['GET', 'POST', 'PUT', 'DELETE'], '/{routes:.+}', function ($request, $response) {
        $uri = $request->getUri()->getPath();
        if (strpos($uri, '/api') !== 0 || $uri == '/') {
            return (new ErrorController)->notAuth($request, $response, []);
        }

        return $response->withStatus(404)->withHeader('Content-Type', 'application/json')
                        ->write(json_encode(['error' => 'API route not found']));
    });

});
