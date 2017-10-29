<?php

namespace App\Controller;

use App\Entity\Appointment;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\JsonResponse;

/**
 * Class AppointmentController
 *
 * @package App\Controller
 */
class AppointmentController extends Controller
{
    /**
     * @return JsonResponse
     */
    public function getAction() : JsonResponse {

        $appointments = $this->getDoctrine()->getRepository(Appointment::class)->findAll();

        return new JsonResponse($appointments);
    }
}