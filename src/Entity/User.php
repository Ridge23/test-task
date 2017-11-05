<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Security\Core\User\UserInterface;
use JsonSerializable;

/**
 * @ORM\Table(name="user")
 * @ORM\Entity(repositoryClass="App\Repository\UserRepository")
 */
class User implements UserInterface, JsonSerializable
{
    const FIELD_EMAIL = 'email';
    const FIELD_USERNAME = 'username';

    /**
     * @ORM\Column(type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=25, unique=true)
     */
    private $username;

    /**
     * @ORM\Column(type="string", length=64)
     */
    private $password;

    /**
     * @ORM\Column(type="string", length=60, unique=true)
     */
    private $email;

    /**
     * @ORM\Column(name="is_active", type="boolean")
     */
    private $isActive;

    /**
     * @ORM\Column(type="string", length=60, unique=true)
     */
    private $apiKey;

    /**
     * User constructor.
     */
    public function __construct()
    {
        $this->isActive = true;
    }

    /**
     * @return int
     */
    public function getId() : int
    {
        return $this->id;
    }

    /**
     * @param int $id
     *
     * @return User
     */
    public function setId($id) : User
    {
        $this->id = $id;

        return $this;
    }

    /**
     * @return string
     */
    public function getUsername() : string
    {
        return $this->username;
    }

    /**
     * @param string $username
     *
     * @return User
     */
    public function setUsername(string $username = '') : User
    {
        $this->username = $username;

        return $this;
    }

    /**
     * @return string
     */
    public function getEmail() : string
    {
        return $this->email;
    }

    /**
     * @param string $email
     *
     * @return User
     */
    public function setEmail(string $email) : User
    {
        $this->email = $email;

        return $this;
    }

    /**
     * @return string
     */
    public function getSalt() : string
    {
        return '';
    }

    /**
     * @return string
     */
    public function getPassword() : string
    {
        return $this->password;
    }

    /**
     * @param string $password
     *
     * @return User
     */
    public function setPassword(string $password = '') : User
    {
        $this->password = $password;

        return $this;
    }

    /**
     * @return string
     */
    public function getApiKey()
    {
        return $this->apiKey;
    }

    /**
     * @param string $apiKey
     */
    public function setApiKey($apiKey)
    {
        $this->apiKey = $apiKey;
    }

    /**
     * @return array
     */
    public function getRoles() : array
    {
        return ['ROLE_API'];
    }

    /**
     * Dummy method (needed to be provided for UserInterface, there is no need in it in current project).
     */
    public function eraseCredentials()
    {
    }

    /**
     * @return array
     */
    public function jsonSerialize() : array
    {
        return [
            self::FIELD_EMAIL => $this->email,
            self::FIELD_USERNAME => $this->username
        ];
    }
}