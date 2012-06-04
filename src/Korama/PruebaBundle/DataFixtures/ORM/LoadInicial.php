<?php

namespace Korama\PruebaBundle\DataFixtures\ORM;

use Doctrine\Common\Persistence\ObjectManager;
use Doctrine\Common\DataFixtures\AbstractFixture;
use Doctrine\Common\DataFixtures\OrderedFixtureInterface;
use Symfony\Component\DependencyInjection\ContainerAwareInterface;
use Symfony\Component\DependencyInjection\ContainerInterface;

use Korama\PruebaBundle\Entity\Cliente,
 Korama\PruebaBundle\Entity\TipoCliente;


/**
 * Description of LoadInicial
 *
 * @author toyos
 */
class LoadInicial extends AbstractFixture implements OrderedFixtureInterface, ContainerAwareInterface
{
 
    public function setContainer(ContainerInterface $container = null)
    {
        $this->container = $container;
    }
    
    public function load(ObjectManager $manager)
    {
        $this->manager = $manager;


        
        // -- Cargar datos de TIPO_CLIENTES-------------------------------------
        $tipos_str=array(
                    "Mayorista",
                    "Minorista",
                    "Comercial"
            );
       
        foreach ($tipos_str as $tipo_str){
            $tipoCliente= new TipoCliente();
            $tipoCliente->setNombre($tipo_str);
            $manager->persist($tipoCliente);
        }
        
        $manager->flush();  

        
        $tiposCliente = $manager->getRepository('KoramaPruebaBundle:TipoCliente')->findAll();        
         // -- Cargar datos de Cliente------------------------------------
        foreach (range(1, 5) as $i) {
            $cliente = new Cliente();

            $cliente->setNombre($this->getNombreDePila());
            $cliente->setTipoCliente($tiposCliente[array_rand($tiposCliente)]);

            $manager->persist($cliente);
        }
        $manager->flush();  
        

 
 
    }
    private function getNombreDePila(){
        return $this->getNombre()." ".$this->getApellidos();
    }
    /**
     * Generador aleatorio de nombres de personas
     * Aproximadamente genera un 50% de hombres y un 50% de mujeres
     */
    private function getNombre()
    {
        // Los nombres más populares en España según el INE
        // Fuente: http://www.ine.es/daco/daco42/nombyapel/nombyapel.htm
        
        $hombres = array('Antonio', 'José', 'Manuel', 'Francisco', 'Juan', 'David', 'José Antonio', 'José Luis', 'Jesús', 'Javier', 'Francisco Javier', 'Carlos', 'Daniel', 'Miguel', 'Rafael', 'Pedro', 'José Manuel', 'Ángel', 'Alejandro', 'Miguel Ángel', 'José María', 'Fernando', 'Luis', 'Sergio', 'Pablo', 'Jorge', 'Alberto');
        $mujeres = array('María Carmen', 'María', 'Carmen', 'Josefa', 'Isabel', 'Ana María', 'María Dolores', 'María Pilar', 'María Teresa', 'Ana', 'Francisca', 'Laura', 'Antonia', 'Dolores', 'María Angeles', 'Cristina', 'Marta', 'María José', 'María Isabel', 'Pilar', 'María Luisa', 'Concepción', 'Lucía', 'Mercedes', 'Manuela', 'Elena', 'Rosa María');
        
        if (rand() % 2) {
            return $hombres[array_rand($hombres)];
        }
        else {
            return $mujeres[array_rand($mujeres)];
        }
    }
    
    /**
     * Generador aleatorio de apellidos de personas
     */
    private function getApellidos()
    {
        // Los apellidos más populares en España según el INE
        // Fuente: http://www.ine.es/daco/daco42/nombyapel/nombyapel.htm
        
        $apellidos = array('García', 'González', 'Rodríguez', 'Fernández', 'López', 'Martínez', 'Sánchez', 'Pérez', 'Gómez', 'Martín', 'Jiménez', 'Ruiz', 'Hernández', 'Díaz', 'Moreno', 'Álvarez', 'Muñoz', 'Romero', 'Alonso', 'Gutiérrez', 'Navarro', 'Torres', 'Domínguez', 'Vázquez', 'Ramos', 'Gil', 'Ramírez', 'Serrano', 'Blanco', 'Suárez', 'Molina', 'Morales', 'Ortega', 'Delgado', 'Castro', 'Ortíz', 'Rubio', 'Marín', 'Sanz', 'Iglesias', 'Nuñez', 'Medina', 'Garrido');
        
        return $apellidos[array_rand($apellidos)].' '.$apellidos[array_rand($apellidos)];
    }
    public function getOrder()
    {
        return 1;
    }
}