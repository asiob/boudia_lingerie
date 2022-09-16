<?php

namespace App\Form;

use App\Entity\Stock;
use App\Entity\Produit;
use App\Entity\Categorie;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\ChoiceList\ChoiceList;
use Symfony\Component\Validator\Constraints\File;
use Symfony\Component\Validator\Constraints\Image;
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
       // $couleursListe = array ("blanc", "noir", "beige", "rouge", "vert", "rose", "bleu", "gris", "marron", "autre" );
        $builder
            ->add('titre')
            ->add('description', TextareaType::class)
            ->add('prix')
            // ->add('quantite')
            ->add('couleur', ChoiceType::class,
            [
                'choices' => [
                    
                    "blanc" => "blanc", 
                    "noir" => "noir", 
                    "beige" => "beige",
                    "rouge" => "rouge",
                    "vert" => "vert", 
                    "rose" => "rose",
                    "bleu" => "bleu",
                    "gris" => "gris",
                    "marron" => "marron",
                    "autre" => "autre" ],
                'multiple' => true,
                'expanded' => true,
                "attr" => [
                    "class"=> ""
                ]
            ])
            ->add('taille'
            , ChoiceType::class,
            [
                'choices' => [
                    "XS" => "XS", 
                    "S" => "S", 
                    "M" => "M", 
                    "L" => "L",
                    "XL" => "XL",
                    "TU" => "TU",
                    "80A" => "80A", 
                    "80B" => "80B",
                    "80C" => "80C",
                    "80D" => "80D",
                    "80E" => "80E",
                    "80F" => "80F", 
                    "85A" => "85A", 
                    "85B" => "85B",
                    "85C" => "85C",
                    "85D" => "85D",
                    "85E" => "85E",
                    "85F" => "85F", 
                    "90A" => "90A", 
                    "90B" => "90B",
                    "90C" => "90C",
                    "90D" => "90D",
                    "90E" => "90E",
                    "90F" => "90F", 
                    "95A" => "95A", 
                    "95B" => "95B",
                    "95C" => "95C",
                    "95D" => "95D",
                    "95E" => "95E",
                    "95F" => "95F", 
                    "100A" => "100A", 
                    "100B" => "100B",
                    "100C" => "100C",
                    "100D" => "100D",
                    "100E" => "100E",
                    "100F" => "100F" 
                ],
                'multiple' => true,
                'expanded' => true,
                "attr" => [
                    "class"=> "d-flex"
                ]
            ])
            ->add('images',
                 FileType::class, [
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
            ->add('stock',
                NULL, [
             'mapped' => false, ])
                
        // le bouton
        ->add('save', SubmitType::class, [
            'label' => 'Ajouter un nouveau produit'
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
