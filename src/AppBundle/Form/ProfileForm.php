<?php

namespace AppBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class ProfileForm extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
            $builder
                ->add('organization',null,[
                    'label'=>false
                ])
                ->add('certification',null,[
                    'label'=>false
                ])
                ->add('periodFrom',null,[
                    'label'=>false
                ])
                ->add('periodTo',null,[
                    'label'=>false
                ])
                ->add('qualification',null,[
                    'label'=>false
                ])
                ->add('category',null,[
                    'label'=>false
                ]);
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => 'AppBundle\Entity\Profile'
        ]);
    }

    public function getBlockPrefix()
    {
        return 'app_bundle_profile_form';
    }
}
