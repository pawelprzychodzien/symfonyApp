<?php

namespace ShoeShopBundle\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;

/**
 * Buty
 *
 * @ORM\Table(name="buty")
 * @ORM\Entity(repositoryClass="ShoeShopBundle\Repository\ButyRepository")
 */
class Buty
{
    /**
     * @var int
     *
     * @ORM\Column(name="id", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    private $id;

    /**
     * @var string
     *
     * @ORM\Column(name="marka", type="string", length=255)
     */
    private $marka;

    /**
     * @var string
     *
     * @ORM\Column(name="model", type="string", length=255)
     */
    private $model;

    /**
     * @var string
     *
     * @ORM\Column(name="kolor", type="string", length=255)
     */
    private $kolor;

    /**
     * @var int
     *
     * @ORM\Column(name="cena", type="float")
     */
    private $cena;

    /**
     * @var ArrayCollection
     * @ORM\ManyToMany(targetEntity="Rozmiar")
     * @ORM\JoinTable(
     *     name="buty__rozmiary",
     *     joinColumns={@ORM\JoinColumn(name="buty_id", referencedColumnName="id")},
     *     inverseJoinColumns={@ORM\JoinColumn(name="rozmiar_id", referencedColumnName="id")}
     * )
     */
    private $rozmiar;

    /**
     * @ORM\Column(type="string")
     *
     * @Assert\NotBlank(message="Dodaj zdjecie miniaturke")
     * @Assert\File(mimeTypes={"image/png", "image/jpeg", "image/jpg",})
     */
    private $zdjecieMIN;

    public function getZdjecieMIN()
    {
        return $this->zdjecieMIN;
    }

    public function setZdjecieMIN($zdjecieMIN)
    {
        $this->zdjecieMIN = $zdjecieMIN;

        return $this;
    }

    /**
     * @ORM\Column(type="string")
     *
     * @Assert\NotBlank(message="Dodaj zdjecie")
     * @Assert\File(mimeTypes={"image/png", "image/jpeg", "image/jpg",})
     */
    private $zdjecie;

    public function getZdjecie()
    {
        return $this->zdjecie;
    }

    public function setZdjecie($zdjecie)
    {
        $this->zdjecie = $zdjecie;

        return $this;
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
     * Set marka
     *
     * @param string $marka
     * @return Buty
     */
    public function setMarka($marka)
    {
        $this->marka = $marka;

    }

    /**
     * Get marka
     *
     * @return string 
     */
    public function getMarka()
    {
        return $this->marka;
    }

    /**
     * Set model
     *
     * @param string $model
     * @return Buty
     */
    public function setModel($model)
    {
        $this->model = $model;

    }

    /**
     * Get model
     *
     * @return string 
     */
    public function getModel()
    {
        return $this->model;
    }

    /**
     * Set kolor
     *
     * @param string $kolor
     * @return Buty
     */
    public function setKolor($kolor)
    {
        $this->kolor = $kolor;

    }

    /**
     * Get kolor
     *
     * @return string 
     */
    public function getKolor()
    {
        return $this->kolor;
    }

    /**
     * Set cena
     *
     * @param integer $cena
     * @return Buty
     */
    public function setCena($cena)
    {
        $this->cena = $cena;

    }

    /**
     * Get cena
     *
     * @return integer 
     */
    public function getCena()
    {
        return $this->cena;
    }

    /**
     * Set rozmiar
     *
     * @param ArrayCollection $rozmiar
     * @return rozmiar
     */
    public function setRozmiar($rozmiar)
    {
        $this->rozmiar = $rozmiar;
        return $this;

    }

    /**
     * @return ArrayCollection
     */
    public function getRozmiar()
    {
        return $this->rozmiar;
    }


    public function __construct()
    {
        $this->rozmiar = new ArrayCollection();
    }
}
