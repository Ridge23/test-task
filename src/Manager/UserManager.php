<?php

namespace App\Manager;

use App\Repository\UserRepository;
use App\Entity\User;

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
     * @param string $email
     *
     * @return User|null
     */
    public function getUserByEmail($email = '') {
        return $this->userRepository->findOneBy(['email' => $email]);
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