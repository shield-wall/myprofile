<?php

namespace App\Controller;

use App\Entity\Certification;
use App\Repository\CertificationRepository;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Security;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;

/**
 * Certification controller.
 *
 * @Route("user/certification")
 */
class CertificationController extends AbstractController
{
    /**
     * Lists all certification entities.
     *
     * @Route("/", name="user_certification_index", methods={"GET"})
     */
    public function indexAction(CertificationRepository $certificationRepository)
    {
        $certifications = $certificationRepository->findBy(['user_id' => $this->getUser()]);

        return $this->render('certification/index.html.twig', array(
            'certifications' => $certifications,
        ));
    }

    /**
     * Creates a new certification entity.
     *
     * @Route("/new", name="user_certification_new", methods={"GET", "POST"})
     */
    public function newAction(Request $request)
    {
        $certification = new Certification();
        $certification->setUserId($this->getUser());
        $form = $this->createForm('App\Form\CertificationType', $certification);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($certification);
            $em->flush();

            return $this->redirectToRoute('user_certification_show', array('id' => $certification->getId()));
        }

        return $this->render('certification/new.html.twig', array(
            'certification' => $certification,
            'form' => $form->createView(),
        ));
    }

    /**
     * Finds and displays a certification entity.
     *
     * @Route("/{id}", name="user_certification_show", methods={"GET"})
     * @Security("user == certification.getUserId()")
     */
    public function showAction(Certification $certification)
    {
        $deleteForm = $this->createDeleteForm($certification);

        return $this->render('certification/show.html.twig', array(
            'certification' => $certification,
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Displays a form to edit an existing certification entity.
     *
     * @Route("/{id}/edit", name="user_certification_edit", methods={"GET", "POST"})
     * @Security("user == certification.getUserId()")
     */
    public function editAction(Request $request, Certification $certification)
    {
        $deleteForm = $this->createDeleteForm($certification);
        $editForm = $this->createForm('App\Form\CertificationType', $certification);
        $editForm->handleRequest($request);

        if ($editForm->isSubmitted() && $editForm->isValid()) {
            $this->getDoctrine()->getManager()->flush();

            return $this->redirectToRoute('user_certification_edit', array('id' => $certification->getId()));
        }

        return $this->render('certification/edit.html.twig', array(
            'certification' => $certification,
            'edit_form' => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Deletes a certification entity.
     *
     * @Route("/{id}", name="user_certification_delete", methods={"DELETE"})
     * @Security("user == certification.getUserId()")
     */
    public function deleteAction(Request $request, Certification $certification)
    {
        $form = $this->createDeleteForm($certification);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->remove($certification);
            $em->flush();
        }

        return $this->redirectToRoute('user_certification_index');
    }

    /**
     * Creates a form to delete a certification entity.
     *
     * @param Certification $certification The certification entity
     *
     * @return \Symfony\Component\Form\Form The form
     */
    private function createDeleteForm(Certification $certification)
    {
        return $this->createFormBuilder()
            ->setAction($this->generateUrl('user_certification_delete', array('id' => $certification->getId())))
            ->setMethod('DELETE')
            ->getForm();
    }
}
