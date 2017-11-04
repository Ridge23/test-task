<?php

namespace App\Repository;

use Doctrine\ORM\EntityRepository;

/**
 * Class AppointmentRepository
 *
 * @package App\Repository
 */
class AppointmentRepository extends EntityRepository
{
    /**
     * @param int $userId
     *
     * @return array
     */
    public function findByUser($userId = 0)
    {
        return $this->findBy(['user' => $userId]);
    }
}