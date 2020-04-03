<?php

namespace App\Controller;

use App\Entity\UserSocialNetworking;
use App\Repository\UserSocialNetworkingRepository;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Security;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;

/**
 * @Route(
 *     "/{_locale}/user/usersocialnetworking",
 *     name="user_usersocialnetworking_",
 *     defaults={"_locale": "pt_BR"},
 *     requirements={"_locale": "en|pt_BR"}
 *     )
 */
class UserSocialNetworkingController extends AbstractController
{
    /**
     * Lists all userSocialNetworking entities.
     *
     * @Route("/", name="index", methods={"GET"})
     */
    public function indexAction(UserSocialNetworkingRepository $userSocialNetworkingRepository)
    {
        $userSocialNetworkings = $userSocialNetworkingRepository->findBy(['user' => $this->getUser()]);

        return $this->render('usersocialnetworking/index.html.twig', array(
            'userSocialNetworkings' => $userSocialNetworkings,
        ));
    }

    /**
     * Creates a new userSocialNetworking entity.
     *
     * @Route("/new", name="new", methods={"GET", "POST"})
     */
    public function newAction(Request $request)
    {
        $userSocialNetworking = new Usersocialnetworking();
        $userSocialNetworking->setUser($this->getUser());
        $form = $this->createForm('App\Form\UserSocialNetworkingType', $userSocialNetworking);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($userSocialNetworking);
            $em->flush();

            $this->addFlash('success', 'messages.item_saved');
            return $this->redirectToRoute('user_usersocialnetworking_index');
        }

        return $this->render('usersocialnetworking/save.html.twig', array(
            'userSocialNetworking' => $userSocialNetworking,
            'form' => $form->createView(),
        ));
    }

    /**
     * Displays a form to edit an existing userSocialNetworking entity.
     *
     * @Route("/{id}/edit", name="edit", methods={"GET", "POST"})
     * @Security("user == userSocialNetworking.getUser()")
     */
    public function editAction(Request $request, UserSocialNetworking $userSocialNetworking)
    {
        $form = $this->createForm('App\Form\UserSocialNetworkingType', $userSocialNetworking);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $this->getDoctrine()->getManager()->flush();
            
            $this->addFlash('success', 'messages.item_saved');
            return $this->redirectToRoute('user_usersocialnetworking_index', array('id' => $userSocialNetworking->getId()));
        }

        return $this->render('usersocialnetworking/save.html.twig', array(
            'userSocialNetworking' => $userSocialNetworking,
            'form' => $form->createView(),
        ));
    }

    /**
     * Deletes a userSocialNetworking entity.
     *
     * @Route("/{id}", name="delete", methods={"DELETE"})
     * @Security("user == userSocialNetworking.getUser()")
     */
    public function deleteAction(Request $request, UserSocialNetworking $userSocialNetworking)
    {
        if ($this->isCsrfTokenValid('delete'.$userSocialNetworking->getId(), $request->request->get('_token'))) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->remove($userSocialNetworking);
            $entityManager->flush();

            $this->addFlash('success', 'messages.item_removed');
        }

        return $this->redirectToRoute('user_usersocialnetworking_index');
    }
}
