<?php

namespace BeTeen\ForumBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolverInterface;

class ReponseStandardType extends AbstractType
{
    
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder->add("contenu","textarea");
    }
    
    public function setDefaultOptions(OptionsResolverInterface $resolver) {
        $resolver->setDefaults(array('data_class'=>'BeTeen\ForumBundle\Entity\ReponseStandard'));
    }
    
    public function getName() {
        return "beteen_forumbundle_reponsestandardtype";
    }

}
