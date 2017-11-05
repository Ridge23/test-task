<?php

namespace App\Manager;

use App\Repository\UserRepository;

/**
 * Class UserManager
 *
 * @package App\Manager
 */
class UserManager
{
    /**
     * @var UserRepository
     */
    protected $userRepository;

    /**
     * UserManager constructor.
     *
     * @param UserRepository $userRepository
     */
    public function __construct(UserRepository $userRepository)
    {
        $this->userRepository = $userRepository;
    }

    /**
     * @param string $apiKey
     *
     * @return array
     */
    public function getUserByApiKey($apiKey = '')
    {
        return $this->userRepository->findByApiKey($apiKey);
    }
}