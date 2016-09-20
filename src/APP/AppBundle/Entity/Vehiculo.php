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

    const en_venta = 1;
    const vendido = 2;
    const publicado = 1;
    const despublicado = 2;
    const nafta = 1;
    const diesel = 2;

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
     * @ORM\Column(name="codProd", type="string", length=255, nullable = true)
     */
    private $codProd;

    /**
     * @var APP\AppBundle\Entity\Marca
     *
     * @ORM\ManyToOne(targetEntity = "APP\AppBundle\Entity\Marca")
     * @ORM\JoinColumn(name = "marca_id", referencedColumnName = "id", nullable = false)
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
     * @var string
     *
     * @ORM\Column(name="descripcion", type="string", length=255, nullable=true)
     */
    private $descripcion;

    /**
     * @var string
     *
     * @ORM\Column(name="notas", type="string", length=255, nullable=true)
     */
    private $notas;

    /**
     * @var integer
     *
     * @ORM\Column(name="valor", type="integer")
     */
    private $valor;

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
     * @ORM\Column(name="combustible", type="integer")
     */
    private $combustible;

    /**
     * @var integer
     *
     * @ORM\Column(name="estado", type="boolean", nullable = true)
     */
    private $estado;

    /**
     * @var integer
     *
     * @ORM\Column(name="publicado", type="boolean", nullable = true)
     */
    private $publicado;

    /**
     * @ORM\OneToMany(targetEntity="APP\CoreBundle\Entity\Imagen", mappedBy="vehiculo", cascade={"persist", "remove"})
     */
    private $imagenes;

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

    function getCodProd() {
        return $this->codProd;
    }

    function getDescripcion() {
        return $this->descripcion;
    }

    function getNotas() {
        return $this->notas;
    }

    function getValor() {
        return $this->valor;
    }

    function setCodProd($codProd) {
        $this->codProd = $codProd;
    }

    function setDescripcion($descripcion) {
        $this->descripcion = $descripcion;
    }

    function setNotas($notas) {
        $this->notas = $notas;
    }

    function setValor($valor) {
        $this->valor = $valor;
    }

    function getUsuarioMod() {
        return $this->usuarioMod;
    }

    function getFechaMod() {
        return $this->fechaMod;
    }

    function setUsuarioMod($usuarioMod) {
        $this->usuarioMod = $usuarioMod;
    }

    function setFechaMod(\DateTime $fechaMod) {
        $this->fechaMod = $fechaMod;
    }

    public function __toString() {
        return $this->marca;
    }

    function getEstado() {
        return $this->estado;
    }

    function getPublicado() {
        return $this->publicado;
    }

    function setEstado($estado) {
        $this->estado = $estado;
    }

    function setPublicado($publicado) {
        $this->publicado = $publicado;
    }

    function getCombustible() {
        return $this->combustible;
    }

    function setCombustible($combustible) {
        $this->combustible = $combustible;
    }

    public function setImagenes($imagenes) {
        foreach ($imagenes as $imagen) {
            $imagen->setVehiculo($this);
        }
        $this->imagenes = $imagenes;

        return $this;
    }

    public function getImagenes() {
        return $this->imagenes;
    }

    public function addImagenes($imagen) {
        $imagen->setVehiculo($this);
        $this->imagenes->add($imagen);
    }

}
