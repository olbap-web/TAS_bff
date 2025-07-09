<?php

namespace App\Middleware;

use Firebase\JWT\JWT;
use Firebase\JWT\JWK;
use GuzzleHttp\Client;
use Psr\Http\Message\ServerRequestInterface as Request;
use Psr\Http\Server\RequestHandlerInterface;
use Psr\Http\Message\ResponseInterface;
use Slim\Psr7\Response as SlimResponse;

class FirebaseAuthMiddleware
{
    private string $firebaseProjectId = 'vetcompanion-13da4'; 

    public function __invoke(Request $request, RequestHandlerInterface $handler): ResponseInterface
    {
        $authHeader = $request->getHeaderLine('Authorization');

        if (!$authHeader || !str_starts_with($authHeader, 'Bearer ')) {
            return $this->unauthorized('Falta token Authorization');
        }

        $token = str_replace('Bearer ', '', $authHeader);

        try {
            $decoded = $this->verifyToken($token);
            return $handler->handle($request->withAttribute('email', $decoded));
        } catch (\Exception $e) {
            return $this->unauthorized($e->getMessage());
        }
    }

    private function verifyToken(string $idToken)
    {
        $client = new Client();
        $res = $client->get('https://www.googleapis.com/service_accounts/v1/jwk/securetoken@system.gserviceaccount.com');
        $keys = json_decode(json_encode(json_decode((string)$res->getBody(), true)), true);

        $decoded = JWT::decode($idToken, JWK::parseKeySet($keys));

        if ($decoded->aud !== $this->firebaseProjectId) {
            throw new \Exception('Audiencia inválida');
        }

        if ($decoded->iss !== "https://securetoken.google.com/{$this->firebaseProjectId}") {
            throw new \Exception('Issuer inválido');
        }

        return $decoded;
    }

    private function unauthorized(string $message): ResponseInterface
    {
        $res = new SlimResponse();
        $res->getBody()->write(json_encode(['error' => 'Unauthorized', 'message' => $message]));
        return $res->withStatus(401)->withHeader('Content-Type', 'application/json');
    }
}
