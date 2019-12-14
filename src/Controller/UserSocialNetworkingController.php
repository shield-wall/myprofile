<?php

namespace App\Controller;

use App\Entity\UserSocialNetworking;
use App\Repository\UserSocialNetworkingRepository;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Security;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;

/**
 * Usersocialnetworking controller.
 *
 * @Route("user/usersocialnetworking")
 */
class UserSocialNetworkingController extends AbstractController
{
    /**
     * Lists all userSocialNetworking entities.
     *
     * @Route("/", name="user_usersocialnetworking_index", methods={"GET"})
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
     * @Route("/new", name="user_usersocialnetworking_new", methods={"GET", "POST"})
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

            return $this->redirectToRoute('user_usersocialnetworking_show', array('id' => $userSocialNetworking->getId()));
        }

        return $this->render('usersocialnetworking/new.html.twig', array(
            'userSocialNetworking' => $userSocialNetworking,
            'form' => $form->createView(),
        ));
    }

    /**
     * Finds and displays a userSocialNetworking entity.
     *
     * @Route("/{id}", name="user_usersocialnetworking_show" , methods={"GET"})
     * @Security("user == userSocialNetworking.getUser()")
     */
    public function showAction(UserSocialNetworking $userSocialNetworking)
    {
        $deleteForm = $this->createDeleteForm($userSocialNetworking);

        return $this->render('usersocialnetworking/show.html.twig', array(
            'userSocialNetworking' => $userSocialNetworking,
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Displays a form to edit an existing userSocialNetworking entity.
     *
     * @Route("/{id}/edit", name="user_usersocialnetworking_edit", methods={"GET", "POST"})
     * @Security("user == userSocialNetworking.getUser()")
     */
    public function editAction(Request $request, UserSocialNetworking $userSocialNetworking)
    {
        $deleteForm = $this->createDeleteForm($userSocialNetworking);
        $editForm = $this->createForm('App\Form\UserSocialNetworkingType', $userSocialNetworking);
        $editForm->handleRequest($request);

        if ($editForm->isSubmitted() && $editForm->isValid()) {
            $this->getDoctrine()->getManager()->flush();

            return $this->redirectToRoute('user_usersocialnetworking_edit', array('id' => $userSocialNetworking->getId()));
        }

        return $this->render('usersocialnetworking/edit.html.twig', array(
            'userSocialNetworking' => $userSocialNetworking,
            'edit_form' => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Deletes a userSocialNetworking entity.
     *
     * @Route("/{id}", name="user_usersocialnetworking_delete", methods={"DELETE"})
     * @Security("user == userSocialNetworking.getUser()")
     */
    public function deleteAction(Request $request, UserSocialNetworking $userSocialNetworking)
    {
        $form = $this->createDeleteForm($userSocialNetworking);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->remove($userSocialNetworking);
            $em->flush();
        }

        return $this->redirectToRoute('user_usersocialnetworking_index');
    }

    /**
     * Creates a form to delete a userSocialNetworking entity.
     *
     * @param UserSocialNetworking $userSocialNetworking The userSocialNetworking entity
     *
     * @return \Symfony\Component\Form\Form The form
     */
    private function createDeleteForm(UserSocialNetworking $userSocialNetworking)
    {
        return $this->createFormBuilder()
            ->setAction($this->generateUrl('user_usersocialnetworking_delete', array('id' => $userSocialNetworking->getId())))
            ->setMethod('DELETE')
            ->getForm()
        ;
    }
}
