<?php

namespace App\Controller;

use Symfony\Component\HttpFoundation\Response;
use App\Entity\User;
use App\Repository\UserRepository;
use App\Service\CurriculumService;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;

/**
 * User controller.
 */
#[Route(path: '/admin/{_locale}/user', name: 'admin_user_')]
class UserController extends AbstractController
{
    /**
     * Lists all user entities.
     */
    #[Route(path: '/', name: 'index', methods: ['GET'])]
    public function indexAction(UserRepository $userRepository): Response
    {
        $users = $userRepository->findAll();
        return $this->render('user/index.html.twig', array(
            'users' => $users,
        ));
    }
    /**
     * Finds and displays a user entity.
     */
    #[Route(path: '/{id}', name: 'show', methods: ['GET'])]
    public function showAction(User $user): Response
    {
        return $this->render('user/show.html.twig', array(
            'user' => $user,
        ));
    }
    #[Route(path: '/{slug}/make_pdf', name: 'make_pdf')]
    public function makePdfAction(User $user, CurriculumService $curriculumService): Response
    {
        $curriculumService->makePdfOnTransloadit($user);
        $this->addFlash('success', 'pdf generated with success!');
        return $this->redirectToRoute('admin_user_index');
    }
}
