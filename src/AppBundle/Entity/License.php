<?php
/*********************************************************************************
 * Developed by Maxx Ng'ang'a
 * (C) 2017 Crysoft Dynamics Ltd
 * Karbon V 2.1
 * User: Maxx
 * Date: 3/23/2018
 * Time: 1:50 PM
 ********************************************************************************/

namespace AppBundle\Entity;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity
 * @ORM\Table(name="license")
 */
class License
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
    private $licenseName;
    /**
     * @ORM\Column(type="string")
     */
    private $licensePeriod;
    /**
     * @ORM\ManyToOne(targetEntity="AppBundle\Entity\Organization")
     */
    private $issuedBy;
    /**
     * @ORM\ManyToOne(targetEntity="AppBundle\Entity\Business")
     */
    private $business;
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
        $this->createdAt = new \DateTime();
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
    public function getLicenseName()
    {
        return $this->licenseName;
    }

    /**
     * @param mixed $licenseName
     */
    public function setLicenseName($licenseName)
    {
        $this->licenseName = $licenseName;
    }

    /**
     * @return mixed
     */
    public function getLicensePeriod()
    {
        return $this->licensePeriod;
    }

    /**
     * @param mixed $licensePeriod
     */
    public function setLicensePeriod($licensePeriod)
    {
        $this->licensePeriod = $licensePeriod;
    }

    /**
     * @return mixed
     */
    public function getBusiness()
    {
        return $this->business;
    }

    /**
     * @param mixed $business
     */
    public function setBusiness($business)
    {
        $this->business = $business;
    }

    /**
     * @return mixed
     */
    public function getIssuedBy()
    {
        return $this->issuedBy;
    }

    /**
     * @param mixed $issuedBy
     */
    public function setIssuedBy($issuedBy)
    {
        $this->issuedBy = $issuedBy;
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


}