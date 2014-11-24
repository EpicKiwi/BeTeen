<?php

namespace BeTeen\AdminBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use \BeTeen\UserBundle\Entity\User;
use BeTeen\UserBundle\Form\UserType;

class UserController extends Controller
{
    public function indexAction()
    {
        $manager = $this->getDoctrine()->getManager();
        $repository = $manager->getRepository("BeTeenUserBundle:User");
        $users = $repository->findLimit(10);
        return $this->render('BeTeenAdminBundle:User:index.html.twig',array("utilisateurs"=>$users));
    }
    
    public function ajoutAction()
    {
        $utilisateur = new User();
        $utilisateur->setRoles(array("ROLE_USER"));
        $utilisateur->setSalt("");
		$utilisateur->setAvatar("");
		$utilisateur->setBackground("");
		$utilisateur->setDescription("");
        
        $form = $this->createForm(new UserType(),$utilisateur);
        
        $requete = $this->get("request");
        if($requete->getMethod() == "POST")
        {
            $form->bind($requete);
            if($form->isValid())
            {
                $manager = $this->getDoctrine()->getManager();
                $manager->persist($utilisateur);
                $manager->flush();
                $this->get('session')->getFlashBag()->add('info','L\'utilisateur '.$utilisateur->getUsername()." a été ajouté");
                return $this->redirect($this->generateUrl("be_teen_admin_user"));
            }
        }
        
        return $this->render("BeTeenAdminBundle:Forum:Ajouter.html.twig",array("form"=>$form->createView()));
    }
}
