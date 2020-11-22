<?php

namespace App\Controller;

use App\Entity\UserLanguage;
use App\Form\UserLanguageType;
use App\Repository\UserLanguageRepository;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Security;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

/**
 * @Route(
 *     "/{_locale}/user/language",
 *     name="user_language_",
 *     defaults={"_locale": "pt_BR"},
 *     requirements={"_locale": "en|pt_BR"}
 *     )
 */
class UserLanguageController extends AbstractController
{
    /**
     * @Route("/", name="index", methods={"GET"})
     * @Security("is_granted('ROLE_USER')")
     */
    public function index(UserLanguageRepository $userLanguageRepository): Response
    {
        return $this->render('user_language/index.html.twig', [
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
        $userLanguage->setUserId($this->getUser());
        $form = $this->createForm(UserLanguageType::class, $userLanguage);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->persist($userLanguage);
            $entityManager->flush();

            $this->addFlash('success', 'messages.item_saved');
            return $this->redirectToRoute('user_language_index');
        }

        return $this->render('user_language/save.html.twig', [
            'user_language' => $userLanguage,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{id}/edit", name="edit", methods={"GET","POST"})
     * @Security("user == userLanguage.getUserId()")
     */
    public function edit(Request $request, UserLanguage $userLanguage): Response
    {
        $form = $this->createForm(UserLanguageType::class, $userLanguage);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $this->getDoctrine()->getManager()->flush();

            $this->addFlash('success', 'messages.item_saved');
            return $this->redirectToRoute('user_language_index');
        }

        return $this->render('user_language/save.html.twig', [
            'user_language' => $userLanguage,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{id}", name="delete", methods={"DELETE"})
     * @Security("user == userLanguage.getUserId()")
     */
    public function delete(Request $request, UserLanguage $userLanguage): Response
    {
        if ($this->isCsrfTokenValid('delete' . $userLanguage->getId(), $request->request->get('_token'))) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->remove($userLanguage);
            $entityManager->flush();

            $this->addFlash('success', 'messages.item_removed');
        }

        return $this->redirectToRoute('user_language_index');
    }
}
