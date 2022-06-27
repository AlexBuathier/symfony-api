<?php

namespace App\DataFixtures;

use App\Entity\NoteExpense;
use App\Repository\CompanyRepository;
use App\Repository\NoteTypeRepository;
use App\Repository\UserRepository;
use DateInterval;
use DateTime;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\DataFixtures\DependentFixtureInterface;
use Doctrine\Persistence\ObjectManager;

class NoteExpenseFixtures extends Fixture implements DependentFixtureInterface
{
    private UserRepository $ur;
    private CompanyRepository $cr;
    private NoteTypeRepository $ntr;

    public function __construct(
        UserRepository $userRepository,
        CompanyRepository $companyRepository,
        NoteTypeRepository $noteTypeRepository,
    ) {
        $this->ur = $userRepository;
        $this->cr = $companyRepository;
        $this->ntr = $noteTypeRepository;
    }

    /**
     * @throws \Exception
     */
    public function load(ObjectManager $manager): void
    {

        for ($i = 0; $i < 10; $i++) {
            $date = new DateTime();
            $noteExpense = new NoteExpense();
            $noteExpense->setNoteDate($date->add(new DateInterval('P' . $i . 'D')));
            $noteExpense->setCreatedAt($date->add(new DateInterval('P' . $i . 'D')));
            $noteExpense->setAmount(mt_rand(10  *100 , 100  *100) /100);
            $noteExpense->setUser($this->ur->find(1));
            $noteExpense->setNoteType($this->ntr->findOneBy(['id' => mt_rand(1, 5)]));
            $noteExpense->setCompany($this->cr->find(mt_rand(1, 4)));
            $manager->persist($noteExpense);
        }

        $manager->flush();
    }

    public function getDependencies(): array
    {
        return [
            UserFixtures::class,
            CompanyFixtures::class,
            NoteTypeFixtures::class,
        ];
    }
}
