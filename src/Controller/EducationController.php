<?php

namespace App\Controller;

use App\Entity\Education;
use App\Repository\EducationRepository;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Security;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;

/**
 * Education controller.
 *
 * @Route("user/education")
 */
class EducationController extends AbstractController
{
    /**
     * Lists all education entities.
     *
     * @Route("/", name="user_education_index", methods={"GET"})
     */
    public function indexAction(EducationRepository $educationRepository)
    {
        $educations = $educationRepository->findBy(['user_id' => $this->getUser()]);

        return $this->render('education/index.html.twig', array(
            'educations' => $educations,
        ));
    }

    /**
     * Creates a new education entity.
     *
     * @Route("/new", name="user_education_new", methods={"GET", "POST"})
     */
    public function newAction(Request $request)
    {
        $education = new Education();
        $education->setUserId($this->getUser());
        $form = $this->createForm('App\Form\EducationType', $education);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($education);
            $em->flush();

            return $this->redirectToRoute('user_education_show', array('id' => $education->getId()));
        }

        return $this->render('education/new.html.twig', array(
            'education' => $education,
            'form' => $form->createView(),
        ));
    }

    /**
     * Finds and displays a education entity.
     *
     * @Route("/{id}", name="user_education_show", methods={"GET"})
     * @Security("user == education.getUserId()")
     */
    public function showAction(Education $education)
    {
        $deleteForm = $this->createDeleteForm($education);

        return $this->render('education/show.html.twig', array(
            'education' => $education,
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Displays a form to edit an existing education entity.
     *
     * @Route("/{id}/edit", name="user_education_edit", methods={"GET", "POST"})
     * @Security("user == education.getUserId()")
     */
    public function editAction(Request $request, Education $education)
    {
        $deleteForm = $this->createDeleteForm($education);
        $education->setUserId($this->getUser());
        $editForm = $this->createForm('App\Form\EducationType', $education);
        $editForm->handleRequest($request);

        if ($editForm->isSubmitted() && $editForm->isValid()) {
            $this->getDoctrine()->getManager()->flush();

            return $this->redirectToRoute('user_education_edit', array('id' => $education->getId()));
        }

        return $this->render('education/edit.html.twig', array(
            'education' => $education,
            'edit_form' => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Deletes a education entity.
     *
     * @Route("/{id}", name="user_education_delete", methods={"DELETE"})
     * @Security("user == education.getUserId()")
     */
    public function deleteAction(Request $request, Education $education)
    {
        $form = $this->createDeleteForm($education);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->remove($education);
            $em->flush();
        }

        return $this->redirectToRoute('user_education_index');
    }

    /**
     * Creates a form to delete a education entity.
     *
     * @param Education $education The education entity
     *
     * @return \Symfony\Component\Form\Form The form
     */
    private function createDeleteForm(Education $education)
    {
        return $this->createFormBuilder()
            ->setAction($this->generateUrl('user_education_delete', array('id' => $education->getId())))
            ->setMethod('DELETE')
            ->getForm();
    }
}
