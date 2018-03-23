<?php
/*********************************************************************************
 * Developed by Maxx Ng'ang'a
 * (C) 2017 Crysoft Dynamics Ltd
 * Karbon V 2.1
 * User: Maxx
 * Date: 3/16/2018
 * Time: 12:26 PM
 ********************************************************************************/

namespace AppBundle\Entity;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity
 * @ORM\Table(name="education")
 */
class Education
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
    private $graduationYear;
    /**
     * @ORM\Column(type="string")
     */
    private $qualification;
    /**
     * @ORM\ManyToOne(targetEntity="AppBundle\Entity\Person")
     */
    private $whoseEducation;
    /**
     * @ORM\ManyToOne(targetEntity="AppBundle\Entity\Organization")
     */
    private $institution;
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
        $this->createdAt= new \DateTime();
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
    public function getGraduationYear()
    {
        return $this->graduationYear;
    }

    /**
     * @param mixed $graduationYear
     */
    public function setGraduationYear($graduationYear)
    {
        $this->graduationYear = $graduationYear;
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
    public function getWhoseEducation()
    {
        return $this->whoseEducation;
    }

    /**
     * @param mixed $whoseEducation
     */
    public function setWhoseEducation($whoseEducation)
    {
        $this->whoseEducation = $whoseEducation;
    }

    /**
     * @return mixed
     */
    public function getInstitution()
    {
        return $this->institution;
    }

    /**
     * @param mixed $institution
     */
    public function setInstitution($institution)
    {
        $this->institution = $institution;
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