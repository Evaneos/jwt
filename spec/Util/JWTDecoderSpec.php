<?php

namespace spec\Evaneos\JWT\Util;

use Evaneos\JWT\Util\JWTDecodeUnexpectedValueException;
use Firebase\JWT\JWT;
use PhpSpec\ObjectBehavior;
use Prophecy\Argument;

class JWTDecoderSpec extends ObjectBehavior
{
    function let()
    {
        $this->beConstructedWith("secret", ["HS256"]);
    }

    function it_is_initializable()
    {
        $this->shouldHaveType('\Evaneos\JWT\Util\JWTDecoder');
    }

    function it_decodes_JWTToken()
    {
        $decodedToken = new \stdClass();
        $decodedToken->sub = '1234567890';
        $decodedToken->name = "John Doe";

        $jwtToken = JWT::encode($decodedToken, 'secret');

        $this->decode($jwtToken)->shouldBeLike($decodedToken);
    }

    function it_throws_a_JWTDecodeUnexpectedValueException_if_there_is_an_UnexpectedValueException()
    {
        $decodedToken = new \stdClass();
        $decodedToken->sub = '1234567890';
        $decodedToken->name = "John Doe";

        $jwtToken = JWT::encode($decodedToken, 'different_secret_key');

        $this->shouldThrow(JWTDecodeUnexpectedValueException::class)->during('decode', [$jwtToken]);
    }

    function it_throws_an_Exception_if_algorithm_is_not_allowed()
    {
        $decodedToken = new \stdClass();
        $decodedToken->sub = '1234567890';
        $decodedToken->name = "John Doe";

        $jwtToken = JWT::encode($decodedToken, 'secret', 'HS384');

        $this->shouldThrow(\Exception::class)->during('decode', [$jwtToken]);
    }

    function it_can_use_a_different_secretKey()
    {
        $this->beConstructedWith("poney", ["HS256"]);

        $decodedToken = new \stdClass();
        $decodedToken->sub = '1234567890';
        $decodedToken->name = "John Doe";

        $jwtToken = JWT::encode($decodedToken, 'poney');

        $this->decode($jwtToken)->shouldBeLike($decodedToken);
    }

    function it_can_allow_different_algorithms()
    {
        $this->beConstructedWith("secret", ["HS256", "HS384"]);

        $decodedToken = new \stdClass();
        $decodedToken->sub = '1234567890';
        $decodedToken->name = "John Doe";

        $jwtToken = JWT::encode($decodedToken, 'secret', 'HS384');

        $this->decode($jwtToken)->shouldBeLike($decodedToken);
    }
}
