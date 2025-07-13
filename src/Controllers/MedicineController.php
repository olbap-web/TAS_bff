<?php

namespace App\Controllers;

use Psr\Http\Message\ResponseInterface as Response;
use Psr\Http\Message\ServerRequestInterface as Request;

use App\Service\MedicineService;

class MedicineController
{
    
    public function getMedicineNotTreatment(Request $request, Response $response): Response
    {
        $params = $request->getQueryParams();
        $pk = $params['id'] ?? null; // pk de la persona

        if (!$pk) {
            $response->getBody()->write(json_encode(['error' => 'Falta indicar el identificador del tratamiento']));
            return $response->withStatus(400)->withHeader('Content-Type', 'application/json');
        }

        $medService = new MedicineService();
        $result = $medService->getMedicineNotTreatment($pk); 

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

    
    public function postMedicine(Request $request, Response $response): Response
    {
        $body = (array)$request->getParsedBody();
        
     
        $medService = new MedicineService();

        $result = $medService->addPet($body);

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
