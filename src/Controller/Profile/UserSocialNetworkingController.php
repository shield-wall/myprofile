<?php

namespace App\Controller\Profile;

use App\Entity\User;
use App\Entity\UserUserSocialNetworking;
use App\Form\UserSocialNetworkingType;
use App\Repository\UserSocialNetworkingRepository;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Security;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

#[Route(path: '/usersocialnetworking', name: 'usersocialnetworking_')]
class UserSocialNetworkingController extends AbstractController
{
    /**
     * Lists all userSocialNetworking entities.
     */
    #[Route(name: 'index', methods: ['GET'])]
    public function indexAction(UserSocialNetworkingRepository $userSocialNetworkingRepository): Response
    {
        $userSocialNetworkings = $userSocialNetworkingRepository->findBy(['user' => $this->getUser()]);

        return $this->render('profile/usersocialnetworking/index.html.twig', [
            'userSocialNetworkings' => $userSocialNetworkings,
        ]);
    }

    /**
     * Creates a new userSocialNetworking entity.
     */
    #[Route(path: '/new', name: 'new', methods: ['GET', 'POST'])]
    public function newAction(Request $request): Response
    {
        $userSocialNetworking = new UserUserSocialNetworking();
        /** @var User $user */
        $user = $this->getUser();
        $userSocialNetworking->setUser($user);
        $form = $this->createForm(UserSocialNetworkingType::class, $userSocialNetworking);
        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($userSocialNetworking);
            $em->flush();

            $this->addFlash('success', 'messages.item_saved');

            return $this->redirectToRoute('profile_usersocialnetworking_index');
        }

        return $this->render('profile/usersocialnetworking/save.html.twig', [
            'userSocialNetworking' => $userSocialNetworking,
            'form' => $form->createView(),
        ]);
    }

    /**
     * Displays a form to edit an existing userSocialNetworking entity.
     *
     * @Security("user == userSocialNetworking.getUser()")
     */
    #[Route(path: '/{id}/edit', name: 'edit', methods: ['GET', 'POST'])]
    public function editAction(Request $request, UserUserSocialNetworking $userSocialNetworking): Response
    {
        $form = $this->createForm(UserSocialNetworkingType::class, $userSocialNetworking);
        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()) {
            $this->getDoctrine()->getManager()->flush();

            $this->addFlash('success', 'messages.item_saved');

            return $this->redirectToRoute(
                'profile_usersocialnetworking_index',
                [
                    'id' => $userSocialNetworking->getId(),
                ]
            );
        }

        return $this->render('profile/usersocialnetworking/save.html.twig', [
            'userSocialNetworking' => $userSocialNetworking,
            'form' => $form->createView(),
        ]);
    }

    /**
     * Deletes a userSocialNetworking entity.
     *
     * @Security("user == userSocialNetworking.getUser()")
     */
    #[Route(path: '/{id}/del', name: 'delete', methods: ['POST'])]
    public function deleteAction(Request $request, UserUserSocialNetworking $userSocialNetworking): Response
    {
        if ($this->isCsrfTokenValid('delete' . $userSocialNetworking->getId(), $request->request->get('_token'))) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->remove($userSocialNetworking);
            $entityManager->flush();

            $this->addFlash('success', 'messages.item_removed');
        }

        return $this->redirectToRoute('profile_usersocialnetworking_index');
    }
}
