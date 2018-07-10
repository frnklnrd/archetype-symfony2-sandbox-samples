<?php

namespace Samples\CompanyBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;
use Symfony\Bridge\Doctrine\Validator\Constraints\UniqueEntity;
use JMS\Serializer\Annotation as Serializer;
use Hateoas\Configuration\Annotation as Hateoas;

/**
 * Worker
 *
 * @ORM\Table(name="samples_company__worker",
 *             uniqueConstraints={
 *                                  @ORM\UniqueConstraint(name="fullname_unique",columns={"firstname","lastname"}),
 *                                  @ORM\UniqueConstraint(name="email_unique",columns={"email"}),
 *                                  @ORM\UniqueConstraint(name="phone_unique",columns={"phone"}),
 * }) 
 *
 * @ORM\Entity(repositoryClass="Samples\CompanyBundle\Repository\WorkerRepository")
 * 
 * @UniqueEntity({"firstname","lastname"})
 * @UniqueEntity("email")
 * @UniqueEntity("phone")
 * 
 * @Serializer\XmlRoot("worker")
 * 
 * 
 * @Hateoas\Relation("self", href = @Hateoas\Route(
 *                                          "samples_company_api_workerapi_get",
 *                                          parameters = {"id" = "expr(object.getId())"},
 *                                          absolute = true
 *                                        ))
 * @Hateoas\Relation("worker_of_company", href = @Hateoas\Route(
 *                                          "samples_company_api_companyapi_worker",
 *                                          parameters = {
 *                                                          "company_id" = "expr(object.getCompany().getId())",
 *                                                          "worker_id" = "expr(object.getId())"
 *                                                       },
 *                                          absolute = true
 *                                        ))
 * 
 */
class Worker {

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
     * @ORM\Column(name="firstname", type="string", length=255)
     */
    private $firstname;

    /**
     * @var string
     *
     * @ORM\Column(name="lastname", type="string", length=255)
     */
    private $lastname;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="birthdate", type="date", nullable=true)
     * @Serializer\Type("DateTime<'Y-m-d'>") 
     */
    private $birthdate;

    /**
     * @var string
     *
     * @ORM\Column(name="email", type="string", length=255, unique=true)
     */
    private $email;

    /**
     * @var string
     *
     * @ORM\Column(name="phone", type="string", length=255, nullable=true)
     */
    private $phone;

    /**
     * @ORM\ManyToOne(targetEntity="Company", inversedBy="workers")
     * @ORM\JoinColumn(name="company_id", referencedColumnName="id", nullable=false)
     */
    private $company;

    /**
     * Get id
     *
     * @return int
     */
    public function getId() {
        return $this->id;
    }

    /**
     * Set firstname
     *
     * @param string $firstname
     *
     * @return Worker
     */
    public function setFirstname($firstname) {
        $this->firstname = $firstname;

        return $this;
    }

    /**
     * Get firstname
     *
     * @return string
     */
    public function getFirstname() {
        return $this->firstname;
    }

    /**
     * Set lastname
     *
     * @param string $lastname
     *
     * @return Worker
     */
    public function setLastname($lastname) {
        $this->lastname = $lastname;

        return $this;
    }

    /**
     * Get lastname
     *
     * @return string
     */
    public function getLastname() {
        return $this->lastname;
    }

    /**
     * Set birthdate
     *
     * @param \DateTime $birthdate
     *
     * @return Worker
     */
    public function setBirthdate($birthdate) {
        $this->birthdate = $birthdate;

        return $this;
    }

    /**
     * Get birthdate
     *
     * @return \DateTime
     */
    public function getBirthdate() {
        return $this->birthdate;
    }

    /**
     * Set email
     *
     * @param string $email
     *
     * @return Worker
     */
    public function setEmail($email) {
        $this->email = $email;

        return $this;
    }

    /**
     * Get email
     *
     * @return string
     */
    public function getEmail() {
        return $this->email;
    }

    /**
     * Set phone
     *
     * @param string $phone
     *
     * @return Worker
     */
    public function setPhone($phone) {
        $this->phone = $phone;

        return $this;
    }

    /**
     * Get phone
     *
     * @return string
     */
    public function getPhone() {
        return $this->phone;
    }

    /**
     * Set company
     *
     * @param \Samples\CompanyBundle\Entity\Company $company
     *
     * @return Worker
     */
    public function setCompany(\Samples\CompanyBundle\Entity\Company $company) {
        $this->company = $company;

        return $this;
    }

    /**
     * Get company
     *
     * @return \Samples\CompanyBundle\Entity\Company
     */
    public function getCompany() {
        return $this->company;
    }

    public function __toString() {
        return $this->email? : '';
    }

}
