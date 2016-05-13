<?php

namespace Evaneos\JWT\JWTRetrieval;

use Symfony\Component\HttpFoundation\Request;

interface JWTRetrievalStrategyInterface
{
    /**
     * @param Request $request
     *
     * @return string
     *
     * @throws JWTNotFoundException
     */
    public function getToken(Request $request);
}
