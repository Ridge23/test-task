<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;
use JsonSerializable;

/**
 * Hospital
 *
 * @ORM\Table(name="hospital")
 * @ORM\Entity()
 */
class Hospital implements JsonSerializable
{

    const FIELD_NAME = 'name';
    const FIELD_COUNTRY = 'country';
    const FIELD_CITY = 'city';

    /**
     * @var int
     *
     * @ORM\Column(name="id", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    private $id;

    /**
     * @var string
     *
     * @ORM\Column(name="name", type="string", length=255)
     */
    private $name;

    /**
     * @var string
     *
     * @ORM\Column(name="country", type="string", length=255)
     */
    private $country;

    /**
     * @var string
     *
     * @ORM\Column(name="city", type="string", length=255)
     */
    private $city;

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
     * @return Hospital
     */
    public function setId(int $id) : Hospital
    {
        $this->id = $id;

        return $this;
    }

    /**
     * @return string
     */
    public function getName()
    {
        return $this->name;
    }

    /**
     * @param string $name
     *
     * @return Hospital
     */
    public function setName(string $name = '') : Hospital
    {
        $this->name = $name;

        return $this;
    }

    /**
     * @return string
     */
    public function getCountry() : string
    {
        return $this->country;
    }

    /**
     * @param string $country
     *
     * @return Hospital
     */
    public function setCountry(string $country = '') : Hospital
    {
        $this->country = $country;

        return $this;
    }

    /**
     * @return string
     */
    public function getCity() : string
    {
        return $this->city;
    }

    /**
     * @param string $city
     *
     * @return Hospital
     */
    public function setCity(string $city = '') : Hospital
    {
        $this->city = $city;

        return $this;
    }

    /**
     * @return array
     */
    public function jsonSerialize() : array
    {
        return [
            self::FIELD_NAME => $this->name,
            self::FIELD_CITY => $this->city,
            self::FIELD_COUNTRY => $this->country
        ];
    }
}