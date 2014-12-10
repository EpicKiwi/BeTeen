<?php

namespace BeTeen\IndexBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class IndexController extends Controller
{
    public function indexAction()
    {
        $manager = $this->getDoctrine()->getManager();
	$repository = $manager->getRepository("BeTeenForumBundle:Categorie");
        $categories = $repository->childrenTopicJoin("index");
        return $this->render('BeTeenIndexBundle:Default:index.html.twig', array('name' => "world" ));
    }
}
