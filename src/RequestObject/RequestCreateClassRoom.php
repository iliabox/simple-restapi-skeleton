<?php

namespace App\RequestObject;

use MccApiTools\RequestObjectBundle\Model\RequestObjectInterface;
use Symfony\Component\Validator\Constraints as Assert;

class RequestCreateClassRoom implements RequestObjectInterface
{
    /**
     * @Assert\NotBlank()
     * @Assert\Length(max=63)
     */
    public string $name;
}
