<?php

namespace App\RequestObject;

use MccApiTools\RequestObjectBundle\Model\RequestableInterface;
use Symfony\Component\Validator\Constraints as Assert;

class RequestUpdateClassRoomActive implements RequestableInterface
{

    /**
     * @Assert\NotNull()
     */
    public bool $isActive;
}
