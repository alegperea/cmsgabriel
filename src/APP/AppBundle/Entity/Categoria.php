<?php

namespace APP\AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Doctrine\Common\Collections\ArrayCollection;

/**
 * APP\AppBundle\Entity\Categoria
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

    
   
    function getId() {
        return $this->id;
    }

    public function getNombre() {
        return $this->nombre;
    }

  
    public function setNombre($nombre) {
        $this->nombre = $nombre;
    }


}
