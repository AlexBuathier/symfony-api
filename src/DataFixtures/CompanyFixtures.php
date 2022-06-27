<?php

namespace App\DataFixtures;

use App\Entity\Company;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;

class CompanyFixtures extends Fixture
{
    public function load(ObjectManager $manager): void
    {
        $name = ['Renault', 'Auchan', 'Cultura', 'Airbnb'];
        for ($i = 0; $i < count($name); $i++) {
            $company = new Company();
            $company->setName($name[$i]);
            $company->setSiret($i . '0000000000000');
            $manager->persist($company);
        }
        $manager->flush();
    }
}
