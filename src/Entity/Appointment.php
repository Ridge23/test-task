<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;
use DateTime;
use JsonSerializable;

/**
 * Appointment
 *
 * @ORM\Table(name="appointment")
 * @ORM\Entity()
 */
class Appointment implements JsonSerializable
{
    const FIELD_ID = 'id';
    const FIELD_CREATED_AT = 'created_at';
    const FIELD_UPDATED_AT = 'updated_at';

    /**
     * @var int
     *
     * @ORM\Column(name="id", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    private $id;

    /**
     * @var DateTime
     *
     * @ORM\Column(name="appointment_datetime", type="datetime")
     */
    private $appointmentDatetime;

    /**
     * @ORM\ManyToOne(targetEntity="Hospital")
     * @ORM\JoinColumn(name="hospital_id", referencedColumnName="id")
     */
    private $hospital;

    /**
     * @ORM\ManyToOne(targetEntity="User")
     * @ORM\JoinColumn(name="user_id", referencedColumnName="id")
     */
    private $user;

    /**
     * @var DateTime
     *
     * @ORM\Column(name="created_at", type="datetime")
     */
    private $createdAt;

    /**
     * @var DateTime
     *
     * @ORM\Column(name="updated_at", type="datetime")
     */
    private $updatedAt;

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
     * @return Appointment
     */
    public function setId($id) : Appointment
    {
        $this->id = $id;

        return $this;
    }

    /**
     * @return DateTime
     */
    public function getAppointmentDatetime() : DateTime
    {
        return $this->appointmentDatetime;
    }

    /**
     * @param DateTime $appointmentDatetime
     * @return Appointment
     */
    public function setAppointmentDatetime(DateTime $appointmentDatetime) : Appointment
    {
        $this->appointmentDatetime = $appointmentDatetime;

        return $this;
    }

    /**
     * @return Hospital
     */
    public function getHospital()
    {
        return $this->hospital;
    }

    /**
     * @param Hospital $hospital
     *
     * @return Appointment
     */
    public function setHospital(Hospital $hospital) : Appointment
    {
        $this->hospital = $hospital;
        return $this;
    }

    /**
     * @return User
     */
    public function getUser() : User
    {
        return $this->user;
    }

    /**
     * @param User $user
     *
     * @return Appointment
     */
    public function setUser(User $user) : Appointment
    {
        $this->user = $user;

        return $this;
    }

    /**
     * @return DateTime
     */
    public function getCreatedAt() : DateTime
    {
        return $this->createdAt;
    }

    /**
     * @param DateTime $createdAt
     *
     * @return Appointment
     */
    public function setCreatedAt(DateTime $createdAt) : Appointment
    {
        $this->createdAt = $createdAt;

        return $this;
    }

    /**
     * @return DateTime
     */
    public function getUpdatedAt() : DateTime
    {
        return $this->updatedAt;
    }

    /**
     * @param DateTime $updatedAt
     *
     * @return Appointment
     */
    public function setUpdatedAt(DateTime $updatedAt) : Appointment
    {
        $this->updatedAt = $updatedAt;

        return $this;
    }

    /**
     * @return array
     */
    public function jsonSerialize() : array
    {
        return [
            self::FIELD_ID => $this->id,
            self::FIELD_CREATED_AT => $this->createdAt,
            self::FIELD_UPDATED_AT => $this->updatedAt
        ];
    }
}