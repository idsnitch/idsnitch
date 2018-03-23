<?php
/*********************************************************************************
 * Developed by Maxx Ng'ang'a
 * (C) 2017 Crysoft Dynamics Ltd
 * Karbon V 2.1
 * User: Maxx
 * Date: 2/26/2018
 * Time: 3:52 PM
 ********************************************************************************/

namespace AppBundle\Entity;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Bridge\Doctrine\Validator\Constraints\UniqueEntity;
use Symfony\Component\HttpFoundation\File\File;
use Vich\UploaderBundle\Mapping\Annotation as Vich;
/**
 * @ORM\Entity
 * @ORM\Table(name="person")
 * @UniqueEntity(fields={"idNumber"},message="This User is already registered. Kindly update their profile")
 * @Vich\Uploadable
 */
class Person
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="UUID")
     * @ORM\Column(type="string")
     */
    private $id;
    /**
     * @ORM\Column(type="string")
     * A person's First Name
     */
    private $firstName;
    /**
     * @ORM\Column(type="string",nullable=true)
     * A person's middle name [ OPTIONAL ]
     */
    private $middleName;
    /**
     * @ORM\Column(type="string")
     * A person's last name
     */
    private $lastName;
    /**
     * @ORM\Column(type="string")
     * A person's ID Number. This has to be Unique for each person
     */
    private $idNumber;
    /**
     * NOTE: This is not a mapped field of entity metadata, just a simple property.
     *
     * @Vich\UploadableField(mapping="product_image", fileNameProperty="imageName", size="imageSize")
     *
     * @var File
     */
    private $imageFile;

    /**
     * @ORM\Column(type="string", length=255)
     *
     * @var string
     */
    private $imageName;

    /**
     * @ORM\Column(type="integer",nullable=true)
     *
     * @var integer
     */
    private $imageSize;

    /**
     * @ORM\Column(type="datetime")
     *
     * @var \DateTime
     */
    private $updatedAt;
    /**
     * @ORM\Column(type="string")
     */
    private $country="KE";
    /**
     * @var
     * @ORM\ManyToOne(targetEntity="AppBundle\Entity\User")
     */
    private $createdBy;
    /**
     * @ORM\Column(type="datetime")
     */
    private $createdAt;
    /**
     * @ORM\OneToMany(targetEntity="AppBundle\Entity\ProfileStats",mappedBy="person")
     */
    private $numberOfViews;
    /**
     * @ORM\OneToMany(targetEntity="AppBundle\Entity\Profile",mappedBy="person")
     */
    private $myCertifications;
    /**
     * @ORM\OneToMany(targetEntity="AppBundle\Entity\Education",mappedBy="whoseEducation")
     */
    private $myEducation;
    /**
     * @ORM\Column(type="string")
     */
    private $userId;

    //Setup The timestamp
    function __construct()
    {
        $this->setCreatedAt(new \DateTime());
        $this->numberOfViews = new ArrayCollection();
        $this->myCertifications = new ArrayCollection();
        $this->myEducation = new ArrayCollection();

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
    public function getUserId()
    {
        return $this->userId;
    }

    /**
     * @param mixed $userId
     */
    public function setUserId($userId)
    {
        $this->userId = $this->getCountry().'-'.$this->getIdNumber();
    }

    /**
     * @return mixed
     */
    public function getNumberOfViews()
    {
        return $this->numberOfViews;
    }

    /**
     * @return mixed
     */
    public function getFirstName()
    {
        return $this->firstName;
    }

    /**
     * @param mixed $firstName
     */
    public function setFirstName($firstName)
    {
        $this->firstName = $firstName;
    }

    /**
     * @return mixed
     */
    public function getMiddleName()
    {
        return $this->middleName;
    }

    /**
     * @param mixed $middleName
     */
    public function setMiddleName($middleName)
    {
        $this->middleName = $middleName;
    }

    /**
     * @return mixed
     */
    public function getLastName()
    {
        return $this->lastName;
    }

    /**
     * @param mixed $lastName
     */
    public function setLastName($lastName)
    {
        $this->lastName = $lastName;
    }

    /**
     * @return mixed
     */
    public function getIdNumber()
    {
        return $this->idNumber;
    }

    /**
     * @param mixed $idNumber
     */
    public function setIdNumber($idNumber)
    {
        $this->idNumber = $idNumber;
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
    public function getFullNames(){
        return $this->getFirstName().' '.$this->getLastName();
    }

    /**
     * @return mixed
     */
    public function getMyCertifications()
    {
        return $this->myCertifications;
    }

    /**
     * @return mixed
     */
    public function getMyEducation()
    {
        return $this->myEducation;
    }

    /**
     * If manually uploading a file (i.e. not using Symfony Form) ensure an instance
     * of 'UploadedFile' is injected into this setter to trigger the  update. If this
     * bundle's configuration parameter 'inject_on_load' is set to 'true' this setter
     * must be able to accept an instance of 'File' as the bundle will inject one here
     * during Doctrine hydration.
     *
     * @param File|\Symfony\Component\HttpFoundation\File\UploadedFile $image
     */
    public function setImageFile(File $image = null)
    {
        $this->imageFile = $image;

        if (null !== $image) {
            // It is required that at least one field changes if you are using doctrine
            // otherwise the event listeners won't be called and the file is lost
            $this->updatedAt = new \DateTimeImmutable();
        }
    }

    public function getImageFile()
    {
        return $this->imageFile;
    }

    public function setImageName($imageName)
    {
        $this->imageName = $imageName;
    }

    public function getImageName()
    {
        return $this->imageName;
    }

    public function setImageSize($imageSize)
    {
        $this->imageSize = $imageSize;
    }

    public function getImageSize()
    {
        return $this->imageSize;
    }

}