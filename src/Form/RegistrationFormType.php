<?php

namespace App\Form;

use App\Entity\User;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\PasswordType;

class RegistrationFormType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('email', TextType::class, [
                'label' => 'E-mail',
                'attr' => [
                    'class' => 'form-control'
                ]
            ])
            
            // ->add('roles')
            ->add('password',PasswordType::class, [
                'label' => 'Mot de passe',
                'attr' => [
                    'class' => 'form-control'
                ]
            ])
            
            ->add('name', TextType::class, [
                'label' => 'Nom',
                'attr' => [
                    'class' => 'form-control'
                ]
            ])
            ->add('prenom', TextType::class, [
                'label' => 'Prénom',
                'attr' => [
                    'class' => 'form-control'
                ]
            ])
            
            ->add('telephone', TextType::class, [
                'label' => 'Téléphone',
                'attr' => [
                    'class' => 'form-control'
                ]
            ])
            ->add('adresse', TextType::class, [
                'attr' => [
                    'class' => 'form-control'
                ]
            ])
            ->add('code_postal', TextType::class, [
                'attr' => [
                    'class' => 'form-control'
                ]
            ])
            ->add('ville', TextType::class, [
                'attr' => [
                    'class' => 'form-control'
                ]
            ])
            ->add('Pays', TextType::class, [
                'attr' => [
                    'class' => 'form-control'
                ]
            ])
            ->add('register', SubmitType::class, 
            [
                'label' => "S'incrire",
                'attr' => [
                    'class' => 'btn btn-primary'
                ]

                    ]

            )

        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => User::class,
        ]);
    }
}
