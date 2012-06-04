<?php

namespace Korama\PruebaBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;

/**
 * Description of TipoCliente
 *
 * @author toyos
 * @ORM\Entity
 * @ORM\Entity(repositoryClass="Korama\PruebaBundle\Entity\TipoClienteRepository")
 */
class TipoCliente {

    /**
     * @var integer $id
     *
     * @ORM\Column(name="id", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $id;

    /**
     * @var string $nombre
     * @ORM\Column(type="string", length=255)
     * @Assert\NotBlank(message="validators.not_blank")
     * @Assert\MaxLength(limit = 255, message="validators.max_length")
     */
    protected $nombre;

    /**
     * @ORM\OneToMany(targetEntity="Cliente", mappedBy="tipoCliente")
     */
    protected $clientes;

    public function __toString() {
        return $this->getNombre();
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
     */
    public function setNombre($nombre) {
        $this->nombre = $nombre;
    }

    /**
     * Get nombre
     *
     * @return string 
     */
    public function getNombre() {
        return $this->nombre;
    }



    public function __construct()
    {
        $this->clientes = new \Doctrine\Common\Collections\ArrayCollection();
    }
    
    /**
     * Add clientes
     *
     * @param Korama\PruebaBundle\Entity\Cliente $clientes
     */
    public function addCliente(\Korama\PruebaBundle\Entity\Cliente $clientes)
    {
        $this->clientes[] = $clientes;
    }

    /**
     * Get clientes
     *
     * @return Doctrine\Common\Collections\Collection 
     */
    public function getClientes()
    {
        return $this->clientes;
    }
}