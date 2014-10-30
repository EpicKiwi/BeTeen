<?php

namespace BeTeen\ForumBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolverInterface;

class CategorieType extends AbstractType
{
    /**
     * @param FormBuilderInterface $builder
     * @param array $options
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('nom',                 'text')
            ->add('description',         'text')
            ->add('allowSujetStandard',  'checkbox',array("label"=>"Autoriser la creation de sujets","required"=>false))
            ->add('parent',              'entity', array("class"=>"BeTeenForumBundle:Categorie","property"=>"nom", "label"=>"Categorie parente"))
        ;
    }
    
    /**
     * @param OptionsResolverInterface $resolver
     */
    public function setDefaultOptions(OptionsResolverInterface $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'BeTeen\ForumBundle\Entity\Categorie'
        ));
    }

    /**
     * @return string
     */
    public function getName()
    {
        return 'beteen_forumbundle_categorie';
    }
}
