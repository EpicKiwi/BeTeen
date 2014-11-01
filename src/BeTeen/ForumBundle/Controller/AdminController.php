<?php

namespace BeTeen\ForumBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use BeTeen\ForumBundle\Entity\Categorie;
use BeTeen\ForumBundle\Entity\SujetStandard;

class AdminController extends Controller
{
    public function InitializeAction()
    {
        $manager = $this->getDoctrine()->getManager();
	$repository = $manager->getRepository("BeTeenForumBundle:Categorie");
        
        if($repository->findBy(array("slug"=>"index")) == null)
        {
            $index = new Categorie();
            $index->setNom("Index");
            $index->setAllowSujetStandard(false);
            $index->setDescription("Racine du forum");
            
            $manager->persist($index);
            
            $manager->flush();
        }
        
        return $this->redirect($this->generateUrl("be_teen_forum_index"));
    }
}
