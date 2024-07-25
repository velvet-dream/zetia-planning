<?php

namespace App\Controller;

use App\Entity\Project;
use App\Entity\Task;
use App\Repository\ProjectRepository;
use App\Repository\TaskRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class UserController extends AbstractController
{
  
    

    #[Route('/', name: 'app_dashboard')]
    public function index(TaskRepository $taskRepository, ProjectRepository $projectRepository): Response
    {
        $tasks = $taskRepository->findAll();
        $projects = $projectRepository->findAll();

        return $this->render('user/dashboard.html.twig', [
            'tasks' => $tasks,
            'projects' => $projects,
        ]);
    }
}