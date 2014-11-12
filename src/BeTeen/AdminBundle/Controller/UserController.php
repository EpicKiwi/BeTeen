<?php

namespace BeTeen\AdminBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class UserController extends Controller
{
    public function indexAction()
    {
        $manager = $this->getDoctrine()->getManager();
        $repository = $manager->getRepository("BeTeenUserBundle:User");
        $users = $repository->findLimit(10);
        return $this->render('BeTeenAdminBundle:User:index.html.twig',array("utilisateurs"=>$users));
    }
}
