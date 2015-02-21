<?php

namespace BeTeen\ForumBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * SujetVersus
 *
 * @ORM\Table()
 * @ORM\Entity(repositoryClass="BeTeen\ForumBundle\Entity\SujetVersusRepository")
 */
class SujetVersus extends Sujet
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
     * @ORM\Column(name="titreGauche", type="string", length=255)
     */
    private $titreGauche;

    /**
     * @var string
     *
     * @ORM\Column(name="titreDroite", type="string", length=255)
     */
    private $titreDroite;


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
     * Set titreGauche
     *
     * @param string $titreGauche
     * @return SujetVersus
     */
    public function setTitreGauche($titreGauche)
    {
        $this->titreGauche = $titreGauche;

        return $this;
    }

    /**
     * Get titreGauche
     *
     * @return string 
     */
    public function getTitreGauche()
    {
        return $this->titreGauche;
    }

    /**
     * Set titreDroite
     *
     * @param string $titreDroite
     * @return SujetVersus
     */
    public function setTitreDroite($titreDroite)
    {
        $this->titreDroite = $titreDroite;

        return $this;
    }

    /**
     * Get titreDroite
     *
     * @return string 
     */
    public function getTitreDroite()
    {
        return $this->titreDroite;
    }
}
