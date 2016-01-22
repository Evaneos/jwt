<?php

namespace Evaneos\JWT\Util;

use Firebase\JWT\JWT;

class JWTEncoder
{
    /**
     * @var string
     */
    private $secretKey;

    /**
     * @var string
     */
    private $algorithm;

    /**
     * Constructor.
     *
     * @param string $secretKey
     * @param string $algorithm
     */
    public function __construct($secretKey, $algorithm = 'HS256')
    {
        $this->secretKey = $secretKey;
        $this->algorithm = $algorithm;
    }

    /**
     * @param mixed $payload
     *
     * @return object
     */
    public function encode($payload)
    {
        return JWT::encode($payload, $this->secretKey, $this->algorithm);
    }
}

