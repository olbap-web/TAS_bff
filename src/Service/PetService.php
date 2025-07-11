<?php

namespace App\Service;


class FamilyGroupService
{
    private string $baseUrl = 'https://pet-fn-218357869562.southamerica-west1.run.app';

    public function __construct()
    {
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
}
