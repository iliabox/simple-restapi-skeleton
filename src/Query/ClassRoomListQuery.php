<?php

namespace App\Query;

use App\Entity\ClassRoom;
use Doctrine\ORM\EntityManagerInterface;

class ClassRoomListQuery
{

    /**
     * @var EntityManagerInterface
     */
    private $em;

    /**
     * ListClassRoomQuery constructor.
     * @param EntityManagerInterface $em
     */
    public function __construct(EntityManagerInterface $em)
    {
        $this->em = $em;
    }

    public function __invoke(): array
    {
        $qb = $this->em->createQueryBuilder()
            ->select('cr')
            ->from(ClassRoom::class, 'cr')
            ;

        return $qb->getQuery()->getResult();
    }
}
