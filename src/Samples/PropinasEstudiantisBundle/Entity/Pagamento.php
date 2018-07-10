<?php

namespace Samples\PropinasEstudiantisBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;

/**
 * @ORM\Entity
 * @ORM\Table(name="samples_propinas_estudiantis__pagamento")
 * @ORM\Entity(repositoryClass="\Samples\PropinasEstudiantisBundle\EntityRepository\PagamentoRepository") 
 */
class Pagamento {

    /**
     * @ORM\Id
     * @ORM\Column(type="guid")
     * @ORM\GeneratedValue(strategy="UUID")
     */
    protected $id;

    /**
     * @ORM\OneToOne(targetEntity="Estudante")
     * @ORM\JoinColumn(name="estudante_id", referencedColumnName="id", nullable=false)
     */
    private $estudante;
	
    /**
     * @ORM\ManyToOne(targetEntity="AnoLectivo")
     * @ORM\JoinColumn(name="ano_lectivo_id", referencedColumnName="id", nullable=false)
     */
    protected $ano_lectivo;
	
    /**
     * @ORM\Column(type="decimal", scale=2, nullable=true)
     */
    protected $pago_mes_1;

    /**
     * @ORM\Column(type="date", nullable=true)
     */
    protected $data_pago_mes_1;

    /**
     * @ORM\Column(type="decimal", scale=2, nullable=true)
     */
    protected $pago_mes_2;

    /**
     * @ORM\Column(type="date", nullable=true)
     */
    protected $data_pago_mes_2;

    /**
     * @ORM\Column(type="decimal", scale=2, nullable=true)
     */
    protected $pago_mes_3;

    /**
     * @ORM\Column(type="date", nullable=true)
     */
    protected $data_pago_mes_3;

    /**
     * @ORM\Column(type="decimal", scale=2, nullable=true)
     */
    protected $pago_mes_4;

    /**
     * @ORM\Column(type="date", nullable=true)
     */
    protected $data_pago_mes_4;

    /**
     * @ORM\Column(type="decimal", scale=2, nullable=true)
     */
    protected $pago_mes_5;

    /**
     * @ORM\Column(type="date", nullable=true)
     */
    protected $data_pago_mes_5;

    /**
     * @ORM\Column(type="decimal", scale=2, nullable=true)
     */
    protected $pago_mes_6;

    /**
     * @ORM\Column(type="date", nullable=true)
     */
    protected $data_pago_mes_6;

    /**
     * @ORM\Column(type="decimal", scale=2, nullable=true)
     */
    protected $pago_mes_7;

    /**
     * @ORM\Column(type="date", nullable=true)
     */
    protected $data_pago_mes_7;

    /**
     * @ORM\Column(type="decimal", scale=2, nullable=true)
     */
    protected $pago_mes_8;

    /**
     * @ORM\Column(type="date", nullable=true)
     */
    protected $data_pago_mes_8;

    /**
     * @ORM\Column(type="decimal", scale=2, nullable=true)
     */
    protected $pago_mes_9;

    /**
     * @ORM\Column(type="date", nullable=true)
     */
    protected $data_pago_mes_9;

    /**
     * @ORM\Column(type="decimal", scale=2, nullable=true)
     */
    protected $pago_mes_10;

    /**
     * @ORM\Column(type="date", nullable=true)
     */
    protected $data_pago_mes_10;

    /**
     * @ORM\Column(type="decimal", scale=2, nullable=true)
     */
    protected $pago_mes_11;

    /**
     * @ORM\Column(type="date", nullable=true)
     */
    protected $data_pago_mes_11;


    /**
     * @ORM\Column(type="decimal", scale=2, nullable=true)
     */
    protected $pago_mes_12;

    /**
     * @ORM\Column(type="date", nullable=true)
     */
    protected $data_pago_mes_12;

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
     * Set pago_mes_1
     *
     * @param string $pagoMes1
     * @return Pagamento
     */
    public function setPagoMes1($pagoMes1)
    {
        $this->pago_mes_1 = $pagoMes1;

        return $this;
    }

    /**
     * Get pago_mes_1
     *
     * @return string 
     */
    public function getPagoMes1()
    {
        return $this->pago_mes_1;
    }

    /**
     * Set data_pago_mes_1
     *
     * @param \DateTime $dataPagoMes1
     * @return Pagamento
     */
    public function setDataPagoMes1($dataPagoMes1)
    {
        $this->data_pago_mes_1 = $dataPagoMes1;

        return $this;
    }

    /**
     * Get data_pago_mes_1
     *
     * @return \DateTime 
     */
    public function getDataPagoMes1()
    {
        return $this->data_pago_mes_1;
    }

    /**
     * Set estudante
     *
     * @param \Samples\PropinasEstudiantisBundle\Entity\Estudante $estudante
     * @return Pagamento
     */
    public function setEstudante(\Samples\PropinasEstudiantisBundle\Entity\Estudante $estudante)
    {
        $this->estudante = $estudante;

        return $this;
    }

    /**
     * Get estudante
     *
     * @return \Samples\PropinasEstudiantisBundle\Entity\Estudante 
     */
    public function getEstudante()
    {
        return $this->estudante;
    }

