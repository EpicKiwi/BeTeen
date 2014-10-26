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
            
            $sujet = new SujetStandard();
            $sujet->setCategorie($index);
            $sujet->setTitre("Bienvenue sur le forum");
            $sujet->setDate(new \DateTime);
            $sujet->setContenu("Bienvenue a tous sur le forum !  Lorem ipsum dolor sit amet, consectetur adipiscing elit. Nulla eget purus libero. Proin mollis est at justo tempor, sed pulvinar enim tincidunt. Vestibulum dignissim sodales justo ac egestas. Vestibulum ac nunc porta, porta sapien in, gravida nunc. Ut at diam at nibh egestas hendrerit. Mauris turpis erat, commodo sed nulla id, suscipit egestas velit. Etiam in est mollis, varius diam sed, accumsan risus. Quisque malesuada pharetra lorem in ornare. Aenean convallis purus ex. In molestie massa felis, quis mollis tortor eleifend non. Aliquam semper a erat ut condimentum.Duis in dui massa. Proin interdum urna vitae blandit tempor. Sed consequat mauris a bibendum scelerisque. Curabitur aliquet, urna eget rutrum condimentum, mauris odio commodo sem, eget rutrum magna dui ac sapien. Sed lacinia efficitur justo quis varius. Praesent turpis nunc, viverra a fringilla ut, condimentum in ex. Cras vel pharetra arcu, eu efficitur sapien. Donec iaculis rutrum erat vel interdum. Nullam ullamcorper sem dictum justo viverra mattis. In hac habitasse platea dictumst. Cras scelerisque, arcu eu elementum molestie, eros felis consectetur dui, tristique faucibus dolor velit id metus. Pellentesque dui mauris, faucibus sed lorem at, ultrices pulvinar lacus.Nunc at tempor neque. Vivamus consectetur felis at justo egestas gravida. Maecenas a posuere nibh. Sed venenatis faucibus eleifend. Quisque sed est dictum, lacinia nibh eu, luctus erat. Sed mi nulla, accumsan vitae eros sed, dictum viverra libero. Quisque blandit nibh in leo consectetur, eget tincidunt ipsum imperdiet. Etiam porttitor sit amet tortor rhoncus mollis. Nullam iaculis luctus ipsum, eu varius magna pulvinar a. Ut et lacus finibus, posuere odio id, consectetur velit. Donec neque ligula, egestas lacinia sodales sed, accumsan eu lacus. Mauris lacinia nisi vel elementum faucibus. Duis pulvinar egestas consectetur. Nullam hendrerit, massa placerat venenatis lobortis, dui lorem rhoncus quam, non ultricies lacus lectus id tortor. Quisque eros orci, commodo eu nisi ut, pretium tristique eros.Mauris posuere dolor ex, sed efficitur enim pulvinar eget. Phasellus ac diam lacus. Mauris a dolor facilisis, fringilla est vitae, vulputate dui. Vestibulum auctor odio sit amet ligula rutrum, a luctus arcu rutrum. Ut sed eros sed nisl eleifend dictum. Nulla mattis pretium urna sit amet venenatis. Interdum et malesuada fames ac ante ipsum primis in faucibus. Donec ac ultricies libero. Donec volutpat quis enim nec eleifend. Praesent gravida cursus tortor, pretium pretium erat aliquet tristique. Pellentesque habitant morbi tristique senectus et netus et malesuada fames ac turpis egestas. Lorem ipsum dolor sit amet, consectetur adipiscing elit.Maecenas porta, quam vel imperdiet pharetra, leo ante mattis orci, vel pharetra justo lorem vitae quam. Integer maximus ac sem ac vehicula. Donec viverra a tellus sed mattis. Nam molestie euismod efficitur. Praesent tincidunt felis sit amet maximus gravida. Fusce eu ante tellus. Praesent at massa sagittis, aliquet odio vitae, pellentesque tortor. Mauris eleifend metus enim, aliquam rutrum mauris sodales ac. In sodales tempus libero, vitae gravida ex egestas quis. Cras vel dignissim augue, sit amet pharetra erat.");
            
            $manager->persist($index);
            $manager->persist($cafe);
            $manager->persist($arts);
            $manager->persist($bla);
            $manager->persist($jeux);
            $manager->persist($graphique);
            $manager->persist($audio);
            $manager->persist($video);
            $manager->persist($autre);
            $manager->persist($sujet);
            
            $manager->flush();
        }
        
        return $this->redirect($this->generateUrl("be_teen_forum_index"));
    }
}
