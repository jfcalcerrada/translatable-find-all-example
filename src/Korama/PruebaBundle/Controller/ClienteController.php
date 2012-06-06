<?php

namespace Korama\PruebaBundle\Controller;

use Korama\PruebaBundle\Entity\Cliente;
use Korama\PruebaBundle\Form\ClienteType;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;

class ClienteController extends Controller
{
    
    public function newAction(Request $request)
    {
        $em = $this->getDoctrine()->getEntityManager();
        // create a task and give it some dummy data for this example
        $cliente = new Cliente();
        $cliente->setNombre('Nuevo Nombre');

        $form = $this->createForm(new ClienteType(), $cliente);
        if ($request->getMethod() == 'POST') {
            $form->bindRequest($request);

            if ($form->isValid()) {
            // perform some action, such as saving the task to the database
                $em->persist($cliente);
                $em->flush();
                return $this->redirect($this->generateUrl('cliente_saved'));
            }
        }

        return $this->render('KoramaPruebaBundle:Cliente:edit.html.twig', array(
            'form' => $form->createView(),
        ));
    }
    public function savedAction(){
        return new Response('<html><body><h1>SAVED</h1></body></html>');
    }
    
}
