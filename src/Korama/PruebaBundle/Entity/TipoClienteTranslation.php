<?php

namespace Korama\PruebaBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Gedmo\Translatable\Entity\MappedSuperclass\AbstractTranslation;

/**
 *
 * @author toyos
 * 
 * @ORM\Table(name="tipo_cliente_translations", indexes={
 *     @ORM\index(name="tipo_cliente_translation_idx", columns={"locale", "object_class", "field", "foreign_key"})
 * })
 * @ORM\Entity(repositoryClass="Gedmo\Translatable\Entity\Repository\TranslationRepository")
 */
class TipoClienteTranslation extends AbstractTranslation
{
    /**
     * All required columns are mapped through inherited superclass
     */
}
?>