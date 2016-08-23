<?php

namespace APP\AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Doctrine\Common\Collections\ArrayCollection;

/**
 * Proyecto
 *
 * @ORM\Table()
 * @ORM\Entity(repositoryClass="APP\AppBundle\Entity\ProyectoRepository")
 */
class Proyecto {

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
     * @ORM\Column(name="nombre", type="string", length=255, unique=true)
     */
    private $nombre;

    /**
     * @var integer $usuarios
     *
     * @ORM\ManyToMany(targetEntity="APP\UsuarioBundle\Entity\Usuario", inversedBy="proyectos", cascade={"persist"})
     */
    
    private $usuarios;

    /**
     * @ORM\ManyToOne(targetEntity="App\UsuarioBundle\Entity\Usuario")
     */
    private $usuarioAlta;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="fecha_alta", type="datetime")
     */
    private $fechaAlta;

    
    public function __construct() {        
        $this->usuarios = new ArrayCollection();
        $this->fechaAlta = new \DateTime();                
    }
 
    
    /**
     * Get id
     *
     * @return integer 
     */
    public function getId() {
        return $this->id;
    }

    /**
     * Set nombre
     *
     * @param string $nombre
     * @return Proyecto
     */
    public function setNombre($nombre) {
        $this->nombre = $nombre;

        return $this;
    }

    /**
     * Get nombre
     *
     * @return string 
     */
    public function getNombre() {
        return $this->nombre;
    }

    /**
     * Get usuarios
     *
     * @return integer 
     */
    public function getUsuarios()
    {
        return $this->usuarios;
    }

    public function addUsuario($usuario)
    {
        $this->usuarios->add($usuario);
    }
    
     /**
     * Set roles
     *
     * @param integer $usuarios
     */
    public function setUsuarios($usuarios)
    {
        $this->usuarios = $usuarios;
    }
    
    public function getUsuariosArray()
    {
  
       $array[] = array();
       for ( $i = 0 ; $i < count($this->usuarios); $i++ )
       {
           $usuario = $this->usuarios->get($i);
           $array[$i]= $usuario->getNombre();
       }
       return $array;
    }

    function getUsuarioAlta() {
        return $this->usuarioAlta;
    }

    function getFechaAlta() {
        return $this->fechaAlta;
    }

    function setUsuarioAlta($usuarioAlta) {
        $this->usuarioAlta = $usuarioAlta;
    }

    function setFechaAlta($fechaAlta) {
        $this->fechaAlta = $fechaAlta;
    }

    public function __toString() {
        return $this->nombre;
    }

}
