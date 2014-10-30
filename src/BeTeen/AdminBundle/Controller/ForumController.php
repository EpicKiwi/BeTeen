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
    
    public function supprimerSujetAction($sujet)
    {
        $manager = $this->getDoctrine()->getManager();
        $repository = $manager->getRepository("BeTeenForumBundle:SujetStandard");
        $sujetSupprime = $repository->findOneBySlug($sujet);
        if($sujetSupprime == null)
        {
            throw $this->createNotFoundException("Ce sujet n'existe pas");
        }
        
        $message = "Voulez vous vraiment supprimer le sujet ".$sujetSupprime->getTitre()." ?";
        
        $form = $this->createFormBuilder($sujetSupprime)->getForm();
        
        $requete = $this->get("request");
        if($requete->getMethod() == "POST")
        {
            $this->get('session')->getFlashBag()->add('info','Le sujet '.$sujetSupprime->getTitre()." a été supprimé !");
            $manager->remove($sujetSupprime);
            $manager->flush();
            return $this->redirect($this->generateUrl("be_teen_admin_forum_sujets"));
        }
        
        return $this->render('BeTeenAdminBundle:Forum:supprimer.html.twig',array("form"=>$form->createView(),"message"=>$message));
    }
    
    public function categoriesAction($categorie)
    {
        $manager = $this->getDoctrine()->getManager();
        $repository = $manager->getRepository("BeTeenForumBundle:Categorie");
        $position = $repository->findOneBySlug($categorie);
        if($position == null)
        {
            throw $this->createNotFoundException("Cette catégorie n'existe pas");
        }
        
        $categories = $repository->children($position,true);
        
        return $this->render("BeTeenAdminBundle:Forum:categories.html.twig",array("position"=>$position, "categories"=>$categories));
    }
    
    public function monterCategorieAction($categorie)
    {
        $manager = $this->getDoctrine()->getManager();
        $repository = $manager->getRepository("BeTeenForumBundle:Categorie");
        $position = $repository->findOneBySlug($categorie);
        if($position == null)
        {
            throw $this->createNotFoundException("Cette catégorie n'existe pas");
        }
        
        $repository->moveUp($position,1);
        $this->get('session')->getFlashBag()->add('info','La catégorie '.$position->getNom()." a été décalé d'un rang vers le haut");
                
        return $this->redirect($this->generateUrl("be_teen_admin_forum_categories",array("categorie"=>$position->getParent()->getSlug())));
    }
    
    public function descendreCategorieAction($categorie)
    {
        $manager = $this->getDoctrine()->getManager();
        $repository = $manager->getRepository("BeTeenForumBundle:Categorie");
        $position = $repository->findOneBySlug($categorie);
        if($position == null)
        {
            throw $this->createNotFoundException("Cette catégorie n'existe pas");
        }
        
        $repository->moveDown($position,1);
        $this->get('session')->getFlashBag()->add('info','La catégorie '.$position->getNom()." a été décalé d'un rang vers le bas");
                
        return $this->redirect($this->generateUrl("be_teen_admin_forum_categories",array("categorie"=>$position->getParent()->getSlug())));
    }
    
    public function supprimerCategorieAction($categorie)
    {
        $manager = $this->getDoctrine()->getManager();
        $repository = $manager->getRepository("BeTeenForumBundle:Categorie");
        $cat = $repository->findOneBySlug($categorie);
        if($cat == null)
        {
            throw $this->createNotFoundException("Ce sujet n'existe pas");
        }
        
        $message = "Voulez vous vraiment supprimer la Catégorie ".$cat->getNom()." ?<br/>Cela entrainera la suppression de toutes les catégories parentes et de tout les sujets attachés a ces catégories";
        
        $form = $this->createFormBuilder($cat)->getForm();
        
        $requete = $this->get("request");
        if($requete->getMethod() == "POST")
        {
            $this->get('session')->getFlashBag()->add('info','La catégorie '.$cat->getNom()." a été supprimée !");
            $manager->remove($cat);
            $manager->flush();
            return $this->redirect($this->generateUrl("be_teen_admin_forum_categories",array("categorie"=>$cat->getParent()->getSlug())));
        }
        
        return $this->render('BeTeenAdminBundle:Forum:supprimer.html.twig',array("form"=>$form->createView(),"message"=>$message));
    }
    
    public function switchAllowSujetAction($categorie)
    {
        $manager = $this->getDoctrine()->getManager();
        $repository = $manager->getRepository("BeTeenForumBundle:Categorie");
        $cat = $repository->findOneBySlug($categorie);
        if($cat == null)
        {
            throw $this->createNotFoundException("Ce sujet n'existe pas");
        }
        
        
        if($cat->getAllowSujetStandard())
        {
            $cat->setAllowSujetStandard(false);
            $this->get('session')->getFlashBag()->add('info','La catégorie '.$cat->getNom()." refuse maintenant la création de sujets standards");
        }
        else
        {
            $cat->setAllowSujetStandard(true);
            $this->get('session')->getFlashBag()->add('info','La catégorie '.$cat->getNom()." accepte maintenant la création de sujets standards");
        }
        
        $manager->persist($cat);
        $manager->flush();
        
        return $this->redirect($this->generateUrl("be_teen_admin_forum_categories",array("categorie"=>$cat->getParent()->getSlug())));
    }
}
