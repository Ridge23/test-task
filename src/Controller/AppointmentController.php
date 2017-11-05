<?php

namespace App\Controller;

use App\Manager\AppointmentManager;
use App\Manager\UserManager;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;

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
     * AppointmentController constructor.
     *
     * @param AppointmentManager $appointmentManager
     * @param UserManager $userManager
     */
    public function __construct(AppointmentManager $appointmentManager, UserManager $userManager)
    {
        $this->appointmentManager = $appointmentManager;
        $this->userManager = $userManager;
    }

    /**
     * @return JsonResponse
     */
    public function getAction() : JsonResponse {
        $user = $this->userManager->getUserByEmail($this->getUser()->getUsername());
        $appointments = $this->appointmentManager->getAppointmentsByUser($user->getId());

        return new JsonResponse($appointments);
    }
}