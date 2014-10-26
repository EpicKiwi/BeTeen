<?php

namespace BeTeen\ForumBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use BeTeen\ForumBundle\Entity\Categorie;

class AdminController extends Controller
{
    public function InitializeAction()
    {
        $manager = $this->getDoctrine()->getManager();
	$repository = $manager->getRepository("BeTeenForumBundle:Categorie");
        
        if($repository->findBy(array("nom"=>"Index")) == null)
        {
            $index = new Categorie();
            $index->setNom("Index");
            $index->setDescription("Racine du forum");
            
            $cafe = new Categorie();
            $cafe->setNom("Café");
            $cafe->setDescription("On parle de tout et de rien");
            $cafe->setParent($index);
            
            $arts = new Categorie();
            $arts->setNom("Arts");
            $arts->setDescription("Diffusez vos créations");
            $arts->setParent($index);
            
            $bla = new Categorie();
            $bla->setNom("Bla Bla");
            $bla->setDescription("Parlez de tout et de rien");
            $bla->setParent($cafe);
            
            $jeux = new Categorie();
            $jeux->setNom("Jeux");
            $jeux->setDescription("Jouez a un petit jeu sur le forum");
            $jeux->setParent($cafe);
            
            $graphique = new Categorie();
            $graphique->setNom("Graphique");
            $graphique->setDescription("Diffusez vos photos et dessins");
            $graphique->setParent($arts);
            
            $audio = new Categorie();
            $audio->setNom("Audio");
            $audio->setDescription("Diffusez vos créations musicales");
            $audio->setParent($arts);
            
            $video = new Categorie();
            $video->setNom("Video");
            $video->setDescription("Diffusez vos créations visuelles");
            $video->setParent($arts);
            
            $autre = new Categorie();
            $autre->setNom("Autres");
            $autre->setDescription("Autre chose a diffuser ?");
            $autre->setParent($arts);
            
            $manager->persist($index);
            $manager->persist($cafe);
            $manager->persist($arts);
            $manager->persist($bla);
            $manager->persist($jeux);
            $manager->persist($graphique);
            $manager->persist($audio);
            $manager->persist($video);
            $manager->persist($autre);
            
            $manager->flush();
        }
        
        return $this->redirect($this->generateUrl("be_teen_forum_index"));
    }
}
