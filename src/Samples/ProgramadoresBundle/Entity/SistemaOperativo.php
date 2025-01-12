<?php

namespace Samples\ProgramadoresBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

use Symfony\Bridge\Doctrine\Validator\Constraints\UniqueEntity;

/**
 * @ORM\Entity
 * @ORM\Table(name="samples_programadores__sistema_operativo")
 * @ORM\Entity(repositoryClass="\Samples\ProgramadoresBundle\Manager\SistemaOperativoRepository")
 * @UniqueEntity(fields={"nombre"})  
 */
class SistemaOperativo {

    /**
     * @ORM\Id
     * @ORM\Column(type="guid")
     * @ORM\GeneratedValue(strategy="UUID")
     */
    protected $id;

    /**
     * @ORM\Column(type="string", length=50, unique=true)
     */
    protected $nombre;

    public function __toString() {
        return $this->getNombre()?$this->getNombre():"Sistema Operativo";
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
     * @return SistemaOperativo
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
}
