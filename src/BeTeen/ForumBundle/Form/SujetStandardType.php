<?php

namespace BeTeen\ForumBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolverInterface;

class SujetStandardType extends AbstractType
{
    
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
                ->add("titre","text")
                ->add("contenu","textarea");
    }
    
    public function setDefaultOptions(OptionsResolverInterface $resolver) {
        $resolver->setDefaults(array('data_class'=>'BeTeen\ForumBundle\Entity\SujetStandard'));
    }
    
    public function getName() {
        return "beteen_forumbundle_sujetstandardtype";
    }

}
