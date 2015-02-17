<?php

namespace BeTeen\UserBundle\Controller;

use BeTeen\UserBundle\Entity\User;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\Security\Core\SecurityContext;
use BeTeen\UserBundle\Form\UserRegisterType;

class UserController extends Controller
{
    public function loginAction()
    {
        if($this->get("security.context")->isGranted('IS_AUTHENTICATED_REMEMBERED'))
        {
            return $this->redirect($this->generateUrl("be_teen_index_index"));
        }
        
        $request = $this->get("request");
        $session = $this->get("request")->getSession();
        
        if($request->attributes->has(SecurityContext::AUTHENTICATION_ERROR))
        {
            $error = $request->attributes->get(SecurityContext::AUTHENTICATION_ERROR);
        }
        else
        {
            $error = $request->attributes->get(SecurityContext::AUTHENTICATION_ERROR);
            $session->remove(SecurityContext::AUTHENTICATION_ERROR);
        }
        
        return $this->render('BeTeenUserBundle:User:connexion.html.twig', array(
                            "last_username"=>$session->get(SecurityContext::LAST_USERNAME),
                            "error"=>$error));
    }
    
    public function profilAction($usr)
    {
        $user = $this->getDoctrine()->getRepository("BeTeenUserBundle:User")->findOneByUsername($usr);
        return $this->render("BeTeenUserBundle:User:profil.html.twig",array("utilisateur"=>$user));
    }

    public function registerAction()
    {
        $user = new User();
        $form = $this->createForm(new UserRegisterType, $user);

        $request = $this->get("request");

        $form->handleRequest($request);

        if($form->isValid())
        {
            //Generation du sel
            $user->setSalt(rand(0,pow(10,9)));
            //Generation du mot de passe
            $factory = $this->get('security.encoder_factory');
            $encoder = $factory->getEncoder($user);
            $user->setPassword($encoder->encodePassword($user->getPassword(),$user->getSalt()));
            //Enregistrement en BDD
            $manager = $this->getDoctrine()->getManager();
            $manager->persist($user);
            $manager->flush();
            $this->get("session")->getFlashBag()->add("info","votre compte à été crée, vous pouvez des à présent vous connecter");
            return $this->redirect($this->generateUrl("be_teen_index_index"));
        }

        return $this->render("BeTeenUserBundle:User:enregistrement.html.twig",array("form"=>$form->createView()));
    }
}
