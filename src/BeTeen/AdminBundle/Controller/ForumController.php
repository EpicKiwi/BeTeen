<?php

namespace BeTeen\AdminBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class ForumController extends Controller
{
    public function indexAction()
    {
        $manager = $this->getDoctrine()->getManager();
        $repository = $manager->getRepository("BeTeenForumBundle:Categorie");
        $index = $repository->findOneBySlug("index");
        $categories = $repository->children($index,true);
        return $this->render('BeTeenAdminBundle:Forum:index.html.twig',array("categories"=>$categories));
    }
    
    public function sujetsAction($limit = 0,$inside = false)
    {
        $manager = $this->getDoctrine()->getManager();
        $repository = $manager->getRepository("BeTeenForumBundle:SujetStandard");
        
        if($limit > 0)
        {
            $sujets = $repository->findAllLimitOrderByDate($limit);
        }
        else
        {
            $sujets = $repository->findAllOrderByDate();
        }
        
        if($inside)
        {
            return $this->render('BeTeenAdminBundle:Forum:insideSujets.html.twig',array("sujets"=>$sujets));
        }
        else
        {
            return $this->render('BeTeenAdminBundle:Forum:sujets.html.twig',array("sujets"=>$sujets));
        }
    }
}
