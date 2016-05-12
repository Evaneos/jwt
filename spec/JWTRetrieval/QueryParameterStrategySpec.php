<?php

namespace spec\Evaneos\JWT\JWTRetrieval;

use Evaneos\JWT\JWTRetrieval\JWTNotFoundException;
use Evaneos\JWT\JWTRetrieval\JWTRetrievalStrategyInterface;
use PhpSpec\ObjectBehavior;
use Symfony\Component\HttpFoundation\Request;

class QueryParameterStrategySpec extends ObjectBehavior
{
    function let()
    {
        $this->beConstructedWith('jwt');
    }

    function it_is_initializable()
    {
        $this->shouldHaveType('Evaneos\JWT\JWTRetrieval\QueryParameterStrategy');
    }

    function it_implements_JWTRetrievalStrategyInterface()
    {
        $this->shouldImplement(JWTRetrievalStrategyInterface::class);
    }

    public function it_should_return_the_query_parameter_value()
    {
        $request = new Request();
        $request->query->set('jwt', 'JWTToken');

        $this->getToken($request)->shouldReturn('JWTToken');
    }

    public function it_should_throw_a_JWTNotFoundException_if_no_token_is_found()
    {
        $request = new Request();

        $this->shouldThrow(JWTNotFoundException::class)->duringGetToken($request);
    }
}
