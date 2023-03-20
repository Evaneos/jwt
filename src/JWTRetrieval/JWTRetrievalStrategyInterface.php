<?php

namespace Evaneos\JWT\JWTRetrieval;

use Symfony\Component\HttpFoundation\Request;

interface JWTRetrievalStrategyInterface
{
    /**
     * @throws JWTNotFoundException
     */
    public function getToken(Request $request): string;
}
