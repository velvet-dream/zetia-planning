<?php
namespace App\Controller;
use App\Entity\User;
use App\Form\UserType;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\PasswordHasher\Hasher\UserPasswordHasherInterface;

class RegisterController extends AbstractController
{
    #[Route('/register', name: 'app_register')]
    public function register(Request $request, EntityManagerInterface $entityManager, UserPasswordHasherInterface $passwordHasher)
    {
        $user = new User();
        $form = $this->createForm(UserType::class, $user);

        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $user = $form->getData();

            $hashedPassword = $passwordHasher->hashPassword($user, $user->getUsrPassword());
            $user->setUsrPassword($hashedPassword);



            // Persistance de l'utilisateur
            $entityManager->persist($user);
            $entityManager->flush();

            // Redirection ou rendu d'une vue.
            return $this->redirectToRoute('security_login');
        }

        return $this->render('register/registration.html.twig', [
            'form' => $form->createView(),
        ]);
    }
}
