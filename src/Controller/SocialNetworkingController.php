<?php

namespace App\Controller;

use App\Entity\SocialNetworking;
use App\Form\SocialNetworkingType;
use App\Repository\SocialNetworkingRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Form\Form;
use Symfony\Component\Form\FormInterface;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

#[Route(path: '/{_locale}/admin/socialnetworking', name: 'admin_socialnetworking_', defaults: ['_locale' => 'pt_BR'], requirements: ['_locale' => 'en|pt_BR'])]
class SocialNetworkingController extends AbstractController
{
    /**
     * Lists all socialNetworking entities.
     */
    #[Route(path: '/', name: 'index', methods: ['GET'])]
    public function indexAction(SocialNetworkingRepository $socialNetworkingRepository): Response
    {
        $socialNetworkings = $socialNetworkingRepository->findAll();

        return $this->render('socialnetworking/index.html.twig', [
            'socialNetworkings' => $socialNetworkings,
        ]);
    }

    /**
     * Creates a new socialNetworking entity.
     */
    #[Route(path: '/new', name: 'new', methods: ['GET', 'POST'])]
    public function newAction(Request $request): Response
    {
        $socialNetworking = new Socialnetworking();
        $form = $this->createForm(SocialNetworkingType::class, $socialNetworking);
        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($socialNetworking);
            $em->flush();

            return $this->redirectToRoute('admin_socialnetworking_index');
        }

        return $this->render('socialnetworking/new.html.twig', [
            'socialNetworking' => $socialNetworking,
            'form' => $form->createView(),
        ]);
    }

    /**
     * Finds and displays a socialNetworking entity.
     */
    #[Route(path: '/{id}', name: 'show', methods: ['GET'])]
    public function showAction(SocialNetworking $socialNetworking): Response
    {
        $deleteForm = $this->createDeleteForm($socialNetworking);

        return $this->render('socialnetworking/show.html.twig', [
            'socialNetworking' => $socialNetworking,
            'delete_form' => $deleteForm->createView(),
        ]);
    }

    /**
     * Displays a form to edit an existing socialNetworking entity.
     */
    #[Route(path: '/{id}/edit', name: 'edit', methods: ['GET', 'POST'])]
    public function editAction(Request $request, SocialNetworking $socialNetworking): Response
    {
        $deleteForm = $this->createDeleteForm($socialNetworking);
        $editForm = $this->createForm(SocialNetworkingType::class, $socialNetworking);
        $editForm->handleRequest($request);
        if ($editForm->isSubmitted() && $editForm->isValid()) {
            $this->getDoctrine()->getManager()->flush();

            return $this->redirectToRoute('admin_socialnetworking_edit', ['id' => $socialNetworking->getId()]);
        }

        return $this->render('socialnetworking/edit.html.twig', [
            'socialNetworking' => $socialNetworking,
            'edit_form' => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
        ]);
    }

    /**
     * Deletes a socialNetworking entity.
     */
    #[Route(path: '/{id}', name: 'delete', methods: ['DELETE'])]
    public function deleteAction(Request $request, SocialNetworking $socialNetworking): Response
    {
        $form = $this->createDeleteForm($socialNetworking);
        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->remove($socialNetworking);
            $em->flush();
        }

        return $this->redirectToRoute('admin_socialnetworking_index');
    }

    private function createDeleteForm(SocialNetworking $socialNetworking): FormInterface
    {
        return $this->createFormBuilder()
            ->setAction($this->generateUrl('admin_socialnetworking_delete', ['id' => $socialNetworking->getId()]))
            ->setMethod(Request::METHOD_DELETE)
            ->getForm();
    }
}
