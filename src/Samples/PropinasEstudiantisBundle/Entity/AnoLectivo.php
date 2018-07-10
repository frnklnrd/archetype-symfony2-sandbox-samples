<?php

namespace Samples\PropinasEstudiantisBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Symfony\Bridge\Doctrine\Validator\Constraints\UniqueEntity;

/**
 * @ORM\Entity
 * @ORM\Table(name="samples_propinas_estudiantis__ano_lectivo")
 * @ORM\Entity(repositoryClass="\Samples\PropinasEstudiantisBundle\EntityRepository\AnoLectivoRepository") 
 */
class AnoLectivo {

    /**
     * @ORM\Id
     * @ORM\Column(type="guid")
     * @ORM\GeneratedValue(strategy="UUID")
     */
    private $id;

    /**
     * @ORM\Column(type="integer")
     */
    protected $ano;
		
    /**
     * @ORM\Column(type="decimal", scale=2, nullable=true)
     */
    protected $custo_mes_1;
	
    /**
     * @ORM\Column(type="decimal", scale=2, nullable=true)
     */
    protected $custo_mes_2;

    /**
     * @ORM\Column(type="decimal", scale=2, nullable=true)
     */
    protected $custo_mes_3;

    /**
     * @ORM\Column(type="decimal", scale=2, nullable=true)
     */
    protected $custo_mes_4;

    /**
     * @ORM\Column(type="decimal", scale=2, nullable=true)
     */
    protected $custo_mes_5;

    /**
     * @ORM\Column(type="decimal", scale=2, nullable=true)
     */
    protected $custo_mes_6;

    /**
     * @ORM\Column(type="decimal", scale=2, nullable=true)
     */
    protected $custo_mes_7;

    /**
     * @ORM\Column(type="decimal", scale=2, nullable=true)
     */
    protected $custo_mes_8;

    /**
     * @ORM\Column(type="decimal", scale=2, nullable=true)
     */
    protected $custo_mes_9;

    /**
     * @ORM\Column(type="decimal", scale=2, nullable=true)
     */
    protected $custo_mes_10;

    /**
     * @ORM\Column(type="decimal", scale=2, nullable=true)
     */
    protected $custo_mes_11;

    /**
     * @ORM\Column(type="decimal", scale=2, nullable=true)
     */
    protected $custo_mes_12;

    public function __toString() {
        return "".($this->getAno() ? $this->getAno() : "Ano Lectivo");
    }

