<?php

namespace App\Repository;

use Doctrine\ORM\EntityRepository;

/**
 * Class UserRepository
 *
 * @package App\Repository
 */
class UserRepository extends EntityRepository
{
    /**
     * @param string $apiKey
     *
     * @return array
     */
    public function findByApiKey($apiKey = '')
    {
        return $this->findBy(['apiKey' => $apiKey]);
    }
}