<?php

namespace App\Service;

use GuzzleHttp\Client;

class ReminderService
{
    private Client $client;
    private string $baseUrl = 'https://reminder-fn-218357869562.southamerica-west1.run.app';

    public function __construct()
    {
        $this->client = new Client();
    }


    public function getReminderByFG(string $email): ?array
    {
        $response = $this->client->request('GET', $this->baseUrl, [
            'query' => [
                'email' => $email,
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
    public function getReminderByPet(string $email): ?array
    {
        $response = $this->client->request('GET', $this->baseUrl, [
            'query' => [
                'pet' => $email,
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
}
