<?php

namespace Samples\PropinasEstudiantisBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

use Symfony\Bridge\Doctrine\Validator\Constraints\UniqueEntity;

/**
 * @ORM\Entity
 * @ORM\Table(name="samples_propinas_estudiantis__classe")
 * @ORM\Entity(repositoryClass="\Samples\PropinasEstudiantisBundle\EntityRepository\ClasseRepository") 
 */
class Classe {

    /**
     * @ORM\Id
     * @ORM\Column(type="guid")
     * @ORM\GeneratedValue(strategy="UUID")
     */
    protected $id;

    /**
     * @ORM\Column(type="integer")
     */
    protected $numero;
    
    /**
     * @ORM\Column(type="string")
     */
    protected $nome;
    
    public function __toString() {
        return $this->getNome()?$this->getNome():"Classe";
    }

    /**
     * Get id
     *
     * @return guid 
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * Set numero
     *
     * @param integer $numero
     * @return Classe
     */
    public function setNumero($numero)
    {
        $this->numero = $numero;

        return $this;
    }

    /**
     * Get numero
     *
     * @return integer 
     */
    public function getNumero()
    {
        return $this->numero;
    }

    /**
     * Set nome
     *
     * @param string $nome
     * @return Classe
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
}
