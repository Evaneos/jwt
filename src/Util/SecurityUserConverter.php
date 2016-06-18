<?php

namespace Evaneos\JWT\Util;

use Evaneos\Security\User;
use Evaneos\Security\UserId;

class SecurityUserConverter
{
    /**
     * Build a User from a JWT token.
     *
     * @param object $token
     * @return User
     */
    public function buildUserFromToken($token)
    {
        return new User(new UserId($token->sub));
    }

    /**
     * Get the JWT token of a user.
     *
     * @param User $user
     * @return array
     */
    public function buildTokenFromUser(User $user)
    {
        return array('sub' => (string) $user->id());
    }
}
