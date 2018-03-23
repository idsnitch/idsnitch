<?php

namespace AppBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\CountryType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class OrganizationForm extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('organizationName',null,[
                'label'=>false
            ])
            ->add('organizationAddress',null,[
                'label'=>false
            ])
            ->add('country',CountryType::class,[
                'label'=>false,
                'preferred_choices'=>["KE"]
            ]);
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => 'AppBundle\Entity\Organization'
        ]);
    }

    public function getBlockPrefix()
    {
        return 'app_bundle_organization_form';
    }
}
