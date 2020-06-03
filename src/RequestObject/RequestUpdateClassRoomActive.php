<?php

namespace App\RequestObject;

use MccApiTools\RequestObjectBundle\Model\RequestObjectInterface;
use Symfony\Component\Validator\Constraints as Assert;

class RequestUpdateClassRoomActive implements RequestObjectInterface
{

    /**
     * @Assert\NotNull()
     */
    public bool $isActive;
}
