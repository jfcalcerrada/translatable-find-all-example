<?php

namespace Korama\PruebaBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;

use Doctrine\Common\Collections\ArrayCollection;
use Gedmo\Mapping\Annotation as Gedmo;
use Gedmo\Translatable\Translatable;

/**
 * Description of TipoCliente
 *
 * @author toyos
 * @ORM\Entity
 * @ORM\Entity(repositoryClass="Korama\PruebaBundle\Entity\TipoClienteRepository")
 * @Gedmo\TranslationEntity(class="Korama\PruebaBundle\Entity\TipoClienteTranslation")
 */
class TipoCliente  {

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
     * @Gedmo\Translatable
     * @ORM\Column(type="string", length=255)
     * @Assert\NotBlank(message="validators.not_blank")
     * @Assert\MaxLength(limit = 255, message="validators.max_length")
     */
    protected $nombre;
    
 /**
     * @ORM\OneToMany(
     *   targetEntity="TipoClienteTranslation",
     *   mappedBy="object",
     *   cascade={"persist", "remove"}
     * )
     */ 
    private $translations; 
    
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
    
    /**
     * @Gedmo\Locale
     * Used locale to override Translation listener`s locale
     * this is not a mapped field of entity metadata, just a simple property
     */
    private $locale;
    
    public function setTranslatableLocale($locale)
    {
        $this->locale = $locale;
    }
    
    public function __construct()
    {
        $this->translations = new ArrayCollection();
        $this->clientes = new \Doctrine\Common\Collections\ArrayCollection();
    }
    /**
     * Add translations
     *
     * @param Korama\PruebaBundle\Entity\TipoClienteTranslation $translation
     */
    public function addTranslation(\Korama\PruebaBundle\Entity\TipoClienteTranslation $translation)
    {
        if (!$this->translations->contains($translation)) {
            $this->translations[] = $translation;
            $translation->setObject($this);
        }
     }

    /**
     * Get translations
     *
     * @return Doctrine\Common\Collections\Collection 
     */
    public function getTranslations()
    {
        return $this->translations;
    }
}