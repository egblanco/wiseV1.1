<?php

namespace AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Alquiler
 *
 * @ORM\Table()
 * @ORM\Entity(repositoryClass="AppBundle\Entity\AlquilerRepository")   
 */
class Alquiler
{
    /**
     * @var integer
     *
     * @ORM\Id
     * @ORM\Column(type="string", length=36)
     * @ORM\GeneratedValue(strategy="UUID")
     */
    private $id;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="fecha_inicio", type="datetime")
     */
    private $fechaInicio;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="fecha_fin", type="datetime")
     */
    private $fechaFin;

    /**
     * @var string
     *
     * @ORM\Column(name="codigo", type="string", length=255)
     */
    private $codigo;

    /**
     * @var float
     *
     * @ORM\Column(name="total", type="float")
     */
    private $total;

    /**
     * @var array
     *
     * @ORM\OneToMany(targetEntity="AlquilerArticulo", mappedBy="alquiler", cascade={"all"})
     */
    private $alquilerArticulos;

    /**
     * @ORM\OneToOne(targetEntity="Cliente")
     * @ORM\JoinColumn(name="id_cliente", referencedColumnName="id")
     */
    private $cliente;

    /**
     * @ORM\ManyToOne(targetEntity="Lugar", inversedBy="alquileresRecogida")
     * @ORM\JoinColumn(name="id_recogida", referencedColumnName="id")
     */
    private $lugarRecogida;

    /**
     * @ORM\ManyToOne(targetEntity="Lugar", inversedBy="alquileresRegreso")
     * @ORM\JoinColumn(name="id_regreso", referencedColumnName="id")
     */
    private $lugarRegreso;

    /**
     * @ORM\ManyToOne(targetEntity="Oferta", inversedBy="alquileres")
     * @ORM\JoinColumn(name="id_oferta", referencedColumnName="id", nullable=false)
     */
    private $oferta;

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
     * Set fechaInicio
     *
     * @param \DateTime $fechaInicio
     * @return Alquiler
     */
    public function setFechaInicio($fechaInicio)
    {
        $this->fechaInicio = $fechaInicio;

        return $this;
    }

    /**
     * Get fechaInicio
     *
     * @return \DateTime 
     */
    public function getFechaInicio()
    {
        return $this->fechaInicio;
    }

    /**
     * Set fechaFin
     *
     * @param \DateTime $fechaFin
     * @return Alquiler
     */
    public function setFechaFin($fechaFin)
    {
        $this->fechaFin = $fechaFin;

        return $this;
    }

    /**
     * Get fechaFin
     *
     * @return \DateTime 
     */
    public function getFechaFin()
    {
        return $this->fechaFin;
    }

    /**
     * Set codigo
     *
     * @param string $codigo
     * @return Alquiler
     */
    public function setCodigo($codigo)
    {
        $this->codigo = $codigo;

        return $this;
    }

    /**
     * Get codigo
     *
     * @return string 
     */
    public function getCodigo()
    {
        return $this->codigo;
    }

    /**
     * Set total
     *
     * @param float $total
     * @return Alquiler
     */
    public function setTotal($total)
    {
        $this->total = $total;

        return $this;
    }

    /**
     * Get total
     *
     * @return float 
     */
    public function getTotal()
    {
        return $this->total;
    }

    /**
     * Add alquilerArticulos
     *
     * @param \AppBundle\Entity\AlquilerArticulo $alquilerArticulos
     * @return Alquiler
     */
    public function addAlquilerArticulo(\AppBundle\Entity\AlquilerArticulo $alquilerArticulos)
    {
        $this->alquilerArticulos[] = $alquilerArticulos;

        return $this;
    }

    /**
     * Remove alquilerArticulos
     *
     * @param \AppBundle\Entity\AlquilerArticulo $alquilerArticulos
     */
    public function removeAlquilerArticulo(\AppBundle\Entity\AlquilerArticulo $alquilerArticulos)
    {
        $this->alquilerArticulos->removeElement($alquilerArticulos);
    }

    /**
     * Get alquilerArticulos
     *
     * @return \Doctrine\Common\Collections\Collection 
     */
    public function getAlquilerArticulos()
    {
        return $this->alquilerArticulos;
    }

    public function getAuto(){
        foreach($this->alquilerArticulos as $alquilerArticulo){
            $articulo = $alquilerArticulo->getArticulo();
            if($articulo instanceof Auto){
                return $articulo;
            }
        }
    }

    public function hasArticle($id){
        foreach($this->getAlquilerArticulos() as $alquilerArticulo){
            if($alquilerArticulo->getArticulo()->getId() == $id){
                return true;
            }
        }
        return false;
    }

    /**
     * Set cliente
     *
     * @param \AppBundle\Entity\Cliente $cliente
     * @return Alquiler
     */
    public function setCliente(\AppBundle\Entity\Cliente $cliente = null)
    {
        $this->cliente = $cliente;

        return $this;
    }

    /**
     * Get cliente
     *
     * @return \AppBundle\Entity\Cliente 
     */
    public function getCliente()
    {
        return $this->cliente;
    }

    /**
     * Constructor
     */
    public function __construct()
    {
        $this->alquilerArticulos = new \Doctrine\Common\Collections\ArrayCollection();
    }

    /**
     * Set lugarRecogida
     *
     * @param \AppBundle\Entity\Lugar $lugarRecogida
     * @return Alquiler
     */
    public function setLugarRecogida(\AppBundle\Entity\Lugar $lugarRecogida = null)
    {
        $this->lugarRecogida = $lugarRecogida;

        return $this;
    }

    /**
     * Get lugarRecogida
     *
     * @return \AppBundle\Entity\Lugar 
     */
    public function getLugarRecogida()
    {
        return $this->lugarRecogida;
    }

    /**
     * Set lugarRegreso
     *
     * @param \AppBundle\Entity\Lugar $lugarRegreso
     * @return Alquiler
     */
    public function setLugarRegreso(\AppBundle\Entity\Lugar $lugarRegreso = null)
    {
        $this->lugarRegreso = $lugarRegreso;

        return $this;
    }

    /**
     * Get lugarRegreso
     *
     * @return \AppBundle\Entity\Lugar 
     */
    public function getLugarRegreso()
    {
        return $this->lugarRegreso;
    }


    /**
     * Set oferta
     *
     * @param \AppBundle\Entity\Oferta $oferta
     * @return Alquiler
     */
    public function setOferta(\AppBundle\Entity\Oferta $oferta = null)
    {
        $this->oferta = $oferta;

        return $this;
    }

    /**
     * Get oferta
     *
     * @return \AppBundle\Entity\Oferta 
     */
    public function getOferta()
    {
        return $this->oferta;
    }
}
