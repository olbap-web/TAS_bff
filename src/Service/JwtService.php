<?php

namespace App\Services;

use Firebase\JWT\JWT;
use Firebase\JWT\Key;

class JwtService
{
    private string $secret;

    public function __construct()
    {
        $this->secret = 'super_secret_key'; 
    }

    public function generate(array $payload): string
    {
        $payload['iat'] = time();
        $payload['exp'] = time() + (60 * 60); // 1 hora
        return JWT::encode($payload, $this->secret, 'HS256');
    }

    public function verify(string $token): ?object
    {
        try {
            return JWT::decode($token, new Key($this->secret, 'HS256'));
        } catch (\Exception $e) {
            return null;
        }
    }
}
