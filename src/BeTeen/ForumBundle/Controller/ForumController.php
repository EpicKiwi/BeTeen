<?php

namespace BeTeen\ForumBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use BeTeen\ForumBundle\Entity\Categorie;
use BeTeen\ForumBundle\Entity\SujetStandard;
use BeTeen\ForumBundle\Form\SujetStandardType;
use BeTeen\ForumBundle\Entity\ReponseStandard;
use BeTeen\ForumBundle\Form\ReponseStandardType;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Security;

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
        
        $reponse = new ReponseStandard();
        $reponse->setSujet($sujet);
        $form = $this->createForm(new ReponseStandardType, $reponse);
        
        if($sujet == null)
        {
            throw $this->createNotFoundException('Sujet non trouvé');
        }
	return $this->render('BeTeenForumBundle:Forum:Sujet.html.twig',array("sujet"=>$sujet,"form"=>$form->createView()));
    }
    
  /**
   * @Security("has_role('ROLE_USER')")
   */
    public function ajouterSujetAction($categorie)
    {
        $manager = $this->getDoctrine()->getManager();
	$repository = $manager->getRepository("BeTeenForumBundle:Categorie");
        
        $sujet = new SujetStandard();
        $position = $repository->findOneBySlug($categorie);
        if($position->getAllowSujetStandard())
        {
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
        else
        {
            $this->get('session')->getFlashBag()->add('info','Vous ne pouvez pas ajouter de sujet ici !');
            return $this->redirect($this->generateUrl("be_teen_forum_categorie",array("categorie"=>$categorie)));
        }
    }
    
    public function ajouterReponseAction($categorie,$sujet)
    {
        $manager = $this->getDoctrine()->getManager();
	$repository = $manager->getRepository("BeTeenForumBundle:SujetStandard");
        
        $reponse = new ReponseStandard();
        $sujetActuel = $repository->findOneBySlug($sujet);
        $reponse->setSujet($sujetActuel);
        
        if($sujetActuel->getVerouille() == false)
        {
            $form = $this->createForm(new ReponseStandardType, $reponse);

            $requete = $this->get("request");

            if($requete->getMethod() == 'POST')
            {
                $form->bind($requete);
                if($form->isValid())
                {
                    $manager->persist($reponse);
                    $manager->flush();
                }
            }
        }
        $this->get('session')->getFlashBag()->add('info','Ce sujet est verouillé');
        return $this->redirect($this->generateUrl("be_teen_forum_sujet",array("categorie"=>$categorie,"sujet"=>$sujet)));
    }
	
}
