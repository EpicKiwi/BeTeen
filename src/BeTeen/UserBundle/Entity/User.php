<?php

namespace BeTeen\UserBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Security\Core\User\UserInterface;

/**
 * User
 *
 * @ORM\Table()
 * @ORM\Entity(repositoryClass="BeTeen\UserBundle\Entity\UserRepository")
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
     * @var text
     *
     * @ORM\Column(name="description", type="string")
     */
    private $description;

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
        return $this->background;
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
}
