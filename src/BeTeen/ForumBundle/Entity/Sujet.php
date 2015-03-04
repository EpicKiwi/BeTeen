<?php

namespace BeTeen\ForumBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Doctrine\ORM\Mapping\MappedSuperclass;

/**
 * Sujet
 *
 * @MappedSuperclass
 */
class Sujet
{

    /**
     * @var string
     *
     * @ORM\Column(name="titre", type="string", length=255)
     */
    private $titre;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="dateCreation", type="datetime")
     */
    private $dateCreation;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="dateModification", type="datetime")
     */
    private $dateModification;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="dateDerniereReponse", type="datetime")
     */
    private $dateDerniereReponse;

    /**
     * @var integer
     *
     * @ORM\Column(name="nombreReponse", type="integer")
     */
    private $nombreReponse;

    /**
     * @ORM\ManyToOne(targetEntity="BeTeen\ForumBundle\Entity\Categorie", inversedBy="sujets")
     *
     * @ORM\JoinColumn(nullable=false)
     */
    private $categorie;


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
     * Set titre
     *
     * @param string $titre
     * @return Sujet
     */
    public function setTitre($titre)
    {
        $this->titre = $titre;

        return $this;
    }

    /**
     * Get titre
     *
     * @return string 
     */
    public function getTitre()
    {
        return $this->titre;
    }

    /**
     * Set dateCreation
     *
     * @param \DateTime $dateCreation
     * @return Sujet
     */
    public function setDateCreation($dateCreation)
    {
        $this->dateCreation = $dateCreation;

        return $this;
    }

    /**
     * Get dateCreation
     *
     * @return \DateTime 
     */
    public function getDateCreation()
    {
        return $this->dateCreation;
    }

    /**
     * Set dateModification
     *
     * @param \DateTime $dateModification
     * @return Sujet
     */
    public function setDateModification($dateModification)
    {
        $this->dateModification = $dateModification;

        return $this;
    }

    /**
     * Get dateModification
     *
     * @return \DateTime 
     */
    public function getDateModification()
    {
        return $this->dateModification;
    }

    /**
     * Set dateDerniereReponse
     *
     * @param \DateTime $dateDerniereReponse
     * @return Sujet
     */
    public function setDateDerniereReponse($dateDerniereReponse)
    {
        $this->dateDerniereReponse = $dateDerniereReponse;

        return $this;
    }

    /**
     * Get dateDerniereReponse
     *
     * @return \DateTime 
     */
    public function getDateDerniereReponse()
    {
        return $this->dateDerniereReponse;
    }

    /**
     * Set nombreReponse
     *
     * @param integer $nombreReponse
     * @return Sujet
     */
    public function setNombreReponse($nombreReponse)
    {
        $this->nombreReponse = $nombreReponse;

        return $this;
    }

    /**
     * Get nombreReponse
     *
     * @return integer 
     */
    public function getNombreReponse()
    {
        return $this->nombreReponse;
    }
}
