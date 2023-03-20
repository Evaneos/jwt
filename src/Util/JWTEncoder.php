<?php

namespace Evaneos\JWT\Util;

use Firebase\JWT\JWT;

class JWTEncoder
{
    private string $secretKey;
    private string $algorithm;
    private ?string $kid;

    public function __construct(string $secretKey, string $algorithm = 'HS256', string $kid = null)
    {
        $this->secretKey = $secretKey;
        $this->algorithm = $algorithm;
        $this->kid = $kid;
    }

    public function encode(array $payload): string
    {
        return JWT::encode($payload, $this->secretKey, $this->algorithm, $this->kid);
    }
}

