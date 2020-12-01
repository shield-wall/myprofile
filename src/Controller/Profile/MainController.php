<?php

namespace App\Controller\Profile;

use App\Form\ProfileType;
use App\Service\BackgroundImageService;
use App\Service\CurriculumService;
use App\Service\ProfileImageService;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class MainController extends AbstractController
{
    /**
     * @Route("/edit", name="edit", methods={"GET", "POST"})
     *
     * @param Request $request
     * @param ProfileImageService $profileImageService
     * @param BackgroundImageService $backgroundImageService
     * @return Response
     */
    public function editAction(
        Request $request,
        ProfileImageService $profileImageService,
        BackgroundImageService $backgroundImageService
    ): Response {
        $user = $this->getUser();
        $form = $this->createForm(ProfileType::class, $user);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $profileImageService->upload($user, $form->get('profile_image')->getData());
            $backgroundImageService->upload($user, $form->get('background_image')->getData());

            $this->getDoctrine()->getManager()->flush();
            $this->addFlash('success', 'messages.item_saved');
            return $this->redirectToRoute('profile_edit');
        }

        return $this->render('account/main.html.twig', array(
            'form' => $form->createView(),
        ));
    }

    /**
     * @Route("/generate-curriculum", name="generate_curriculum", methods={"GET"})
     *
     * @param CurriculumService $curriculumService
     * @return Response
     */
    public function generateCurriculumAction(CurriculumService $curriculumService): Response
    {
        $user = $this->getUser();
        $curriculumService->makePdfOnTransloadit($user);
        $this->addFlash('success', 'messages.generate_curriculum');

        return $this->redirectToRoute('profile_edit');
    }
}