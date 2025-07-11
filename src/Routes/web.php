<?php

use Slim\Routing\RouteCollectorProxy;
use App\Controllers\UserController;
use App\Controllers\ReminderController;
use App\Controllers\FamilyGroupController;
use App\Controllers\PetController;
use App\Controllers\MedicalCtrlController;




use App\Controllers\ErrorController;
use App\Middleware\FirebaseAuthMiddleware;

$app->group('/api', function (RouteCollectorProxy $group) {

    // $group->get('/user', [UserController::class, 'getUserByEmail']);
    $group->get('/reminder/family-group', [ReminderController::class, 'getReminderByFammilyGroup']);
    $group->get('/reminder/pet', [ReminderController::class, 'getReminderByPet']);

    $group->get('/family-group/persona', [FamilyGroupController::class, 'getFamilyGroupByPersona']);
    $group->get('/pet/family-group', [PetController::class, 'getPetsByFamilyGroup']);

    $group->get('/medical-ctrl/pet', [MedicalCtrlController::class, 'getMedicalCtrlByPet']);

    $group->post('/pet', [PetController::class, 'postPet']);
    $group->post('/medical-ctrl', [MedicalCtrlController::class, 'postMedicalCtrl']);

    $group->post('/user', [UserController::class, 'postUser']);
    $group->get('/user', [UserController::class, 'getUserByEmail']);


    // Rutas protegidas dentro de /api
    $group->group('/secure', function (RouteCollectorProxy $auth) {
        $auth->get('/user', [UserController::class, 'getUserByEmail']);
        // $auth->get('/reminder/family-group', [ReminderController::class, 'getReminderByFammilyGroup']);
        // $auth->get('/family-group/persona', [FamilyGroupController::class, 'getFamilyGroupByPersona']);
        // $auth->get('/pet/family-group', [PetController::class, 'getPetsByFamilyGroup']);


    })->add(new FirebaseAuthMiddleware());


    $group->map(['GET', 'POST', 'PUT', 'DELETE'], '/{routes:.+}', function ($request, $response) {
        $uri = $request->getUri()->getPath();
        if (strpos($uri, '/api') !== 0 || $uri == '/') {
            return (new ErrorController)->notAuth($request, $response, []);
        }

        return $response->withStatus(404)->withHeader('Content-Type', 'application/json')->write(json_encode(['error' => 'API route not found']));
    });

});
