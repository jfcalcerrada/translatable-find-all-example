<?php

namespace Korama\PruebaBundle\Controller;

use Korama\PruebaBundle\Entity\Cliente;
use Korama\PruebaBundle\Form\ClienteType;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;

class ClienteController extends Controller
{
    
    public function indexAction()
    {
            $listaCliente = $this->getDoctrine()
            ->getRepository('KoramaPruebaBundle:Cliente')
            ->findAll();

        return $this->render('KoramaPruebaBundle:Cliente:index.html.twig', 
                array(
                    'listaCliente' => $listaCliente
                )
                );
    }
    public function editAction($id=null)
    {
        $em = $this->getDoctrine()->getEntityManager();
        $request = $this->getRequest();
        // create a task and give it some dummy data for this example
        $cliente=$this->cargaEntity($id);

        //$cliente->setNombre('Nuevo Nombre');

        $form = $this->createForm(new ClienteType(), $cliente);
        if ($request->getMethod() == 'POST') {
            $form->bindRequest($request);

            if ($form->isValid()) {
            // perform some action, such as saving the task to the database
                $em->persist($cliente);
                $em->flush();
                return $this->redirect($this->generateUrl('cliente_view',
                                            array(
                                                "id" => $cliente->getId()
                                      )));
            }
        }

        return $this->render('KoramaPruebaBundle:Cliente:edit.html.twig', array(
            'form' => $form->createView(),
        ));
    }
    private function cargaEntity( $id ){

        if (! $id){
            return new Cliente();
        }
        $entity = $this->getDoctrine()->getEntityManager()
                       ->find('KoramaPruebaBundle:Cliente',$id);
        
        if (!$entity) {
            throw $this->createNotFoundException("No existe esa entidad");
        }

        return $entity;
    }
    public function viewAction($id =0){
        $em = $this->getDoctrine()->getEntityManager();
        
        $cliente = $this->getDoctrine()
        ->getRepository('KoramaPruebaBundle:Cliente')
        ->find($id);
        
        
        if (!$cliente) {
            throw $this->createNotFoundException('No product found for id '.$id);
        } 
        $repository = $em->getRepository('Gedmo\Translatable\Entity\Translation');
        $translations = $repository->findTranslations($cliente);
        return $this->render('KoramaPruebaBundle:Cliente:view.html.twig', array(
            'cliente' => $cliente,
            'translations' => $translations
        ));
       
        
    }

    
}
