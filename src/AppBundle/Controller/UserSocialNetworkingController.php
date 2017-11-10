<?php

namespace AppBundle\Controller;

use AppBundle\Entity\User;
use AppBundle\Entity\UserSocialNetworking;
use FOS\UserBundle\Model\UserManager;
use FOS\UserBundle\Model\UserManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;use Symfony\Component\HttpFoundation\Request;

/**
 * Usersocialnetworking controller.
 *
 * @Route("user/usersocialnetworking")
 */
class UserSocialNetworkingController extends Controller
{
    /**
     * Lists all userSocialNetworking entities.
     *
     * @Route("/", name="user_usersocialnetworking_index")
     * @Method("GET")
     */
    public function indexAction()
    {
        $em = $this->getDoctrine()->getManager();

        $userSocialNetworkings = $em->getRepository('AppBundle:UserSocialNetworking')->findAll();

        return $this->render('usersocialnetworking/index.html.twig', array(
            'userSocialNetworkings' => $userSocialNetworkings,
        ));
    }

    /**
     * Creates a new userSocialNetworking entity.
     *
     * @Route("/new", name="user_usersocialnetworking_new")
     * @Method({"GET", "POST"})
     */
    public function newAction(Request $request)
    {
        $userSocialNetworking = new Usersocialnetworking();
        $userSocialNetworking->setUser($this->getUser());
        $form = $this->createForm('AppBundle\Form\UserSocialNetworkingType', $userSocialNetworking);
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
     * @Route("/{id}", name="user_usersocialnetworking_show")
     * @Method("GET")
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
     * @Route("/{id}/edit", name="user_usersocialnetworking_edit")
     * @Method({"GET", "POST"})
     */
    public function editAction(Request $request, UserSocialNetworking $userSocialNetworking)
    {
        $userSocialNetworking->setUser($this->getUser());
        $deleteForm = $this->createDeleteForm($userSocialNetworking);
        $editForm = $this->createForm('AppBundle\Form\UserSocialNetworkingType', $userSocialNetworking);
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
     * @Route("/{id}", name="user_usersocialnetworking_delete")
     * @Method("DELETE")
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
