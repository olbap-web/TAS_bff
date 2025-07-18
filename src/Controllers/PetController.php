<?php

namespace App\Controllers;

use Psr\Http\Message\ResponseInterface as Response;
use Psr\Http\Message\ServerRequestInterface as Request;

use App\Service\PetService;

class PetController
{
    
    public function getPetsByFamilyGroup(Request $request, Response $response): Response
    {
        $params = $request->getQueryParams();
        $pk = $params['id'] ?? null; // pk de la persona

        if (!$pk) {
            $response->getBody()->write(json_encode(['error' => 'Falta indicar el identificador de la persona']));
            return $response->withStatus(400)->withHeader('Content-Type', 'application/json');
        }

        $petService = new PetService();
        $result = $petService->getPetsByFamilyGroup($pk); 

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

    public function getPetByPk(Request $request, Response $response): Response
    {
        $params = $request->getQueryParams();
        $pk = $params['id'] ?? null; // pk de la persona

        if (!$pk) {
            $response->getBody()->write(json_encode(['error' => 'Falta indicar el identificador de la Mascota']));
            return $response->withStatus(400)->withHeader('Content-Type', 'application/json');
        }

        $petService = new PetService();
        $result = $petService->getPetByPk($pk); 

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

    public function postPet(Request $request, Response $response): Response
    {
        $body = (array)$request->getParsedBody();
        
     
        $petService = new PetService();

        $result = $petService->addPet($body);

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
