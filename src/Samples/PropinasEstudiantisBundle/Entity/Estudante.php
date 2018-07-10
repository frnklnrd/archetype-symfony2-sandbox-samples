<?php

namespace Samples\PropinasEstudiantisBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;

use Symfony\Bridge\Doctrine\Validator\Constraints\UniqueEntity;

/**
 * @ORM\Entity
 * @ORM\Table(name="samples_propinas_estudiantis__estudante")
 * @ORM\Entity(repositoryClass="\Samples\PropinasEstudiantisBundle\EntityRepository\EstudanteRepository") 
 */
class Estudante {

    /**
     * @ORM\Id
     * @ORM\Column(type="guid")
     * @ORM\GeneratedValue(strategy="UUID")
     */
    protected $id;

    /**
     * @ORM\Column(type="string")
     */
    protected $bi;

    /**
     * @ORM\Column(type="string")
     */
    protected $nome;

    /**
     * @ORM\Column(type="date", nullable=true)
     */
    protected $data_nacimento;

    /**
     * @ORM\ManyToOne(targetEntity="Provincia")
     * @ORM\JoinColumn(name="provincia_id", referencedColumnName="id", nullable=true)
     */
    protected $provincia_nacimento;

    /**
     * @ORM\ManyToOne(targetEntity="Municipio")
     * @ORM\JoinColumn(name="municipio_id", referencedColumnName="id", nullable=true)
     */
    protected $municipio_nacimento;

    /**
     * @ORM\ManyToOne(targetEntity="Turma")
     * @ORM\JoinColumn(name="turma_id", referencedColumnName="id")
     */
    protected $turma;

    /**
     * @ORM\ManyToOne(targetEntity="Curso")
     * @ORM\JoinColumn(name="curso_id", referencedColumnName="id")
     */
    protected $curso;

    /**
     * @ORM\ManyToOne(targetEntity="Classe")
     * @ORM\JoinColumn(name="classe_id", referencedColumnName="id")
     */
    protected $classe;

    /**
     * @ORM\OneToOne(targetEntity="Pagamento", mappedBy="estudante",cascade={"all"})
     * @Assert\Valid()
     */
    private $pagamento;
	
    public function __toString() {
        return $this->getNome() ? $this->getNome() : "Estudante";
    }

    public function getPagoMes1()
    {
        return ($this->getPagamento()->getDataPagoMes1()!=null);
    }
    public function getPagoMes2()
    {
        return ($this->getPagamento()->getDataPagoMes2()!=null);
    }
    public function getPagoMes3()
    {
        return ($this->getPagamento()->getDataPagoMes3()!=null);
    }
    public function getPagoMes4()
    {
        return ($this->getPagamento()->getDataPagoMes4()!=null);
    }
    public function getPagoMes5()
    {
        return ($this->getPagamento()->getDataPagoMes5()!=null);
    }
    public function getPagoMes6()
    {
        return ($this->getPagamento()->getDataPagoMes6()!=null);
    }
    public function getPagoMes7()
    {
        return ($this->getPagamento()->getDataPagoMes7()!=null);
    }
    public function getPagoMes8()
    {
        return ($this->getPagamento()->getDataPagoMes8()!=null);
    }
    public function getPagoMes9()
    {
        return ($this->getPagamento()->getDataPagoMes9()!=null);
    }
    public function getPagoMes10()
    {
        return ($this->getPagamento()->getDataPagoMes10()!=null);
    }
    public function getPagoMes11()
    {
        return ($this->getPagamento()->getDataPagoMes11()!=null);
    }
    public function getPagoMes12()
    {
        return ($this->getPagamento()->getDataPagoMes12()!=null);
    }
	
    public function getClasseTurma()
    {
        return $this->getClasse()." ".$this->getTurma();
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
     * Set bi
     *
     * @param string $bi
     * @return Estudante
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
     * Set nome
     *
     * @param string $nome
     * @return Estudante
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
     * Set data_nacimento
     *
     * @param \DateTime $dataNacimento
     * @return Estudante
     */
    public function setDataNacimento($dataNacimento)
    {
        $this->data_nacimento = $dataNacimento;

        return $this;
    }

    /**
     * Get data_nacimento
     *
     * @return \DateTime 
     */
    public function getDataNacimento()
    {
        return $this->data_nacimento;
    }

    /**
     * Set provincia_nacimento
     *
     * @param \Samples\PropinasEstudiantisBundle\Entity\Provincia $provinciaNacimento
     * @return Estudante
     */
    public function setProvinciaNacimento(\Samples\PropinasEstudiantisBundle\Entity\Provincia $provinciaNacimento = null)
    {
        $this->provincia_nacimento = $provinciaNacimento;

        return $this;
    }

    /**
     * Get provincia_nacimento
     *
     * @return \Samples\PropinasEstudiantisBundle\Entity\Provincia 
     */
    public function getProvinciaNacimento()
    {
        return $this->provincia_nacimento;
    }

    /**
     * Set municipio_nacimento
     *
     * @param \Samples\PropinasEstudiantisBundle\Entity\Municipio $municipioNacimento
     * @return Estudante
     */
    public function setMunicipioNacimento(\Samples\PropinasEstudiantisBundle\Entity\Municipio $municipioNacimento = null)
    {
        $this->municipio_nacimento = $municipioNacimento;

        return $this;
    }

    /**
     * Get municipio_nacimento
     *
     * @return \Samples\PropinasEstudiantisBundle\Entity\Municipio 
     */
    public function getMunicipioNacimento()
    {
        return $this->municipio_nacimento;
    }

    /**
     * Set turma
     *
     * @param \Samples\PropinasEstudiantisBundle\Entity\Turma $turma
     * @return Estudante
     */
    public function setTurma(\Samples\PropinasEstudiantisBundle\Entity\Turma $turma = null)
    {
        $this->turma = $turma;

        return $this;
    }

    /**
     * Get turma
     *
     * @return \Samples\PropinasEstudiantisBundle\Entity\Turma 
     */
    public function getTurma()
    {
        return $this->turma;
    }

    /**
     * Set curso
     *
     * @param \Samples\PropinasEstudiantisBundle\Entity\Curso $curso
     * @return Estudante
     */
    public function setCurso(\Samples\PropinasEstudiantisBundle\Entity\Curso $curso = null)
    {
        $this->curso = $curso;

        return $this;
    }

    /**
     * Get curso
     *
     * @return \Samples\PropinasEstudiantisBundle\Entity\Curso 
     */
    public function getCurso()
    {
        return $this->curso;
    }

    /**
     * Set classe
     *
     * @param \Samples\PropinasEstudiantisBundle\Entity\Classe $classe
     * @return Estudante
     */
    public function setClasse(\Samples\PropinasEstudiantisBundle\Entity\Classe $classe = null)
    {
        $this->classe = $classe;

        return $this;
    }

    /**
     * Get classe
     *
     * @return \Samples\PropinasEstudiantisBundle\Entity\Classe 
     */
    public function getClasse()
    {
        return $this->classe;
    }

    /**
     * Set pagamento
     *
     * @param \Samples\PropinasEstudiantisBundle\Entity\Pagamento $pagamento
     * @return Estudante
     */
    public function setPagamento(\Samples\PropinasEstudiantisBundle\Entity\Pagamento $pagamento = null)
    {
        $this->pagamento = $pagamento;

        return $this;
    }

    /**
     * Get pagamento
     *
     * @return \Samples\PropinasEstudiantisBundle\Entity\Pagamento 
     */
    public function getPagamento()
    {
        return $this->pagamento;
    }
}
