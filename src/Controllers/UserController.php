<?php

namespace App\Controllers;

use Psr\Http\Message\ResponseInterface as Response;
use Psr\Http\Message\ServerRequestInterface as Request;

use App\Services\UserService;

class UserController
{
    public function getUser(Request $request, Response $response): Response
    {
        $params = $request->getQueryParams();
        $rut = $params['rut'] ?? null;
        $dv = $params['dv'] ?? null;

        if (!$rut || !$dv) {
            $response->getBody()->write(json_encode(['error' => 'Faltan parámetros rut o dv']));
            return $response->withStatus(400)->withHeader('Content-Type', 'application/json');
        }

        $userFn = new UserService();
        $result = $userFn->getUserByRut($rut, $dv);

        $response->getBody()->write(json_encode($result));
        return $response->withHeader('Content-Type', 'application/json');
    }
    public function getUserByEmail(Request $request, Response $response): Response
    {
        $params = $request->getQueryParams();
        $rut = $params['email'] ?? null;

        if (!$rut ) {
            $response->getBody()->write(json_encode(['error' => 'Falta indicar el email']));
            return $response->withStatus(400)->withHeader('Content-Type', 'application/json');
        }

        $userFn = new UserService();
        $result = $userFn->getPersonaByEmail($email);

        $response->getBody()->write(json_encode($result));
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
