<?php

namespace App\Controller;

use App\Repository\UserRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;

class ResponsableController extends AbstractController
{
    #[Route('/employees', name: 'app_employees')]
    public function index(UserRepository $userRepository): Response
    {
        $employees = $userRepository->findAll();
        return $this->render('responsable/employees.html.twig', [
            'controller_name' => 'ResponsableController',
            "employees" => $employees,
        ]);
    }
}
