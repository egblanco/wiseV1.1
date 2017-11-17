<?php

namespace AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * BannerTipo
 *
 * @ORM\Table()
 * @ORM\Entity
 */
class BannerTipo
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
     * @ORM\OneToMany(targetEntity="Banner", mappedBy="tipo")
     **/
    private $banners;


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
     * @return BannerTipo
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
     * Constructor
     */
    public function __construct()
    {
        $this->banners = new \Doctrine\Common\Collections\ArrayCollection();
    }

    /**
     * Add banners
     *
     * @param \AppBundle\Entity\Banner $banners
     * @return BannerTipo
     */
    public function addBanner(\AppBundle\Entity\Banner $banners)
    {
        $this->banners[] = $banners;

        return $this;
    }

    /**
     * Remove banners
     *
     * @param \AppBundle\Entity\Banner $banners
     */
    public function removeBanner(\AppBundle\Entity\Banner $banners)
    {
        $this->banners->removeElement($banners);
    }

    /**
     * Get banners
     *
     * @return \Doctrine\Common\Collections\Collection 
     */
    public function getBanners()
    {
        return $this->banners;
    }

    public function __toString()
    {
        return $this->getNombre();
    }
}
