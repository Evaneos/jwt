<?php

namespace Evaneos\JWT\Util;

use Evaneos\JWT\User;
use Evaneos\JWT\UserId;

class SecurityUserConverter implements UserConverter
{
    /**
     * (non-PHPdoc).
     *
     * @see \Evaneos\JWT\Util\UserConverter::buildUserFromToken()
     */
    public function buildUserFromToken($token)
    {
        return new User(new UserId($token->sub));
    }
    
    /**
     * (non-PHPdoc).
     *
     * @see \Evaneos\JWT\Util\UserConverter::buildTokenFromUser()
     */
    public function buildTokenFromUser(User $user)
    {
        return array('sub' => (string) $user->id());
    }
}
