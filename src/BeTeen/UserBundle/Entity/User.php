<?php

namespace BeTeen\UserBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;
use Symfony\Component\Security\Core\User\UserInterface;
use Symfony\Bridge\Doctrine\Validator\Constraints\UniqueEntity;

/**
 * User
 *
 * @ORM\Table()
 * @ORM\Entity(repositoryClass="BeTeen\UserBundle\Entity\UserRepository")
 * @UniqueEntity(fields = "username", message = "Ce nom d'utilisateur est déjà utilisé")
 * @UniqueEntity(fields = "email", message = "Cet email est déjà utilisée")
 */
class User implements UserInterface
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
     * @ORM\Column(name="username", type="string", length=255, unique=true)
     */
    private $username;

    /**
     * @var string
     *
     * @ORM\Column(name="password", type="string", length=255)
     */
    private $password;

    /**
     * @var string
     *
     * @ORM\Column(name="salt", type="string", length=255)
     */
    private $salt;
    

    /**
     * @var string
     *
     * @ORM\Column(name="email", type="string", length=255)
     * @Assert\Email(message = "Vous n'avez pas entré une adresse email valide")
     */
    private $email;
    

    /**
     * @var string
     *
     * @ORM\Column(name="avatar", type="string", length=255)
     */
    private $avatar;
    

    /**
     * @var string
     *
     * @ORM\Column(name="background", type="string", length=255)
     */
    private $background;

    /**
     * @var datetime
     *
     * @ORM\Column(name="dateNaissance",type="datetime",nullable=true)
     */
    private $dateNaissance;

    /**
     * @var \Datetime
     *
     * @ORM\Column(name="dateInscription",type="datetime",nullable=false)
     */
    private $dateInscription;

    /**
     * @var string
     *
     * @ORM\Column(name="localisation", type="string", length=255, nullable=true)
     */
    private $localisation;

    /**
     * @var boolean
     *
     * @ORM\Column(name="sexe", type="boolean", length=255, nullable=false)
     */
    private $sexe;

    /**
     * @var string
     *
     * @ORM\Column(name="interets", type="text", nullable=true)
     */
    private $interets;

    /**
     * @var string
     *
     * @ORM\Column(name="facebook", type="string", length=255, nullable=true)
     */
    private $facebook;

    /**
     * @var string
     *
     * @ORM\Column(name="twitter", type="string", length=255, nullable=true)
     */
    private $twitter;

    /**
     * @var string
     *
     * @ORM\Column(name="google", type="string", length=255, nullable=true)
     */
    private $google;

    /**
     * @var boolean
     *
     * @ORM\Column(name="status", type="boolean", length=255, nullable=false)
     */
    private $status;

    /**
     * @var array
     *
     * @ORM\Column(name="roles", type="array")
     */
    private $roles;

    /**
     * @ORM\OneToMany(targetEntity="BeTeen\ForumBundle\Entity\SujetStandard", mappedBy="auteur", cascade={"remove"})
     * @ORM\JoinColumn(nullable=false)
     */
    private $sujetsStandards;

    /**
     * @ORM\OneToMany(targetEntity="BeTeen\ForumBundle\Entity\ReponseStandard", mappedBy="auteur", cascade={"remove"})
     * @ORM\JoinColumn(nullable=false)
     */
    private $reponsesStandards;
    
    public function __construct()
    {
        $this->roles = array();
        $this->dateInscription = new \DateTime();
        $this->sexe = true;
        $this->status = false;
        $this->avatar = "";
        $this->background = "";
        $this->roles = array("ROLE_USER");
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
     * Set username
     *
     * @param string $username
     * @return User
     */
    public function setUsername($username)
    {
        $this->username = $username;

        return $this;
    }

    /**
     * Get username
     *
     * @return string 
     */
    public function getUsername()
    {
        return $this->username;
    }

    /**
     * Set password
     *
     * @param string $password
     * @return User
     */
    public function setPassword($password)
    {
        $this->password = $password;

        return $this;
    }

    /**
     * Get password
     *
     * @return string 
     */
    public function getPassword()
    {
        return $this->password;
    }

    /**
     * Set salt
     *
     * @param string $salt
     * @return User
     */
    public function setSalt($salt)
    {
        $this->salt = $salt;

        return $this;
    }

    /**
     * Get salt
     *
     * @return string 
     */
    public function getSalt()
    {
        return $this->salt;
    }

    /**
     * Set roles
     *
     * @param array $roles
     * @return User
     */
    public function setRoles($roles)
    {
        $this->roles = $roles;

        return $this;
    }

    /**
     * Get roles
     *
     * @return array 
     */
    public function getRoles()
    {
        return $this->roles;
    }

    public function eraseCredentials() {
        
    }


    /**
     * Set email
     *
     * @param string $email
     * @return User
     */
    public function setEmail($email)
    {
        $this->email = $email;

        return $this;
    }

    /**
     * Get email
     *
     * @return string 
     */
    public function getEmail()
    {
        return $this->email;
    }

    /**
     * Set avatar
     *
     * @param string $avatar
     * @return User
     */
    public function setAvatar($avatar)
    {
        $this->avatar = $avatar;

        return $this;
    }

    /**
     * Get avatar
     *
     * @return string 
     */
    public function getAvatar()
    {
        if($this->avatar == "")
        {
            return "default.png";
        }
        return $this->avatar;
    }

    /**
     * Set background
     *
     * @param string $background
     * @return User
     */
    public function setBackground($background)
    {
        $this->background = $background;

        return $this;
    }

    /**
     * Get background
     *
     * @return string 
     */
    public function getBackground()
    {
        if($this->background != "")
        {
            return $this->background;
        }
        else
        {
            return "default.jpg";
        }
    }

    /**
     * Set description
     *
     * @param string $description
     * @return User
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
     * Add sujetsStandards
     *
     * @param \BeTeen\ForumBundle\Entity\SujetStandard $sujetsStandards
     * @return User
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
     * Add reponsesStandards
     *
     * @param \BeTeen\ForumBundle\Entity\ReponseStandard $reponsesStandards
     * @return User
     */
    public function addReponsesStandard(\BeTeen\ForumBundle\Entity\ReponseStandard $reponsesStandards)
    {
        $this->reponsesStandards[] = $reponsesStandards;

        return $this;
    }

    /**
     * Remove reponsesStandards
     *
     * @param \BeTeen\ForumBundle\Entity\ReponseStandard $reponsesStandards
     */
    public function removeReponsesStandard(\BeTeen\ForumBundle\Entity\ReponseStandard $reponsesStandards)
    {
        $this->reponsesStandards->removeElement($reponsesStandards);
    }

    /**
     * Get reponsesStandards
     *
     * @return \Doctrine\Common\Collections\Collection 
     */
    public function getReponsesStandards()
    {
        return $this->reponsesStandards;
    }

    /**
     * Set dateNaissance
     *
     * @param \DateTime $dateNaissance
     * @return User
     */
    public function setDateNaissance($dateNaissance)
    {
        $this->dateNaissance = $dateNaissance;

        return $this;
    }

    /**
     * Get dateNaissance
     *
     * @return \DateTime 
     */
    public function getDateNaissance()
    {
        return $this->dateNaissance;
    }

    /**
     * Set dateInscription
     *
     * @param \DateTime $dateInscription
     * @return User
     */
    public function setDateInscription($dateInscription)
    {
        $this->dateInscription = $dateInscription;

        return $this;
    }

    /**
     * Get dateInscription
     *
     * @return \DateTime 
     */
    public function getDateInscription()
    {
        return $this->dateInscription;
    }

    /**
     * Set localisation
     *
     * @param string $localisation
     * @return User
     */
    public function setLocalisation($localisation)
    {
        $this->localisation = $localisation;

        return $this;
    }

    /**
     * Get localisation
     *
     * @return string 
     */
    public function getLocalisation()
    {
        return $this->localisation;
    }

    /**
     * Set sexe
     *
     * @param boolean $sexe
     * @return User
     */
    public function setSexe($sexe)
    {
        $this->sexe = $sexe;

        return $this;
    }

    /**
     * Get sexe
     *
     * @return boolean 
     */
    public function getSexe()
    {
        return $this->sexe;
    }

    /**
     * Get sexe
     *
     * @return String
     */
    public function getFormatedSexe()
    {
        if($this->sexe)
        {
            return "Homme";
        }
        else
        {
            return "Femme";
        }
    }

    /**
     * Set interets
     *
     * @param string $interets
     * @return User
     */
    public function setInterets($interets)
    {
        $this->interets = $interets;

        return $this;
    }

    /**
     * Get interets
     *
     * @return string 
     */
    public function getInterets()
    {
        return $this->interets;
    }

    /**
     * Set facebook
     *
     * @param string $facebook
     * @return User
     */
    public function setFacebook($facebook)
    {
        $this->facebook = $facebook;

        return $this;
    }

    /**
     * Get facebook
     *
     * @return string 
     */
    public function getFacebook()
    {
        return $this->facebook;
    }

    /**
     * Set twitter
     *
     * @param string $twitter
     * @return User
     */
    public function setTwitter($twitter)
    {
        $this->twitter = $twitter;

        return $this;
    }

    /**
     * Get twitter
     *
     * @return string 
     */
    public function getTwitter()
    {
        return $this->twitter;
    }

    /**
     * Set google
     *
     * @param string $google
     * @return User
     */
    public function setGoogle($google)
    {
        $this->google = $google;

        return $this;
    }

    /**
     * Get google
     *
     * @return string 
     */
    public function getGoogle()
    {
        return $this->google;
    }

    /**
     * Set status
     *
     * @param boolean $status
     * @return User
     */
    public function setStatus($status)
    {
        $this->status = $status;

        return $this;
    }

    /**
     * Get status
     *
     * @return boolean 
     */
    public function getStatus()
    {
        return $this->status;
    }
}
