<?php

namespace Samples\CompanyBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;
use Symfony\Bridge\Doctrine\Validator\Constraints\UniqueEntity;
use JMS\Serializer\Annotation as Serializer;
use Hateoas\Configuration\Annotation as Hateoas;

/**
 * Company
 *
 * @ORM\Table(name="samples_company__company",
 *             uniqueConstraints={
 *                                  @ORM\UniqueConstraint(name="name_unique",columns={"name"}),
 *                                  @ORM\UniqueConstraint(name="website_unique",columns={"website"}),
 * }) 
 * @ORM\Entity(repositoryClass="Samples\CompanyBundle\Repository\CompanyRepository")
 *
 * @UniqueEntity("name")
 * @UniqueEntity("website")
 * 
 * @Serializer\XmlRoot("company")
 *
 * @Hateoas\Relation("self", href = @Hateoas\Route(
 *                                          "samples_company_api_companyapi_get",
 *                                          parameters = {"id" = "expr(object.getId())"},
 *                                          absolute = false
 *                                        ))
 * @Hateoas\Relation("workers", href = @Hateoas\Route(
 *                                          "samples_company_api_companyapi_workers",
 *                                          parameters = {"id" = "expr(object.getId())"},
 *                                          absolute = true
 *                                        ))
 *
 * @Hateoas\Relation("custom", href = "expr('/app/api/companies/' ~ object.getId()~'/custom')")
 *  
 */
class Company {

    /**
     * @var int
     *
     * @ORM\Column(name="id", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     * 
     * @Serializer\XmlAttribute
     */
    private $id;

    /**
     * @var string
     *
     * @ORM\Column(name="name", type="string", length=255, unique=true)
     * @Assert\NotBlank()
     * @Assert\NotNull()
     */
    private $name;

    /**
     * @var string
     *
     * @ORM\Column(name="country", type="string", length=255, nullable=false)
     * @Assert\NotBlank()
     */
    private $country;

    /**
     * @var string
     *
     * @ORM\Column(name="website", type="string", length=255, nullable=false, unique=true)
     * @Assert\NotBlank()
     * @Assert\Url(protocols = {"http", "https"})
     */
    private $website;

    /**
     * @ORM\OneToMany(targetEntity="Worker", mappedBy="company", cascade={"all"}, orphanRemoval=true)
     * @Serializer\Exclude
     */
    private $workers;

    /**
     * Get id
     *
     * @return int
     */
    public function getId() {
        return $this->id;
    }

    /**
     * Set name
     *
     * @param string $name
     *
     * @return Company
     */
    public function setName($name) {
        $this->name = $name;

        return $this;
    }

    /**
     * Get name
     *
     * @return string
     */
    public function getName() {
        return $this->name;
    }

    /**
     * Set country
     *
     * @param string $country
     *
     * @return Company
     */
    public function setCountry($country) {
        $this->country = $country;

        return $this;
    }

    /**
     * Get country
     *
     * @return string
     */
    public function getCountry() {
        return $this->country;
    }

    /**
     * Set website
     *
     * @param string $website
     *
     * @return Company
     */
    public function setWebsite($website) {
        $this->website = $website;

        return $this;
    }

    /**
     * Get website
     *
     * @return string
     */
    public function getWebsite() {
        return $this->website;
    }

    /**
     * Constructor
     */
    public function __construct() {
        $this->workers = new \Doctrine\Common\Collections\ArrayCollection();
    }

    /**
     * Add worker
     *
     * @param \Samples\CompanyBundle\Entity\Worker $worker
     *
     * @return Company
     */
    public function addWorker(\Samples\CompanyBundle\Entity\Worker $worker) {
        $this->workers[] = $worker;

        return $this;
    }

    /**
     * Remove worker
     *
     * @param \Samples\CompanyBundle\Entity\Worker $worker
     */
    public function removeWorker(\Samples\CompanyBundle\Entity\Worker $worker) {
        $this->workers->removeElement($worker);
    }

    /**
     * Get workers
     *
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getWorkers() {
        return $this->workers;
    }

    public function __toString() {
        return $this->name? : '';
    }

}
