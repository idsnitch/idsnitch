<?php

namespace AppBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\CountryType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class BusinessForm extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('businessName',null,[
                'label'=>false
            ])
            ->add('businessNumber',null,[
                'label'=>false
            ])
            ->add('country',CountryType::class,[
                'label'=>false,
                'placeholder'=>'Choose Country'
            ]);

    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => 'AppBundle\Entity\Business'
        ]);
    }

    public function getBlockPrefix()
    {
        return 'app_bundle_business_form';
    }
}
