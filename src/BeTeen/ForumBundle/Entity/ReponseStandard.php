<?php

namespace BeTeen\ForumBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * ReponseStandard
 *
 * @ORM\Table()
 * @ORM\Entity
 */
class ReponseStandard
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
     * @ORM\ManyToOne(targetEntity="BeTeen\ForumBundle\Entity\SujetStandard",inversedBy="reponses")
     * @ORM\JoinColumn(nullable=false)
     */
    private $sujet;

    /**
     * @ORM\ManyToOne(targetEntity="BeTeen\UserBundle\Entity\User",inversedBy="reponsesStandards")
     * @ORM\JoinColumn(nullable=false)
     */
    private $auteur;
    
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
     * Set contenu
     *
     * @param string $contenu
     * @return ReponseStandard
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
     * @return ReponseStandard
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
     * Set sujet
     *
     * @param \BeTeen\ForumBundle\Entity\SujetStandard $sujet
     * @return ReponseStandard
     */
    public function setSujet(\BeTeen\ForumBundle\Entity\SujetStandard $sujet)
    {
        $this->sujet = $sujet;

        return $this;
    }

    /**
     * Get sujet
     *
     * @return \BeTeen\ForumBundle\Entity\SujetStandard 
     */
    public function getSujet()
    {
        return $this->sujet;
    }

    /**
     * Set auteur
     *
     * @param \BeTeen\UserBundle\Entity\User $auteur
     * @return ReponseStandard
     */
    public function setAuteur(\BeTeen\UserBundle\Entity\User $auteur)
    {
        $this->auteur = $auteur;

        return $this;
    }

    /**
     * Get auteur
     *
     * @return \BeTeen\UserBundle\Entity\User 
     */
    public function getAuteur()
    {
        return $this->auteur;
    }
}
