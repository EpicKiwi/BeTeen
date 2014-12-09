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
    
    public function listAction()
    {
        $manager = $this->getDoctrine()->getManager();
        $repository = $manager->getRepository("BeTeenUserBundle:User");
        $users = $repository->findLimit(0);
        return $this->render('BeTeenAdminBundle:User:list.html.twig',array("utilisateurs"=>$users));
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
                $encoder = $this->get('security.encoder_factory')->getEncoder($utilisateur);
                $encodedPass = $encoder->encodePassword($utilisateur->getPassword(), $utilisateur->getSalt());
                $utilisateur->setPassword($encodedPass);
                $manager = $this->getDoctrine()->getManager();
                $manager->persist($utilisateur);
                $manager->flush();
                $this->get('session')->getFlashBag()->add('info','L\'utilisateur '.$utilisateur->getUsername()." a été ajouté");
                return $this->redirect($this->generateUrl("be_teen_admin_user"));
            }
        }
        
        return $this->render("BeTeenAdminBundle:Forum:Ajouter.html.twig",array("form"=>$form->createView()));
    }
    
    public function modifierAction($user)
    {
        $manager = $this->getDoctrine()->getManager();
        $repository = $manager->getRepository("BeTeenUserBundle:User");
        $userRef = $repository->findOneByUsername($user);
        $utilisateur = $userRef;
        $form = $this->createForm(new UserType(),$utilisateur);
        
        $requete = $this->get("request");
        if($requete->getMethod() == "POST")
        {
            $form->bind($requete);
            if($form->isValid())
            {
                $encoder = $this->get('security.encoder_factory')->getEncoder($utilisateur);
                $encodedPass = $encoder->encodePassword($utilisateur->getPassword(), $utilisateur->getSalt());
                
                if($utilisateur->getPassword() == "")
                {
                    $this->get('session')->getFlashBag()->add('info','Le mot de passe de '.$utilisateur->getUsername()." reste inchangé");
                    $utilisateur->setPassword($userRef->getPassword());
                }
                else
                {
                    $this->get('session')->getFlashBag()->add('info','Le mot de passe de '.$utilisateur->getUsername()." a été modifié");
                    $utilisateur->setPassword($encodedPass);
                }
                $manager->persist($utilisateur);
                $manager->flush();
                $this->get('session')->getFlashBag()->add('info','L\'utilisateur '.$utilisateur->getUsername()." a été modifié");
                return $this->redirect($this->generateUrl("be_teen_admin_user_liste"));
            }
        }
        
        return $this->render("BeTeenAdminBundle:Forum:Modifier.html.twig",array("form"=>$form->createView()));
    }
    
    public function supprimerAction($user)
    {
        $manager = $this->getDoctrine()->getManager();
        $repository = $manager->getRepository("BeTeenUserBundle:User");
        $utilisateur = $repository->findOneByUsername($user);
        $message = "Voulez vous vraiment supprimer l'utilisateur ".$utilisateur->getUsername()." ?";
        
        $form = $this->createFormBuilder($utilisateur)->getForm();
        
        $requete = $this->get("request");
        if($requete->getMethod() == "POST")
        {
            $this->get('session')->getFlashBag()->add('info','L\'utilisateur '.$utilisateur->getUsername()." a été supprimé !");
            $manager->remove($utilisateur);
            $manager->flush();
            return $this->redirect($this->generateUrl("be_teen_admin_user_liste"));
        }
        
        return $this->render('BeTeenAdminBundle:Forum:supprimer.html.twig',array("form"=>$form->createView(),"message"=>$message));
    }
}
