<?php

namespace App\DataFixtures;

use App\Entity\Lesson;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\Persistence\ObjectManager;
use Faker\Factory;

class LessonFixture extends Fixture
{
    public function load(ObjectManager $manager)
    {
        // $product = new Product();
        // $manager->persist($product);
        $faker = Factory::create('fr_FR');
        for($i=0; $i<25;$i++)
        {
            $lesson = new Lesson();
            $lesson->setTitle($faker->words(3, true))
                ->setSeoTitle($faker->words(3,true))
                ->setPicture($faker->words(1,true))
                ->setContent($faker->sentences(3,true))
                ->setGrade('2nde')
                ->setType('cours')
                ->setSubject('python')
                ->setState(1);
            $manager->persist($lesson);
        }
        for($i=0; $i<25;$i++)
        {
            $lesson = new Lesson();
            $lesson->setTitle($faker->words(3, true))
                ->setSeoTitle($faker->words(3,true))
                ->setPicture($faker->words(1,true))
                ->setContent($faker->sentences(3,true))
                ->setGrade('1ere')
                ->setType('cours')
                ->setSubject('python')
                ->setState(1);
            $manager->persist($lesson);
        }
        for($i=0; $i<25;$i++)
        {
            $lesson = new Lesson();
            $lesson->setTitle($faker->words(3, true))
                ->setSeoTitle($faker->words(3,true))
                ->setPicture($faker->words(1,true))
                ->setContent($faker->sentences(3,true))
                ->setGrade('Tle')
                ->setType('cours')
                ->setSubject('python')
                ->setState(1);
            $manager->persist($lesson);
        }
        for($i=0; $i<25;$i++)
        {
            $lesson = new Lesson();
            $lesson->setTitle($faker->words(3, true))
                ->setSeoTitle($faker->words(3,true))
                ->setPicture($faker->words(1,true))
                ->setContent($faker->sentences(3,true))
                ->setGrade('2nde')
                ->setType('exercice')
                ->setSubject('python')
                ->setState(1);
            $manager->persist($lesson);
        }
        for($i=0; $i<25;$i++)
        {
            $lesson = new Lesson();
            $lesson->setTitle($faker->words(3, true))
                ->setSeoTitle($faker->words(3,true))
                ->setPicture($faker->words(1,true))
                ->setContent($faker->sentences(3,true))
                ->setGrade('2nde')
                ->setType('corrige')
                ->setSubject('python')
                ->setState(1);
            $manager->persist($lesson);
        }
        $manager->flush();
    }
}
