<?php

namespace Samples\EscolaBundle\Entity;

use Symfony\Component\HttpFoundation\File\UploadedFile;
use Doctrine\ORM\Mapping as ORM;

/**
 *
 * @ORM\Table(name="samples_escola__image")
 * @ORM\Entity
 * @ORM\HasLifecycleCallbacks
 */
class Image
{
    /**
     * @var string
     *
     * @ORM\Id
     * @ORM\Column(type="guid")
     * @ORM\GeneratedValue(strategy="UUID")
     */
    protected $id;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $file_path;

    /**
     * Get id
     *
     * @return guid 
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * Set file_path
     *
     * @param string $file_path
     * @return Pelicula
     */
    public function setFilePath($file_path) {
        $this->file_path = $file_path;

        return $this;
    }

    /**
     * Get file_path
     *
     * @return string 
     */
    public function getFilePath() {
        return $this->file_path;
    }

    private $file;

    private $file_path_temp;

    /**
     * Sets file.
     *
     * @param UploadedFile $file
     */
    public function setFile(UploadedFile $file = null) {
        $this->file = $file;
        // check if we have an old image path
        if (isset($this->file_path)) {
            // store the old name to delete after the update
            $this->file_path_temp = $this->file_path;
            $this->file_path = null;
        } else {
            $this->file_path = 'initial';
        }
    }

    /**
     * @ORM\PrePersist()
     * @ORM\PreUpdate()
     */
    public function preUpload() {
        if (null !== $this->getFile()) {
            // do whatever you want to generate a unique name
            $filename = sha1(uniqid(mt_rand(), true));
            $this->file_path = $filename . '.' . $this->getFile()->guessExtension();
        }
    }

    /**
     * @ORM\PostPersist()
     * @ORM\PostUpdate()
     */
    public function upload() {
        if (null === $this->getFile()) {
            return;
        }
        // if there is an error when moving the file, an exception will
        // be automatically thrown by move(). This will properly prevent
        // the entity from being persisted to the database on error
        $this->getFile()->move($this->getUploadRootDir(), $this->file_path);
        // check if we have an old image
        if (isset($this->file_path_temp)) {
            // delete the old image
            unlink($this->getUploadRootDir() . '/' . $this->file_path_temp);
            // clear the temp image path
            $this->file_path_temp = null;
        }
        $this->file = null;
    }

    /**
     * @ORM\PostRemove()
     */
    public function removeUpload() {
        if ($file = $this->getAbsolutePath()) {
            unlink($file);
        }
    }

    /**
     * Get file.
     *
     * @return UploadedFile
     */
    public function getFile() {
        return $this->file;
    }

    public function getAbsolutePath() {
		// file full path
        return null === $this->file_path ? null : $this->getUploadRootDir() . '/' . $this->file_path;
    }

    public function getWebPath() {
		// web url for file
        return null === $this->file_path ? null : $this->getUploadDir() . '/' . $this->file_path;
    }

    protected function getUploadRootDir() {
		// full path where images will be saved
        return __DIR__ . '/../../../../web/' . $this->getUploadDir();
    }

    protected function getUploadDir() {
		// relative path where images will be saved
        return '/uploads/images';
    }

    public function getPreview() {
		// image tag
        return null === $this->file_path ? "<img width='50px' src='/bundles/samplesindex/img/no-foto.png'>" : "<img width='50px' src='".$this->getUploadDir() . '/' . $this->file_path."'>";
    }	
}
