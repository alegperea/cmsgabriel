<?php

namespace APP\AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Doctrine\Common\Collections\ArrayCollection;

/**
 * Venta
 *
 * @ORM\Table()
 * @ORM\Entity(repositoryClass="APP\AppBundle\Entity\VentaRepository")
 */
class Venta {

    /**
     * @var integer
     *
     * @ORM\Column(name="id", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    private $id;


        /**
     * @var APP\AppBundle\Entity\Cliente
     *
     * @ORM\ManyToOne(targetEntity = "APP\AppBundle\Entity\Cliente")
     * @ORM\JoinColumn(name = "cliente_id", referencedColumnName = "id", nullable = false)
     */
    private $cliente;
    
        /**
     * @var APP\AppBundle\Entity\Vehiculo
     *
     * @ORM\ManyToOne(targetEntity = "APP\AppBundle\Entity\Vehiculo")
     * @ORM\JoinColumn(name = "vehiculo_id", referencedColumnName = "id", nullable = false)
     */
    private $vehiculo;
    

    /**
     * @var integer
     *
     * @ORM\Column(name="valor", type="string")
     */
    private $valor;

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
     * @var integer
     *
     * @ORM\Column(name="estado", type="boolean")
     */
    private $estado;
    

    function getId() {
        return $this->id;
    }

    Public function getCliente() {
        return $this->cliente;
    }

    function getVehiculo() {
        return $this->vehiculo;
    }

    function getValor() {
        return $this->valor;
    }

    function getObservaciones() {
        return $this->observaciones;
    }

    function getUsuarioAlta() {
        return $this->usuarioAlta;
    }

    function getUsuarioMod() {
        return $this->usuarioMod;
    }

    function getFechaAlta() {
        return $this->fechaAlta;
    }

    function getFechaMod() {
        return $this->fechaMod;
    }

    function getEstado() {
        return $this->estado;
    }

    function setCliente(APP\AppBundle\Entity\Cliente $cliente) {
        $this->cliente = $cliente;
    }

    function setVehiculo(APP\AppBundle\Entity\Vehiculo $vehiculo) {
        $this->vehiculo = $vehiculo;
    }

    function setValor($valor) {
        $this->valor = $valor;
    }

    function setObservaciones($observaciones) {
        $this->observaciones = $observaciones;
    }

    function setUsuarioAlta($usuarioAlta) {
        $this->usuarioAlta = $usuarioAlta;
    }

    function setUsuarioMod($usuarioMod) {
        $this->usuarioMod = $usuarioMod;
    }

    function setFechaAlta(\DateTime $fechaAlta) {
        $this->fechaAlta = $fechaAlta;
    }

    function setFechaMod(\DateTime $fechaMod) {
        $this->fechaMod = $fechaMod;
    }

    function setEstado($estado) {
        $this->estado = $estado;
    }



}
