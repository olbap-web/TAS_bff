<?php

namespace App\Controllers;

use Psr\Http\Message\ResponseInterface as Response;
use Psr\Http\Message\ServerRequestInterface as Request;

use App\Service\FamilyGroupService;

class FamilyGroupController
{
    
    public function getFamilyGroupByPersona(Request $request, Response $response): Response
    {
        $params = $request->getQueryParams();
        $pk = $params['id'] ?? null; // pk de la persona

        if (!$pk) {
            $response->getBody()->write(json_encode(['error' => 'Falta indicar el identificador de la persona']));
            return $response->withStatus(400)->withHeader('Content-Type', 'application/json');
        }

        $FGservice = new FamilyGroupService();
        $result = $FGservice->getFamilyGroupByPersona($pk); 

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
    public function getMembersByFamilyGroup(Request $request, Response $response): Response
    {
        $params = $request->getQueryParams();
        $pk = $params['id'] ?? null; // pk de la persona

        if (!$pk) {
            $response->getBody()->write(json_encode(['error' => 'Falta indicar el identificador de la persona']));
            return $response->withStatus(400)->withHeader('Content-Type', 'application/json');
        }

        $FGservice = new FamilyGroupService();
        $result = $FGservice->getMembers($pk); 

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
    public function postFamilyGroup(Request $request, Response $response): Response
    {
        $body = (array)$request->getParsedBody();

        $FGservice = new FamilyGroupService();

        $result = $FGservice->addFamilyGroup($body);

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
    }#

    // public function deactivateFromFamilyGroup(Request $request, Response $response): Response
    // {
    //     $body = (array)$request->getParsedBody();

    //     $FGservice = new FamilyGroupService();

    //     $result = $FGservice->addFamilyGroup($body);

    //    if(isset($result['status'])){
    //         if($result['status'] !=200){
    //             $response->getBody()->write(json_encode([
    //                 "message"=>$result['message'],
    //                 "error"=>true,
    //             ]));
    //             return $response->withStatus(400)->withHeader('Content-Type', 'application/json');
    //         }
    //     }

    //     $response->getBody()->write(json_encode($result));
    //     return $response->withHeader('Content-Type', 'application/json');
    // }

}
