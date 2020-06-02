<?php

namespace App\Doctrine;

use Doctrine\ORM\EntityManagerInterface;

final class Commit
{

    private EntityManagerInterface $em;

    public function __construct(EntityManagerInterface $em)
    {
        $this->em = $em;
    }

    public function __invoke(bool $clearAfterFlush = false)
    {
        $this->em->flush();
        $clearAfterFlush && $this->em->clear();
    }
}
