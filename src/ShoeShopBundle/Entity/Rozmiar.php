<?php

namespace ShoeShopBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Rozmiar
 *
 * @ORM\Table(name="rozmiar")
 * @ORM\Entity(repositoryClass="ShoeShopBundle\Repository\RozmiarRepository")
 */
class Rozmiar
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
     * @var int
     *
     * @ORM\Column(name="rozmiar", type="integer", unique=true)
     */
    private $rozmiar;


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
     * Set rozmiar
     *
     * @param integer $rozmiar
     * @return Rozmiar
     */
    public function setRozmiar($rozmiar)
    {
        $this->rozmiar = $rozmiar;

        return $this;
    }

    /**
     * Get rozmiar
     *
     * @return integer
     */
    public function getRozmiar()
    {
        return $this->rozmiar;
    }


    /**
     * @return string
     */
    public function __toString() {

        return (string) $this->getRozmiar();
    }

}
