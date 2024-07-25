<?php

namespace App\Controller;

use App\Entity\Project;
use App\Entity\Task;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class UserController extends AbstractController
{
    #[Route('/', name: 'app_index')]
    public function index(): Response
    {
        return $this->render('user/index.html.twig', [
            'controller_name' => 'UserController',
        ]);
    }

    #[Route('/dashboard', name: 'app_dashboard')]
    public function dashboard(EntityManagerInterface $entityManager): Response
    
    {

        $user = $this->getUser();
        $tasks = $entityManager->getRepository(Task::class)->findByUser($user);
        $projects = $entityManager->getRepository(Project::class)->findByUser($user);

        return $this->render('user/dashboard.html.twig', [
            'tasks' => $tasks,
            'projects' => $projects,
        ]);
      
    }
}