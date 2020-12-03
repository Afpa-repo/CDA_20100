<?php

namespace App\Form;

use App\Entity\Commande;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class OrderType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('adresse', EntityType::class, [
                'label'=>'Veillez comfirmer votre adress de livraison',
                'required'=>true,
                'class'=>Commande::class,
                'multiple'=>false,
                'expanded'=>true
            ])

            ->add('adresse1', ChoiceType::class, [
                'data_class'=>Commande::class
            ])
        ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            // Configure your form options here
        ]);
    }
}
