<?php

namespace AppBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class LicenseForm extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('issuedBy',null,[
                'label'=>false
            ])
            ->add('licenseName',null,[
                'label'=>false
            ])
            ->add('licensePeriod',null,[
                'label'=>false
            ]);

    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => 'AppBundle\Entity\License'
        ]);
    }

    public function getBlockPrefix()
    {
        return 'app_bundle_license_form';
    }
}
