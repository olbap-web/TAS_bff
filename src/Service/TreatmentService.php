<?php

namespace App\Service;

use GuzzleHttp\Client;

class TreatmentService
{
    private string $baseUrl = 'https://treatment-fn-218357869562.southamerica-west1.run.app';
    private Client $client;
    public function __construct()
    {
                $this->client = new Client();
    }


    public function getTreatmentByPk(int $pk): ?array
    {
        $response = $this->client->request('GET', $this->baseUrl, [
            'query' => [
                'id' => $pk,
            ],
            'timeout' => 5.0
        ]);

        if($response->getStatusCode() != 200){
            return [
                'status'=>$response->getStatusCode(),
                'message' => $response->getBody(),
            ];
        }

        $body = $response->getBody()->getContents();
        return json_decode($body, true);
    }
    public function getDocumentsByTreatment(int $pk): ?array
    {
        $response = $this->client->request('GET', $this->baseUrl, [
            'query' => [
                'id' => $pk,
                "documento"=>true,
            ],
            'timeout' => 5.0
        ]);

        if($response->getStatusCode() != 200){
            return [
                'status'=>$response->getStatusCode(),
                'message' => $response->getBody(),
            ];
        }

        $body = $response->getBody()->getContents();
        return json_decode($body, true);
    }
    public function getMedicinesByTreatment(int $pk): ?array
    {
        $response = $this->client->request('GET', $this->baseUrl, [
            'query' => [
                'id' => $pk,
                "medicamento"=>true,
            ],
            'timeout' => 5.0
        ]);

        if($response->getStatusCode() != 200){
            return [
                'status'=>$response->getStatusCode(),
                'message' => $response->getBody(),
            ];
        }

        $body = $response->getBody()->getContents();
        return json_decode($body, true);
    }
    public function getTreatmentsByPet(int $pk): ?array
    {
        $response = $this->client->request('GET', $this->baseUrl, [
            'query' => [
                'id' => $pk,
                "mascota"=>true,
            ],
            'timeout' => 5.0
        ]);

        if($response->getStatusCode() != 200){
            return [
                'status'=>$response->getStatusCode(),
                'message' => $response->getBody(),
            ];
        }

        $body = $response->getBody()->getContents();
        return json_decode($body, true);
    }
    




    #ADD
    public function addTreatment(array $insert): ?array{
        $response = $this->client->request('POST', $this->baseUrl, [
            'json' => $insert, 
            'timeout' => 5.0
        ]);

        if ($response->getStatusCode() !== 200) {
            return [
                'status' => $response->getStatusCode(),
                'message' => $response->getBody()->getContents(),
            ];
        }

        $body = $response->getBody()->getContents();
        return json_decode($body, true);
    }

}
