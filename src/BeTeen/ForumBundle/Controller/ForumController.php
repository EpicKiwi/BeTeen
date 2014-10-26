<?php

namespace BeTeen\ForumBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use BeTeen\ForumBundle\Entity\Categorie;

class ForumController extends Controller
{
    public function categorieAction($categorie)
    {
        $manager = $this->getDoctrine()->getManager();
	$repository = $manager->getRepository("BeTeenForumBundle:Categorie");
        
        $position = $repository->findOneBy(array("slug"=>$categorie));
        
        if($position == null)
        {
            throw $this->createNotFoundException('Catégorie non trouvée');
        }
        
	$categories = $repository->children($position,true);
        
        return $this->render('BeTeenForumBundle:Forum:categorie.html.twig',array("listeCategories"=>$categories,"categorieActuelle"=>$position));
    }
	
    public function sujetAction($categorie,$sujet)
    {
        $manager = $this->getDoctrine()->getManager();
	$repository = $manager->getRepository("BeTeenForumBundle:SujetStandard");
	$sujet = $repository->findOneByslug($sujet);
        if($sujet == null)
        {
            throw $this->createNotFoundException('Sujet non trouvé');
        }
	return $this->render('BeTeenForumBundle:Forum:Sujet.html.twig',array("sujet"=>$sujet));
    }
	
}
