<?php

namespace Samples\EscuelaBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;

/**
 * @ORM\Entity
 * @ORM\Table(name="samples_escuela__curso_recibido")
 */
class CursoRecibido {

    /**
     * @ORM\Id
     * @ORM\Column(type="integer")
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    protected $id;

    /**
     * @ORM\ManyToOne(targetEntity="Estudiante")
     * @ORM\JoinColumn(name="estudiante_id", referencedColumnName="id", nullable=false)
     */
    protected $estudiante;

    /**
     * @ORM\ManyToOne(targetEntity="Asignatura")
     * @ORM\JoinColumn(name="asignatura_id", referencedColumnName="id", nullable=false)
     */
    protected $asignatura;

    /**
     * @ORM\Column(type="integer", nullable=false)
     * @Assert\Range(min=1, max=5, minMessage="Debe ser mayor o igual que {{ limit }}", maxMessage="Debe ser menor o igual que {{ limit }}", invalidMessage="Debe ser un número entre 1 y 5")
     * @Assert\Type(type="integer", message="Debe ser un valor entero")
     */
    private $nota;

    public function __toString() {
        return $this->getAsignatura() . " : " . $this->getNota();
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
     * Set nota
     *
     * @param integer $nota
     * @return CursoRecibido
     */
    public function setNota($nota)
    {
        $this->nota = $nota;
    
        return $this;
    }

    /**
     * Get nota
     *
     * @return integer 
     */
    public function getNota()
    {
        return $this->nota;
    }

    /**
     * Set estudiante
     *
     * @param \Samples\EscuelaBundle\Entity\Estudiante $estudiante
     * @return CursoRecibido
     */
    public function setEstudiante(\Samples\EscuelaBundle\Entity\Estudiante $estudiante)
    {
        $this->estudiante = $estudiante;
    
        return $this;
    }

    /**
     * Get estudiante
     *
     * @return \Samples\EscuelaBundle\Entity\Estudiante 
     */
    public function getEstudiante()
    {
        return $this->estudiante;
    }

    /**
     * Set asignatura
     *
     * @param \Samples\EscuelaBundle\Entity\Asignatura $asignatura
     * @return CursoRecibido
     */
    public function setAsignatura(\Samples\EscuelaBundle\Entity\Asignatura $asignatura)
    {
        $this->asignatura = $asignatura;
    
        return $this;
    }

    /**
     * Get asignatura
     *
     * @return \Samples\EscuelaBundle\Entity\Asignatura 
     */
    public function getAsignatura()
    {
        return $this->asignatura;
    }
}