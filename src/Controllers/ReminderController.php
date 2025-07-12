<?php

namespace App\Controllers;

use Psr\Http\Message\ResponseInterface as Response;
use Psr\Http\Message\ServerRequestInterface as Request;

use App\Service\ReminderService;

class ReminderController
{
    
    public function getReminderByPk(Request $request, Response $response): Response
    {
        $params = $request->getQueryParams();
        $pk = $params['pk'] ?? null; // pk del family_group

        if (!$pk) {
            $response->getBody()->write(json_encode(['error' => 'Falta indicar el identificador']));
            return $response->withStatus(400)->withHeader('Content-Type', 'application/json');
        }

        $reminderServ = new ReminderService();
        $result = $reminderServ->getReminderByPk($pk); 

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

    public function getReminderByUser(Request $request, Response $response): Response
    {
        $params = $request->getQueryParams();
        $pk = $params['id'] ?? null; // pk del family_group

        if (!$pk) {
            $response->getBody()->write(json_encode(['error' => 'Falta indicar el usuario']));
            return $response->withStatus(400)->withHeader('Content-Type', 'application/json');
        }

        $reminderServ = new ReminderService();
        $result = $reminderServ->getReminderByUser($pk); 

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
    public function postReminder(Request $request, Response $response){
        $body = (array)$request->getParsedBody();
        
        $reminderServ = new ReminderService();

        $result = $reminderServ->addReminder($body);

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
