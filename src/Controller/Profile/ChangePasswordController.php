<?php

namespace App\Controller\Profile;

use Symfony\Component\PasswordHasher\Hasher\UserPasswordHasherInterface;
use App\Form\ChangePasswordAccountFormType;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class ChangePasswordController extends AbstractController
{
    #[Route(path: '/change-password', name: 'change_password')]
    public function __invoke(Request $request, UserPasswordHasherInterface $passwordEncoder) : Response
    {
        $user = $this->getUser();
        $form = $this->createForm(ChangePasswordAccountFormType::class);
        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()) {
            // Encode the plain password, and set it.
            $encodedPassword = $passwordEncoder->encodePassword(
                $this->getUser(),
                $form->get('plainPassword')->getData()
            );

            $user->setPassword($encodedPassword);
            $this->getDoctrine()->getManager()->flush();

            $this->addFlash('success', 'messages.item_saved');
        }
        return $this->render('profile/change-password.html.twig', [
            'form' => $form->createView(),
        ]);
    }
}
