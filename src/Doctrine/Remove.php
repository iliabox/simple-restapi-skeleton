<?php

namespace App\Doctrine;

use Doctrine\ORM\EntityManagerInterface;

final class Remove
{

    private EntityManagerInterface $em;

    public function __construct(EntityManagerInterface $em)
    {
        $this->em = $em;
    }

    public function __invoke($entity)
    {
        $this->em->remove($entity);
    }
}
