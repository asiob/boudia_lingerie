<?php

namespace App\Controller\Admin;

use App\Entity\Produit;
use Doctrine\ORM\EntityManagerInterface;
use EasyCorp\Bundle\EasyAdminBundle\Field\IdField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextField;
use EasyCorp\Bundle\EasyAdminBundle\Field\ColorField;
use EasyCorp\Bundle\EasyAdminBundle\Field\ImageField;
use EasyCorp\Bundle\EasyAdminBundle\Field\MoneyField;
use Symfony\Component\HttpFoundation\File\UploadedFile;
use EasyCorp\Bundle\EasyAdminBundle\Field\DateTimeField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextEditorField;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractCrudController;
use EasyCorp\Bundle\EasyAdminBundle\Field\AssociationField;

class ProduitCrudController extends AbstractCrudController
{
    public static function getEntityFqcn(): string
    {
        return Produit::class;
       
    }

    
    public function configureFields(string $pageName): iterable
    {
        return [
            IdField::new('id')->hideOnForm(),
            TextField::new('titre'),
            TextEditorField::new('description'),
            MoneyField::new('prix')->setCurrency('EUR'),
            ColorField::new('couleur')->showSample(false),
            AssociationField::new('categorie'),
            // ImageField::new('image')
            //     ->setBasePath('uploads')
            //     ->setUploadDir('public/uploads')
            //     ->setFormTypeOption('multiple', true)
            //     ->setUploadedFileNamePattern(
            //         fn (UploadedFile $file): string => sprintf('upload_%d_%s.%s', random_int(1, 999), $file->getFilename(), $file->guessExtension())),
            DateTimeField::new('updatedAt')->hideOnForm(),  
            DateTimeField::new('createdAt')->hideOnForm(),  
             
        ];

    }
    
// public function persistEntity(EntityManagerInterface $em, $entityInstance): void
// {
//     if (!$entityInstance instanceof Produit) return;

//     $entityInstance->setCreatedAt(new \DateTimeImmutable);

//     parent::persistEntity($em,$entityInstance);


// }

}
 