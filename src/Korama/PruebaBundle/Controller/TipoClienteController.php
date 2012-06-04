<?php

namespace Korama\PruebaBundle\Controller;

use Korama\PruebaBundle\Entity\TipoCliente;
use Korama\PruebaBundle\Form\TipoClienteType;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;

class TipoClienteController extends Controller
{
    
    public function newAction(Request $request)
    {
        $em = $this->getDoctrine()->getEntityManager();
        // create a task and give it some dummy data for this example
        $tipoCliente = new TipoCliente();
        $tipoCliente->setNombre('Nuevo Nombre');

        $form = $this->createForm(new TipoClienteType(), $tipoCliente);
        if ($request->getMethod() == 'POST') {
            $form->bindRequest($request);

            if ($form->isValid()) {
            // perform some action, such as saving the task to the database
                $em->persist($tipoCliente);
                $em->flush();
                return $this->redirect($this->generateUrl('tipoCliente_saved'));
            }
        }

        return $this->render('KoramaPruebaBundle:TipoCliente:new.html.twig', array(
            'form' => $form->createView(),
        ));
    }
    public function savedAction(){
        return new Response('<html><body><h1>SAVED</h1></body></html>');
    }
    
}
