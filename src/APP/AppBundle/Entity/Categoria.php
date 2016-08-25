<?php

namespace APP\AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Doctrine\Common\Collections\ArrayCollection;

/**
 * Categoria
 *
 * @ORM\Table()
 * @ORM\Entity(repositoryClass="APP\AppBundle\Entity\CategoriaRepository")
 */
class Categoria {

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

    
    

    public function __construct() {
        $this->fechaAlta = new \DateTime();
    }

   
    function getId() {
        return $this->id;
    }

    function getNombre() {
        return $this->nombre;
    }

  
    function setNombre($nombre) {
        $this->nombre = $nombre;
    }


}
