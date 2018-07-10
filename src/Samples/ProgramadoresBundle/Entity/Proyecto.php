<?php

namespace Samples\ProgramadoresBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

use Symfony\Bridge\Doctrine\Validator\Constraints\UniqueEntity;

/**
 * @ORM\Entity
 * @ORM\Table(name="samples_programadores__proyecto")
 * @ORM\Entity(repositoryClass="\Samples\ProgramadoresBundle\Manager\ProyectoRepository") 
 */
class Proyecto {

    /**
     * @ORM\Id
     * @ORM\Column(type="guid")
     * @ORM\GeneratedValue(strategy="UUID")
     */
    protected $id;

    /**
     * @ORM\Column(type="string", length=50)
     */
    protected $nombre;
    
    /**
     * @ORM\Column(type="date")
     */
    protected $fecha;
    
    /**
     * @ORM\ManyToOne(targetEntity="LenguajeProgramacion")
     * @ORM\JoinColumn(name="lenguaje_programacion_id", referencedColumnName="id")
     */
    protected $lenguaje_programacion;    
    
    /**
     * @ORM\ManyToOne(targetEntity="Programador",cascade={"persist"})
     * @ORM\JoinColumn(name="programador_id", referencedColumnName="id")
     */
    protected $programador;
    

    public function __toString() {
        return $this->getNombre()?$this->getNombre():"Proyecto";
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
     * @return LenguajeProgramacion
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
     * Set fecha
     *
     * @param \DateTime $fecha
     * @return Proyecto
     */
    public function setFecha($fecha)
    {
        $this->fecha = $fecha;
    
        return $this;
    }

    /**
     * Get fecha
     *
     * @return \DateTime 
     */
    public function getFecha()
    {
        return $this->fecha;
    }

    /**
     * Set lenguaje_programacion
     *
     * @param \Samples\ProgramadoresBundle\Entity\LenguajeProgramacion $lenguajeProgramacion
     * @return Proyecto
     */
    public function setLenguajeProgramacion(\Samples\ProgramadoresBundle\Entity\LenguajeProgramacion $lenguajeProgramacion = null)
    {
        $this->lenguaje_programacion = $lenguajeProgramacion;
    
        return $this;
    }

    /**
     * Get lenguaje_programacion
     *
     * @return \Samples\ProgramadoresBundle\Entity\LenguajeProgramacion 
     */
    public function getLenguajeProgramacion()
    {
        return $this->lenguaje_programacion;
    }

    /**
     * Set programador
     *
     * @param \Samples\ProgramadoresBundle\Entity\Programador $programador
     * @return Proyecto
     */
    public function setProgramador(\Samples\ProgramadoresBundle\Entity\Programador $programador = null)
    {
        $this->programador = $programador;
    
        return $this;
    }

    /**
     * Get programador
     *
     * @return \Samples\ProgramadoresBundle\Entity\Programador 
     */
    public function getProgramador()
    {
        return $this->programador;
    }
}
