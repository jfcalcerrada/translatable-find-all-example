<?php

namespace Korama\PruebaBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilder;

/**
 * Description of AlojamientoType
 *
 * @author toyos
 */
class TipoClienteType extends AbstractType {

    public function buildForm(FormBuilder $builder, array $options) {
        $builder
                ->add("nombre" )
        ;
    }

    public function getName() {
        return 'tipocliente';
    }

    public function getDefaultOptions(array $options)
    {
        return array(
            'data_class' => 'Korama\PruebaBundle\Entity\TipoCliente',
        );
    }
}

?>