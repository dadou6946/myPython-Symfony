<?php

namespace App\Form;

use App\Entity\LessonSearch;
use App\Entity\Tag;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class LessonSearchType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('grade', ChoiceType::class, [
                "required" => false,
                "label" => "Niveau",
                "choices" => [
                    "2nde" => "2nde",
                    "1ere" => "1ere",
                    "Tle" => "Tle",
                    "Spe" => "Spe"
                ]
            ])
            ->add('type', ChoiceType::class, [
                "required" => false,
                "label" => "Type",
                "choices" => [
                    "cours" => "cours",
                    "exercice" => "exercice",
                    "corrigé" => "corrigé",
                    "tutoriel" => "tutoriel",
                ]
            ])
            ->add('subject', ChoiceType::class, [
                "required" => false,
                "label" => "Sujet",
                "choices" => [
                    "python" => "python",
                    "html" => "html",
                    "css" => "css",
                ]
            ])
            ->add('tags', EntityType::class, [
                "required" => false,
                "label" => "Tags",
                "class" => Tag::class,
                "choice_label" => "name",
                "multiple" => true
            ])
        ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => LessonSearch::class,
            'method' => 'get',
            'csrf_protection' => false
        ]);
    }

    public function getBlockPrefix()
    {
        return "";
    }
}
