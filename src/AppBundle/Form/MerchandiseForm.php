<?php

namespace AppBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class MerchandiseForm extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('distributor',null,[
                'label'=>false
            ])
            ->add('serialNumber',null,[
                'label'=>false
            ])
            ->add('productDescription',null,[
                'label'=>false
            ])
            ->add('organization',null,[
                'label'=>false,
                'placeholder'=>'Choose Brand'
            ]);
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => 'AppBundle\Entity\Merchandise'
        ]);
    }

    public function getBlockPrefix()
    {
        return 'app_bundle_merchandise_form';
    }
}
