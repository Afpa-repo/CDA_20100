<?php

namespace App\Form;

use App\Entity\Produit;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class ProduitType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('proLib')
            ->add('proDescr')
            ->add('proPrixAchat')
            ->add('proPhoto')
            ->add('proStock')
            ->add('proActif')
            ->add('proSRub')
            ->add('contientLiv')
            ->add('envFour')
            ->add('seComposeDeCmd')
        ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => Produit::class,
        ]);
    }
}
