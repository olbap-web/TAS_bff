<?php

namespace App\Service;
use GuzzleHttp\Client;


class MedicalCtrlService
{
    private string $baseUrl = 'https://medical-ctrl-218357869562.southamerica-west1.run.app';
    private Client $client;
    public function __construct()
    {
                $this->client = new Client();
    }

    public function getMedicalCtrlByPk(int $pk): ?array
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
    public function getMedicalCtrlByPet(int $pk): ?array
    {
        $response = $this->client->request('GET', $this->baseUrl, [
            'query' => [
                'mascota'=>true,
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
    public function addMedicalCtrl(array $insert): ?array{
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
