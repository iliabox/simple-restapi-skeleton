<?php

namespace App\Doctrine;

use Doctrine\ORM\EntityManagerInterface;

final class Persist
{

    /**
     * @var EntityManagerInterface
     */
    private $em;

    /**
     * @param EntityManagerInterface $em
     */
    public function __construct(EntityManagerInterface $em)
    {
        $this->em = $em;
    }

    public function __invoke($entity)
    {
        $this->em->persist($entity);
    }
}
