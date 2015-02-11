<?php

namespace BeTeen\IndexBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class IndexController extends Controller
{
    public function indexAction()
    {
    	$repository = $this->getDoctrine()->getRepository("BeTeenForumBundle:Categorie");
    	$index = $repository->findOneBySlug("index");
        if($index == null)
        {
            throw $this->createNotFoundException('Index inéxistant : vous devez créer un index de forum sur votre base de données avec le slug "index"');
        }
        
    	$categories = $repository->children($index,true);
        return $this->render('BeTeenIndexBundle:Default:index.html.twig', array('index' => $index, 'categories' => $categories ));
    }
}
