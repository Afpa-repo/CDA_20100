<?php

namespace App\Form;

use App\Entity\Produit;
use App\Entity\SousRubrique;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Validator\Constraints\Image;
use Symfony\Component\Validator\Constraints\Regex;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\FileType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\NumberType;
use Symfony\Component\Form\Extension\Core\Type\CheckboxType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;

class ProduitType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('proLib', TextType::class, [
                'label' => 'Nom du produit',
                'help' => 'Indiquez ici le nom complet du produit',
                'attr' => [
                    'placeholder' => 'Produit',
                ],
                'constraints' => [
                    new Regex([
                        'pattern' => '/^[A-Za-z0-9éèàçâêûîôäëüïö\_\'\-\s]+$/',
                        'message' => 'Caratère(s) non valide(s)'
                    ]),
                ]
            ])
            ->add('proDescr', TextareaType::class, [
                'label' => 'Description du produit',
                'help' => 'Indiquez ici la description complète du produit',
                'attr' => [
                    'placeholder' => 'Description du produit',
                ],
                'constraints' => [
                    new Regex([
                        'pattern' => '/^[A-Za-z0-9\/éèàçâêûîôäëüïö\:\_\'\-\s]+$/',
                        'message' => 'Caratère(s) non valide(s)'
                    ]),
                ]
            ])
            ->add('proPrixAchat', NumberType::class, [
                'label' => 'Prix unitaire',
                'help' => 'Indiquez ici le prix unitaire',
                'attr' => [
                    'placeholder' => 'Prix unitaire',
                ],
                'constraints' => [
                    new Regex([
                        'pattern' => '/^[0-9.]+$/',
                        'message' => 'Caratère(s) non valide(s)'
                    ]),
                ]
            ])
            ->add('proPhoto', FileType::class, [
                'label' => 'Photo du produit',
                'help' => 'Sélectionner une photo du produit',
                // unmapped => fichier non associé à aucune propriété d'entité, validation impossible avec les annotations
                // 'mapped' => false : permet de dire que ce champ n'est pas lié à la base de données
                'mapped' => false,
                // Pour éviter de recharger la photo lors de l'édition du profil
                // 'required' => false : nous ne voulons pas que l'upload d'un fichier soit obligatoire
                'required' => false,
                // 'constraints' => [ ] : définition des contraintes de validation pour ce champ
                'attr' => [
                    'placeholder' => 'Photo du produit',
                ],
                'constraints' => [
                    new Image([
                        'maxSize' => '2000k',
                        'mimeTypesMessage' => 'Veuillez insérer une photo au format jpg, jpeg ou png'
                    ]),
                ]
            ])
            ->add('proStock', NumberType::class, [
                'label' => 'Quantité en stock',
                'help' => 'Indiquez ici les quantités en stock',
                'attr' => [
                    'placeholder' => 'Quantités en stock',
                ],
                'constraints' => [
                    new Regex([
                        'pattern' => '/^[0-9]+$/',
                        'message' => 'Caratère(s) non valide(s)'
                    ]),
                ]
            ])
            ->add('proActif', CheckboxType::class, [
                'label' => 'Présent dans le catalogue',
                'help' => 'Cochez si le produit est présent',
            ])
            ->add('proSRub', EntityType::class, [
                'class' => SousRubrique::class,
                'label' => 'Nom de la sous-rubrique',
                'help' => 'Sélectionner la sous-rubrique du produit',
                'placeholder' => 'Choisir la sous-rubrique',
            ])
        ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => Produit::class,
        ]);
    }

}
