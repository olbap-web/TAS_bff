<?php

namespace App\Service;

use GuzzleHttp\Client;

class MedicineService
{
    private string $baseUrl = 'https://medicine-fn-218357869562.southamerica-west1.run.app';
    private Client $client;
    public function __construct()
    {
                $this->client = new Client();
    }


    public function getMedicineNotTreatment(int $pk): ?array
    {
        $response = $this->client->request('GET', $this->baseUrl, [
            'query' => [
                'id' => $pk,
                'not_tratamiento'=>1

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

    public function getPetByPk(int $pk): ?array
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

        $body = $response->getBody()->getContents();
        return json_decode($body, true);
    }

}

/**
 * <b>Fatal error</b>: Uncaught TypeError: json_decode(): Argument #1 ($json) must be of type string, array given in
 * /app/src/Service/PetService.php:50
 * Stack trace:
 * #0 /app/src/Service/PetService.php(50): json_decode(Array, true)
 * #1 /app/src/Controllers/PetController.php(55): App\Service\PetService-&gt;addPet(Array)
*/
