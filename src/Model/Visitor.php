<?php

namespace MatiashApp\Model;

class Visitor extends BaseModel
{
    /**
     * @var int
     */
    private $id;

    /**
     * @var int
     */
    private $ipAddress;

    /**
     * @var string
     */
    private $country;

    /**
     * @var string
     */
    private $city;

    public function getTableName()
    {
        return 'visitors';
    }

    public function setId($id)
    {
        $this->id = $id;

        return $this;
    }

    public function setIpAddress($ipAddress)
    {
        $this->ipAddress = $ipAddress;

        return $this;
    }

    public function setCountry($country)
    {
        $this->country = $country;

        return $this;
    }

    public function setCity($city)
    {
        $this->city = $city;

        return $this;
    }

    /**
     * @return int
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * @return string
     */
    public function getIpAddress()
    {
        return $this->ipAddress;
    }

    /**
     * @return string
     */
    public function getCountry()
    {
        return $this->country;
    }

    /**
     * @return string
     */
    public function getCity()
    {
        return $this->city;
    }

    public function toArray()
    {
        $result = [];

        foreach ($this as $field => $value) {
            $result[$field] = $value;
        }

        return $result;
    }
}