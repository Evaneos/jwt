<?php

namespace Evaneos\JWT\JWTRetrieval;

use Symfony\Component\HttpFoundation\Request;

class QueryParameterStrategy implements JWTRetrievalStrategyInterface
{
    private string $parameterName;

    /**
     * QueryParameterStrategy constructor.
     *
     * @param string $parameterName
     */
    public function __construct(string $parameterName = 'jwt')
    {
        $this->parameterName = $parameterName;
    }

    /**
     * {@inheritdoc}
     */
    public function getToken(Request $request): string
    {
        if (null === $token = $request->query->get($this->parameterName)) {
            throw new JWTNotFoundException();
        }

        return $token;
    }
}
