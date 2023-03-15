<?php

namespace Evaneos\JWT\Util;

use Firebase\JWT\JWT;

class JWTEncoder
{
    private string $secretKey;

    private string $algorithm;

    public function __construct(string $secretKey, string $algorithm = 'HS256')
    {
        $this->secretKey = $secretKey;
        $this->algorithm = $algorithm;
    }

    public function encode(array $payload): string
    {
        return JWT::encode($payload, $this->secretKey, $this->algorithm);
    }
}