    /**
     * Set ano_lectivo
     *
     * @param \Samples\PropinasEstudiantisBundle\Entity\AnoLectivo $anoLectivo
     * @return Pagamento
     */
    public function setAnoLectivo(\Samples\PropinasEstudiantisBundle\Entity\AnoLectivo $anoLectivo)
    {
        $this->ano_lectivo = $anoLectivo;

        return $this;
    }

    /**
     * Get ano_lectivo
     *
     * @return \Samples\PropinasEstudiantisBundle\Entity\AnoLectivo 
     */
    public function getAnoLectivo()
    {
        return $this->ano_lectivo;
    }

    /**
     * Set pago_mes_2
     *
     * @param string $pagoMes2
     * @return Pagamento
     */
    public function setPagoMes2($pagoMes2)
    {
        $this->pago_mes_2 = $pagoMes2;

        return $this;
    }

    /**
     * Get pago_mes_2
     *
     * @return string 
     */
    public function getPagoMes2()
    {
        return $this->pago_mes_2;
    }

    /**
     * Set data_pago_mes_2
     *
     * @param \DateTime $dataPagoMes2
     * @return Pagamento
     */
    public function setDataPagoMes2($dataPagoMes2)
    {
        $this->data_pago_mes_2 = $dataPagoMes2;

        return $this;
    }

    /**
     * Get data_pago_mes_2
     *
     * @return \DateTime 
     */
    public function getDataPagoMes2()
    {
        return $this->data_pago_mes_2;
    }

    /**
     * Set pago_mes_3
     *
     * @param string $pagoMes3
     * @return Pagamento
     */
    public function setPagoMes3($pagoMes3)
    {
        $this->pago_mes_3 = $pagoMes3;

        return $this;
    }

    /**
     * Get pago_mes_3
     *
     * @return string 
     */
    public function getPagoMes3()
    {
        return $this->pago_mes_3;
    }

    /**
     * Set data_pago_mes_3
     *
     * @param \DateTime $dataPagoMes3
     * @return Pagamento
     */
    public function setDataPagoMes3($dataPagoMes3)
    {
        $this->data_pago_mes_3 = $dataPagoMes3;

        return $this;
    }

    /**
     * Get data_pago_mes_3
     *
     * @return \DateTime 
     */
    public function getDataPagoMes3()
    {
        return $this->data_pago_mes_3;
    }

    /**
     * Set pago_mes_4
     *
     * @param string $pagoMes4
     * @return Pagamento
     */
    public function setPagoMes4($pagoMes4)
    {
        $this->pago_mes_4 = $pagoMes4;

        return $this;
    }

    /**
     * Get pago_mes_4
     *
     * @return string 
     */
    public function getPagoMes4()
    {
        return $this->pago_mes_4;
    }

    /**
     * Set data_pago_mes_4
     *
     * @param \DateTime $dataPagoMes4
     * @return Pagamento
     */
    public function setDataPagoMes4($dataPagoMes4)
    {
        $this->data_pago_mes_4 = $dataPagoMes4;

        return $this;
    }

    /**
     * Get data_pago_mes_4
     *
     * @return \DateTime 
     */
    public function getDataPagoMes4()
    {
        return $this->data_pago_mes_4;
    }

    /**
     * Set pago_mes_5
     *
     * @param string $pagoMes5
     * @return Pagamento
     */
    public function setPagoMes5($pagoMes5)
    {
        $this->pago_mes_5 = $pagoMes5;

        return $this;
    }

    /**
     * Get pago_mes_5
     *
     * @return string 
     */
    public function getPagoMes5()
    {
        return $this->pago_mes_5;
    }

    /**
     * Set data_pago_mes_5
     *
     * @param \DateTime $dataPagoMes5
     * @return Pagamento
     */
    public function setDataPagoMes5($dataPagoMes5)
    {
        $this->data_pago_mes_5 = $dataPagoMes5;

        return $this;
    }

    /**
     * Get data_pago_mes_5
     *
     * @return \DateTime 
     */
    public function getDataPagoMes5()
    {
        return $this->data_pago_mes_5;
    }

    /**
     * Set pago_mes_6
     *
     * @param string $pagoMes6
     * @return Pagamento
     */
    public function setPagoMes6($pagoMes6)
    {
        $this->pago_mes_6 = $pagoMes6;

        return $this;
    }

    /**
     * Get pago_mes_6
     *
     * @return string 
     */
    public function getPagoMes6()
    {
        return $this->pago_mes_6;
    }

    /**
     * Set data_pago_mes_6
     *
     * @param \DateTime $dataPagoMes6
     * @return Pagamento
     */
    public function setDataPagoMes6($dataPagoMes6)
    {
        $this->data_pago_mes_6 = $dataPagoMes6;

        return $this;
    }

    /**
     * Get data_pago_mes_6
     *
     * @return \DateTime 
     */
    public function getDataPagoMes6()
    {
        return $this->data_pago_mes_6;
    }

