<?php

namespace AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Vich\UploaderBundle\Mapping\Annotation as Vich;
use Symfony\Component\HttpFoundation\File\File;
use Symfony\Component\Validator\Constraints as Assert;

/**
 * Banner
 *
 * @ORM\Table()
 * @ORM\Entity(repositoryClass="AppBundle\Entity\BannerRepository")
 * @Vich\Uploadable
 */
class Banner
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
     * @ORM\Column(name="nombre", type="string", length=255)
     */
    private $nombre;

    /**
     * @ORM\ManyToOne(targetEntity="BannerTipo", inversedBy="banners")
     * @ORM\JoinColumn(name="id_tipo", referencedColumnName="id", nullable=false)
     *
     */
    private $tipo;

    /**
     * @var \stdClass
     *
     * @ORM\ManyToOne(targetEntity="Oferta", inversedBy="banners")
     * @ORM\JoinColumn(name="id_oferta", referencedColumnName="id")
     */
    private $oferta;

    /**
     * @var \stdClass
     *
     * @ORM\ManyToOne(targetEntity="OfertaAuto", inversedBy="banners")
     * @ORM\JoinColumn(name="id_oferta_auto", referencedColumnName="id")
     */
    private $ofertaAuto;

    /**
     * @ORM\Column(type="string", length=255, nullable=false)
     * @var string
     */
    protected $image;

    /**
     * @Vich\UploadableField(mapping="banner_images", fileNameProperty="image")
     * @Assert\File(
     *      maxSize="5M",
     *      mimeTypes={"image/png", "image/jpeg", "image/gif"}
     * )
     * @var File
     */
    protected $imageFile;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="updated", type="datetime")
     */
    protected $updatedAt;


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
     * @return Banner
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

    public function setImageFile(File $image = null)
    {
        $this->imageFile = $image;

        if ($image) {
            // if 'updatedAt' is not defined in your entity, use another property
            $this->updatedAt = new \DateTime('now');
        }
    }

    public function getImageFile()
    {
        return $this->imageFile;
    }

    public function setImage($image)
    {
        $this->image = $image;
    }

    public function getImage()
    {
        return $this->image;
    }

    /**
     * Set updatedAt
     *
     * @param \DateTime $updatedAt
     * @return Banner
     */
    public function setUpdatedAt($updatedAt)
    {
        $this->updatedAt = $updatedAt;

        return $this;
    }

    /**
     * Get updatedAt
     *
     * @return \DateTime 
     */
    public function getUpdatedAt()
    {
        return $this->updatedAt;
    }

    /**
     * Set tipo
     *
     * @param \AppBundle\Entity\BannerTipo $tipo
     * @return Banner
     */
    public function setTipo(\AppBundle\Entity\BannerTipo $tipo)
    {
        $this->tipo = $tipo;

        return $this;
    }

    /**
     * Get tipo
     *
     * @return \AppBundle\Entity\BannerTipo 
     */
    public function getTipo()
    {
        return $this->tipo;
    }

    /**
     * Set ofertaAuto
     *
     * @param \AppBundle\Entity\OfertaAuto $ofertaAuto
     * @return Banner
     */
    public function setOfertaAuto(\AppBundle\Entity\OfertaAuto $ofertaAuto = null)
    {
        $this->ofertaAuto = $ofertaAuto;

        return $this;
    }

    /**
     * Get ofertaAuto
     *
     * @return \AppBundle\Entity\OfertaAuto 
     */
    public function getOfertaAuto()
    {
        return $this->ofertaAuto;
    }

    public function getAuto()
    {
        return $this->ofertaAuto->getAuto();
    }

    public function getDiario()
    {
        return $this->ofertaAuto->getPrecio();
    }

    public function getSemanal()
    {
        return $this->ofertaAuto->getSemanal();
    }

    /**
     * Set oferta
     *
     * @param \AppBundle\Entity\Oferta $oferta
     * @return Banner
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
