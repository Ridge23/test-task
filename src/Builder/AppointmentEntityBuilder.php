<?php

namespace App\Builder;

use App\Entity\Appointment;
use App\Entity\User;
use App\Entity\Hospital;
use DateTime;

/**
 * Class AppointmentEntityBuilder
 *
 * @package App\Builder
 */
class AppointmentEntityBuilder
{
    /**
     * @param User $user
     * @param Hospital $hospital
     * @param string $dateTime
     *
     * @return Appointment
     */
    public function build(User $user, Hospital $hospital, $dateTime = '')
    {
        $appointment = new Appointment();

        $appointment->setUser($user);
        $appointment->setHospital($hospital);
        $appointment->setAppointmentDatetime(new DateTime($dateTime));

        return $appointment;
    }
}