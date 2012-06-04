<?php

namespace Korama\PruebaBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilder;

/**
 * Description of AlojamientoType
 *
 * @author toyos
 */
class ClienteType extends AbstractType {

    public function buildForm(FormBuilder $builder, array $options) {
        $builder
                ->add("nombre" )
                ->add("tipoCliente")
        ;
    }

    public function getName() {
        return 'cliente';
    }

    public function getDefaultOptions(array $options)
    {
        return array(
            'data_class' => 'Korama\PruebaBundle\Entity\Cliente',
        );
    }
}

?>