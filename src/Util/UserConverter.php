<?php

namespace Evaneos\JWT\Util;

use Evaneos\JWT\User;

interface UserConverter
{
    /**
     * @param array|object $token
     *
     * @return User
     */
    public function buildUserFromToken($token);
    
    /**
     * @param User $user
     * 
     * @return array|object
     */
    public function buildTokenFromUser(User $user);
}
