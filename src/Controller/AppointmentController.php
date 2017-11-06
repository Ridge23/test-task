<?php

namespace App\Controller;

use App\Manager\AppointmentManager;
use App\Manager\HospitalManager;
use App\Manager\UserManager;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use App\Entity\User;
use DateTime;
use Exception;

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
    public function getAllAction() : JsonResponse
    {
        $status = Response::HTTP_OK;
        $user = $this->getUserEntity();
        $appointments = $this->appointmentManager->getAppointmentsByUser($user->getId());

        return new JsonResponse($appointments, $status);
    }

    /**
     * @param $id
     *
     * @return JsonResponse
     */
    public function getAction($id) : JsonResponse
    {
        $appointment = $this->appointmentManager->getAppointmentById($id);

        return new JsonResponse($appointment);
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
        $appointment = $this->appointmentManager->createAppointment($user, $hospital, $appointmentData['appointment_time']);

        return new JsonResponse($appointment);
    }

    /**
     * @param Request $request
     * @param int $id
     *
     * @return JsonResponse
     */
    public function updateAction(Request $request, $id) : JsonResponse
    {
        $status = Response::HTTP_OK;
        $message = '';

        $appointmentData = json_decode($request->getContent(), true);

        $user = $this->getUserEntity();
        $hospital = $this->hospitalManager->getById($appointmentData['hospital_id']);

        try {
            $this->appointmentManager->updateAppointment($id, $user, $hospital, $appointmentData['appointment_time']);
        } catch (Exception $e) {
            $status = Response::HTTP_INTERNAL_SERVER_ERROR;
            $message = $e->getMessage();
        }

        return new JsonResponse($message, $status);
    }

    /**
     * @param int $id
     *
     * @return JsonResponse
     */
    public function deleteAction($id) : JsonResponse
    {
        $status = Response::HTTP_OK;
        $message = '';

        $user = $this->getUserEntity();

        try {
            $this->appointmentManager->deleteAppointment($id, $user);
        } catch (Exception $e) {
            $status = Response::HTTP_INTERNAL_SERVER_ERROR;
            $message = $e->getMessage();
        }

        return new JsonResponse($message, $status);
    }

    /**
     * @return User|null
     */
    protected function getUserEntity()
    {
        return $this->userManager->getUserByEmail($this->getUser()->getUsername());
    }
}