<?php

namespace App\Controller\Profile;

use App\Entity\Experience;
use App\Entity\User;
use App\Form\ExperienceType;
use App\Repository\ExperienceRepository;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Security;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

#[Route(path: '/experience', name: 'experience_')]
class ExperienceController extends AbstractController
{
    #[Route(name: 'index', methods: ['GET'])]
    public function indexAction(ExperienceRepository $experienceRepository): Response
    {
        $experiences = $experienceRepository->findBy(['user' => $this->getUser()]);

        return $this->render('profile/experience/index.html.twig', [
            'experiences' => $experiences,
        ]);
    }

    /**
     * Creates a new experience entity.
     */
    #[Route(path: '/new', name: 'new', methods: ['GET', 'POST'])]
    public function newAction(Request $request): Response
    {
        $experience = new Experience();
        /** @var User $user */
        $user = $this->getUser();
        $experience->setUser($user);
        $form = $this->createForm(ExperienceType::class, $experience);
        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($experience);
            $em->flush();

            $this->addFlash('success', 'messages.item_saved');

            return $this->redirectToRoute('profile_experience_index');
        }

        return $this->render('profile/experience/save.html.twig', [
            'experience' => $experience,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Security("user == experience.getUser()")
     */
    #[Route(path: '/{id}/edit', name: 'edit', methods: ['GET', 'POST'])]
    public function editAction(Request $request, Experience $experience): Response
    {
        $form = $this->createForm(ExperienceType::class, $experience);
        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()) {
            $this->getDoctrine()->getManager()->flush();

            $this->addFlash('success', 'messages.item_saved');

            return $this->redirectToRoute('profile_experience_index');
        }

        return $this->render('profile/experience/save.html.twig', [
            'experience' => $experience,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Security("user == experience.getUser()")
     */
    #[Route(path: '/{id}/del', name: 'delete', methods: ['POST'])]
    public function deleteAction(Request $request, Experience $experience): Response
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
