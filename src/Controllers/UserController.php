<?php

namespace App\Controllers;

use Psr\Http\Message\ResponseInterface as Response;
use Psr\Http\Message\ServerRequestInterface as Request;

use App\Service\UserService;

class UserController
{
    public function getUserByRut(Request $request, Response $response): Response
    {
        $params = $request->getQueryParams();
        $aux = isset($params['rut']) && strlen(trim($params['rut']))>0? trim($params['rut']) : null;
        
        if (!$aux) {
            $response->getBody()->write(json_encode(['error' => 'Falta indicar el rut']));
            return $response->withStatus(400)->withHeader('Content-Type', 'application/json');
        }

        $rut = explode('-',$aux)[0];
        $dv = explode('-',$aux)[1];


        $userFn = new UserService();
        $result = $userFn->getUserByRut($rut, $dv);

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

    public function postUser(Request $request, Response $response){
        $body = (array)$request->getParsedBody();
        
        $usrService = new UserService();

        
        /**
         * Antes de agregar deberiamos preguntar si existe rut ?
         * aunque puedo hacer las consultas y manejar todo ese flujo desde la app flutter
        */

        // print_r($body);

        $result = $usrService->addUser($body);

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
