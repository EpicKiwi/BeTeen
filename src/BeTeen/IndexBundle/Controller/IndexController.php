<?php

namespace BeTeen\IndexBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class IndexController extends Controller
{
    public function indexAction()
    {
        return $this->render('BeTeenIndexBundle:Default:index.html.twig', array('name' => "world" ));
    }
}
