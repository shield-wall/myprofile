<?php

namespace App\Controller\Profile;

use App\Entity\UserLanguage;
use App\Form\UserLanguageType;
use App\Repository\UserLanguageRepository;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Security;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

/**
 * @Route("/user-language", name="user_language_")
 */
class UserLanguageController extends AbstractController
{
    /**
     * @Route(name="index", methods={"GET"})
     */
    public function index(UserLanguageRepository $userLanguageRepository): Response
    {
        return $this->render('profile/user_language/index.html.twig', [
            'user_languages' => $userLanguageRepository->findAll(),
        ]);
    }

    /**
     * @Route("/new", name="new", methods={"GET","POST"})
     * @Security("is_granted('ROLE_USER')")
     */
    public function new(Request $request): Response
    {
        $userLanguage = new UserLanguage();
        $userLanguage->setUser($this->getUser());
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
     * @Route("/{id}/edit", name="edit", methods={"GET","POST"})
     * @Security("user == userLanguage.getUser()")
     */
    public function edit(Request $request, UserLanguage $userLanguage): Response
    {
        $form = $this->createForm(UserLanguageType::class, $userLanguage);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $this->getDoctrine()->getManager()->flush();

            $this->addFlash('success', 'messages.item_saved');
            return $this->redirectToRoute('profile_user_language_index');
        }

        return $this->render('profile/profile_user_language/save.html.twig', [
            'profile_user_language' => $userLanguage,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{id}", name="delete", methods={"DELETE"})
     * @Security("user == userLanguage.getUser()")
     */
    public function delete(Request $request, UserLanguage $userLanguage): Response
    {
        if ($this->isCsrfTokenValid('delete' . $userLanguage->getId(), $request->request->get('_token'))) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->remove($userLanguage);
            $entityManager->flush();

            $this->addFlash('success', 'messages.item_removed');
        }

        return $this->redirectToRoute('profile_user_language_index');
    }
}
