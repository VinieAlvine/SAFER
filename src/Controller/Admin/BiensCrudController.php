<?php

namespace App\Controller\Admin;

use App\Entity\Biens;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractCrudController;
use EasyCorp\Bundle\EasyAdminBundle\Field\AssociationField;
use EasyCorp\Bundle\EasyAdminBundle\Field\ImageField;
use EasyCorp\Bundle\EasyAdminBundle\Field\MoneyField;
use EasyCorp\Bundle\EasyAdminBundle\Field\SlugField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextareaField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextField;

class BiensCrudController extends AbstractCrudController
{
    public static function getEntityFqcn(): string
    {
        return Biens::class;
    }


    public function configureFields(string $pageName): iterable
    {
        return [
              TextField::new('Reference'),
              TextField::new('intitule'),
             SlugField::new('slug')->setTargetFieldName('intitule'),
            TextField::new('surface'),
            TextField::new('localisation'),
            TextField::new('etat'),
            ImageField::new('image')
                ->setBasePath('image/')

                ->setUploadDir('/public/image')
                ->setUploadedFileNamePattern('[randomhash].[extension]')

                 ->setRequired(false)
                 ,
            TextareaField::new('descriptif'),
             MoneyField::new('prix')->setCurrency('EUR'),
            AssociationField::new('category')
        ];
    }

}
