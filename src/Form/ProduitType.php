<?php

namespace App\Form;


use App\Entity\Taille;
use App\Entity\Couleur;
use App\Entity\Produit;
use App\Entity\Categorie;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Validator\Constraints\File;
use Symfony\Component\Validator\Constraints\NotBlank;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\FileType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;

class ProduitType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        
                    //dd(array_values($couleursListe)[0]);
        $builder
            ->add('titre')
            ->add('description', TextareaType::class)
            ->add('prix')
            // ->add('quantite')
            ->add('couleur', EntityType::class, [
                'class' => Couleur::class,
                'choice_label' => 'name',
            ])

            // ->add('taille', EntityType::class, [
            //     'class' => Taille::class,
            //     'choice_label' => 'name',
            //     'mapped' => false,
            //     'multiple' => true,
            //     'expanded' => true,
            // ])
            
            ->add('images',
                // null,
                // data_class => null,
                 FileType::class,
                [
                // 'attr' => [],
                'label' => false,
                'multiple' => true, 
                'mapped' => false, 
                'required' => false,
                'constraints' => [
                    new File([
                        'maxSize' => '1024k',
                        'mimeTypes' => [
                            'image/jpg',
                            'image/jpeg',
                        ],
                        'mimeTypesMessage' => 'merci de mettre une image valide'
                    ])
                ] 
            ])
            
            ->add('categorie', EntityType::class, [
                'required' => true,
                'label' => 'choisir une catégorie',
                'class' => Categorie::class,
                'choice_label' => 'nom',
                'constraints' => [
                    new NotBlank([
                        'message' => 'Veuillez choisir une catégorie'

                        ])
                ]
            ])
            
                
        // le bouton
        ->add('save', SubmitType::class, [
            'label' => 'Ajouter un nouveau produit',
            'attr' => ['class' => 'bouton_ajout_produit'],           
        ]
        )
;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Produit::class,
        ]);
    }
}
