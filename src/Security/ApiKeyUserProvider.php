<?php

namespace App\Security;

use App\Entity\User as UserEntity;
use App\Repository\UserRepository;
use Symfony\Component\Security\Core\User\UserProviderInterface;
use Symfony\Component\Security\Core\User\User;
use Symfony\Component\Security\Core\User\UserInterface;
use Symfony\Component\Security\Core\Exception\UnsupportedUserException;

/**
 * Class ApiKeyUserProvider
 *
 * @package App\Security
 */
class ApiKeyUserProvider implements UserProviderInterface
{
    /**
     * @var UserRepository
     */
    private $userRepository;

    public function __construct(UserRepository $userRepository)
    {
        $this->userRepository = $userRepository;
    }

    /**
     * @param $apiKey
     *
     * @return mixed
     */
    public function getUsernameForApiKey($apiKey)
    {
        /** @var UserEntity $user */
        $user = $this->userRepository->findByApiKey($apiKey);

        return $user->getEmail();
    }

    /**
     * Creates a security 'user' instance (not entity). Could be accessed via Request object in controller.
     *
     * @param string $username
     *
     * @return User
     */
    public function loadUserByUsername($username)
    {
        return new User(
            $username,
            null,
            ['ROLE_API']
        );
    }

    /**
     * User refresh is not needed - apiKey is supposed to be sent in each request
     *
     * @param UserInterface $user
     *
     * @throws UnsupportedUserException
     *
     * @return void
     */
    public function refreshUser(UserInterface $user)
    {
        throw new UnsupportedUserException();
    }

    /**
     * @param string $class
     *
     * @return bool
     */
    public function supportsClass($class)
    {
        return User::class === $class;
    }
}