<?php

namespace App\Controller\Profile;

use App\Form\ExperienceType;
use App\Entity\Experience;
use App\Repository\ExperienceRepository;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Security;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;

#[Route(path: '/experience', name: 'experience_')]
class ExperienceController extends AbstractController
{
    #[Route(name: 'index', methods: ['GET'])]
    public function indexAction(ExperienceRepository $experienceRepository)
    {
        $experiences = $experienceRepository->findBy(['user' => $this->getUser()]);
        return $this->render('profile/experience/index.html.twig', array(
            'experiences' => $experiences,
        ));
    }
    /**
     * Creates a new experience entity.
     */
    #[Route(path: '/new', name: 'new', methods: ['GET', 'POST'])]
    public function newAction(Request $request)
    {
        $experience = new Experience();
        $experience->setUser($this->getUser());
        $form = $this->createForm(ExperienceType::class, $experience);
        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($experience);
            $em->flush();

            $this->addFlash('success', 'messages.item_saved');
            return $this->redirectToRoute('profile_experience_index');
        }
        return $this->render('profile/experience/save.html.twig', array(
            'experience' => $experience,
            'form' => $form->createView(),
        ));
    }
    /**
     * @Security("user == experience.getUser()")
     */
    #[Route(path: '/{id}/edit', name: 'edit', methods: ['GET', 'POST'])]
    public function editAction(Request $request, Experience $experience)
    {
        $form = $this->createForm(ExperienceType::class, $experience);
        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()) {
            $this->getDoctrine()->getManager()->flush();

            $this->addFlash('success', 'messages.item_saved');
            return $this->redirectToRoute('profile_experience_index');
        }
        return $this->render('profile/experience/save.html.twig', array(
            'experience' => $experience,
            'form' => $form->createView(),
        ));
    }
    /**
     * @Security("user == experience.getUser()")
     */
    #[Route(path: '/{id}', name: 'delete', methods: ['DELETE'])]
    public function deleteAction(Request $request, Experience $experience)
    {
        if ($this->isCsrfTokenValid('delete' . $experience->getId(), $request->request->get('_token'))) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->remove($experience);
            $entityManager->flush();

            $this->addFlash('success', 'messages.item_removed');
        }
        return $this->redirectToRoute('profile_experience_index');
    }
}
