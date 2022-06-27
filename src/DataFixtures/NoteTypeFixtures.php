<?php

namespace App\DataFixtures;

use App\Entity\NoteType;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;

class NoteTypeFixtures extends Fixture
{
    public function load(ObjectManager $manager): void
    {
        $typeNames = ['Essence', 'Péage', 'Repas', 'Conférence', 'Autre'];
        for ($i = 0; $i < count($typeNames); $i++) {
            $type = new NoteType();
            $type->setName($typeNames[$i]);
            $manager->persist($type);
        }
        $manager->flush();
    }
}
