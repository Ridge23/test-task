<?php

namespace App\Manager;

use App\Entity\Appointment;
use App\Entity\Hospital;
use App\Repository\AppointmentRepository;
use Doctrine\ORM\EntityManager;
use App\Entity\User;
use DateTime;

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
     * @param EntityManager $entityManager
     */
    public function __construct(
        AppointmentRepository $appointmentRepository,
        EntityManager $entityManager
    ) {
        $this->appointmentRepository = $appointmentRepository;
        $this->entityManager = $entityManager;
    }

    /**
     * @param User $user
     * @param Hospital $hospital
     * @param DateTime $dateTime
     *
     * @return Appointment
     */
    public function createAppointment(User $user, Hospital $hospital, DateTime $dateTime)
    {
        $appointment = new Appointment();

        $appointment->setUser($user);
        $appointment->setHospital($hospital);
        $appointment->setAppointmentDatetime($dateTime);

        $this->entityManager->persist($appointment);
        $this->entityManager->flush();

        return $appointment;
    }

    /**
     * @param $userId
     *
     * @return array
     */
    public function getAppointmentsByUser($userId) : array
    {
        return $this->appointmentRepository->findByUser($userId);
    }

    /**
     * @param $id
     *
     * @return Appointment|null
     */
    public function getAppointmentById($id)
    {
        return $this->appointmentRepository->find($id);
    }
}