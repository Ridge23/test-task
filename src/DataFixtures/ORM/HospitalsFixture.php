<?php

namespace App\DataFixtures\ORM;

use App\Entity\Hospital;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\Persistence\ObjectManager;

/**
 * Class HospitalsFixture
 *
 * @package App\DataFixtures\ORM
 */
class HospitalsFixture extends Fixture
{
    /**
     * @param ObjectManager $manager
     */
    public function load(ObjectManager $manager)
    {
        $hospital = new Hospital();
        $hospital->setCountry('Luxembourg');
        $hospital->setCity('Luxembourg');
        $hospital->setName('Centre Hospitalier de Luxembourg');

        $this->addReference('test-hospital-1', $hospital);

        $manager->persist($hospital);

        $hospital = new Hospital();
        $hospital->setCountry('Luxembourg');
        $hospital->setCity('Luxembourg');
        $hospital->setName('Clinique Privee Dr E Bohler ');

        $this->addReference('test-hospital-2', $hospital);

        $manager->persist($hospital);

        $manager->flush();
    }
}