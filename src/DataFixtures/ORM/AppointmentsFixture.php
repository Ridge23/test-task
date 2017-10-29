<?php

namespace App\DataFixtures\ORM;

use DateTime;
use App\Entity\Hospital;
use App\Entity\Appointment;
use App\Entity\User;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\Persistence\ObjectManager;

/**
 * Class AppointmentsFixture
 *
 * @package App\DataFixtures\ORM
 */
class AppointmentsFixture extends Fixture
{
    /**
     * @param ObjectManager $manager
     */
    public function load(ObjectManager $manager)
    {
        /** @var User $user1 */
        $user1 = $this->getReference('test-user-1');
        /** @var User $user2 */
        $user2 = $this->getReference('test-user-2');

        /** @var Hospital $hospital1 */
        $hospital1 = $this->getReference('test-hospital-1');

        /** @var Hospital $hospital2 */
        $hospital2 = $this->getReference('test-hospital-2');

        $appointment = new Appointment();

        $appointment->setAppointmentDatetime(new DateTime('2017-12-25T08:00'));
        $appointment->setHospital($hospital1);
        $appointment->setUser($user1);
        $appointment->setCreatedAt(new DateTime());
        $appointment->setUpdatedAt(new DateTime());

        $manager->persist($appointment);

        $appointment = new Appointment();

        $appointment->setAppointmentDatetime(new DateTime('2017-10-25T08:00'));
        $appointment->setHospital($hospital2);
        $appointment->setUser($user1);
        $appointment->setCreatedAt(new DateTime());
        $appointment->setUpdatedAt(new DateTime());

        $manager->persist($appointment);

        $appointment = new Appointment();

        $appointment->setAppointmentDatetime(new DateTime('2017-08-25T08:00'));
        $appointment->setHospital($hospital1);
        $appointment->setUser($user1);
        $appointment->setCreatedAt(new DateTime());
        $appointment->setUpdatedAt(new DateTime());

        $manager->persist($appointment);

        $appointment = new Appointment();

        $appointment->setAppointmentDatetime(new DateTime('2017-07-21T08:00'));
        $appointment->setHospital($hospital1);
        $appointment->setUser($user2);
        $appointment->setCreatedAt(new DateTime());
        $appointment->setUpdatedAt(new DateTime());

        $manager->persist($appointment);

        $appointment = new Appointment();

        $appointment->setAppointmentDatetime(new DateTime('2017-07-25T08:00'));
        $appointment->setHospital($hospital2);
        $appointment->setUser($user2);
        $appointment->setCreatedAt(new DateTime());
        $appointment->setUpdatedAt(new DateTime());

        $manager->persist($appointment);

        $appointment = new Appointment();

        $appointment->setAppointmentDatetime(new DateTime('2017-08-01T08:00'));
        $appointment->setHospital($hospital2);
        $appointment->setUser($user2);
        $appointment->setCreatedAt(new DateTime());
        $appointment->setUpdatedAt(new DateTime());

        $manager->persist($appointment);

        $appointment = new Appointment();

        $appointment->setAppointmentDatetime(new DateTime('2017-08-04T08:00'));
        $appointment->setHospital($hospital2);
        $appointment->setUser($user2);
        $appointment->setCreatedAt(new DateTime());
        $appointment->setUpdatedAt(new DateTime());

        $manager->persist($appointment);

        $manager->flush();
    }

    /**
     * @return array
     */
    public function getDependencies()
    {
        return [
            UsersFixture::class,
            HospitalsFixture::class
        ];
    }
}