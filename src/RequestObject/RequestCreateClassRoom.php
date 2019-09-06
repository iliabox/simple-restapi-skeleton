<?php

namespace App\RequestObject;

use Symfony\Component\Validator\Constraints;

class RequestCreateClassRoom implements RequestObjectInterface
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
