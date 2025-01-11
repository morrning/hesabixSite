<?php

namespace App\Controller\Admin;

use App\Entity\Cat;
use App\Entity\Post;
use EasyCorp\Bundle\EasyAdminBundle\Config\Crud;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractCrudController;
use EasyCorp\Bundle\EasyAdminBundle\Field\AssociationField;
use EasyCorp\Bundle\EasyAdminBundle\Field\BooleanField;
use EasyCorp\Bundle\EasyAdminBundle\Field\CodeEditorField;
use EasyCorp\Bundle\EasyAdminBundle\Field\IdField;
use EasyCorp\Bundle\EasyAdminBundle\Field\ImageField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextareaField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextEditorField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextField;

class PostCrudController extends AbstractCrudController
{
    public static function getEntityFqcn(): string
    {
        return Post::class;
    }

    public function configureFields(string $pageName): iterable
    {
        return [
            AssociationField::new('cat', 'نوع محتوا'),
            AssociationField::new('tree', 'دسته‌بندی')->hideOnIndex(),
            TextField::new('url', 'آدرس صفحه'),
            TextField::new('version', 'شماره نسخه'),
            TextField::new('title', 'عنوان'),
            TextareaField::new('intro', 'خلاصه مطلب')->hideOnIndex(),
            TextEditorField::new('body', 'متن')->hideOnIndex(),
            CodeEditorField::new('plain', 'ساختار')->hideOnIndex(),
            TextField::new('keywords', 'کلیدواژه‌ها'),
            ImageField::new('mainPic','تصویر شاخص')
            ->setUploadDir('/public/uploaded/')
            ->setBasePath('/uploaded/')
        ];
    }

    public function configureCrud(Crud $crud): Crud
    {
        return $crud
            // the labels used to refer to this entity in titles, buttons, etc.
            ->setEntityLabelInSingular('محتوا')
            ->setEntityLabelInPlural('محتواها')
        ;
    }

    public function createEntity(string $entityFqcn)
    {
        $item = new Post();
        $item->setSubmitter($this->getUser());
        $item->setDateSubmit(time());
        $item->setViews(0);
        return $item;
    }

}
