<?php

namespace Evaneos\JWT\JWTRetrieval;

use Symfony\Component\HttpFoundation\Request;

class ChainStrategy implements JWTRetrievalStrategyInterface
{
    /**
     * @var JWTRetrievalStrategyInterface[]
     */
    private $strategies;

    /**
     * ChainStrategy constructor.
     *
     * @param JWTRetrievalStrategyInterface[] $strategies
     */
    public function __construct(array $strategies)
    {
        $this->strategies = $strategies;
    }

    /**
     * {@inheritdoc}
     */
    public function getToken(Request $request)
    {
        foreach ($this->strategies as $strategy) {
            try {
                $token = $strategy->getToken($request);

                return $token;
            } catch (JWTNotFoundException $e) {
            }
        }

        throw new JWTNotFoundException();
    }
}
