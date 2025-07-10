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
        $email = $params['fg'] ?? null; // pk del family_group

        if (!$email) {
            $response->getBody()->write(json_encode(['error' => 'Falta indicar el email']));
            return $response->withStatus(400)->withHeader('Content-Type', 'application/json');
        }

        $userFn = new ReminderService();
        $result = $userFn->getPersonaByEmail($email); 

        if($result['status'] !=200){
            $response->getBody()->write(json_encode([
                "message"=>$result['message'],
                "error"=>true,
            ]));
            return $response->withStatus(400)->withHeader('Content-Type', 'application/json');
        }

        $response->getBody()->write(json_encode($result));
        return $response->withHeader('Content-Type', 'application/json');
    }

  

}
