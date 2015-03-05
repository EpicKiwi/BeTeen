<?php

namespace BeTeen\ForumBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\HttpFoundation\File\UploadedFile;

/**
 * Upload
 *
 * @ORM\Table()
 * @ORM\Entity(repositoryClass="BeTeen\ForumBundle\Entity\UploadRepository")
 * @ORM\HasLifecycleCallbacks
 */
class Upload
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
     * @ORM\Column(name="chemin", type="string", length=255, nullable=true)
     */
    private $chemin;

    /**
     * @var string
     *
     * @ORM\Column(name="nom", type="string", length=255, nullable=true)
     */
    private $nom;

    /**
     * @var string
     *
     * @ORM\Column(name="type", type="string", length=255, nullable=true)
     */
    private $type;

    /**
     * @var string
     *
     * @ORM\Column(name="taille", type="decimal", nullable=true)
     */
    private $taille;

    private $file;

    private $tempFilename;

    /**
     * @ORM\PrePersist()
     * @ORM\preUpdate()
     */
    public function preUpload()
    {
        if($this->file === null) {
            return;
        }
        $this->type = $this->file->getMimeType();
    }

    /**
     * @ORM\PostPersist()
     * @ORM\PostUpdate()
     */
    public function upload()
    {
        if($this->file === null) {
            return;
        }
        if(null !== $this->tempFilename)
        {
            $oldFile = $this->getUploadRootDir()."/".$this->tempFilename;
            if(file_exists($oldFile))
            {
                unlink($oldFile);
            }
        }
        //Le nom du ficher sera de type 42-FichierLol.png
        $this->nom = $this->id."-".$this->file->getClientOriginalName();
        //Le chemin est relatif au dossier WEB
        $this->chemin = $this->getUploadDir()."/".$this->nom;
        //La taille
        $this->taille = $this->file->getClientSize();
        //On déplace le fichier
        $this->file->move($this->getUploadRootDir(),$this->nom);
    }

    /**
     * @ORM\PostRemove
     */
    public function removeUpload()
    {
        if(file_exists($this->getUploadRootDir()."/".$this->nom))
        {
            unlink($this->nom);
        }
    }

    public function getUploadDir()
    {
        return "uploads/all";
    }

    public function getUploadRootDir()
    {
        return __DIR__."/../../../../web/".$this->getUploadDir();
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
     * Set chemin
     *
     * @param string $chemin
     * @return Upload
     */
    public function setChemin($chemin)
    {
        $this->chemin = $chemin;

        return $this;
    }

    /**
     * Get chemin
     *
     * @return string 
     */
    public function getChemin()
    {
        return $this->chemin;
    }

    /**
     * Set nom
     *
     * @param string $nom
     * @return Upload
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
     * Set type
     *
     * @param string $type
     * @return Upload
     */
    public function setType($type)
    {
        $this->type = $type;

        return $this;
    }

    /**
     * Get type
     *
     * @return string 
     */
    public function getType()
    {
        return $this->type;
    }

    /**
     * Set taille
     *
     * @param string $taille
     * @return Upload
     */
    public function setTaille($taille)
    {
        $this->taille = $taille;

        return $this;
    }

    /**
     * Get taille
     *
     * @return string 
     */
    public function getTaille()
    {
        return $this->taille;
    }

    public function setFile($file)
    {
        $this->file = $file;

        if(null !== $this->chemin)
        {
            $this->tempFilename = $this->nom;
            $this->chemin = null;
            $this->nom = null;
        }

        return $this;
    }

    public function getFile()
    {
        return $this->file;
    }
}
