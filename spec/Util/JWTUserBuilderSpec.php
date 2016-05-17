<?php

namespace spec\Evaneos\JWT\Util;

use Evaneos\JWT\Util\JWTDecoder;
use Evaneos\JWT\Util\JWTEncoder;
use Evaneos\JWT\Util\JWTUserBuilder;
use Evaneos\JWT\Util\SecurityUserConverter;
use Evaneos\Security\User;
use PhpSpec\ObjectBehavior;
use Prophecy\Argument;

class JWTUserBuilderSpec extends ObjectBehavior
{
    function let(
        JWTDecoder $decoder,
        JWTEncoder $encoder,
        SecurityUserConverter $converter
    ) {
        $this->beConstructedWith($decoder, $encoder, $converter);
    }

    function it_is_initializable()
    {
        $this->shouldHaveType(JWTUserBuilder::class);
    }

    function it_throws_the_decoder_exception(JWTDecoder $decoder)
    {
        $decoder->decode('qwerty')->shouldBeCalled()->willThrow(\Exception::class);

        $this->shouldThrow(\Exception::class)->duringBuildUserFromToken('qwerty');
    }

    function it_should_return_user_from_converter(JWTDecoder $decoder, SecurityUserConverter $converter, User $user)
    {
        $token = new \stdClass();

        $decoder->decode('qwerty')->shouldBeCalled()->willReturn($token);

        $converter->buildUserFromToken($token)->shouldBeCalled()->willReturn($user);

        $this->buildUserFromToken('qwerty')->shouldBe($user);
    }
}
