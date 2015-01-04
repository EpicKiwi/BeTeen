<?php

namespace BeTeen\ForumBundle\Entity;

use Gedmo\Mapping\Annotation as Gedmo;
use Doctrine\ORM\Mapping as ORM;

/**
 * Categorie
 *
 * @Gedmo\Tree(type="nested")
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
     * @ORM\OneToMany(targetEntity="BeTeen\ForumBundle\Entity\SujetStandard", mappedBy="categorie", cascade={"remove"})
     */
    private $sujetsStandards;
    
    /**
     * @ORM\OneToOne(targetEntity="BeTeen\ForumBundle\Entity\SujetStandard")
     */
    private $dernierSujet;
    
    /**
     * @var integer
     * 
     * @ORM\Column(name="sujetNumber", type="integer")
     */
    private $sujetNumber;
    
    /**
     * @var boolean
     *
     * @ORM\Column(name="allowSujetStandard", type="boolean")
     */
    private $allowSujetStandard;

    /**
     * @Gedmo\TreeLeft
     * @ORM\Column(name="lft", type="integer")
     */
    private $lft;

    /**
     * @Gedmo\TreeLevel
     * @ORM\Column(name="lvl", type="integer")
     */
    private $lvl;

    /**
     * @Gedmo\TreeRight
     * @ORM\Column(name="rgt", type="integer")
     */
    private $rgt;

    /**
     * @Gedmo\TreeRoot
     * @ORM\Column(name="root", type="integer", nullable=true)
     */
    private $root;

    /**
     * @Gedmo\TreeParent
     * @ORM\ManyToOne(targetEntity="Categorie", inversedBy="children")
     * @ORM\JoinColumn(name="parent_id", referencedColumnName="id", onDelete="CASCADE")
     */
    private $parent;

    /**
     * @ORM\OneToMany(targetEntity="Categorie", mappedBy="parent", cascade={"remove"})
     * @ORM\OrderBy({"lft" = "ASC"})
     */
    private $children;
    
    /**
     * @var string
     * @Gedmo\Slug(fields={"nom"})
     * @ORM\Column(length=128, unique=true)
     */
    private $slug;
    
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
     * Constructor
     */
    public function __construct()
    {
        $this->sujetsStandards = new \Doctrine\Common\Collections\ArrayCollection();
        $this->sujetNumber = 0;
    }

    /**
     * Add sujetsStandards
     *
     * @param \BeTeen\ForumBundle\Entity\SujetStandard $sujetsStandards
     * @return Categorie
     */
    public function addSujetsStandard(\BeTeen\ForumBundle\Entity\SujetStandard $sujetsStandards)
    {
        $this->sujetsStandards[] = $sujetsStandards;
    
        return $this;
    }

    /**
     * Remove sujetsStandards
     *
     * @param \BeTeen\ForumBundle\Entity\SujetStandard $sujetsStandards
     */
    public function removeSujetsStandard(\BeTeen\ForumBundle\Entity\SujetStandard $sujetsStandards)
    {
        $this->sujetsStandards->removeElement($sujetsStandards);
    }

    /**
     * Get sujetsStandards
     *
     * @return \Doctrine\Common\Collections\Collection 
     */
    public function getSujetsStandards()
    {
        
        return $this->sujetsStandards;
    }

    /**
     * Set ordre
     *
     * @param integer $ordre
     * @return Categorie
     */
    public function setOrdre($ordre)
    {
        $this->ordre = $ordre;
    
        return $this;
    }

    /**
     * Get ordre
     *
     * @return integer 
     */
    public function getOrdre()
    {
        return $this->ordre;
    }

    /**
     * Set lft
     *
     * @param integer $lft
     * @return Categorie
     */
    public function setLft($lft)
    {
        $this->lft = $lft;
    
        return $this;
    }

    /**
     * Get lft
     *
     * @return integer 
     */
    public function getLft()
    {
        return $this->lft;
    }

    /**
     * Set lvl
     *
     * @param integer $lvl
     * @return Categorie
     */
    public function setLvl($lvl)
    {
        $this->lvl = $lvl;
    
        return $this;
    }

    /**
     * Get lvl
     *
     * @return integer 
     */
    public function getLvl()
    {
        return $this->lvl;
    }

    /**
     * Set rgt
     *
     * @param integer $rgt
     * @return Categorie
     */
    public function setRgt($rgt)
    {
        $this->rgt = $rgt;
    
        return $this;
    }

    /**
     * Get rgt
     *
     * @return integer 
     */
    public function getRgt()
    {
        return $this->rgt;
    }

    /**
     * Set root
     *
     * @param integer $root
     * @return Categorie
     */
    public function setRoot($root)
    {
        $this->root = $root;
    
        return $this;
    }

    /**
     * Get root
     *
     * @return integer 
     */
    public function getRoot()
    {
        return $this->root;
    }

    /**
     * Set parent
     *
     * @param \BeTeen\ForumBundle\Entity\Categorie $parent
     * @return Categorie
     */
    public function setParent(\BeTeen\ForumBundle\Entity\Categorie $parent = null)
    {
        $this->parent = $parent;
    
        return $this;
    }

    /**
     * Get parent
     *
     * @return \BeTeen\ForumBundle\Entity\Categorie 
     */
    public function getParent()
    {
        return $this->parent;
    }

    /**
     * Add children
     *
     * @param \BeTeen\ForumBundle\Entity\Categorie $children
     * @return Categorie
     */
    public function addChild(\BeTeen\ForumBundle\Entity\Categorie $children)
    {
        $this->children[] = $children;
    
        return $this;
    }

    /**
     * Remove children
     *
     * @param \BeTeen\ForumBundle\Entity\Categorie $children
     */
    public function removeChild(\BeTeen\ForumBundle\Entity\Categorie $children)
    {
        $this->children->removeElement($children);
    }

    /**
     * Get children
     *
     * @return \Doctrine\Common\Collections\Collection 
     */
    public function getChildren()
    {
        return $this->children;
    }

    /**
     * Set slug
     *
     * @param string $slug
     * @return Categorie
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
     * Set allowSujetStandard
     *
     * @param boolean $allowSujetStandard
     * @return Categorie
     */
    public function setAllowSujetStandard($allowSujetStandard)
    {
        $this->allowSujetStandard = $allowSujetStandard;

        return $this;
    }

    /**
     * Get allowSujetStandard
     *
     * @return boolean 
     */
    public function getAllowSujetStandard()
    {
        return $this->allowSujetStandard;
    }

    /**
     * Set sujetNumber
     *
     * @param integer $sujetNumber
     * @return Categorie
     */
    public function setSujetNumber($sujetNumber)
    {
        $this->sujetNumber = $sujetNumber;

        return $this;
    }

    /**
     * Get sujetNumber
     *
     * @return integer 
     */
    public function getSujetNumber()
    {
        return $this->sujetNumber;
    }
    
    public function addSujetNumber()
    {
        $tmp = $this->sujetNumber;
        $tmp += 1;
        $this->sujetNumber = $tmp;
        if($this->parent != null)
        {
            $this->parent->addSujetNumber();
        }
    }
    
    public function delSujetNumber()
    {
        $tmp = $this->sujetNumber;
        $tmp -= 1;
        $this->sujetNumber = $tmp;
        if($this->parent != null)
        {
            $this->parent->delSujetNumber();
        }
    }

    /**
     * Set dernierSujet
     *
     * @param \BeTeen\ForumBundle\Entity\SujetStandard $dernierSujet
     * @return Categorie
     */
    public function setDernierSujet(\BeTeen\ForumBundle\Entity\SujetStandard $dernierSujet = null)
    {
        $this->dernierSujet = $dernierSujet;

        return $this;
    }

    /**
     * Get dernierSujet
     *
     * @return \BeTeen\ForumBundle\Entity\SujetStandard 
     */
    public function getDernierSujet()
    {
        return $this->dernierSujet;
    }
}
