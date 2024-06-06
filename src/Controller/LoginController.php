<?php
namespace App\Controller;

use App\Entity\User;
use Symfony\Component\Security\Http\Authentication\AuthenticationUtils;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class LoginController extends AbstractController
{
#[Route('/login', name: 'security_login')]
    public function login(AuthenticationUtils $authenticationUtils): Response
    {
        // retrouver une erreur d'authentification s'il y en a une
        $error = $authenticationUtils->getLastAuthenticationError();
        // retrouver le dernier identifiant de connexion utilisé
        $lastUsername = $authenticationUtils->getLastUsername();
        $titre = "Enter your data connexion";
        $vue = 'login/login.html.twig';
        return $this->render(
            $vue,
            [
                'last_username' => $lastUsername,
                'error' => $error,
                'titre' => $titre,
            ]
        );
    }

    #[Route('/logout', name: 'app_logout')]
    public function logout()
    {
        
    }

}
