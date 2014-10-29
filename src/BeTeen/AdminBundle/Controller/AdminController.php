<?php

namespace BeTeen\AdminBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class AdminController extends Controller
{
    public function indexAction()
    {
        $manager = $this->getDoctrine()->getManager();
        $repository = $manager->getRepository("BeTeenForumBundle:SujetStandard");
        $sujets = $repository->findAllLimitorderByDate(10);
        return $this->render('BeTeenAdminBundle:Index:index.html.twig',array("sujets"=>$sujets));
    }
}
