<?php

namespace BeTeen\ForumBundle\Entity;

use Gedmo\Mapping\Annotation as Gedmo;
use Doctrine\ORM\Mapping as ORM;

/**
 * SujetStandard
 *
 * @ORM\Table()
 * @ORM\Entity(repositoryClass="BeTeen\ForumBundle\Entity\SujetStandardRepository")
 */
class SujetStandard
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
     * @ORM\Column(name="titre", type="string", length=255)
     */
    private $titre;

    /**
     * @var string
     *
     * @ORM\Column(name="contenu", type="text")
     */
    private $contenu;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="date", type="datetime")
     */
    private $date;
    
    
    /**
     * @var boolean
     *
     * @ORM\Column(name="verouille", type="boolean")
     */
    private $verouille;

    /**
     * @ORM\ManyToOne(targetEntity="BeTeen\ForumBundle\Entity\Categorie",inversedBy="sujetsStandards")
     * @ORM\JoinColumn(nullable=false)
     */
    private $categorie;
    
	
    /**
     * @ORM\OneToMany(targetEntity="BeTeen\ForumBundle\Entity\ReponseStandard", mappedBy="sujet", cascade={"remove"})
     */
    private $reponses;
    
    /**
     * @Gedmo\Slug(fields={"titre"})
     * @ORM\Column(length=128, unique=true)
     */
    private $slug;


    public function __construct() 
    {
        $this->date = new \DateTime;
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
     * Set titre
     *
     * @param string $titre
     * @return SujetStandard
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
     * Set contenu
     *
     * @param string $contenu
     * @return SujetStandard
     */
    public function setContenu($contenu)
    {
        $this->contenu = $contenu;
    
        return $this;
    }

    /**
     * Get contenu
     *
     * @return string 
     */
    public function getContenu()
    {
        return $this->contenu;
    }

    /**
     * Set date
     *
     * @param \DateTime $date
     * @return SujetStandard
     */
    public function setDate($date)
    {
        $this->date = $date;
    
        return $this;
    }

    /**
     * Get date
     *
     * @return \DateTime 
     */
    public function getDate()
    {
        return $this->date;
    }

    /**
     * Set categorie
     *
     * @param \BeTeen\ForumBundle\Entity\Categorie $categorie
     * @return SujetStandard
     */
    public function setCategorie(\BeTeen\ForumBundle\Entity\Categorie $categorie)
    {
        $this->categorie = $categorie;
    
        return $this;
    }

    /**
     * Get categorie
     *
     * @return \BeTeen\ForumBundle\Entity\Categorie 
     */
    public function getCategorie()
    {
        return $this->categorie;
    }

    /**
     * Set slug
     *
     * @param string $slug
     * @return SujetStandard
     */
    public function setSlug($slug)
    {
        $this->slug = $slug;
    
        return $this;
    }

    /**
     * Get slug
     *
     * @return string 
     */
    public function getSlug()
    {
        return $this->slug;
    }

    /**
     * Add reponses
     *
     * @param \BeTeen\ForumBundle\Entity\ReponseStandard $reponses
     * @return SujetStandard
     */
    public function addReponse(\BeTeen\ForumBundle\Entity\ReponseStandard $reponses)
    {
        $this->reponses[] = $reponses;

        return $this;
    }

    /**
     * Remove reponses
     *
     * @param \BeTeen\ForumBundle\Entity\ReponseStandard $reponses
     */
    public function removeReponse(\BeTeen\ForumBundle\Entity\ReponseStandard $reponses)
    {
        $this->reponses->removeElement($reponses);
    }

    /**
     * Get reponses
     *
     * @return \Doctrine\Common\Collections\Collection 
     */
    public function getReponses()
    {
        return $this->reponses;
    }

    /**
     * Set verouille
     *
     * @param boolean $verouille
     * @return SujetStandard
     */
    public function setVerouille($verouille)
    {
        $this->verouille = $verouille;

        return $this;
    }

    /**
     * Get verouille
     *
     * @return boolean 
     */
    public function getVerouille()
    {
        return $this->verouille;
    }
}
