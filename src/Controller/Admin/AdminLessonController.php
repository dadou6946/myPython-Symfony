<?php

namespace App\Controller\Admin;

use App\Entity\Lesson;
use App\Form\LessonType;
use App\Repository\LessonRepository;
use Doctrine\Common\Persistence\ObjectManager;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class AdminLessonController extends AbstractController
{

    /**
     * @var LessonRepository
     */
    private $repository;
    /**
     * @var ObjectManager
     */
    private $om;

    /**
     * AdminLessonController constructor.
     * @param LessonRepository $repository
     * @param ObjectManager $om
     */
    public function __construct(LessonRepository $repository, ObjectManager $om)
    {
        $this->repository = $repository;
        $this->om = $om;
    }

    /** Accueil admin
     * @Route("/admin", name="admin.lesson.index")
     * @return \Symfony\Component\HttpFoundation\Response
     */
    public function index()
    {
        $lessons = $this->repository->findAll();
        return $this->render('admin/lesson/index.html.twig', compact('lessons'));
    }

    /** Edition de cours
     * @Route("admin/{id}", name="admin.lesson.edit", methods="GET|POST")
     * @param Lesson $lesson
     * @param Request $request
     * @param ObjectManager $om
     * @return \Symfony\Component\HttpFoundation\Response
     */
    public function edit(Lesson $lesson, Request $request, ObjectManager $om)
    {
        $form = $this->createForm(LessonType::class, $lesson);
        $form->handleRequest($request);

        if($form->isSubmitted() && $form->isValid())
        {
            $this->om->flush();
            $this->addFlash('success','Cours modifié avec succès!');
            return $this->redirectToRoute("admin.lesson.index");
        }

        return $this->render("admin/lesson/edit.html.twig", [
            "lesson" => $lesson,
            "form" => $form->createView()
        ]);
    }

    /** Création d'un cours
     * @Route("/admin/lesson/create", name="admin.lesson.new")
     * @param Request $request
     */
    public function new(Request $request)
    {
        $lesson = new Lesson();
        $form = $this->createForm(LessonType::class, $lesson);
        $form->handleRequest($request);

        if($form->isSubmitted() && $form->isValid())
        {
            $this->om->persist($lesson);
            $this->om->flush();
            $this->addFlash('success','Vous avez créé un cours !');
            return $this->redirectToRoute("admin.lesson.index");
        }

        return $this->render("admin/lesson/new.html.twig", [
            "lesson" => $lesson,
            "form" => $form->createView()
        ]);
    }

    /** Suppression de cours
     * @Route("admin/{id}", name="admin.lesson.delete", methods="DELETE")
     * @param Lesson $lesson
     */
    public function delete(Lesson $lesson, Request $request)
    {
        if($this->isCsrfTokenValid('delete'.$lesson->getId(), $request->get('_token')))
        {
            $this->om->remove($lesson);
            $this->om->flush();
            $this->addFlash('success','Vous avez supprimé un cours avec succès!');
        }
        return $this->redirectToRoute("admin.lesson.index");
    }
}