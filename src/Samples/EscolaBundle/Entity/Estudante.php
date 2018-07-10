<?php

namespace Samples\EscolaBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Estudante
 *
 * @ORM\Table(name="samples_escola__estudante")
 * @ORM\Entity
 */
class Estudante
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
     * @var \DateTime
     *
     * @ORM\Column(name="data_nascimento", type="date")
     */
    private $dataNascimento;
	
    /**
     * @ORM\OneToOne(targetEntity="Image",cascade={"all"})
     * @ORM\JoinColumn(name="foto_id", referencedColumnName="id", nullable=false)
     */
    private $foto;

    /**
     * @ORM\ManyToMany(targetEntity="Evento")
     * @ORM\JoinTable(name="samples_escola__evento_participacao",
	 *           joinColumns={@ORM\JoinColumn(name="estudante_id", referencedColumnName="id")},
     *           inverseJoinColumns={@ORM\JoinColumn(name="evento_id",referencedColumnName="id")})
     */
    private $eventos;	

    /**
     * @ORM\OneToMany(targetEntity="Pesquisa", mappedBy="estudante",cascade={"all"})
     */
    private $pesquisas;
	
    /**
     * @ORM\OneToOne(targetEntity="Morada", mappedBy="estudante", cascade={"all"})
     */
    private $morada;	
	
    /**
     * @ORM\ManyToOne(targetEntity="Curso")
     * @ORM\JoinColumn(name="curso_id", referencedColumnName="id")
     */
    private $curso;
	
    /**
     * @ORM\ManyToOne(targetEntity="Turma")
     * @ORM\JoinColumn(name="turma_id", referencedColumnName="id")
     */
    private $turma;	
	
    /**
     * @ORM\ManyToOne(targetEntity="Ano")
     * @ORM\JoinColumn(name="ano_id", referencedColumnName="id")
     */
    private $ano;

    /**
     * @ORM\ManyToOne(targetEntity="Disciplina")
     * @ORM\JoinColumn(name="disciplina_id", referencedColumnName="id")
     */
    private $disciplina_favorita;

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
     * Set dataNascimento
     *
     * @param \DateTime $dataNascimento
     * @return Estudante
     */
    public function setDataNascimento($dataNascimento)
    {
        $this->dataNascimento = $dataNascimento;

        return $this;
    }

    /**
     * Get dataNascimento
     *
     * @return \DateTime 
     */
    public function getDataNascimento()
    {
        return $this->dataNascimento;
    }

    /**
     * Add pesquisas
     *
     * @param \Samples\EscolaBundle\Entity\Pesquisa $pesquisas
     * @return Estudante
     */
    public function addPesquisa(\Samples\EscolaBundle\Entity\Pesquisa $pesquisas)
    {
        $this->pesquisas[] = $pesquisas;

        return $this;
    }

    /**
     * Remove pesquisas
     *
     * @param \Samples\EscolaBundle\Entity\Pesquisa $pesquisas
     */
    public function removePesquisa(\Samples\EscolaBundle\Entity\Pesquisa $pesquisas)
    {
        $this->pesquisas->removeElement($pesquisas);
    }

    /**
     * Get pesquisas
     *
     * @return \Doctrine\Common\Collections\Collection 
     */
    public function getPesquisas()
    {
        return $this->pesquisas;
    }

    /**
     * Set foto
     *
     * @param \Samples\EscolaBundle\Entity\Image $foto
     * @return Estudante
     */
    public function setFoto(\Samples\EscolaBundle\Entity\Image $foto)
    {
        $this->foto = $foto;

        return $this;
    }

    /**
     * Get foto
     *
     * @return \Samples\EscolaBundle\Entity\Image 
     */
    public function getFoto()
    {
        return $this->foto;
    }
	
	public function __toString()
	{
		return $this->id? $this->getNome():"";
	}

    /**
     * Set morada
     *
     * @param \Samples\EscolaBundle\Entity\Morada $morada
     * @return Estudante
     */
    public function setMorada(\Samples\EscolaBundle\Entity\Morada $morada = null)
    {
        $this->morada = $morada;

        return $this;
    }

    /**
     * Get morada
     *
     * @return \Samples\EscolaBundle\Entity\Morada 
     */
    public function getMorada()
    {
        return $this->morada;
    }

    /**
     * Set curso
     *
     * @param \Samples\EscolaBundle\Entity\Curso $curso
     * @return Estudante
     */
    public function setCurso(\Samples\EscolaBundle\Entity\Curso $curso = null)
    {
        $this->curso = $curso;

        return $this;
    }

    /**
     * Get curso
     *
     * @return \Samples\EscolaBundle\Entity\Curso 
     */
    public function getCurso()
    {
        return $this->curso;
    }

    /**
     * Set turma
     *
     * @param \Samples\EscolaBundle\Entity\Turma $turma
     * @return Estudante
     */
    public function setTurma(\Samples\EscolaBundle\Entity\Turma $turma = null)
    {
        $this->turma = $turma;

        return $this;
    }

    /**
     * Get turma
     *
     * @return \Samples\EscolaBundle\Entity\Turma 
     */
    public function getTurma()
    {
        return $this->turma;
    }

    /**
     * Set ano
     *
     * @param \Samples\EscolaBundle\Entity\Ano $ano
     * @return Estudante
     */
    public function setAno(\Samples\EscolaBundle\Entity\Ano $ano = null)
    {
        $this->ano = $ano;

        return $this;
    }

    /**
     * Get ano
     *
     * @return \Samples\EscolaBundle\Entity\Ano 
     */
    public function getAno()
    {
        return $this->ano;
    }

    /**
     * Set disciplina_favorita
     *
     * @param \Samples\EscolaBundle\Entity\Disciplina $disciplinaFavorita
     * @return Estudante
     */
    public function setDisciplinaFavorita(\Samples\EscolaBundle\Entity\Disciplina $disciplinaFavorita = null)
    {
        $this->disciplina_favorita = $disciplinaFavorita;

        return $this;
    }

    /**
     * Get disciplina_favorita
     *
     * @return \Samples\EscolaBundle\Entity\Disciplina 
     */
    public function getDisciplinaFavorita()
    {
        return $this->disciplina_favorita;
    }

    /**
     * Add eventos
     *
     * @param \Samples\EscolaBundle\Entity\Evento $eventos
     * @return Estudante
     */
    public function addEvento(\Samples\EscolaBundle\Entity\Evento $eventos)
    {
        $this->eventos[] = $eventos;

        return $this;
    }

    /**
     * Remove eventos
     *
     * @param \Samples\EscolaBundle\Entity\Evento $eventos
     */
    public function removeEvento(\Samples\EscolaBundle\Entity\Evento $eventos)
    {
        $this->eventos->removeElement($eventos);
    }

    /**
     * Get eventos
     *
     * @return \Doctrine\Common\Collections\Collection 
     */
    public function getEventos()
    {
        return $this->eventos;
    }
    /**
     * Constructor
     */
    public function __construct()
    {
        $this->eventos = new \Doctrine\Common\Collections\ArrayCollection();
        $this->pesquisas = new \Doctrine\Common\Collections\ArrayCollection();
    }

}
