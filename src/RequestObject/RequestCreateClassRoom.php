<?php

namespace App\RequestObject;

use MccApiTools\RequestObjectBundle\Model\RequestableInterface;
use Symfony\Component\Validator\Constraints;

class RequestCreateClassRoom implements RequestableInterface
{
    /**
     * @var string
     *
     * @Constraints\Type("string")
     * @Constraints\NotBlank()
     * @Constraints\Length(max=63)
     */
    public $name;
}
