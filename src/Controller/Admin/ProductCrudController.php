<?php

namespace App\Controller\Admin;

use App\Entity\Product;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractCrudController;

class ProductCrudController extends AbstractCrudController
{
    public static function getEntityFqcn(): string
    {
        return Product::class;
    }

    public function createEntity(string $entityFqcn)
    {
        $product = new Product();
        $product->setDate(new \DateTime());

        return $product;
    }

    public function configureFields(string $pageName): iterable
    {
        return [
            'name',
            'about'
        ];
    }
}
