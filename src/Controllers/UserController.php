<?php

namespace App\Controllers;

use Psr\Http\Message\ResponseInterface as Response;
use Psr\Http\Message\ServerRequestInterface as Request;

use App\Service\UserService;

class UserController
{
    public function getUser(Request $request, Response $response): Response
    {
        $params = $request->getQueryParams();
        $rut = $params['rut'] ?? null;
        $dv = $params['dv'] ?? null;

        if (!$rut || !$dv) {
            $response->getBody()->write(json_encode(['error' => 'Faltan parámetros rut o dv']));
            return $response->withStatus(400)->withHeader('Content-Type', 'application/json');
        }

        $userFn = new UserService();
        $result = $userFn->getUserByRut($rut, $dv);

        $response->getBody()->write(json_encode($result));
        return $response->withHeader('Content-Type', 'application/json');
    }
    public function getUserByEmail(Request $request, Response $response): Response
    {
        $params = $request->getQueryParams();
        $email = $params['email'] ?? null;

        if (!$email) {
            $response->getBody()->write(json_encode(['error' => 'Falta indicar el email']));
            return $response->withStatus(400)->withHeader('Content-Type', 'application/json');
        }

        $userFn = new UserService();
        $result = $userFn->getPersonaByEmail($email); 

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
