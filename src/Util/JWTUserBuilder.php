<?php

namespace Evaneos\JWT\Util;

use Evaneos\JWT\User;
use Evaneos\JWT\UserId;

class JWTUserBuilder
{
    /**
     * @var JWTDecoder
     */
    private $decoder;
    
    /**
     * @var JWTEncoder
     */
    private $encoder;
    
    /**
     * @var UserConverter
     */
    private $converter;
    
    /**
     * Constructor.
     *
     * @param JWTDecoder    $decoder
     * @param JWTEncoder    $encoder
     * @param UserConverter $converter
     */
    public function __construct(
        JWTDecoder $decoder,
        JWTEncoder $encoder,
        UserConverter $converter
    ) {
        $this->decoder = $decoder;
        $this->encoder = $encoder;
        $this->converter = $converter;
    }
    
    /**
     * @param  string $token
     * @return User
     */
    public function buildUserFromToken($token)
    {
        return $this->converter->buildUserFromToken($this->decoder->decode($token));
    }
    
    /**
     * @param  User $user
     * @return string
     */
    public function buildTokenFromUser(User $user)
    {
        return $this->encoder->encode($this->converter->buildTokenFromUser($user));
    }
}
