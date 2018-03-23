<?php

namespace AppBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\CountryType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Vich\UploaderBundle\Form\Type\VichFileType;

class PersonForm extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('firstName',null,[
                'label'=>false
            ])
            ->add('imageFile', VichFileType::class, [
                'required' => false,
                'label'=>false
            ])
            ->add('idNumber',null,[
                'label'=>false
            ])
            ->add('middleName',null,[
                'label'=>false
            ])
            ->add('lastName',null,[
                'label'=>false
            ])
            ->add('idNumber',null,[
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
            'data_class' => 'AppBundle\Entity\Person'
        ]);
    }

    public function getBlockPrefix()
    {
        return 'app_bundle_person_form';
    }
}
