<?php

namespace App\Form;

use App\Entity\User;
use PhpParser\Node\Expr\New_;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\PasswordType;
use Symfony\Component\Validator\Constraints\Length;
use Symfony\Component\Validator\Constraints\NotBlank;

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
                ],
                'constraints'=> [
                     
                    new Length([
                        'min'=>12, 
                        'minMessage'=>'Votre mot de passe doit avoir minimum 12 caractères',
                        'max'=>4096,  
                    ])   , 
                    ],
            ])
            
            ->add('name', TextType::class, [
                'label' => 'Nom',
                'attr' => [
                    'class' => 'form-control'
                ],
                'constraints'=> [
                    
                    new Length([
                        'min'=>2, 
                        'minMessage'=>'Votre nom doit avoir minimum 2 caractères',
                        'max'=>40,  
                    ])   , 
                    ],
            ])
            ->add('prenom', TextType::class, [
                'label' => 'Prénom',
                'attr' => [
                    'class' => 'form-control'
                ],
                'constraints'=> [
                    
                    new Length([
                        'min'=>2, 
                        'minMessage'=>'Votre prénom doit avoir minimum 2 caractères',
                        'max'=>40,  
                    ])   , 
                    ],
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
                ],
                'constraints'=> [
                    
                    new Length([
                        'min'=>5, 
                        'minMessage'=>'Votre adresse doit avoir minimum 5 caractères',
                        'max'=>4050,  
                    ])   , 
                    ],
            ])
            ->add('code_postal', TextType::class, [
                'attr' => [
                    'class' => 'form-control',
                    'maxlength' => 5
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
