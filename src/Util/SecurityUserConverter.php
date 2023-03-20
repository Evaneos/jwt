<?php

namespace Evaneos\JWT\Util;

use Evaneos\Security\User;
use Evaneos\Security\UserId;
use stdClass;

class SecurityUserConverter
{
    public function buildUserFromToken(stdClass $token): User
    {
        return new User(new UserId($token->sub));
    }

    public function buildTokenFromUser(User $user): array
    {
        return ['sub' => (string) $user->id()];
    }
}
