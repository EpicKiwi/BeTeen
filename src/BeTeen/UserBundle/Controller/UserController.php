<?php

namespace BeTeen\UserBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\Security\Core\SecurityContext;

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
}
