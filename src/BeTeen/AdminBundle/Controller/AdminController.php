<?php

namespace BeTeen\AdminBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class AdminController extends Controller
{
    public function indexAction()
    {
        return $this->render('BeTeenAdminBundle:Index:index.html.twig');
    }
}
