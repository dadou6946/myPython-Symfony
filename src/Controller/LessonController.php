<?php

namespace App\Controller;

use App\Entity\Lesson;
use App\Repository\LessonRepository;
use Doctrine\Common\Persistence\ObjectManager;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class LessonController extends AbstractController
{
    /**
     * @var LessonRepository
     */
    private $repository;
    private $om;

    public function __construct(LessonRepository $repository, ObjectManager $om)
    {
        $this->repository = $repository;
        $this->om = $om;
    }

    /** Liste des cours
     * @Route("/lesson", name="lesson.index")
     * @return Response
     */
    public function index(): Response
    {
        $lessons = $this->repository->findLatestPython();
        dump($lessons);
        return $this->render('lesson/index.html.twig', [
            'lessons' => $lessons
        ]);
        //$l[0]->setTitle('Premier cours');
        //$this->om->flush();
        //$lesson = new Lesson();
        //$lesson->setTitle('Premier cours')
        //    ->setContent('Le contenu du premier cours')
        //    ->setGrade('2nde')
        //    ->setSubject('python')
        //   ->setType('cours');
        //$em = $this->getDoctrine()->getManager();
        //$em->persist($lesson);
        //$em->flush();
    }

    /** Page contenu d'un cours
     * @Route("/lesson/{slug}-{id}", name="lesson.show", requirements={"slug": "[a-z1-9\-]*"})
     * @return Response
     */
    public function show(Lesson $lesson, string $slug): Response
    {
        dump($lesson);
        // Redirection si le slug ne correspond pas
        if($lesson->getSlug() !== $slug)
        {
            return $this->redirectToRoute('lesson.show', [
                'id' => $lesson->getId(),
                'slug' => $lesson->getSlug()
            ], 301);
        }
        return $this->render('lesson/show.html.twig', [
            'lesson' => $lesson
        ]);
    }
}