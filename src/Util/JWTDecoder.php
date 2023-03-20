<?php

namespace Evaneos\JWT\Util;

use Firebase\JWT\JWT;
use Firebase\JWT\Key;
use stdClass;
use UnexpectedValueException;

class JWTDecoder
{
    /**
     * @var Key|array<string,Key>
     */
    private $keyOrKeyArray;

    public function __construct(string $secretKey, array $allowedAlgorithms = [])
    {
        if (count($allowedAlgorithms) === 1) {
            $this->keyOrKeyArray = new Key($secretKey, array_pop($allowedAlgorithms));
        } else {
            $this->keyOrKeyArray = [];
            foreach ($allowedAlgorithms as $kid => $algorithm) {
                $this->keyOrKeyArray[$kid] = new Key($secretKey, $algorithm);
            }
        }
    }

    /**
     * @throws JWTDecodeUnexpectedValueException
     */
    public function decode(string $encodedToken): stdClass
    {
        try {
            return JWT::decode($encodedToken, $this->keyOrKeyArray);
        } catch (UnexpectedValueException $e) {
            throw new JWTDecodeUnexpectedValueException('JWT can not be decoded.', 0, $e);
        }
    }
}
