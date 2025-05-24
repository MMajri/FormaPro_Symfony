<?php

namespace App\Controller\Admin;

use App\Entity\Tuto;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractCrudController;
use EasyCorp\Bundle\EasyAdminBundle\Field\IdField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextEditorField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextField;
use EasyCorp\Bundle\EasyAdminBundle\Field\ImageField;
use EasyCorp\Bundle\EasyAdminBundle\Field\SlugField;

class TutoCrudController extends AbstractCrudController
{
    public static function getEntityFqcn(): string
    {
        return Tuto::class;
    }


    public function configureFields(string $pageName): iterable
    {
        $fields = [
			ImageField::new('image', 'Image')
				->setBasePath('uploads/images/')
				->setUploadDir('public/uploads/images/')
				->setUploadedFileNamePattern('[randomhash].[extension]')
				->setRequired(true),
        ];

		$name = TextField::new('name', 'Titre')
			->setFormTypeOption('attr', [
				'placeholder' => 'Titre du tutoriel',
				'maxlength' => 255,
			]);
		$fields[] = $name;

		$slug = SlugField::new('slug')
			->setTargetFieldName('name')
			->setFormTypeOption('attr', [
				'placeholder' => 'Slug du tutoriel',
				'maxlength' => 255,
			]);
		$fields[] = $slug;

		$subtitle = TextField::new('subtitle', 'Sous-titre')
			->setFormTypeOption('attr', [
				'placeholder' => 'Sous-titre du tutoriel',
				'maxlength' => 255,
			]);
		$fields[] = $subtitle;
		
		$video = TextField::new('video', 'Vidéo')
			->setFormTypeOption('attr', [
				'placeholder' => 'ID de la vidéo de présentation du tutoriel',
				'maxlength' => 255,
			]);
		$fields[] = $video;

		$link = TextField::new('link', 'Lien')
			->setFormTypeOption('attr', [
				'placeholder' => 'Lien du tutoriel',
				'maxlength' => 255,
			]);
		$fields[] = $link;

		$description = TextEditorField::new('description', 'Description')
			->setFormTypeOption('attr', [
				'placeholder' => 'Description du tutoriel',
			]);
		$fields[] = $description;

        return $fields;
    }
}
