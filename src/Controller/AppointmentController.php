<?php

namespace App\Controller;

use App\Manager\AppointmentManager;
use App\Manager\HospitalManager;
use App\Manager\UserManager;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use DateTime;

/**
 * Class AppointmentController
 *
 * @package App\Controller
 */
class AppointmentController extends Controller
{
    /**
     * @var AppointmentManager
     */
    protected $appointmentManager;

    /**
     * @var UserManager
     */
    protected $userManager;

    /**
     * @var HospitalManager
     */
    protected $hospitalManager;

    /**
     * AppointmentController constructor.
     *
     * @param AppointmentManager $appointmentManager
     * @param UserManager $userManager
     * @param HospitalManager $hospitalManager
     */
    public function __construct(
        AppointmentManager $appointmentManager,
        UserManager $userManager,
        HospitalManager $hospitalManager
    ) {
        $this->appointmentManager = $appointmentManager;
        $this->userManager = $userManager;
        $this->hospitalManager = $hospitalManager;
    }

    /**
     * @return JsonResponse
     */
    public function getAction() : JsonResponse
    {
        $user = $this->getUserEntity();
        $appointments = $this->appointmentManager->getAppointmentsByUser($user->getId());

        return new JsonResponse($appointments);
    }

    /**
     * @param Request $request
     *
     * @return JsonResponse
     */
    public function createAction(Request $request) : JsonResponse
    {
        $appointmentData = json_decode($request->getContent(), true);

        $user = $this->getUserEntity();
        $hospital = $this->hospitalManager->getById($appointmentData['hospital_id']);
        $dateTime = new DateTime($appointmentData['appointment_time']);

        $appointment = $this->appointmentManager->createAppointment($user, $hospital, $dateTime);

        return new JsonResponse($appointment);
    }

    /**
     * @return JsonResponse
     */
    public function updateAction() : JsonResponse
    {
        return new JsonResponse();
    }

    /**
     * @return JsonResponse
     */
    public function deleteAction() : JsonResponse
    {
        return new JsonResponse();
    }

    protected function getUserEntity()
    {
        return $this->userManager->getUserByEmail($this->getUser()->getUsername());
    }
}