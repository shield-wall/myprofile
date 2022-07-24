<?php

namespace App\Controller\Profile;

use App\Entity\User;
use App\Form\ProfileType;
use App\Service\BackgroundImageService;
use App\Service\CurriculumService;
use App\Service\ProfileImageService;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class MainController extends AbstractController
{
    public function __construct(private readonly EntityManagerInterface $entityManager)
    {
    }

    #[Route(path: '/edit', name: 'edit', methods: ['GET', 'POST'])]
    public function editAction(Request $request, ProfileImageService $profileImageService, BackgroundImageService $backgroundImageService): Response
    {
        /** @var User $user */
        $user = $this->getUser();

        $bucketImagePath = $this->changeCdnToBucket($user->getImage());
        $bucketBackgroundPath = $this->changeCdnToBucket($user->getBackgroundImage());
        $user->setImage($bucketImagePath);
        $user->setBackgroundImage($bucketBackgroundPath);

        $form = $this->createForm(ProfileType::class, $user);
        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()) {
            $profileImageService->upload($user, $form->get('profile_image')->getData());
            $backgroundImageService->upload($user, $form->get('background_image')->getData());

            $this->entityManager->persist($user);
            $this->entityManager->flush();
            $this->addFlash('success', 'messages.item_saved');

            return $this->redirectToRoute('profile_edit');
        }

        return $this->render('profile/main.html.twig', [
            'form' => $form->createView(),
        ]);
    }

    #[Route(path: '/generate-curriculum', name: 'generate_curriculum', methods: ['GET'])]
    public function generateCurriculumAction(CurriculumService $curriculumService): Response
    {
        /** @var User $user */
        $user = $this->getUser();
        $bucketPath = $this->changeCdnToBucket($user->getImage());
        $user->setImage($bucketPath);
        $curriculumService->makePdfOnTransloadit($user);
        $this->addFlash('success', 'messages.generate_curriculum');

        return $this->redirectToRoute('profile_edit');
    }

    /**
     * @TODO please find a better solution for this workaround.
     */
    private function changeCdnToBucket(string $path): string
    {
        return str_replace('https://cdn', 'https://bucket', $path);
    }
}
