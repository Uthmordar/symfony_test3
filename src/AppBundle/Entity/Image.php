<?php

namespace AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;

/**
 * Image
 *
 * @ORM\Table()
 * @ORM\Entity(repositoryClass="AppBundle\Entity\ImageRepository")
 * @ORM\HasLifecycleCallbacks()
 */
class Image
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
     * @ORM\Column(name="filename", type="string", length=255)
     */
    private $filename;

    /**
     * @var string
     *
     * @ORM\Column(name="title", type="string", length=255)
     */
    private $title;

    /**
     * @var string
     *
     * @ORM\Column(name="description", type="text")
     */
    private $description;

    /**
     * @var integer
     *
     * @ORM\Column(name="filesize", type="integer")
     */
    private $filesize;

    /**
     * @var string
     *
     * @ORM\Column(name="mimetype", type="string", length=255)
     */
    private $mimetype;

    /**
     * @var boolean
     *
     * @ORM\Column(name="isPublished", type="boolean")
     */
    private $isPublished;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="dateCreated", type="datetime")
     */
    private $dateCreated;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="dateModified", type="datetime")
     */
    private $dateModified;
    
    /**
     * @Assert\Image(
     *  maxSize="6M"
     * )
     */
    private $file;
    
    /**
     * @ORM\PrePersist()
     */
    public function prePersist(){
        $this->setFilename(sha1($this->getFile()->getClientOriginalName()) . uniqid() . "." . $this->getFile()->guessExtension());
        $this->setMimetype($this->getFile()->getMimeType());
        $this->setFilesize($this->getFile()->getSize());
        
        $this->setIsPublished(true);
        $this->setDateCreated(new \Datetime());
        $this->setDateModified(new \Datetime());
        
        $this->getFile()->move(__DIR__ . DIRECTORY_SEPARATOR . ".." . DIRECTORY_SEPARATOR . ".." . DIRECTORY_SEPARATOR . ".." . DIRECTORY_SEPARATOR . "web" . DIRECTORY_SEPARATOR . "uploads" . DIRECTORY_SEPARATOR . "originals", $this->getFilename());
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
     * Set filename
     *
     * @param string $filename
     * @return Image
     */
    public function setFilename($filename)
    {
        $this->filename = $filename;

        return $this;
    }

    /**
     * Get filename
     *
     * @return string 
     */
    public function getFilename()
    {
        return $this->filename;
    }

    /**
     * Set title
     *
     * @param string $title
     * @return Image
     */
    public function setTitle($title)
    {
        $this->title = $title;

        return $this;
    }

    /**
     * Get title
     *
     * @return string 
     */
    public function getTitle()
    {
        return $this->title;
    }

    /**
     * Set description
     *
     * @param string $description
     * @return Image
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
     * Set filesize
     *
     * @param integer $filesize
     * @return Image
     */
    public function setFilesize($filesize)
    {
        $this->filesize = $filesize;

        return $this;
    }

    /**
     * Get filesize
     *
     * @return integer 
     */
    public function getFilesize()
    {
        return $this->filesize;
    }

    /**
     * Set mimetype
     *
     * @param string $mimetype
     * @return Image
     */
    public function setMimetype($mimetype)
    {
        $this->mimetype = $mimetype;

        return $this;
    }

    /**
     * Get mimetype
     *
     * @return string 
     */
    public function getMimetype()
    {
        return $this->mimetype;
    }

    /**
     * Set isPublished
     *
     * @param boolean $isPublished
     * @return Image
     */
    public function setIsPublished($isPublished)
    {
        $this->isPublished = $isPublished;

        return $this;
    }

    /**
     * Get isPublished
     *
     * @return boolean 
     */
    public function getIsPublished()
    {
        return $this->isPublished;
    }

    /**
     * Set dateCreated
     *
     * @param \DateTime $dateCreated
     * @return Image
     */
    public function setDateCreated($dateCreated)
    {
        $this->dateCreated = $dateCreated;

        return $this;
    }

    /**
     * Get dateCreated
     *
     * @return \DateTime 
     */
    public function getDateCreated()
    {
        return $this->dateCreated;
    }

    /**
     * Set dateModified
     *
     * @param \DateTime $dateModified
     * @return Image
     */
    public function setDateModified($dateModified)
    {
        $this->dateModified = $dateModified;

        return $this;
    }

    /**
     * Get dateModified
     *
     * @return \DateTime 
     */
    public function getDateModified()
    {
        return $this->dateModified;
    }
    
    public function getFile(){
        return $this->file;
    }
    
    public function setFile(\Symfony\Component\HttpFoundation\File\UploadedFile $file){
        $this->file=$file;
        return $this;
    }
}
