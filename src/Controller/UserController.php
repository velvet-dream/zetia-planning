<?php

namespace App\Controller;

use App\Entity\Project;
use App\Entity\Task;
use App\Form\RegistrationFormType;
use App\Form\UserType;
use App\Repository\ProjectRepository;
use App\Repository\TaskRepository;
use App\Repository\UserRepository;
use Doctrine\ORM\EntityManager;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Bundle\SecurityBundle\Security;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class UserController extends AbstractController
{
    #[Route('/', name: 'app_index')]
    public function index(): Response
    {
        return $this->redirectToRoute('app_dashboard');
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

    #[Route('/profile', name: 'app_profile')]
    public function profile(Request $request, Security $security, EntityManagerInterface $em, UserRepository $userRepository): Response
    {
        $securityUser = $security->getUser();

        // Check if the user is authenticated before rendering the dashboard
        if (!$securityUser) {
            // Redirect to login if user is not authenticated
            return $this->redirectToRoute('app_login');
        }

        // To access setUsrAvatar method, we need an User entity instead of the one from Security
        $user = $userRepository->findOneBy(['usrMail' => $securityUser->getUserIdentifier()]);

        // We will have 2 different forms. One for the name/first name/ profile pic and one for the password / email
        $basicUserInfosForm = $this->createForm(UserType::class, $user, ['only_fields' => ['usrName', 'usrFirstName', 'usrAvatar']]);

        $sensitiveUserInfosForm = $this->createForm(RegistrationFormType::class, $user, ['only_fields' => ['usrPassword', 'usrMail']]);

        $basicUserInfosForm->handleRequest($request);

        if ($basicUserInfosForm->isSubmitted() && $basicUserInfosForm->isValid()) {
            $imageFile = $basicUserInfosForm->get('usrAvatar')->getData(); // Récupérer le fichier image soumis
            // Vérifier si une image a été soumise
            if ($imageFile) {
                $extension = $imageFile->guessExtension();
                if (!in_array($extension, ['png', 'jpg', 'jpeg'])) {
                    $this->addFlash('error', 'Seuls les formats png, jpg et jpeg sont acceptés.');
                    return $this->redirectToRoute('app_profile');
                }
                // Générer un nom de fichier unique
                $uid = uniqid(strtolower(pathinfo($imageFile->getClientOriginalName(), PATHINFO_FILENAME)));
                $newFilename = $uid . '.' . $imageFile->guessExtension();

                // Déplacer le fichier vers le répertoire où le stocker
                $destination = $this->getParameter('kernel.project_dir') . '/assets/images/profiles/';
                $imageFile->move(
                    $destination,
                    $newFilename
                );

                $user->setUsrAvatar($newFilename);
            }
            $em->persist($user);
            $em->flush();

            $this->addFlash('success', 'Votre profil a été mis à jour !');
        }
        return $this->render('user/profile.html.twig', [
            'user' => $securityUser,
            'basicUserInfosForm' => $basicUserInfosForm,
            'sensitiveUserInfosForm' => $sensitiveUserInfosForm
        ]);
    }
}
