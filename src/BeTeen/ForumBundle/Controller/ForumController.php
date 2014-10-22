<?php

namespace BeTeen\ForumBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class ForumController extends Controller
{
	public function indexAction()
	{
		$manager = $this->getDoctrine()->getManager();
		$repository = $manager->getRepository("BeTeenForumBundle:Categorie");
		$position = $repository->findOneBy(array("nom"=>"Index"));
		$categories = $repository->findAllSubcategories($position);
        return $this->render('BeTeenForumBundle:Forum:index.html.twig',array("listeCategories"=>$categories,"categorieActuelle"=>$position));
	}
    public function categorieAction($categorie)
    {
		$manager = $this->getDoctrine()->getManager();
		$repository = $manager->getRepository("BeTeenForumBundle:Categorie");
		$position = $repository->find($categorie);
		$categories = $repository->findAllSubcategories($position);
        return $this->render('BeTeenForumBundle:Forum:index.html.twig',array("listeCategories"=>$categories,"categorieActuelle"=>$position));
    }
	
}
