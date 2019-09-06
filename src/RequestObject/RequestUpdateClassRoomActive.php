<?php

namespace App\RequestObject;

use Symfony\Component\Validator\Constraints;

class RequestUpdateClassRoomActive implements RequestObjectInterface
{

    /**
     * @var bool
     *
     * @Constraints\NotNull()
     * @Constraints\Type(type="boolean")
     */
    public $isActive;
}
