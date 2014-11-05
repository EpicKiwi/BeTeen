<?php

namespace BeTeen\IndexBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class DefaultController extends Controller
{
    public function indexAction($name)
    {
        return $this->render('BeTeenIndexBundle:Default:index.html.twig', array('name' => $name));
    }
}
