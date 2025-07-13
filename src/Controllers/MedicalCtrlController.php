<?php

namespace App\Controllers;

use Psr\Http\Message\ResponseInterface as Response;
use Psr\Http\Message\ServerRequestInterface as Request;

use App\Service\MedicalCtrlService;

class MedicalCtrlController
{
    public function getMedicalCtrlByPk(Request $request, Response $response): Response
    {
        $params = $request->getQueryParams();
        $pk = $params['id'] ?? null; // pk de la persona

        if (!$pk) {
            $response->getBody()->write(json_encode(['error' => 'Falta indicar el identificador de la persona']));
            return $response->withStatus(400)->withHeader('Content-Type', 'application/json');
        }

        $FGservice = new MedicalCtrlService();
        $result = $FGservice->getMedicalCtrlByPk($pk); 

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
    public function getMedicalCtrlByPet(Request $request, Response $response): Response
    {
        $params = $request->getQueryParams();
        $pk = $params['id'] ?? null; // pk de la persona

        if (!$pk) {
            $response->getBody()->write(json_encode(['error' => 'Falta indicar el identificador de la persona']));
            return $response->withStatus(400)->withHeader('Content-Type', 'application/json');
        }

        $FGservice = new MedicalCtrlService();
        $result = $FGservice->getMedicalCtrlByPet($pk); 

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
    public function postMedicalCtrl(Request $request, Response $response): Response
    {
        $body = (array)$request->getParsedBody();

        $MCService = new MedicalCtrlService();

        $result = $MCService->addMedicalCtrl($body);

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
