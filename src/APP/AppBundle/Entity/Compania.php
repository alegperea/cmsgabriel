<?php

namespace APP\AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Doctrine\Common\Collections\ArrayCollection;

/**
 * Compania
 *
 * @ORM\Table()
 * @ORM\Entity(repositoryClass="APP\AppBundle\Entity\CompaniaRepository")
 */
class Compania {

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
     * @var string
     *
     * @ORM\Column(name="telefono", type="string", length=255)
     */
    private $telefono;

    /**
     * @var string
     *
     * @ORM\Column(name="celular", type="string", length=255)
     */
    private $celular;

    /**
     * @var string
     *
     * @ORM\Column(name="cuit", type="string", length=255, unique=true)
     */
    private $cuit;

    /**
     * @var string
     *
     * @ORM\Column(name="mail", type="string", length=255, unique=true)
     */
    private $mail;

    /**
     * @var string
     *
     * @ORM\Column(name="direccion", type="string", length=255)
     */
    private $direccion;

    /**
     * @var string
     *
     * @ORM\Column(name="observaciones", type="string", length=255, unique=true)
     */
    private $observaciones;

    /**
     * @ORM\ManyToOne(targetEntity="APP\UsuarioBundle\Entity\Usuario")
     */
    private $usuarioAlta;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="fecha_alta", type="datetime")
     */
    private $fechaAlta;
    
        /**
     * @var string
     *
     * @ORM\Column(name="estado", type="integer")
     */
    private $estado;

    
    
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
    function getTelefono() {
        return $this->telefono;
    }

    function getCelular() {
        return $this->celular;
    }

    function getCuit() {
        return $this->cuit;
    }

    function getMail() {
        return $this->mail;
    }

    function getDireccion() {
        return $this->direccion;
    }

    function getObservaciones() {
        return $this->observaciones;
    }

    function getUsuarioAlta() {
        return $this->usuarioAlta;
    }

    function getFechaAlta() {
        return $this->fechaAlta;
    }

    function getEstado() {
        return $this->estado;
    }

    function setTelefono($telefono) {
        $this->telefono = $telefono;
    }

    function setCelular($celular) {
        $this->celular = $celular;
    }

    function setCuit($cuit) {
        $this->cuit = $cuit;
    }

    function setMail($mail) {
        $this->mail = $mail;
    }

    function setDireccion($direccion) {
        $this->direccion = $direccion;
    }

    function setObservaciones($observaciones) {
        $this->observaciones = $observaciones;
    }

    function setUsuarioAlta($usuarioAlta) {
        $this->usuarioAlta = $usuarioAlta;
    }

    function setFechaAlta(\DateTime $fechaAlta) {
        $this->fechaAlta = $fechaAlta;
    }

    function setEstado($estado) {
        $this->estado = $estado;
    }


    
    
}
