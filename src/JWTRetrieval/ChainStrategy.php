<?php

namespace Evaneos\JWT\JWTRetrieval;

use Symfony\Component\HttpFoundation\Request;

class ChainStrategy implements JWTRetrievalStrategyInterface
{
    /**
     * @var JWTRetrievalStrategyInterface[]
     */
    private array $strategies;

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
    public function getToken(Request $request): string
    {
        foreach ($this->strategies as $strategy) {
            try {
                return $strategy->getToken($request);
            } catch (JWTNotFoundException $e) {
            }
        }

        throw new JWTNotFoundException();
    }
}
