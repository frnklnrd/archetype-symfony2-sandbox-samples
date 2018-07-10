<?php

namespace Samples\PropinasEstudiantisBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

use Symfony\Bridge\Doctrine\Validator\Constraints\UniqueEntity;

/**
 * @ORM\Entity
 * @ORM\Table(name="samples_propinas_estudiantis__municipio")
 * @ORM\Entity(repositoryClass="\Samples\PropinasEstudiantisBundle\EntityRepository\MunicipioRepository") 
 */
class Municipio {

    /**
     * @ORM\Id
     * @ORM\Column(type="guid")
     * @ORM\GeneratedValue(strategy="UUID")
     */
    protected $id;

    /**
     * @ORM\Column(type="string")
     */
    protected $nome;
    
    /**
     * @ORM\ManyToOne(targetEntity="Provincia")
     * @ORM\JoinColumn(name="provincia_id", referencedColumnName="id")
     */
    protected $provincia;    

    public function __toString() {
        return $this->getNome()?$this->getNome():"Municipio";
    }


    /**
     * Get id
     *
     * @return integer 
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * Set nombre
     *
     * @param string $nombre
     * @return string
     */
    public function setNombre($nombre)
    {
        $this->nombre = $nombre;
    
        return $this;
    }

    /**
     * Get nombre
     *
     * @return string 
     */
    public function getNombre()
    {
        return $this->nombre;
    }

    /**
     * Set nome
     *
     * @param string $nome
     * @return Municipio
     */
    public function setNome($nome)
    {
        $this->nome = $nome;

        return $this;
    }

    /**
     * Get nome
     *
     * @return string 
     */
    public function getNome()
    {
        return $this->nome;
    }

    /**
     * Set provincia
     *
     * @param \Samples\PropinasEstudiantisBundle\Entity\Provincia $provincia
     * @return Municipio
     */
    public function setProvincia(\Samples\PropinasEstudiantisBundle\Entity\Provincia $provincia = null)
    {
        $this->provincia = $provincia;

        return $this;
    }

    /**
     * Get provincia
     *
     * @return \Samples\PropinasEstudiantisBundle\Entity\Provincia 
     */
    public function getProvincia()
    {
        return $this->provincia;
    }
}
