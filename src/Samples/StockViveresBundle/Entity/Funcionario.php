<?php

namespace Samples\StockViveresBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Funcionario
 *
 * @ORM\Table(name="samples_stock_viveres__funcionario")
 * @ORM\Entity
 */
class Funcionario
{
    /**
     * @var integer
     *
     * @ORM\Column(name="id", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    private $id;

    /**
     * @var string
     *
     * @ORM\Column(name="nome", type="string", length=255)
     */
    private $nome;

    /**
     * @var string
     *
     * @ORM\Column(name="bi", type="string", length=255)
     */
    private $bi;

    /**
     * @var string
     *
     * @ORM\Column(name="cargo", type="string", length=255, nullable=true)
     */
    private $cargo;

    /**
     * @ORM\OneToOne(targetEntity="\Sonata\UserBundle\Entity\BaseUser", cascade={"all"})
     * @ORM\JoinColumn(name="usuario_id", referencedColumnName="id", nullable=true)
     */
    private $usuario;
	
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
     * Set nome
     *
     * @param string $nome
     * @return Funcionario
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
     * Set bi
     *
     * @param string $bi
     * @return Funcionario
     */
    public function setBi($bi)
    {
        $this->bi = $bi;

        return $this;
    }

    /**
     * Get bi
     *
     * @return string 
     */
    public function getBi()
    {
        return $this->bi;
    }

    /**
     * Set cargo
     *
     * @param string $cargo
     * @return Funcionario
     */
    public function setCargo($cargo)
    {
        $this->cargo = $cargo;

        return $this;
    }

    /**
     * Get cargo
     *
     * @return string 
     */
    public function getCargo()
    {
        return $this->cargo;
    }

    /**
     * Set usuario
     *
     * @param \Sonata\UserBundle\Entity\BaseUser $usuario
     * @return Funcionario
     */
    public function setUsuario(\Sonata\UserBundle\Entity\BaseUser $usuario = null)
    {
        $this->usuario = $usuario;

        return $this;
    }

    /**
     * Get usuario
     *
     * @return \Sonata\UserBundle\Entity\BaseUser 
     */
    public function getUsuario()
    {
        return $this->usuario;
    }
	
	public function __toString()
	{
		return $this->id?$this->nome:"";
	}

}