    public function getPagoDoMes($i)
    {
        switch($i)
		{
			case 1:
				return $this->custo_mes_1;
			case 2:
				return $this->custo_mes_2;
			case 3:
				return $this->custo_mes_3;
			case 4:
				return $this->custo_mes_4;
			case 5:
				return $this->custo_mes_5;
			case 6:
				return $this->custo_mes_6;
			case 7:
				return $this->custo_mes_7;
			case 8:
				return $this->custo_mes_8;
			case 9:
				return $this->custo_mes_9;
			case 10:
				return $this->custo_mes_10;
			case 11:
				return $this->custo_mes_11;
			case 12:
				return $this->custo_mes_12;
			default:
				return null;
		}
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
     * Set ano
     *
     * @param integer $ano
     * @return AnoLectivo
     */
    public function setAno($ano)
    {
        $this->ano = $ano;

        return $this;
    }

    /**
     * Get ano
     *
     * @return integer 
     */
    public function getAno()
    {
        return $this->ano;
    }

    /**
     * Set custo_mes_1
     *
     * @param string $custoMes1
     * @return AnoLectivo
     */
    public function setCustoMes1($custoMes1)
    {
        $this->custo_mes_1 = $custoMes1;

        return $this;
    }

    /**
     * Get custo_mes_1
     *
     * @return string 
     */
    public function getCustoMes1()
    {
        return $this->custo_mes_1;
    }

    /**
     * Set custo_mes_2
     *
     * @param string $custoMes2
     * @return AnoLectivo
     */
    public function setCustoMes2($custoMes2)
    {
        $this->custo_mes_2 = $custoMes2;

        return $this;
    }

    /**
     * Get custo_mes_2
     *
     * @return string 
     */
    public function getCustoMes2()
    {
        return $this->custo_mes_2;
    }

    /**
     * Set custo_mes_3
     *
     * @param string $custoMes3
     * @return AnoLectivo
     */
    public function setCustoMes3($custoMes3)
    {
        $this->custo_mes_3 = $custoMes3;

        return $this;
    }

    /**
     * Get custo_mes_3
     *
     * @return string 
     */
    public function getCustoMes3()
    {
        return $this->custo_mes_3;
    }

    /**
     * Set custo_mes_4
     *
     * @param string $custoMes4
     * @return AnoLectivo
     */
    public function setCustoMes4($custoMes4)
    {
        $this->custo_mes_4 = $custoMes4;

        return $this;
    }

    /**
     * Get custo_mes_4
     *
     * @return string 
     */
    public function getCustoMes4()
    {
        return $this->custo_mes_4;
    }

    /**
     * Set custo_mes_5
     *
     * @param string $custoMes5
     * @return AnoLectivo
     */
    public function setCustoMes5($custoMes5)
    {
        $this->custo_mes_5 = $custoMes5;

        return $this;
    }

    /**
     * Get custo_mes_5
     *
     * @return string 
     */
    public function getCustoMes5()
    {
        return $this->custo_mes_5;
    }

    /**
     * Set custo_mes_6
     *
     * @param string $custoMes6
     * @return AnoLectivo
     */
    public function setCustoMes6($custoMes6)
    {
        $this->custo_mes_6 = $custoMes6;

        return $this;
    }

    /**
     * Get custo_mes_6
     *
     * @return string 
     */
    public function getCustoMes6()
    {
        return $this->custo_mes_6;
    }

    /**
     * Set custo_mes_7
     *
     * @param string $custoMes7
     * @return AnoLectivo
     */
    public function setCustoMes7($custoMes7)
    {
        $this->custo_mes_7 = $custoMes7;

        return $this;
    }

    /**
     * Get custo_mes_7
     *
     * @return string 
     */
    public function getCustoMes7()
    {
        return $this->custo_mes_7;
    }

    /**
     * Set custo_mes_8
     *
     * @param string $custoMes8
     * @return AnoLectivo
     */
    public function setCustoMes8($custoMes8)
    {
        $this->custo_mes_8 = $custoMes8;

        return $this;
    }

    /**
     * Get custo_mes_8
     *
     * @return string 
     */
    public function getCustoMes8()
    {
        return $this->custo_mes_8;
    }

    /**
     * Set custo_mes_9
     *
     * @param string $custoMes9
     * @return AnoLectivo
     */
    public function setCustoMes9($custoMes9)
    {
        $this->custo_mes_9 = $custoMes9;

        return $this;
    }

    /**
     * Get custo_mes_9
     *
     * @return string 
     */
    public function getCustoMes9()
    {
        return $this->custo_mes_9;
    }

    /**
     * Set custo_mes_10
     *
     * @param string $custoMes10
     * @return AnoLectivo
     */
    public function setCustoMes10($custoMes10)
    {
        $this->custo_mes_10 = $custoMes10;

        return $this;
    }

    /**
     * Get custo_mes_10
     *
     * @return string 
     */
    public function getCustoMes10()
    {
        return $this->custo_mes_10;
    }

    /**
     * Set custo_mes_11
     *
     * @param string $custoMes11
     * @return AnoLectivo
     */
    public function setCustoMes11($custoMes11)
    {
        $this->custo_mes_11 = $custoMes11;

        return $this;
    }

    /**
     * Get custo_mes_11
     *
     * @return string 
     */
    public function getCustoMes11()
    {
        return $this->custo_mes_11;
    }

    /**
     * Set custo_mes_12
     *
     * @param string $custoMes12
     * @return AnoLectivo
     */
    public function setCustoMes12($custoMes12)
    {
        $this->custo_mes_12 = $custoMes12;

        return $this;
    }

    /**
     * Get custo_mes_12
     *
     * @return string 
     */
    public function getCustoMes12()
    {
        return $this->custo_mes_12;
    }
}
