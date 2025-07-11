<?php

namespace App\Controllers;

use Psr\Http\Message\ResponseInterface as Response;
use Psr\Http\Message\ServerRequestInterface as Request;

use App\Service\ReminderService;

class ReminderController
{
    
    public function getReminderByFammilyGroup(Request $request, Response $response): Response
    {
        $params = $request->getQueryParams();
        $pk = $params['fg'] ?? null; // pk del family_group

        if (!$pk) {
            $response->getBody()->write(json_encode(['error' => 'Falta indicar el grupo familiar']));
            return $response->withStatus(400)->withHeader('Content-Type', 'application/json');
        }

        $reminderServ = new ReminderService();
        $result = $reminderServ->getReminderByFG($pk); 

        if(isset($result['status'])){
            if($result['status'] !=200){
                $response->getBody()->write(json_encode([
                    "message"=>$result['message'],
                    "error"=>true,
                ]));
                return $response->withStatus(400)->withHeader('Content-Type', 'application/json');
            }
        }

        $response->getBody()->write(json_encode($result));
        return $response->withHeader('Content-Type', 'application/json');
    }

    public function getReminderByPet(Request $request, Response $response): Response
    {
        $params = $request->getQueryParams();
        $pk = $params['pet'] ?? null; // pk del family_group

        if (!$pk) {
            $response->getBody()->write(json_encode(['error' => 'Falta indicar la mascota']));
            return $response->withStatus(400)->withHeader('Content-Type', 'application/json');
        }

        $reminderServ = new ReminderService();
        $result = $reminderServ->getReminderByPet($pk); 

        if(isset($result['status'])){
            if($result['status'] !=200){
                $response->getBody()->write(json_encode([
                    "message"=>$result['message'],
                    "error"=>true,
                ]));
                return $response->withStatus(400)->withHeader('Content-Type', 'application/json');
            }
        }

        $response->getBody()->write(json_encode($result));
        return $response->withHeader('Content-Type', 'application/json');
    }

}
