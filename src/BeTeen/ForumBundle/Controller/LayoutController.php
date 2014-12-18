<?php

namespace BeTeen\ForumBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use \BeTeen\UserBundle\Entity\User;

class LayoutController extends Controller 
{
    public function sujetAction($input,$reponse = false)
    {
        return $this->render("BeTeenForumBundle:Layout:sujet.html.twig",array("isReponse"=>$reponse,"input"=>$input));
    }
}