    /**
     * Set pago_mes_7
     *
     * @param string $pagoMes7
     * @return Pagamento
     */
    public function setPagoMes7($pagoMes7)
    {
        $this->pago_mes_7 = $pagoMes7;

        return $this;
    }

    /**
     * Get pago_mes_7
     *
     * @return string 
     */
    public function getPagoMes7()
    {
        return $this->pago_mes_7;
    }

    /**
     * Set data_pago_mes_7
     *
     * @param \DateTime $dataPagoMes7
     * @return Pagamento
     */
    public function setDataPagoMes7($dataPagoMes7)
    {
        $this->data_pago_mes_7 = $dataPagoMes7;

        return $this;
    }

    /**
     * Get data_pago_mes_7
     *
     * @return \DateTime 
     */
    public function getDataPagoMes7()
    {
        return $this->data_pago_mes_7;
    }

    /**
     * Set pago_mes_8
     *
     * @param string $pagoMes8
     * @return Pagamento
     */
    public function setPagoMes8($pagoMes8)
    {
        $this->pago_mes_8 = $pagoMes8;

        return $this;
    }

    /**
     * Get pago_mes_8
     *
     * @return string 
     */
    public function getPagoMes8()
    {
        return $this->pago_mes_8;
    }

    /**
     * Set data_pago_mes_8
     *
     * @param \DateTime $dataPagoMes8
     * @return Pagamento
     */
    public function setDataPagoMes8($dataPagoMes8)
    {
        $this->data_pago_mes_8 = $dataPagoMes8;

        return $this;
    }

    /**
     * Get data_pago_mes_8
     *
     * @return \DateTime 
     */
    public function getDataPagoMes8()
    {
        return $this->data_pago_mes_8;
    }

    /**
     * Set pago_mes_9
     *
     * @param string $pagoMes9
     * @return Pagamento
     */
    public function setPagoMes9($pagoMes9)
    {
        $this->pago_mes_9 = $pagoMes9;

        return $this;
    }

    /**
     * Get pago_mes_9
     *
     * @return string 
     */
    public function getPagoMes9()
    {
        return $this->pago_mes_9;
    }

    /**
     * Set data_pago_mes_9
     *
     * @param \DateTime $dataPagoMes9
     * @return Pagamento
     */
    public function setDataPagoMes9($dataPagoMes9)
    {
        $this->data_pago_mes_9 = $dataPagoMes9;

        return $this;
    }

    /**
     * Get data_pago_mes_9
     *
     * @return \DateTime 
     */
    public function getDataPagoMes9()
    {
        return $this->data_pago_mes_9;
    }

    /**
     * Set pago_mes_10
     *
     * @param string $pagoMes10
     * @return Pagamento
     */
    public function setPagoMes10($pagoMes10)
    {
        $this->pago_mes_10 = $pagoMes10;

        return $this;
    }

    /**
     * Get pago_mes_10
     *
     * @return string 
     */
    public function getPagoMes10()
    {
        return $this->pago_mes_10;
    }

    /**
     * Set data_pago_mes_10
     *
     * @param \DateTime $dataPagoMes10
     * @return Pagamento
     */
    public function setDataPagoMes10($dataPagoMes10)
    {
        $this->data_pago_mes_10 = $dataPagoMes10;

        return $this;
    }

    /**
     * Get data_pago_mes_10
     *
     * @return \DateTime 
     */
    public function getDataPagoMes10()
    {
        return $this->data_pago_mes_10;
    }

    /**
     * Set pago_mes_11
     *
     * @param string $pagoMes11
     * @return Pagamento
     */
    public function setPagoMes11($pagoMes11)
    {
        $this->pago_mes_11 = $pagoMes11;

        return $this;
    }

    /**
     * Get pago_mes_11
     *
     * @return string 
     */
    public function getPagoMes11()
    {
        return $this->pago_mes_11;
    }

    /**
     * Set data_pago_mes_11
     *
     * @param \DateTime $dataPagoMes11
     * @return Pagamento
     */
    public function setDataPagoMes11($dataPagoMes11)
    {
        $this->data_pago_mes_11 = $dataPagoMes11;

        return $this;
    }

    /**
     * Get data_pago_mes_11
     *
     * @return \DateTime 
     */
    public function getDataPagoMes11()
    {
        return $this->data_pago_mes_11;
    }

    /**
     * Set pago_mes_12
     *
     * @param string $pagoMes12
     * @return Pagamento
     */
    public function setPagoMes12($pagoMes12)
    {
        $this->pago_mes_12 = $pagoMes12;

        return $this;
    }

    /**
     * Get pago_mes_12
     *
     * @return string 
     */
    public function getPagoMes12()
    {
        return $this->pago_mes_12;
    }

    /**
     * Set data_pago_mes_12
     *
     * @param \DateTime $dataPagoMes12
     * @return Pagamento
     */
    public function setDataPagoMes12($dataPagoMes12)
    {
        $this->data_pago_mes_12 = $dataPagoMes12;

        return $this;
    }

    /**
     * Get data_pago_mes_12
     *
     * @return \DateTime 
     */
    public function getDataPagoMes12()
    {
        return $this->data_pago_mes_12;
    }
}
