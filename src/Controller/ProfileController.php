<?php
namespace App\Controller;

use App\Entity\User;
use App\Service\{ProfileImageService, BackgroundImageService};
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Security;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

/**
 * @Route("/profile", name="profile_")
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
    ) {
    	$user = $this->getUser();
        $form = $this->createForm('App\Form\ProfileType', $user);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
        	$profileImageService->upload($user, $form->get('profile_image')->getData());
        	$backgroundImageService->upload($user, $form->get('background_image')->getData());

            $this->getDoctrine()->getManager()->flush();

            return $this->redirectToRoute('profile_edit');
        }

        return $this->render('@FOSUser/Profile/edit.html.twig', array(
            'form' => $form->createView(),
        ));
    }
}