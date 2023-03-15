<?php

namespace Evaneos\JWT\Util;

use Firebase\JWT\JWT;

class JWTDecoder
{
    /**
     * @var string
     */
    private $secretKey;

    /**
     * @var array
     */
    private $allowedAlgorithms;

    /**
     * Constructor.
     *
     * @param string $secretKey
     * @param array  $allowedAlgorithms
     */
    public function __construct($secretKey, array $allowedAlgorithms = array())
    {
        $this->secretKey = $secretKey;
        $this->allowedAlgorithms = $allowedAlgorithms;
    }

    /**
     * @param string $encodedToken
     *
     * @return object
     *
     * @throws JWTDecodeUnexpectedValueException
     */
    public function decode($encodedToken)
    {
        try {
            return JWT::decode($encodedToken, new Key($this->secretKey, $this->allowedAlgorithms) );
        } catch (\UnexpectedValueException $e) {
            throw new JWTDecodeUnexpectedValueException('JWT can not be decoded.', 0, $e);
        }
    }
}
