<?php

namespace App\Form;

use App\Entity\Stock;
use App\Entity\Produit;
use App\Entity\Categorie;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Validator\Constraints\Image;
use Symfony\Component\Validator\Constraints\NotBlank;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;

class ProduitType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('titre')
            ->add('description')
            ->add('prix')
            ->add('quantite')
            ->add('couleur')
            ->add('taille')
            ->add('images'
            , EntityType::class, [
                'required' => true,
                'label' => 'Ajouter une image',
                'class' => Image::class,
                'choice_label' => 'nom',
                'constraints' => [
                    new NotBlank([
                        'message' => 'Veuillez ajouter une image'

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
            ->add('stock', EntityType::class, [
                'required' => true,
                'label' => 'Entrer le stock',
                'class' => Stock::class,
                'choice_label' => 'quantite',
                'constraints' => [
                    new NotBlank([
                        'message' => 'Veuillez entrer le stock pour ce produit'

                        ])
                ]
            ])
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
