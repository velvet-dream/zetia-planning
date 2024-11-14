<?php

namespace App\Controller;

use App\Entity\Organization;
use App\Form\OrganizationType;
use App\Repository\OrganizationRepository;
use App\Repository\UserRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Bundle\SecurityBundle\Security;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;

class OrganizationsController extends AbstractController
{
    #[Route('/organizations', name: 'app_organizations')]
    public function index(Security $security, UserRepository $usrRepo, OrganizationRepository $orgRepo, EntityManagerInterface $em): Response
    {
        $securityUser = $security->getUser();

        if (!$securityUser) {
            // Redirect to login if user is not authenticated
            return $this->redirectToRoute('app_login');
        }
        return $this->render('organizations/index.html.twig', [
            'controller_name' => 'OrganizationsController',
        ]);
    }
}
