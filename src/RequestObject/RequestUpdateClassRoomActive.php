<?php

namespace App\RequestObject;

use MccApiTools\RequestObjectBundle\Model\RequestableInterface;
use Symfony\Component\Validator\Constraints;

class RequestUpdateClassRoomActive implements RequestableInterface
{

    /**
     * @var bool
     *
     * @Constraints\NotNull()
     * @Constraints\Type(type="boolean")
     */
    public $isActive;
}
