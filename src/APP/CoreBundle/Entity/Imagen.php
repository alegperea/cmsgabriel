<?php

namespace APP\CoreBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

use Symfony\Component\Validator\Constraints as Assert;

/**
 * Document
 *
 * @ORM\Table()
 * @ORM\Entity(repositoryClass="APP\CoreBundle\Entity\ImagenRepository")
 * @ORM\HasLifecycleCallbacks
 */
class Imagen
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
     * @Assert\File(maxSize="6000000")
     */
    public $file;

    /**
     * @var string
     *
     * @ORM\Column(name="nombre", type="string", length=255)
     */
    private $nombre;
    
    /**
     * @var string
     *
     * @ORM\Column(name="archivo", type="string", length=255)
     */
    private $archivo;

    /**
     * @var string
     *
     * @ORM\Column(name="path", type="string", length=255, nullable=true)
     */
    private $path;
    
    /**
     * @ORM\ManyToOne(targetEntity="APP\UsuarioBundle\Entity\Usuario", inversedBy="imagenes")
     */
    private $usuario;

    
  /**
   * @ORM\ManyToOne(targetEntity="APP\AppBundle\Entity\Vehiculo", inversedBy="imagenes")
   */
  private $vehiculo;
  

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
     * Set nombre
     *
     * @param string $name
     * @return Document
     */
    public function setNombre($nombre)
    {
        $this->nombre = $nombre;

        return $this;
    }

    /**
     * Get nombre
     *
     * @return string 
     */
    public function getNombre()
    {
        return $this->nombre;
    }

    /**
     * Set path
     *
     * @param string $path
     * @return Document
     */
    public function setPath($path)
    {
        $this->path = $path;

        return $this;
    }

    /**
     * Get path
     *
     * @return string 
     */
    public function getPath()
    {
        return $this->path;
    }
    
    public function getAbsolutePath()
    {
        return null === $this->path
            ? null
            : $this->getUploadRootDir().'/'.$this->path;
    }

    public function getWebPath()
    {
        return null === $this->path
            ? null
            : $this->getUploadDir().'/'.$this->path;
    }

    protected function getUploadRootDir()
    {
        // the absolute directory path where uploaded
        // documents should be saved
        return __DIR__.'/../../../../web/'.$this->getUploadDir();
    }

    protected function getUploadDir()
    {
        // get rid of the __DIR__ so it doesn't screw up
        // when displaying uploaded doc/image in the view.
        return 'uploads';
    }
    
    /**
     * @ORM\PrePersist()
     * @ORM\PreUpdate()
     */
    public function preUpload($extension)
    {
        if (null !== $this->file) {
       
            $this->path = sha1(uniqid(mt_rand(), true)).'.'.$extension;
            $this->archivo = $this->file->getClientOriginalName();
        }
    }

    /**
     * @ORM\PostPersist()
     * @ORM\PostUpdate()
     */
    public function upload()
    {        
                
        if (null === $this->file) {
            return;
        }
        
        // s'il y a une erreur lors du déplacement du fichier, une exception
        // va automatiquement être lancée par la méthode move(). Cela va empêcher
        // proprement l'entité d'être persistée dans la base de données si
        // erreur il y a
     
        $this->file->move($this->getUploadRootDir(), $this->path);        

        unset($this->file);

        $this->file = null;
    }

    /**
     * @ORM\PostRemove()
     */
    public function removeUpload()
    {
        if ($file = $this->getAbsolutePath()) {
               
            unlink($file);
        }
    }

    function getUsuario() {
        return $this->usuario;
    }

    function setUsuario($usuario) {
        $this->usuario = $usuario;
    }
    
    function getArchivo() {
        return $this->archivo;
    }

    function setArchivo($archivo) {
        $this->archivo = $archivo;
    }
    
    public function getVehiculo()
    {
        return $this->vehiculo;
    }
    
    public function setVehiculo($vehiculo){
        $this->vehiculo = $vehiculo;

        return $this;
    }
    
    public function __toString() {
        return $this->nombre;
    }
    
    function getFile() {
        return $this->file;
    }

    function setFile(\Symfony\Component\HttpFoundation\File\UploadedFile $file) {
        $this->file = $file;
    }
    
    public function getExtension()
    {
        if( $this->getNombre()){        
            $name_array = explode('.', $this->getNNombre());
            $file_type = $name_array[sizeof($name_array) - 1];
            return $file_type;
        }
                
    }


    
    
}
