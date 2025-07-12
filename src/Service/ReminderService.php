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


    public function getReminderByPk(string $pk): ?array
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
    public function getReminderByUser(string $user): ?array
    {
        $response = $this->client->request('GET', $this->baseUrl, [
            'query' => [
                'usuario' => $user,
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
    public function addReminder(array $insert): ?array{
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
