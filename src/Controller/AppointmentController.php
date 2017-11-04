<?php

namespace App\Controller;

use App\Manager\AppointmentManager;
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
     * AppointmentController constructor.
     *
     * @param AppointmentManager $appointmentManager
     */
    public function __construct(AppointmentManager $appointmentManager)
    {
        $this->appointmentManager = $appointmentManager;
    }

    /**
     * @param Request $request
     *
     * @return JsonResponse
     */
    public function getAction(Request $request) : JsonResponse {
        $appointments = $this->appointmentManager->getAppointmentsByUser(13);

        return new JsonResponse($appointments);
    }
}