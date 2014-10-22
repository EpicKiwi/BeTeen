<?php

namespace BeTeen\ForumBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class ForumController extends Controller
{
    public function categorieAction($categorie)
    {
		$manager = $this->getDoctrine()->getManager();
		$repository = $manager->getRepository("BeTeenForumBundle:Categorie");
		if($categorie == 0)
		{
			$position = $repository->findOneBy(array("nom"=>"Index"));
		}
		else
		{
			$position = $repository->find($categorie);
		}
		$categories = $repository->findAllSubcategories($position);
        return $this->render('BeTeenForumBundle:Forum:index.html.twig',array("listeCategories"=>$categories,"categorieActuelle"=>$position));
    }
	
}
