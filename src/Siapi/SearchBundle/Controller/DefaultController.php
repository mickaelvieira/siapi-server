<?php

namespace Siapi\SearchBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class DefaultController extends Controller
{
    public function indexAction($name)
    {
        return $this->render('SiapiSearchBundle:Default:index.html.twig', array('name' => $name));
    }
}
