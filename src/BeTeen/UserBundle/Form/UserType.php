<?php

namespace BeTeen\UserBundle\Form;

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
            ->add('username')
            ->add('password','password',array("required"=>false))
            ->add('email')
            ->add('roles','choice',array('choices'=>array('ROLE_USER'=>'Utilisateur','ROLE_MODERATEUR'=>'Modérateur','ROLE_ADMIN'=>'Administrateur','ROLE_SUPER_ADMIN'=>'Super administrateur'),'multiple'=>true))
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
