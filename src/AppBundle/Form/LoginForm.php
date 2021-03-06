<?php

namespace AppBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\PasswordType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class LoginForm extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('_username',null,[
                'label'=>false,
                'attr'=>[
                    'placeholder'=>'Username',
                    'class'=>'form-control'
                ]
            ])
            ->add('_password',PasswordType::class,[
                'label'=>false,
                'attr'=>[
                    'placeholder'=>'Password',
                    'class'=>'form-control'
                ]
            ]);
    }


}
