<?php

namespace BeTeen\ForumBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use BeTeen\ForumBundle\Entity\Categorie;
use BeTeen\ForumBundle\Entity\SujetStandard;
use BeTeen\ForumBundle\Form\SujetStandardType;

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
	$sujet = $repository->findOneSubjectSlug($sujet);
        if($sujet == null)
        {
            throw $this->createNotFoundException('Sujet non trouvé');
        }
	return $this->render('BeTeenForumBundle:Forum:Sujet.html.twig',array("sujet"=>$sujet));
    }
    
    public function ajouterSujetAction($categorie)
    {
        $manager = $this->getDoctrine()->getManager();
	$repository = $manager->getRepository("BeTeenForumBundle:Categorie");
        
        $sujet = new SujetStandard();
        $position = $repository->findOneBySlug($categorie);
        $sujet->setCategorie($position);
        $form = $this->createForm(new SujetStandardType, $sujet);
        $requete = $this->get("request");
        if($requete->getMethod() == 'POST')
        {
            $form->bind($requete);
            if($form->isValid())
            {
                $manager->persist($sujet);
                $manager->flush();
                return $this->redirect($this->generateUrl("be_teen_forum_categorie",array("categorie"=>$categorie)));
            }
        }
        else
        {
            return $this->render("BeTeenForumBundle:Formulaire:nouveauSujetStandard.html.twig",array("form"=>$form->createView(),"categorieActuelle"=>$position));
        }
    }
	
}
