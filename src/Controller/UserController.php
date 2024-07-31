<?php

namespace App\Controller;

use App\Entity\Project;
use App\Entity\Task;
use App\Repository\ProjectRepository;
use App\Repository\TaskRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Bundle\SecurityBundle\Security;
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
    public function dashboard(Security $security, TaskRepository $tskRepository, ProjectRepository $pctRepository): Response
    {
        $user = $security->getUser();

        // Check if the user is authenticated before rendering the dashboard
        if (!$user) {
            // Redirect to login if user is not authenticated
            return $this->redirectToRoute('app_login');
        }

        // Note : we will need to fetch daily tasks (i.e. tasks being worked on today) for the dashboard.

        $tasks = $tskRepository->findByUser($user);
        $projects = $pctRepository->findByUser($user);

        return $this->render('user/dashboard.html.twig', [
            'tasks' => $tasks,
            'projects' => $projects,
        ]);
    }
}
