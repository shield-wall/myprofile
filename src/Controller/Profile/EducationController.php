<?php

namespace App\Controller\Profile;

use App\Entity\Education;
use App\Form\EducationType;
use App\Repository\EducationRepository;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Security;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;

/**
 * @Route("/education", name="education_")
 */
class EducationController extends AbstractController
{
    /**
     * Lists all education entities.
     *
     * @Route(name="index", methods={"GET"})
     */
    public function indexAction(EducationRepository $educationRepository)
    {
        $educations = $educationRepository->findBy(['user' => $this->getUser()]);

        return $this->render('/profile/education/index.html.twig', array(
            'educations' => $educations,
        ));
    }

    /**
     * @Route("/new", name="new", methods={"GET", "POST"})
     */
    public function newAction(Request $request)
    {
        $education = new Education();
        $education->setUser($this->getUser());
        $form = $this->createForm(EducationType::class, $education);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($education);
            $em->flush();

            $this->addFlash('success', 'messages.item_saved');
            return $this->redirectToRoute('profile_education_index');
        }

        return $this->render('profile/education/save.html.twig', array(
            'education' => $education,
            'form' => $form->createView(),
        ));
    }

    /**
     * @Route("/{id}/edit", name="edit", methods={"GET", "POST"})
     * @Security("user == education.getUser()")
     */
    public function editAction(Request $request, Education $education)
    {
        $education->setUser($this->getUser());
        $form = $this->createForm('App\Form\EducationType', $education);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $this->getDoctrine()->getManager()->flush();

            $this->addFlash('success', 'messages.item_saved');
            return $this->redirectToRoute('profile_education_index');
        }

        return $this->render('profile/education/save.html.twig', array(
            'education' => $education,
            'form' => $form->createView(),
        ));
    }

    /**
     * Deletes a education entity.
     *
     * @Route("/{id}", name="delete", methods={"DELETE"})
     * @Security("user == education.getUser()")
     */
    public function deleteAction(Request $request, Education $education)
    {
        if ($this->isCsrfTokenValid('delete' . $education->getId(), $request->request->get('_token'))) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->remove($education);
            $entityManager->flush();

            $this->addFlash('success', 'messages.item_removed');
        }

        return $this->redirectToRoute('profile_education_index');
    }
}
