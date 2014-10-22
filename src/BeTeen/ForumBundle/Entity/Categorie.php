<?php

namespace BeTeen\ForumBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Categorie
 *
 * @ORM\Table()
 * @ORM\Entity(repositoryClass="BeTeen\ForumBundle\Entity\CategorieRepository")
 */
class Categorie
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
     * @ORM\Column(name="nom", type="string", length=255)
     */
    private $nom;

    /**
     * @var string
     *
     * @ORM\Column(name="description", type="text")
     */
    private $description;

    /**
     * @var string
     *
     * @ORM\Column(name="regles", type="text")
     */
    private $regles;

	/**
	 * @ORM\ManyToOne(targetEntity="BeTeen\ForumBundle\Entity\Categorie")
	 * @ORM\JoinColumn(nullable=true)
	 */
	private $categorieParente;

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
     * Set nom
     *
     * @param string $nom
     * @return Categorie
     */
    public function setNom($nom)
    {
        $this->nom = $nom;
    
        return $this;
    }

    /**
     * Get nom
     *
     * @return string 
     */
    public function getNom()
    {
        return $this->nom;
    }

    /**
     * Set description
     *
     * @param string $description
     * @return Categorie
     */
    public function setDescription($description)
    {
        $this->description = $description;
    
        return $this;
    }

    /**
     * Get description
     *
     * @return string 
     */
    public function getDescription()
    {
        return $this->description;
    }

    /**
     * Set regles
     *
     * @param string $regles
     * @return Categorie
     */
    public function setRegles($regles)
    {
        $this->regles = $regles;
    
        return $this;
    }

    /**
     * Get regles
     *
     * @return string 
     */
    public function getRegles()
    {
        return $this->regles;
    }

    /**
     * Set categorieParente
     *
     * @param \BeTeen\ForumBundle\Entity\Categorie $categorieParente
     * @return Categorie
     */
    public function setCategorieParente(\BeTeen\ForumBundle\Entity\Categorie $categorieParente = null)
    {
        $this->categorieParente = $categorieParente;
    
        return $this;
    }

    /**
     * Get categorieParente
     *
     * @return \BeTeen\ForumBundle\Entity\Categorie 
     */
    public function getCategorieParente()
    {
        return $this->categorieParente;
    }
}
