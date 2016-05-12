<?php

namespace spec\Evaneos\JWT\JWTRetrieval;

use Evaneos\JWT\JWTRetrieval\JWTNotFoundException;
use Evaneos\JWT\JWTRetrieval\JWTRetrievalStrategyInterface;
use PhpSpec\ObjectBehavior;
use Symfony\Component\HttpFoundation\Request;

class ChainStrategySpec extends ObjectBehavior
{
    function let(
        JWTRetrievalStrategyInterface $strategy1,
        JWTRetrievalStrategyInterface $strategy2,
        JWTRetrievalStrategyInterface $strategy3
    ) {
        $this->beConstructedWith([$strategy1, $strategy2, $strategy3]);
    }

    function it_is_initializable()
    {
        $this->shouldHaveType('Evaneos\JWT\JWTRetrieval\ChainStrategy');
    }

    function it_implements_JWTRetrievalStrategyInterface()
    {
        $this->shouldImplement(JWTRetrievalStrategyInterface::class);
    }

    public function it_should_return_the_token_found_in_the_first_valid_strategy(
        JWTRetrievalStrategyInterface $strategy1,
        JWTRetrievalStrategyInterface $strategy2,
        JWTRetrievalStrategyInterface $strategy3
    ) {
        $request = new Request();

        $strategy1->getToken($request)->shouldBeCalled()->willThrow(JWTNotFoundException::class);
        $strategy2->getToken($request)->shouldBeCalled()->willReturn('JWTToken');
        $strategy3->getToken($request)->shouldNotBeCalled();

        $this->getToken($request)->shouldReturn('JWTToken');
    }

    public function it_should_throw_a_JWTNotFoundException_if_no_token_is_found(
        JWTRetrievalStrategyInterface $strategy1,
        JWTRetrievalStrategyInterface $strategy2,
        JWTRetrievalStrategyInterface $strategy3
    ) {
        $request = new Request();

        $strategy1->getToken($request)->shouldBeCalled()->willThrow(JWTNotFoundException::class);
        $strategy2->getToken($request)->shouldBeCalled()->willThrow(JWTNotFoundException::class);
        $strategy3->getToken($request)->shouldBeCalled()->willThrow(JWTNotFoundException::class);

        $this->shouldThrow(JWTNotFoundException::class)->duringGetToken($request);
    }
}
