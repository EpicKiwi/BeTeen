<?php

namespace BeTeen\UserBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolverInterface;

class UserRegisterType extends AbstractType
{
    /**
     * @param FormBuilderInterface $builder
     * @param array $options
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('username',   'text',array("label" => "Nom d'utilisateur"))
            ->add('password',   'repeated',array(
                                                'type' => 'password',
                                                'invalid_message' => 'Les mot de passe doivent correspondre',
                                                'options' => array('required' => true),
                                                'first_options' => array('label' => 'Mot de passe'),
                                                'second_options' => array('label' => 'Comfirmez votre mot de passe')
                                                ))
            ->add('email',      'repeated',array(
                                                'type' => 'text',
                                                'invalid_message' => 'Les adresses emails doivent correspondre',
                                                'options' => array('required' => true),
                                                'first_options' => array('label' => 'Adresse email'),
                                                'second_options' => array('label' => 'Comfirmez votre adresse')
                                                ));
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
