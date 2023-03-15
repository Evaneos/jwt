<?php

namespace Evaneos\JWT\Util;

use Firebase\JWT\JWT;
use Firebase\JWT\Key;
use stdClass;
use UnexpectedValueException;

class JWTDecoder
{
    /**
     * @var Key[]
     */
    private array $keys = [];

    public function __construct(string $secretKey, array $allowedAlgorithms = [])
    {
        foreach ($allowedAlgorithms as $algorithm) {
            $this->keys[] = new Key($secretKey, $algorithm);
        }
    }

    /**
     * @throws JWTDecodeUnexpectedValueException
     */
    public function decode(string $encodedToken): stdClass
    {
        try {
            return JWT::decode($encodedToken, $this->keys);
        } catch (UnexpectedValueException $e) {
            throw new JWTDecodeUnexpectedValueException('JWT can not be decoded.', 0, $e);
        }
    }
}
