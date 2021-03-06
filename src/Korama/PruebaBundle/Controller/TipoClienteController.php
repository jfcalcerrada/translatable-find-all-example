<?php

namespace Korama\PruebaBundle\Controller;

use Korama\PruebaBundle\Entity\TipoCliente;
use Korama\PruebaBundle\Form\TipoClienteType;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;

class TipoClienteController extends Controller
{    
    public function indexAction()
    {
            $listatipoCliente = $this->getDoctrine()
            ->getRepository('KoramaPruebaBundle:TipoCliente')
            ->findAll();

        return $this->render('KoramaPruebaBundle:TipoCliente:index.html.twig', 
                array(
                    'listatipoCliente' => $listatipoCliente
                )
                );
    }
    public function editAction($id=null)
    {
        $em = $this->getDoctrine()->getEntityManager();
        $request = $this->getRequest();
        // create a task and give it some dummy data for this example
        $tipoCliente=$this->cargaEntity($id);

        //$tipoCliente->setNombre('Nuevo Nombre');

        $form = $this->createForm(new TipoClienteType(), $tipoCliente);
        if ($request->getMethod() == 'POST') {
            $form->bindRequest($request);

            if ($form->isValid()) {
            // perform some action, such as saving the task to the database
                $em->persist($tipoCliente);
                $em->flush();
                return $this->redirect($this->generateUrl('tipocliente_view',
                                            array(
                                                "id" => $tipoCliente->getId()
                                      )));
            }
        }

        return $this->render('KoramaPruebaBundle:TipoCliente:edit.html.twig', array(
            'form' => $form->createView(),
        ));
    }
    private function cargaEntity( $id ){

        if (! $id){
            return new TipoCliente();
        }
        $entity = $this->getDoctrine()->getEntityManager()
                       ->find('KoramaPruebaBundle:TipoCliente',$id);
        
        if (!$entity) {
            throw $this->createNotFoundException("No existe esa entidad");
        }

        return $entity;
    }
    public function viewAction($id =0){
        $em = $this->getDoctrine()->getEntityManager();
        
        $tipoCliente = $this->getDoctrine()
        ->getRepository('KoramaPruebaBundle:TipoCliente')
        ->find($id);
        
        
        if (!$tipoCliente) {
            throw $this->createNotFoundException('No product found for id '.$id);
        } 
        //$repository = $em->getRepository('Gedmo\Translatable\Entity\Translation');
        //$translations = $repository->findTranslations($tipoCliente);
        return $this->render('KoramaPruebaBundle:TipoCliente:view.html.twig', array(
            'tipoCliente' => $tipoCliente
        ));
       
        
    }

}
