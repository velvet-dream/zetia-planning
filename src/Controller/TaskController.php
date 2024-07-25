<?php

namespace App\Controller;

use App\Entity\Task;
use App\Form\TaskType;
use App\Repository\TaskRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use App\Entity\Project;
use App\Entity\StatusTask;
use App\Repository\ProjectRepository;

#[Route('/task')]
class TaskController extends AbstractController
{
    #[Route('/', name: 'ViewTask', methods: ['GET'])]
    public function index(TaskRepository $taskRepository): Response
    {
        return $this->render('task/index.html.twig', [
            'tasks' => $taskRepository->findAll(),
        ]);
    }

    
    
        #[Route('/new', name: 'NewTask', methods: ['GET', 'POST'])]
        public function new(Request $request, EntityManagerInterface $entityManager, ProjectRepository $projectRepository): Response
        {
            $task = new Task();
            $form = $this->createForm(TaskType::class, $task);
    
            // Récupérez la liste des projets disponibles
            $projects = $projectRepository->findAll();
            $statusRepository = $entityManager->getRepository(StatusTask::class);
            $allStatuses = $statusRepository->findAll();
            dump($allStatuses);
            $form->handleRequest($request);
    
            if ($form->isSubmitted() && $form->isValid()) {
                $statusTask = $form->get('tskStatus')->getData();
                if ($statusTask instanceof StatusTask) {
                    $task->setTskStatus($statusTask);
                }
                $entityManager->persist($task);
                $entityManager->flush();
                // ...
            
    
                return $this->redirectToRoute('ViewTask', [], Response::HTTP_SEE_OTHER);
            }
    
            return $this->render('task/new.html.twig', [
                'task' => $task,
                'form' => $form->createView(),
                'projects' => $projects, 
            ]);
        }
    
    

       

    #[Route('/{tskId}', name: 'showTask', methods: ['GET'])]
    public function show(Task $task): Response
    {
        return $this->render('task/show.html.twig', [
            'task' => $task,
        ]);
    }
    #[Route('/{tskId}/edit', name: 'editTask', methods: ['GET', 'POST'])]
    public function edit(Request $request, Task $task, EntityManagerInterface $entityManager): Response
    {
        $form = $this->createForm(TaskType::class, $task);
        $form->handleRequest($request);
    
        if ($form->isSubmitted() && $form->isValid()) {
            $project = $entityManager->getRepository(Project::class)->find($request->request->get('project_id'));
            if (!$project) {
                throw $this->createNotFoundException('Le projet n\'existe pas');
            }
            $task->setProject($project);
    
            $statusTask = $entityManager->getRepository(StatusTask::class)->find($request->request->get('status_task_id'));
            if (!$statusTask) {
                throw $this->createNotFoundException('Le statut de la tâche n\'existe pas');
            }
            $task->setTskStatus($statusTask);
    
            $entityManager->flush();
    
            return $this->redirectToRoute('ViewTask', [], Response::HTTP_SEE_OTHER);
        }
    
        return $this->render('task/edit.html.twig', [
            'task' => $task,
            'form' => $form->createView(),
        ]);
    }
    

    #[Route('/{tskId}', name: 'deleteTask', methods: ['POST'])]
    public function delete(Request $request, Task $task, EntityManagerInterface $entityManager): Response
    {
        if ($this->isCsrfTokenValid('delete'.$task->getTskId(), $request->request->get('_token'))) {
            $entityManager->remove($task);
            $entityManager->flush();
        }

        return $this->redirectToRoute('ViewTask', [], Response::HTTP_SEE_OTHER);
    }
}