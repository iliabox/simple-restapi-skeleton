<?php

namespace App\RequestObject;

use MccApiTools\RequestObjectBundle\Model\RequestableInterface;
use Symfony\Component\Validator\Constraints as Assert;

class RequestCreateClassRoom implements RequestableInterface
{
    /**
     * @Assert\NotBlank()
     * @Assert\Length(max=63)
     */
    public string $name;
}
