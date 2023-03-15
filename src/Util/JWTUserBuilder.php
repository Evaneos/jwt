<?php

namespace Evaneos\JWT\Util;

use Evaneos\Security\User;

class JWTUserBuilder
{
    private JWTDecoder $decoder;
    private JWTEncoder $encoder;
    private SecurityUserConverter $converter;

    public function __construct(
        JWTDecoder            $decoder,
        JWTEncoder            $encoder,
        SecurityUserConverter $converter
    ) {
        $this->decoder = $decoder;
        $this->encoder = $encoder;
        $this->converter = $converter;
    }

    /**
     * @throws JWTDecodeUnexpectedValueException
     */
    public function buildUserFromToken(string $token): User
    {
        return $this->converter->buildUserFromToken($this->decoder->decode($token));
    }

    public function buildTokenFromUser(User $user): string
    {
        return $this->encoder->encode($this->converter->buildTokenFromUser($user));
    }
}
