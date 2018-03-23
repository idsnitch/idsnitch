<?php

namespace AppBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class EducationForm extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
            $builder
                ->add('institution',null,[
                    'label'=>false
                ])
                ->add('graduationYear',null,[
                    'label'=>false
                ])
                ->add('qualification',null,[
                    'label'=>false
                ]);
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => 'AppBundle\Entity\Education'
        ]);
    }

    public function getBlockPrefix()
    {
        return 'app_bundle_profile_form';
    }
}
