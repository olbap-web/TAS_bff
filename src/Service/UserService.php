<?php

namespace App\Service;

use GuzzleHttp\Client;

class UserService
{
    private Client $client;
    private string $baseUrl = 'https://user-fn-218357869562.us-east1.run.app';

    public function __construct()
    {
        $this->client = new Client();
    }

    // public function getUserByRut(string $rut, string $dv): ?array
    // {
    //     try {
    //         $response = $this->client->request('GET', $this->baseUrl, [
    //             'query' => [
    //                 'rut' => $rut,
    //                 'dv' => $dv
    //             ],
    //             'timeout' => 5.0
    //         ]);

    //         $body = $response->getBody()->getContents();
    //         return json_decode($body, true);

    //     } catch (\Exception $e) {
    //         return ['error' => 'No se pudo contactar con user-fn', 'message' => $e->getMessage()];
    //     }
    // }
    public function getPersonaByEmail(string $email): ?array
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
}
