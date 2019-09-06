<?php

namespace App\DataFixtures;

use App\Entity\ClassRoom;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\Persistence\ObjectManager;
use Ramsey\Uuid\Uuid;

class ClassRoomFixtures extends Fixture
{
    public function load(ObjectManager $manager)
    {
        $classRoomsNames = [
            'Alpha',
            'Bravo',
            'Charlie',
            'Delta',
            'Echo',
            'Foxtrot',
            'Golf',
        ];

        $entities = array_map([ClassRoom::class, 'create'], $classRoomsNames);

        array_walk($entities, [$manager, 'persist']);

        $manager->flush();
    }
}
