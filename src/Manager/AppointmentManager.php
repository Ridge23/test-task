<?php

namespace App\Manager;

use App\Builder\AppointmentEntityBuilder;
use App\Entity\Appointment;
use App\Entity\Hospital;
use App\Exception\ApplicationUserMismatchException;
use App\Repository\AppointmentRepository;
use Doctrine\ORM\EntityManager;
use App\Entity\User;
use DateTime;
use Symfony\Component\Validator\Constraints\Date;

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
     * @var AppointmentEntityBuilder
     */
    protected $appointmentEntityBuilder;

    /**
     * AppointmentManager constructor.
     *
     * @param AppointmentRepository $appointmentRepository
     * @param AppointmentEntityBuilder $appointmentEntityBuilder
     * @param EntityManager $entityManager
     */
    public function __construct(
        AppointmentRepository $appointmentRepository,
        AppointmentEntityBuilder $appointmentEntityBuilder,
        EntityManager $entityManager
    ) {
        $this->appointmentRepository = $appointmentRepository;
        $this->entityManager = $entityManager;
        $this->appointmentEntityBuilder = $appointmentEntityBuilder;
    }

    /**
     * @param User $user
     * @param Hospital $hospital
     * @param string $dateTime
     *
     * @return Appointment
     */
    public function createAppointment(User $user, Hospital $hospital, $dateTime = '')
    {
        $appointment = $this->appointmentEntityBuilder->build($user, $hospital, $dateTime);

        $this->entityManager->persist($appointment);
        $this->entityManager->flush();

        return $appointment;
    }

    /**
     * @param int $userId
     *
     * @return array
     */
    public function getAppointmentsByUser($userId) : array
    {
        return $this->appointmentRepository->findByUser($userId);
    }

    /**
     * @param int $id
     *
     * @return Appointment|null
     */
    public function getAppointmentById($id)
    {
        return $this->appointmentRepository->find($id);
    }

    /**
     * @param int $id
     * @param User $user
     * @param Hospital $hospital
     * @param string $dateTime
     * @return Appointment|null
     * @throws ApplicationUserMismatchException
     */
    public function updateAppointment($id = 0, User $user, Hospital $hospital, $dateTime = '')
    {
        $appointment = $this->getAppointmentById($id);

        if ($appointment->getUser() !== $user) {
            throw new ApplicationUserMismatchException();
        } else {
            $appointment->setHospital($hospital);
            $appointment->setAppointmentDatetime(new DateTime($dateTime));

            $this->entityManager->persist($appointment);
            $this->entityManager->flush();

            return $appointment;
        }
    }

    /**
     * @param $appointmentId
     * @param User $user
     * @throws ApplicationUserMismatchException
     */
    public function deleteAppointment($appointmentId, User $user)
    {
        $appointment = $this->getAppointmentById($appointmentId);

        if ($appointment->getUser() !== $user) {
            throw new ApplicationUserMismatchException();
        } else {
            $this->entityManager->remove($appointment);
        }
    }
}