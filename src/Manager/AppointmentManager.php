<?php

namespace App\Manager;

use Doctrine\ORM\EntityManager;

/**
 * Class AppointmentManager
 *
 * @package App\Manager
 */
class AppointmentManager
{
    /**
     * @var EntityManager
     */
    protected $entityManager;

    public function __construct(
        EntityManager $entityManager
    ) {
        $this->entityManager = $entityManager;
    }

    public function getAppointmentsByUser($userId)
    {

    }

    public function createAppointment()
    {

    }
}