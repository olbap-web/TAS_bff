<?php

namespace App\Controllers;

use Psr\Http\Message\ResponseInterface as Response;
use Psr\Http\Message\ServerRequestInterface as Request;

class UserController
{
    public function getUser(Request $request, Response $response): Response
{
    $user = $request->getAttribute('user');

    $data = [
        'uid' => $user->user_id,
        'email' => $user->email ?? null,
        'firebase' => true
    ];

    $response->getBody()->write(json_encode($data));
    return $response->withHeader('Content-Type', 'application/json');
}

    public function login(Request $request, Response $response): Response
    {
        $params = (array)$request->getParsedBody();

        $email = $params['email'] ?? '';
        $password = $params['password'] ?? '';

        // Simulación login (reemplazar por lógica real)
        if ($email === 'pablo@example.com' && $password === '123456') {
            $response->getBody()->write(json_encode(['token' => 'fake-jwt-token']));
        } else {
            $response->getBody()->write(json_encode(['error' => 'Credenciales inválidas']));
            return $response->withStatus(401)->withHeader('Content-Type', 'application/json');
        }

        return $response->withHeader('Content-Type', 'application/json');
    }
}
