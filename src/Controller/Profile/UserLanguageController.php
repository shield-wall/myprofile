<?php

namespace App\Controller\Profile;

use App\Entity\User;
use App\Entity\UserLanguage;
use App\Form\UserLanguageType;
use App\Repository\UserLanguageRepository;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\IsGranted;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

#[Route(path: '/user-language', name: 'user_language_')]
class UserLanguageController extends AbstractController
{
    #[Route(name: 'index', methods: ['GET'])]
    public function index(UserLanguageRepository $userLanguageRepository): Response
    {
        $userLanguages = $userLanguageRepository->findBy(['user' => $this->getUser()]);

        return $this->render('profile/user_language/index.html.twig', [
            'user_languages' => $userLanguages,
        ]);
    }

    #[Route(path: '/new', name: 'new', methods: ['GET', 'POST'])]
    public function new(Request $request): Response
    {
        $userLanguage = new UserLanguage();
        /** @var User $user */
        $user = $this->getUser();
        $userLanguage->setUser($user);
        $form = $this->createForm(UserLanguageType::class, $userLanguage);
        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->persist($userLanguage);
            $entityManager->flush();

            $this->addFlash('success', 'messages.item_saved');

            return $this->redirectToRoute('profile_user_language_index');
        }

        return $this->render('profile/user_language/save.html.twig', [
            'profile_user_language' => $userLanguage,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @IsGranted("ROLE_USER", subject="userLanguage")
     */
    #[Route(path: '/{id}/edit', name: 'edit', methods: ['GET', 'POST'])]
    public function edit(Request $request, UserLanguage $userLanguage): Response
    {
        $form = $this->createForm(UserLanguageType::class, $userLanguage);
        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()) {
            $this->getDoctrine()->getManager()->flush();

            $this->addFlash('success', 'messages.item_saved');

            return $this->redirectToRoute('profile_user_language_index');
        }

        return $this->render('profile/user_language/save.html.twig', [
            'profile_user_language' => $userLanguage,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @IsGranted("ROLE_USER", subject="userLanguage")
     */
    #[Route(path: '/{id}/del', name: 'delete', methods: ['POST'])]
    public function delete(Request $request, UserLanguage $userLanguage): Response
    {
        if ($this->isCsrfTokenValid('delete' . $userLanguage->getId(), $request->request->getAlpha('_token'))) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->remove($userLanguage);
            $entityManager->flush();

            $this->addFlash('success', 'messages.item_removed');
        }

        return $this->redirectToRoute('profile_user_language_index');
    }
}
