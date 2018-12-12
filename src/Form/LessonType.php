<?php

namespace App\Form;

use App\Entity\Lesson;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class LessonType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('title')
            ->add('seo_title')
            ->add('picture')
            ->add('content')
            ->add('grade', ChoiceType::class, [
                "choices" => [
                    "2nde" => "2nde",
                    "1ere" => "1ere",
                    "Tle" => "Tle",
                    "Spe" => "Spe"
                ]
            ])
            ->add('type', ChoiceType::class, [
                "choices" => [
                    "cours" => "cours",
                    "exercice" => "exercice",
                    "corrigé" => "corrigé",
                    "tutoriel" => "tutoriel",
                ]
            ])
            ->add('subject', ChoiceType::class, [
                "choices" => [
                    "python" => "python",
                    "html" => "html",
                    "css" => "css",
                ]
            ])
            ->add('state')
        ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => Lesson::class,
            "translation_domain" => "forms"
        ]);
    }

    private function getChoices()
    {

    }
}
