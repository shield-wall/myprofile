<?php

namespace App\Controller\Profile;

use App\Entity\Certification;
use App\Repository\CertificationRepository;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Security;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;

/**
 * @Route("/certification", name="certification_")
 */
class CertificationController extends AbstractController
{
    /**
     * @Route(name="index", methods={"GET"})
     */
    public function indexAction(CertificationRepository $certificationRepository)
    {
        $certifications = $certificationRepository->findBy(['user' => $this->getUser()]);

        return $this->render('profile/certification/index.html.twig', array(
            'certifications' => $certifications,
        ));
    }

    /**
     * @Route("/new", name="new", methods={"GET", "POST"})
     */
    public function newAction(Request $request)
    {
        $certification = new Certification();
        $certification->setUser($this->getUser());
        $form = $this->createForm('App\Form\CertificationType', $certification);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($certification);
            $em->flush();

            $this->addFlash('success', 'messages.item_saved');
            return $this->redirectToRoute('profile_certification_index');
        }

        return $this->render('profile/certification/save.html.twig', array(
            'certification' => $certification,
            'form' => $form->createView(),
        ));
    }

    /**
     * @Route("/{id}/edit", name="edit", methods={"GET", "POST"})
     * @Security("user == certification.getUser()")
     */
    public function editAction(Request $request, Certification $certification)
    {
        $form = $this->createForm('App\Form\CertificationType', $certification);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $this->getDoctrine()->getManager()->flush();

            $this->addFlash('success', 'messages.item_saved');
            return $this->redirectToRoute('profile_certification_index');
        }

        return $this->render('profile/certification/save.html.twig', array(
            'certification' => $certification,
            'form' => $form->createView(),
        ));
    }

    /**
     * Deletes a certification entity.
     *
     * @Route("/{id}", name="delete", methods={"DELETE"})
     * @Security("user == certification.getUser()")
     */
    public function deleteAction(Request $request, Certification $certification)
    {
        if ($this->isCsrfTokenValid('delete' . $certification->getId(), $request->request->get('_token'))) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->remove($certification);
            $entityManager->flush();

            $this->addFlash('success', 'messages.item_removed');
        }

        return $this->redirectToRoute('profile_certification_index');
    }
}
