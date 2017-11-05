<?php

namespace App\Manager;

use App\Entity\Hospital;
use App\Repository\HospitalRepository;

/**
 * Class HospitalManager
 *
 * @package App\Manager
 */
class HospitalManager
{
    /**
     * @var HospitalRepository
     */
    private $hospitalRepository;

    /**
     * HospitalManager constructor.
     *
     * @param HospitalRepository $hospitalRepository
     */
    public function __construct(HospitalRepository $hospitalRepository)
    {
        $this->hospitalRepository = $hospitalRepository;
    }

    /**
     * @param int $id
     *
     * @return Hospital|null
     */
    public function getById($id = 0)
    {
        return $this->hospitalRepository->find($id);
    }
}