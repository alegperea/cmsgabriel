<?php

namespace APP\AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Doctrine\Common\Collections\ArrayCollection;

/**
 * Vehiculo
 *
 * @ORM\Table()
 * @ORM\Entity(repositoryClass="APP\AppBundle\Entity\VehiculoRepository")
 */
class Vehiculo {

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
     * @ORM\Column(name="marca", type="string", length=255, unique=true)
     */
    private $marca;

    /**
     * @var string
     *
     * @ORM\Column(name="modelo", type="string", length=255, unique=true)
     */
    private $modelo;

    /**
     * @var string
     *
     * @ORM\Column(name="patente", type="string", length=255, unique=true)
     */
    private $patente;

    /**
     * @var string
     *
     * @ORM\Column(name="patente", type="string", length=255, unique=true)
     */
    private $siniestro;

    /**
     * @ORM\ManyToOne(targetEntity="APP\AppBundle\Entity\Compania")
     */
    private $compania;

    /**
     * @ORM\ManyToOne(targetEntity="APP\AppBundle\Entity\Categoria")
     */
    private $categoria;

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

    function getMarca() {
        return $this->marca;
    }

    function getModelo() {
        return $this->modelo;
    }

    function getPatente() {
        return $this->patente;
    }

    function getSiniestro() {
        return $this->siniestro;
    }

    function getCompania() {
        return $this->compania;
    }

    function getCategoria() {
        return $this->categoria;
    }

    function getUsuarioAlta() {
        return $this->usuarioAlta;
    }

    function getFechaAlta() {
        return $this->fechaAlta;
    }

    function setMarca($marca) {
        $this->marca = $marca;
    }

    function setModelo($modelo) {
        $this->modelo = $modelo;
    }

    function setPatente($patente) {
        $this->patente = $patente;
    }

    function setSiniestro($siniestro) {
        $this->siniestro = $siniestro;
    }

    function setCompania($compania) {
        $this->compania = $compania;
    }

    function setCategoria($categoria) {
        $this->categoria = $categoria;
    }

    function setUsuarioAlta($usuarioAlta) {
        $this->usuarioAlta = $usuarioAlta;
    }

    function setFechaAlta(\DateTime $fechaAlta) {
        $this->fechaAlta = $fechaAlta;
    }

    
    public function __toString() {
        return $this->nombre;
    }

}
