<?php

namespace App\Service;

use GuzzleHttp\Client;

class PetService
{
    private string $baseUrl = 'https://pet-fn-218357869562.southamerica-west1.run.app';
    private Client $client;
    public function __construct()
    {
                $this->client = new Client();
    }


    public function getPetsByFamilyGroup(int $pk): ?array
    {
        $response = $this->client->request('GET', $this->baseUrl, [
            'query' => [
                'gf' => $pk,
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

    public function addPet(array $insert): ?array{
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

        return json_decode(["id"=>$response->getBody()->getContents()], true);

      
    }

}
