<?php

namespace Korama\PruebaBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;

class DefaultController extends Controller
{
    
    public function inicioAction()
    {
        return $this->render('KoramaPruebaBundle:Default:inicio.html.twig');
        
    }
    
    public function menuAction()
    {
        return $this->render('KoramaPruebaBundle:Default:menu.html.twig');
        
    }    

}
