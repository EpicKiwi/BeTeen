<?php

namespace BeTeen\UserBundle\Form;

use BeTeen\ForumBundle\Form\UploadType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolverInterface;

class UserType extends AbstractType
{
    /**
     * @param FormBuilderInterface $builder
     * @param array $options
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('email')
            ->add('avatar',         new UploadType(),   array("required"=>false,"label"=>"Avatar"))
            //->add('background')
            ->add('dateNaissance',  'birthday')
            ->add('localisation',   "text",             array("required"=>false))
            ->add('sexe',           'choice',           array("choices"=>array(true=>"Homme",false=>"Femme")))
            ->add('interets',       "textarea",         array("required"=>false))
            ->add('facebook',       "text",             array("required"=>false))
            ->add('twitter',        "text",             array("required"=>false))
            ->add('google',         "text",             array("required"=>false))
        ;
    }
    
    /**
     * @param OptionsResolverInterface $resolver
     */
    public function setDefaultOptions(OptionsResolverInterface $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'BeTeen\UserBundle\Entity\User'
        ));
    }

    /**
     * @return string
     */
    public function getName()
    {
        return 'beteen_userbundle_user';
    }
}
