<?php

namespace App\Controller;

use App\Service\{BackgroundImageService, CurriculumService, ProfileImageService};
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Security;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;

/**
 * @Route(
 *     "/{_locale}/profile",
 *     name="profile_",
 *     defaults={"_locale": "pt_BR"},
 *     requirements={"_locale": "en|pt_BR"}
 *     )
 */
class ProfileController extends AbstractController
{
    /**
     * @Route("/edit", name="edit", methods={"GET", "POST"})
     * @Security("is_granted('ROLE_USER')")
     */
    public function editAction(
        Request $request,
        ProfileImageService $profileImageService,
        BackgroundImageService $backgroundImageService
    )
    {
        $user = $this->getUser();
        $form = $this->createForm('App\Form\ProfileType', $user);
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
     * @Security("is_granted('ROLE_USER')")
     */
    public function generateCurriculumAction(CurriculumService $curriculumService)
    {
        $user = $this->getUser();
        $curriculumService->makePdfOnTransloadit($user);
        $this->addFlash('success', 'messages.generate_curriculum');

        return $this->redirectToRoute('profile_edit');
    }
}