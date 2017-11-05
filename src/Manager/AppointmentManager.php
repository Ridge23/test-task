<?php

namespace App\Manager;

use App\Repository\AppointmentRepository;
use Doctrine\ORM\EntityManager;

/**
 * Class AppointmentManager
 *
 * @package App\Manager
 */
class AppointmentManager
{
    /**
     * @var AppointmentRepository
     */
    protected $appointmentRepository;

    /**
     * AppointmentManager constructor.
     *
     * @param AppointmentRepository $appointmentRepository
     */
    public function __construct(
        AppointmentRepository $appointmentRepository
    ) {
        $this->appointmentRepository = $appointmentRepository;
    }

    /**
     * @param $userId
     *
     * @return array
     */
    public function getAppointmentsByUser($userId)
    {
        return $this->appointmentRepository->findByUser($userId);
    }
}