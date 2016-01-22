<?php

namespace Evaneos\JWT;

class UserId
{
    /**
     * @var mixed
     */
    private $id;

    /**
     * Constructor.
     *
     * @param mixed $id
     */
    public function __construct($id)
    {
        $this->id = $id;
    }

    /**
     * @return string
     */
    public function __toString()
    {
        return (string) $this->id;
    }

    /**
     * @return mixed
     */
    public function id()
    {
        return $this->id;
    }
}
