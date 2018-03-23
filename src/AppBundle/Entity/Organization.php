<?php
/*********************************************************************************
 * Developed by Maxx Ng'ang'a
 * (C) 2017 Crysoft Dynamics Ltd
 * Karbon V 2.1
 * User: Maxx
 * Date: 2/26/2018
 * Time: 6:18 PM
 ********************************************************************************/

namespace AppBundle\Entity;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity
 * @ORM\Table(name="organization")
 */
class Organization
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="UUID")
     * @ORM\Column(type="string")
     */
    private $id;
    /**
     * @ORM\Column(type="string")
     */
    private $organizationName;
    /**
     * @ORM\Column(type="text")
     */
    private $organizationAddress;
    /**
     * @ORM\Column(type="text")
     */
    private $organizationDescription="";
    /**
     * @ORM\Column(type="string")
     */
    private $organizationRemarks;

    /**
     * @ORM\Column(type="string")
     */
    private $country;
    /**
     * @ORM\Column(type="datetime")
     */
    private $createdAt;
    /**
     * @ORM\ManyToOne(targetEntity="AppBundle\Entity\User")
     */
    private $createdBy;

    function __construct()
    {
        $this->setCreatedAt(new \DateTime());
    }

    /**
     * @return mixed
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * @return mixed
     */
    public function getOrganizationName()
    {
        return $this->organizationName;
    }

    /**
     * @param mixed $organizationName
     */
    public function setOrganizationName($organizationName)
    {
        $this->organizationName = $organizationName;
    }

    /**
     * @return mixed
     */
    public function getOrganizationAddress()
    {
        return $this->organizationAddress;
    }

    /**
     * @param mixed $organizationAddress
     */
    public function setOrganizationAddress($organizationAddress)
    {
        $this->organizationAddress = $organizationAddress;
    }

    /**
     * @return mixed
     */
    public function getOrganizationDescription()
    {
        return $this->organizationDescription;
    }

    /**
     * @param mixed $organizationDescription
     */
    public function setOrganizationDescription($organizationDescription)
    {
        $this->organizationDescription = $organizationDescription;
    }

    /**
     * @return mixed
     */
    public function getOrganizationRemarks()
    {
        return $this->organizationRemarks;
    }

    /**
     * @param mixed $organizationRemarks
     */
    public function setOrganizationRemarks($organizationRemarks)
    {
        $this->organizationRemarks = $organizationRemarks;
    }

    /**
     * @return mixed
     */
    public function getCountry()
    {
        return $this->country;
    }

    /**
     * @param mixed $country
     */
    public function setCountry($country)
    {
        $this->country = $country;
    }


    /**
     * @return mixed
     */
    public function getCreatedAt()
    {
        return $this->createdAt;
    }

    /**
     * @param mixed $createdAt
     */
    public function setCreatedAt($createdAt)
    {
        $this->createdAt = $createdAt;
    }

    /**
     * @return mixed
     */
    public function getCreatedBy()
    {
        return $this->createdBy;
    }

    /**
     * @param mixed $createdBy
     */
    public function setCreatedBy($createdBy)
    {
        $this->createdBy = $createdBy;
    }
    function __toString()
    {
        return $this->organizationName;
    }

}