<?php

namespace Korama\PruebaBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Doctrine\Common\Collections\ArrayCollection;
use Symfony\Component\Validator\Constraints as Assert;

/**
 * Description of Alojamiento
 *
 * @author toyos
 * @ORM\Entity(repositoryClass="Korama\PruebaBundle\Entity\ClienteRepository")
 */
class Cliente {
    /**
     * @var integer $id
     * @ORM\Column(name="id", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $id;

    /**
     * @var string $nombre
     * @ORM\Column(type="string", length=255)
     */
    protected $nombre;
    /**
     * @ORM\ManyToOne(targetEntity="TipoCliente", inversedBy="clientes")
     * @ORM\JoinColumn(name="tipo_cliente_id", referencedColumnName="id")
     */ 
    protected $tipoCliente;
  
    /**
     * Get id
     *
     * @return integer 
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * Set nombre
     *
     * @param string $nombre
     */
    public function setNombre($nombre)
    {
        $this->nombre = $nombre;
    }

    /**
     * Get nombre
     *
     * @return string 
     */
    public function getNombre()
    {
        return $this->nombre;
    }

 

    /**
     * Set tipo_cliente
     *
     * @param Korama\PruebaBundle\Entity\TipoCliente $tipoCliente
     */
    public function setTipoCliente(\Korama\PruebaBundle\Entity\TipoCliente $tipoCliente)
    {
        $this->tipoCliente = $tipoCliente;
    }

    /**
     * Get tipo_alojamiento
     *
     * @return Korama\PruebaBundle\Entity\TipoCliente $tipoCliente
     */
    public function getTipoCliente()
    {
        return $this->tipoCliente;
    }
    

    public function __toString(){
        return $this->getNombre();
    }
}