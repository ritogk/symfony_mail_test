<?php

namespace App\Controller;

use App\Form\Type\TaskType;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use App\Form\Model\Task;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\Request;

class TaskController extends AbstractController
{
  #[Route('/task', methods: ['GET'])]
  public function new(): Response
  {
    $task = new Task();
    $task->setTask('Write a blog post');
    $task->setDueDate(new \DateTime('tomorrow'));

    $form = $this->createForm(TaskType::class, $task);

    return $this->render('task/new.html.twig', [
      'form' => $form,
    ]);
  }

  #[Route('/task', methods: ['POST'])]
  public function newPost(Request $request): Response
  {
    $task = new Task();
    $form = $this->createForm(TaskType::class, $task);
    // formと値オブジェクトを紐づける
    $form->handleRequest($request);
    if ($form->isSubmitted() && $form->isValid()) {
      $task = $form->getData();
      dd($task);
      return $this->redirectToRoute('task_success');
    }

    return $this->render('task/new.html.twig', [
      'form' => $form,
    ]);
  }
}
