<?php

namespace App\Controller;

use App\Repository\LessonRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Twig\Environment;

class HomeController extends AbstractController
{

    /** Page d'accueil
     * @Route("/", name="home")
     * @return Response
     */
    public function index(LessonRepository $lessonRepository): Response
    {
        $lastLessons = $lessonRepository->findLatestPython();
        dump($lastLessons);
        return $this->render('pages/home.html.twig', [
            'lastLessons' => $lastLessons
        ]);
    }
}