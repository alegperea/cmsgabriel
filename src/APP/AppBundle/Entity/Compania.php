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
     * @ORM\Column(name="telefono", type="integer")
     */
    private $telefono;
    
       /**
     * @var integer
     *
     * @ORM\Column(name="celular", type="integer")
     */
    private $celular;

    /**
     * @var string
     *
     * @ORM\Column(name="cuit", type="string", length=255)
     */
    private $cuit;

    /**
     * @var string
     *
     * @ORM\Column(name="email", type="string", length=255)
     */
    private $email;
    
      /**
     * @var string
     *
     * @ORM\Column(name="direccion", type="string", length=255)
     */
    private $direccion;
    
      /**
     * @var string
     *
     * @ORM\Column(name="observaciones", type="string", length=255)
     */
    private $observaciones;

    /**
     * @ORM\ManyToOne(targetEntity="APP\UsuarioBundle\Entity\Usuario")
     */
    private $usuarioAlta;

    /**
     * @ORM\ManyToOne(targetEntity="APP\UsuarioBundle\Entity\Usuario")
     */
    private $usuarioMod;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="fechaAlta", type="datetime")
     */
    private $fechaAlta;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="fechaMod", type="datetime")
     */
    private $fechaMod;

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
     * @return Plataforma
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
    function getTelefono() {
        return $this->telefono;
    }

    function getCuit() {
        return $this->cuit;
    }

    function getEmail() {
        return $this->email;
    }

    function getUsuarioMod() {
        return $this->usuarioMod;
    }

    function getFechaMod() {
        return $this->fechaMod;
    }

    function setTelefono($telefono) {
        $this->telefono = $telefono;
    }

    function setCuit($cuit) {
        $this->cuit = $cuit;
    }

    function setEmail($email) {
        $this->email = $email;
    }

    function setUsuarioMod($usuarioMod) {
        $this->usuarioMod = $usuarioMod;
    }

    function setFechaMod(\DateTime $fechaMod) {
        $this->fechaMod = $fechaMod;
    }

    function getCelular() {
        return $this->celular;
    }

    function getDireccion() {
        return $this->direccion;
    }

    function getObservaciones() {
        return $this->observaciones;
    }

    function setCelular($celular) {
        $this->celular = $celular;
    }

    function setDireccion($direccion) {
        $this->direccion = $direccion;
    }

    function setObservaciones($observaciones) {
        $this->observaciones = $observaciones;
    }


}
