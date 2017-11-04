<?php

namespace App\Factory;

use App\Entity\Appointment;
use App\Entity\Hospital;
use App\Entity\User;
use DateTime;

/**
 * Class AppointmentFactory
 *
 * @package App\Factory
 */
class AppointmentFactory
{
    public function create(User $user, Hospital $hospital, DateTime $dateTime)
    {
        $appointment = new Appointment();

        $appointment->setUser($user);
        $appointment->setHospital($hospital);
        $appointment->setAppointmentDatetime($dateTime);

        return $appointment;
    }
}