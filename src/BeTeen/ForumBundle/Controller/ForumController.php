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
        $position = $repository->findOneBySlugSujetOrder($categorie);
        
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
	return $this->render('BeTeenForumBundle:Forum:sujet.html.twig',array("sujet"=>$sujet,"form"=>$form->createView()));
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
        if($position->getAllowSujetStandard() || $this->get("security.context")->isGranted("ROLE_MODERATEUR"))
        {
            $sujet->setCategorie($position);
            $sujet->setAuteur($this->get('security.context')->getToken()->getUser());
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
        }
        else
        {
            $this->get('session')->getFlashBag()->add('info','Vous ne pouvez pas ajouter de sujet ici !');
            return $this->redirect($this->generateUrl("be_teen_forum_categorie",array("categorie"=>$categorie)));
        }
        return $this->render("BeTeenForumBundle:Formulaire:nouveauSujetStandard.html.twig",array("form"=>$form->createView(),"categorieActuelle"=>$position));
    }
    
  /**
   * @Security("has_role('ROLE_USER')")
   */
    public function modifierSujetAction($categorie,$sujet)
    {
        $manager = $this->getDoctrine()->getManager();
	$repository = $manager->getRepository("BeTeenForumBundle:SujetStandard");
        $sujetActuel = $repository->findOneBySlug($sujet);
        
        if($sujetActuel->getAuteur() == $this->get('security.context')->getToken()->getUser() || $this->get('security.context')->isGranted('ROLE_MODERATEUR'))
        {
            $form = $this->createForm(new SujetStandardType, $sujetActuel);

            $requete = $this->get("request");
            if($requete->getMethod() == 'POST')
            {
                $form->bind($requete);
                if($form->isValid())
                {
                    $manager->persist($sujetActuel);
                    $manager->flush();
                    return $this->redirect($this->generateUrl("be_teen_forum_sujet",array("categorie"=>$categorie,"sujet"=>$sujet)));
                }
            }
        }
        else
        {
            $this->get('session')->getFlashBag()->add('info','Vous ne pouvez pas modifier ce sujet !');
                    return $this->redirect($this->generateUrl("be_teen_forum_sujet",array("categorie"=>$categorie,"sujet"=>$sujet)));
        }
        return $this->render("BeTeenForumBundle:Formulaire:modifierSujetStandard.html.twig",array("form"=>$form->createView(),"sujet"=>$sujetActuel));
    }
    
  /**
   * @Security("has_role('ROLE_USER')")
   */
    public function ajouterReponseAction($categorie,$sujet)
    {
        $manager = $this->getDoctrine()->getManager();
	$repository = $manager->getRepository("BeTeenForumBundle:SujetStandard");
        
        $reponse = new ReponseStandard();
        $sujetActuel = $repository->findOneBySlug($sujet);
        $reponse->setSujet($sujetActuel);
        $reponse->setAuteur($this->getUser());
        
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
    
  /**
   * @Security("has_role('ROLE_USER')")
   */
    public function modifierReponseAction($categorie,$sujet,$reponse)
    {
        $manager = $this->getDoctrine()->getManager();
	$repository = $manager->getRepository("BeTeenForumBundle:ReponseStandard");
        
        $reponse = $repository->find($reponse);
        
        if($reponse->getAuteur() == $this->get('security.context')->getToken()->getUser() || $this->get('security.context')->isGranted('ROLE_MODERATEUR'))
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
            else
            {
                return $this->render("BeTeenForumBundle:Formulaire:modifierReponseStandard.html.twig",array("form"=>$form->createView(),"reponse"=>$reponse));
            }
        }
        else
        {
            $this->get('session')->getFlashBag()->add('info','Vous ne pouvez pas modifier cette réponse');
        }
        return $this->redirect($this->generateUrl("be_teen_forum_sujet",array("categorie"=>$categorie,"sujet"=>$sujet)));
    }
    
  /**
   * @Security("has_role('ROLE_USER')")
   */
    public function supprimerSujetAction($sujet)
    {
        $manager = $this->getDoctrine()->getManager();
        $repository = $manager->getRepository("BeTeenForumBundle:SujetStandard");
        $sujetSupprime = $repository->findOneBySlug($sujet);
        if($sujetSupprime == null)
        {
            throw $this->createNotFoundException("Ce sujet n'existe pas");
        }
        
        if($sujetSupprime->getAuteur() == $this->get('security.context')->getToken()->getUser() || $this->get('security.context')->isGranted('ROLE_MODERATEUR'))
        {
            $form = $this->createFormBuilder($sujetSupprime)->getForm();

            $requete = $this->get("request");
            if($requete->getMethod() == "POST")
            {
                $manager->remove($sujetSupprime);
                $manager->flush();
                $this->get('session')->getFlashBag()->add('info','Le sujet '.$sujetSupprime->getTitre()." a été supprimé");
                return $this->redirect($this->generateUrl("be_teen_forum_categorie",array("categorie"=>$sujetSupprime->getCategorie()->getSlug())));
            }
            
            return $this->render('BeTeenForumBundle:Forum:supprimerSujet.html.twig',array("form"=>$form->createView(),"sujet"=>$sujetSupprime));
        }
        else
        {
            $this->get('session')->getFlashBag()->add('info','Vous ne pouvez pas supprimer ce sujet');
        }
        return $this->redirect($this->generateUrl("be_teen_forum_sujet",array("sujet"=>$sujet,"categorie"=>$sujetSupprime->getCategorie()->getSlug())));
    }
    
  /**
   * @Security("has_role('ROLE_USER')")
   */
    public function supprimerReponseAction($sujet,$categorie,$reponse)
    {
        $manager = $this->getDoctrine()->getManager();
        $repository = $manager->getRepository("BeTeenForumBundle:ReponseStandard");
        $reponseSupprime = $repository->find($reponse);
        if($reponseSupprime == null)
        {
            throw $this->createNotFoundException("Ce sujet n'existe pas");
        }
        
        if($reponseSupprime->getAuteur() == $this->get('security.context')->getToken()->getUser() || $this->get('security.context')->isGranted('ROLE_MODERATEUR'))
        {
            $form = $this->createFormBuilder($reponseSupprime)->getForm();

            $requete = $this->get("request");
            if($requete->getMethod() == "POST")
            {
                $manager->remove($reponseSupprime);
                $manager->flush();
                $this->get('session')->getFlashBag()->add('info',"La réponse a été supprimée");
                return $this->redirect($this->generateUrl("be_teen_forum_sujet",array("sujet"=>$sujet,"categorie"=>$categorie)));
            }
            
            return $this->render('BeTeenForumBundle:Forum:supprimerreponse.html.twig',array("form"=>$form->createView(),"reponse"=>$reponseSupprime));
        }
        else
        {
            $this->get('session')->getFlashBag()->add('info','Vous ne pouvez pas supprimer cette réponse');
        }
        return $this->redirect($this->generateUrl("be_teen_forum_sujet",array("sujet"=>$sujet,"categorie"=>$reponseSupprime->getCategorie()->getSlug())));
    }
	
}
