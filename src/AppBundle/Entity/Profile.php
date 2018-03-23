<?php
/*********************************************************************************
 * Developed by Maxx Ng'ang'a
 * (C) 2017 Crysoft Dynamics Ltd
 * Karbon V 2.1
 * User: Maxx
 * Date: 2/26/2018
 * Time: 3:49 PM
 ********************************************************************************/

namespace AppBundle\Entity;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Bridge\Doctrine\Validator\Constraints\UniqueEntity;

/**
 * @ORM\Entity
 * @ORM\Table(name="profile")
 */
class Profile
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="UUID")
     * @ORM\Column(type="string")
     */
    private $id;
    /**
     * @ORM\ManyToOne(targetEntity="AppBundle\Entity\Organization")
     */
    private $organization;
    /**
     * @ORM\Column(type="string")
     */
    private $certification;
    /**
     * @ORM\Column(type="date")
     */
    private $periodFrom;
    /**
     * @ORM\Column(type="date")
     */
    private $periodTo;
    /**
     * @ORM\Column(type="string",nullable=true)
     */
    private $qualification;
    /**
     * @ORM\Column(type="string",nullable=true)
     */
    private $category;
    /**
     * @ORM\ManyToOne(targetEntity="AppBundle\Entity\Person")
     */
    private $person;
    /**
     * @ORM\ManyToOne(targetEntity="AppBundle\Entity\User")
     */
    private $createdBy;
    /**
     * @ORM\Column(type="datetime")
     */
    private $createdAt;
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
    public function getOrganization()
    {
        return $this->organization;
    }

    /**
     * @param mixed $organization
     */
    public function setOrganization($organization)
    {
        $this->organization = $organization;
    }

    /**
     * @return mixed
     */
    public function getCertification()
    {
        return $this->certification;
    }

    /**
     * @param mixed $certification
     */
    public function setCertification($certification)
    {
        $this->certification = $certification;
    }

    /**
     * @return mixed
     */
    public function getPeriodFrom()
    {
        return $this->periodFrom;
    }

    /**
     * @param mixed $periodFrom
     */
    public function setPeriodFrom($periodFrom)
    {
        $this->periodFrom = $periodFrom;
    }

    /**
     * @return mixed
     */
    public function getPeriodTo()
    {
        return $this->periodTo;
    }

    /**
     * @param mixed $periodTo
     */
    public function setPeriodTo($periodTo)
    {
        $this->periodTo = $periodTo;
    }

    /**
     * @return mixed
     */
    public function getQualification()
    {
        return $this->qualification;
    }

    /**
     * @param mixed $qualification
     */
    public function setQualification($qualification)
    {
        $this->qualification = $qualification;
    }

    /**
     * @return mixed
     */
    public function getCategory()
    {
        return $this->category;
    }

    /**
     * @param mixed $category
     */
    public function setCategory($category)
    {
        $this->category = $category;
    }

    /**
     * @return mixed
     */
    public function getPerson()
    {
        return $this->person;
    }

    /**
     * @param mixed $person
     */
    public function setPerson($person)
    {
        $this->person = $person;
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




}