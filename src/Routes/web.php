<?php

use Slim\Routing\RouteCollectorProxy;
use App\Controllers\UserController;
use App\Controllers\ReminderController;
use App\Controllers\FamilyGroupController;
use App\Controllers\PetController;
use App\Controllers\MedicalCtrlController;
use App\Controllers\TreatmentController;





use App\Controllers\ErrorController;
use App\Middleware\FirebaseAuthMiddleware;

$app->group('/api', function (RouteCollectorProxy $group) {

    // $group->get('/reminder', [ReminderController::class, 'getReminderByPk']);
    // $group->get('/user', [UserController::class, 'getUserByEmail']);
    // $group->get('/user/persona', [UserController::class, 'getUserByRut']);
    
    // $group->get('/reminder/user', [ReminderController::class, 'getReminderByUser']);
    // $group->get('/reminder', [ReminderController::class, 'getReminderByPk']);


    // $group->get('/family-group/persona', [FamilyGroupController::class, 'getFamilyGroupByPersona']);

    // /**family-group/pets  -> hace referencia a las mascotas del grupo familiar ... cambiar esto */

    // $group->get('/pet/family-group', [PetController::class, 'getPetsByFamilyGroup']);
    // $group->get('/pet/detail', [PetController::class, 'getPetByPk']);

    // $group->get('/medical-ctrl/pet', [MedicalCtrlController::class, 'getMedicalCtrlByPet']);
    // $group->get('/medical-ctrl', [MedicalCtrlController::class, 'getMedicalCtrlByPk']);

    // $group->get('/treatment', [TreatmentController::class, 'getTreatmentByPk']);
    // $group->get('/treatment/documents', [TreatmentController::class, 'getDocumentsByTreatment']);
    // $group->get('/treatment/medicine', [TreatmentController::class, 'getMedicineByTreatment']);
    // $group->get('/treatment/pet', [TreatmentController::class, 'getTreatmentsByPet']);


    // #POST
    // $group->post('/user', [UserController::class, 'postUser']);
    // $group->post('/reminder', [ReminderController::class, 'postReminder']);
    // $group->post('/family-group', [FamilyGroupController::class, 'postFamilyGroup']);
    // $group->post('/pet', [PetController::class, 'postPet']);
    // $group->post('/medical-ctrl', [MedicalCtrlController::class, 'postMedicalCtrl']);
    // $group->post('/treatment', [TreatmentController::class, 'postTreatment']);    

    $group->group('/secure', function (RouteCollectorProxy $auth) {
        // $group->get('/user', [UserController::class, 'getUserByEmail']);

        $auth->get('/user', [UserController::class, 'getUserByEmail']);
        $auth->get('/user/persona', [UserController::class, 'getUserByRut']);
        
        $auth->get('/reminder/user', [ReminderController::class, 'getReminderByUser']);
        $auth->get('/reminder', [ReminderController::class, 'getReminderByPk']);


        $auth->get('/family-group/persona', [FamilyGroupController::class, 'getFamilyGroupByPersona']);

        /**family-group/pets  -> hace referencia a las mascotas del grupo familiar ... cambiar esto */

        $auth->get('/pet/family-group', [PetController::class, 'getPetsByFamilyGroup']);
        $auth->get('/pet/detail', [PetController::class, 'getPetByPk']);

        $auth->get('/medical-ctrl/pet', [MedicalCtrlController::class, 'getMedicalCtrlByPet']);
        $auth->get('/medical-ctrl', [MedicalCtrlController::class, 'getMedicalCtrlByPk']);

        $auth->get('/treatment', [TreatmentController::class, 'getTreatmentByPk']);
        $auth->get('/treatment/documents', [TreatmentController::class, 'getDocumentsByTreatment']);
        $auth->get('/treatment/medicine', [TreatmentController::class, 'getMedicineByTreatment']);
        $auth->get('/treatment/pet', [TreatmentController::class, 'getTreatmentsByPet']);


        #POST
        $auth->post('/user', [UserController::class, 'postUser']);
        $auth->post('/reminder', [ReminderController::class, 'postReminder']);
        $auth->post('/family-group', [FamilyGroupController::class, 'postFamilyGroup']);
        $auth->post('/pet', [PetController::class, 'postPet']);
        $auth->post('/medical-ctrl', [MedicalCtrlController::class, 'postMedicalCtrl']);
        $auth->post('/treatment', [TreatmentController::class, 'postTreatment']);

    })->add(new FirebaseAuthMiddleware());


    // $group->map(['GET', 'POST', 'PUT', 'DELETE'], '/{routes:.+}', function ($request, $response) {
    //     $uri = $request->getUri()->getPath();
    //     if (strpos($uri, '/api') !== 0 || $uri == '/') {
    //         return (new ErrorController)->notAuth($request, $response, []);
    //     }

    //     return $response->withStatus(404)->withHeader('Content-Type', 'application/json')->write(json_encode(['error' => 'API route not found']));
    // });

});
