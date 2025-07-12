<?php

namespace App\Controllers;

use Psr\Http\Message\ResponseInterface as Response;
use Psr\Http\Message\ServerRequestInterface as Request;

use App\Service\TreatmentService;

class TreatmentController
{
    
    public function getTreatmentByPk(Request $request, Response $response): Response
    {
        $params = $request->getQueryParams();
        $pk = $params['id'] ?? null; 

        if (!$pk) {
            $response->getBody()->write(json_encode(['error' => 'Falta indicar el identificador del tratamiento']));
            return $response->withStatus(400)->withHeader('Content-Type', 'application/json');
        }

        $treatmentService = new TreatmentService();
        $result = $petService->getTreatmentByPk($pk); 

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

    public function getDocumentsByTreatment(Request $request, Response $response): Response
    {
        $params = $request->getQueryParams();
        $pk = $params['id'] ?? null; 

        if (!$pk) {
            $response->getBody()->write(json_encode(['error' => 'Falta indicar el identificador del tratamiento']));
            return $response->withStatus(400)->withHeader('Content-Type', 'application/json');
        }

        $treatmentService = new TreatmentService();
        $result = $treatmentService->getDocumentsByTreatment($pk); 

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

    public function getMedicineByTreatment(Request $request, Response $response): Response
    {
        $params = $request->getQueryParams();
        $pk = $params['id'] ?? null; 

        if (!$pk) {
            $response->getBody()->write(json_encode(['error' => 'Falta indicar el identificador del tratamiento']));
            return $response->withStatus(400)->withHeader('Content-Type', 'application/json');
        }

        $treatmentService = new TreatmentService();
        $result = $treatmentService->getMedicinesByTreatment($pk); 

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
    public function getTreatmentsByPet(Request $request, Response $response): Response
    {
        $params = $request->getQueryParams();
        $pk = $params['id'] ?? null; 

        if (!$pk) {
            $response->getBody()->write(json_encode(['error' => 'Falta indicar el identificador del tratamiento']));
            return $response->withStatus(400)->withHeader('Content-Type', 'application/json');
        }

        $treatmentService = new TreatmentService();
        $result = $treatmentService->getTreatmentsByPet($pk); 

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

    public function postTreatment(Request $request, Response $response): Response
    {
        $body = (array)$request->getParsedBody();
        
     
        $treatmentService = new TreatmentService();

        $result = $treatmentService->addTreatment($body);

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
