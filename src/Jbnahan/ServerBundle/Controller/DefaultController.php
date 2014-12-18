<?php

namespace Jbnahan\ServerBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class DefaultController extends Controller
{
    public function indexAction($name)
    {
        return $this->render('JbnahanServerBundle:Default:index.html.twig', array('name' => $name));
    }
}
