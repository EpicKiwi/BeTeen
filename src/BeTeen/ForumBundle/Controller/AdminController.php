<?php

namespace BeTeen\ForumBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use \BeTeen\UserBundle\Entity\User;

class AdminController extends Controller
{
    public function InitializeAction()
    {
        $manager = $this->getDoctrine()->getManager();
	$repository = $manager->getRepository("BeTeenUserBundle:User");
        
        if($repository->findBy(array("username"=>"admin")) == null)
        {
            $index = new User();
            $index->setUsername("admin");
            $index->setPassword("root");
            $index->setSalt("");
            $index->setRoles(array("ROLE_SUPER_ADMIN"));
            
            $manager->persist($index);
            
            $manager->flush();
        }
        
        return $this->redirect($this->generateUrl("be_teen_forum_index"));
    }
}
