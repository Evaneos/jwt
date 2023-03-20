<?php

namespace Evaneos\JWT\JWTRetrieval;

use Symfony\Component\HttpFoundation\Request;

class AuthorizationBearerStrategy implements JWTRetrievalStrategyInterface
{
    /**
     * {@inheritdoc}
     */
    public function getToken(Request $request): string
    {
        [$token] = sscanf($request->headers->get('Authorization'), 'Bearer %s');

        if (!$token) {
            throw new JWTNotFoundException();
        }

        return $token;
    }
}
