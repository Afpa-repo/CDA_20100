<?php

namespace App\Form;

use App\Entity\Client;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\EmailType;
use Symfony\Component\Form\Extension\Core\Type\PasswordType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Validator\Constraints\Regex;

class ClientType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('cliNom')
            ->add('cliPrenom')
            ->add('cliEmail', EmailType::class, [
                'label' => 'Votre e-mail',
                'label_attr' => [
                    'class' => 'col-auto col-form-label col-form-label-sm',
                ],
                'help' => 'Indiquez ici votre e-mail',
                'attr' => [
                    'placeholder' => 'Votre e-mail',
                    'class' => 'form-control form-control-sm',
                ],
                'constraints' => [
                    new Regex([
                        'pattern' => '/^[\w-.]+@([\w-]+.)+[\w-]{2,4}$/',
                        'message' => 'Caratère(s) non valide(s)'
                    ]),
                ]
            ])
            ->add('cliPassword', PasswordType::class, [
                'label' => 'Votre mot de passe',
                'label_attr' => [
                    'class' => 'col-auto col-form-label col-form-label-sm',
                ],
                'help' => 'Indiquez ici votre mot de passe',
                'attr' => [
                    'placeholder' => 'Votre mot de passe',
                    'class' => 'form-control form-control-sm',
                ],
                'constraints' => [
                    new Regex([
                        'pattern' => '/^(?=.[a-z])(?=.[A-Z])(?=.\d)(?=.[@$!%?&])[A-Za-z\d@$!%?&]{8,}$/',
                        'message' => 'Caratère(s) non valide(s)'
                    ]),
                ]
            ])
            ->add('cliConfPassword', PasswordType::class, [
                'label' => 'Confirmez votre mot de passe',
                'label_attr' => [
                    'class' => 'col-auto col-form-label col-form-label-sm',
                ],
                'help' => 'Indiquez ici votre confirmation de mot de passe',
                'attr' => [
                    'placeholder' => 'Confirmez votre mot de passe',
                    'class' => 'form-control form-control-sm',
                ],
                'constraints' => [
                    new Regex([
                        'pattern' => '/^(?=.[a-z])(?=.[A-Z])(?=.\d)(?=.[@$!%?&])[A-Za-z\d@$!%?&]{8,}$/',
                        'message' => 'Caratère(s) non valide(s)'
                    ]),
                ]
            ])
            ->add('cliAdresse')
            ->add('cliCp')
            ->add('cliVille')
            //->add('cliRegl')
            //->add('cliCateg')
            //->add('cliCoeff')
            //->add('cliCom')
            //->add('passeCmd')
        ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => Client::class,
        ]);
    }
}
