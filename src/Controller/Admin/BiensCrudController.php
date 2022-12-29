<?php

namespace App\Controller\Admin;

use App\Entity\Biens;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractCrudController;
use EasyCorp\Bundle\EasyAdminBundle\Field\AssociationField;
use EasyCorp\Bundle\EasyAdminBundle\Field\ImageField;
use EasyCorp\Bundle\EasyAdminBundle\Field\MoneyField;
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
           TextField::new('titre'),
         //   TextField::new('surface'),
           // ImageField::new('image')
            //->setFormType(Vic),
           // ->setBasePath('/public/assets/img'),
            TextField::new('etat'),
            TextField::new('titre'),
            TextareaField::new('descriptif'),
           // MoneyField::new('prix'),
            AssociationField::new('category')
        ];
    }

}
