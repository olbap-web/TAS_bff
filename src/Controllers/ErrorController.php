<?php

namespace App\Controllers;

use Psr\Http\Message\ResponseInterface as Response;
use Psr\Http\Message\ServerRequestInterface as Request;

class ErrorController
{
    public function notAuth(Request $request, Response $response): Response
    {
        $result = [
            "error"=> "Unauthorized",
            "code"=>401,
            "message"=>"Must be authenticated to access."
        ];
        $response->getBody()->write(json_encode($result));
        return $response->withHeader('Content-Type', 'application/json');
    }
    
}
