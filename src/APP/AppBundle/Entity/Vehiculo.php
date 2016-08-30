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
     * @ORM\Column(name="marca", type="string", length=255)
     */
    private $marca;

    /**
     * @var string
     *
     * @ORM\Column(name="modelo", type="string", length=255)
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
     * @ORM\Column(name="siniestro", type="string", length=255, unique=true)
     */
    private $siniestro;

    /**
     * @var APP\AppBundle\Entity\Compania
     *
     * @ORM\ManyToOne(targetEntity = "APP\AppBundle\Entity\Compania")
     * @ORM\JoinColumn(name = "compania_id", referencedColumnName = "id", nullable = false)
     */
    private $compania;

    /**
     * @var APP\AppBundle\Entity\Categoria
     *
     * @ORM\ManyToOne(targetEntity = "APP\AppBundle\Entity\Categoria")
     * @ORM\JoinColumn(name = "categoria_id", referencedColumnName = "id", nullable = false)
     */
    private $categoria;

    /**
     * @ORM\ManyToOne(targetEntity="APP\UsuarioBundle\Entity\Usuario")
     */
    private $usuarioAlta;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="fechaAlta", type="datetime")
     */
    private $fechaAlta;

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

    public function getCompania() {
        return $this->compania;
    }

    public function getCategoria() {
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
        return $this->marca;
    }

}
