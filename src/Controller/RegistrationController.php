<?php

namespace App\Controller;

use App\Entity\User;
use App\Form\RegistrationFormType;
use App\Security\EmailVerifier;
use App\Security\FormAuthenticator;
use Symfony\Bridge\Twig\Mime\TemplatedEmail;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Mime\Address;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Security\Core\Encoder\UserPasswordEncoderInterface;
use Symfony\Component\Security\Core\Exception\InvalidCsrfTokenException;
use Symfony\Component\Security\Guard\GuardAuthenticatorHandler;
use Symfony\Contracts\Translation\TranslatorInterface;
use SymfonyCasts\Bundle\VerifyEmail\Exception\VerifyEmailExceptionInterface;

/**
 * @Route(name="app_", defaults={"_locale": "pt_BR"}, priority="10")
 *
 * Class RegistrationController
 * @package App\Controller
 */
class RegistrationController extends AbstractController
{
    private $emailVerifier;

    public function __construct(EmailVerifier $emailVerifier)
    {
        $this->emailVerifier = $emailVerifier;
    }

    /**
     * @Route("/register/{_locale}", name="register")
     *
     * @param Request $request
     * @param UserPasswordEncoderInterface $passwordEncoder
     * @param GuardAuthenticatorHandler $guardHandler
     * @param FormAuthenticator $authenticator
     * @param TranslatorInterface $translator
     * @param string $mailerFrom
     * @param string $mailerFromName
     * @return Response
     */
    public function register(
        Request $request,
        UserPasswordEncoderInterface $passwordEncoder,
        GuardAuthenticatorHandler $guardHandler,
        FormAuthenticator $authenticator,
        TranslatorInterface $translator,
        string $mailerFrom,
        string $mailerFromName
    ): Response {
        $user = new User();
        $form = $this->createForm(RegistrationFormType::class, $user);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $submittedToken = $request->request->get('token');
            if (!$this->isCsrfTokenValid('registration', $submittedToken)) {
                $this->addFlash('danger', 'Invalid CSRF token.');
                throw new InvalidCsrfTokenException();
            }

            // encode the plain password
            $user->setPassword(
                $passwordEncoder->encodePassword(
                    $user,
                    $form->get('plainPassword')->getData()
                )
            );

            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->persist($user);
            $entityManager->flush();

            // generate a signed url and email it to the user
            $this->emailVerifier->sendEmailConfirmation(
                'app_verify_email',
                $user,
                (new TemplatedEmail())
                    ->from(new Address($mailerFrom, $mailerFromName))
                    ->to($user->getEmail())
                    ->subject($translator->trans('email.registration.subject'))
                    ->htmlTemplate('security/registration/confirmation_email.html.twig')
                    ->context([
                        'user' => $user,
                    ])
            );
            // do anything else you need here, like send an email

            return $guardHandler->authenticateUserAndHandleSuccess(
                $user,
                $request,
                $authenticator,
                'main' // firewall name in security.yaml
            );
        }

        return $this->render('security/registration/register.html.twig', [
            'registrationForm' => $form->createView(),
        ]);
    }

    /**
     * @Route("/verify/email", name="verify_email")
     *
     * @param Request $request
     * @param TranslatorInterface $translator
     * @return Response
     */
    public function verifyUserEmail(Request $request, TranslatorInterface $translator): Response
    {
        $this->denyAccessUnlessGranted('IS_AUTHENTICATED_FULLY');

        // validate email confirmation link, sets User::isVerified=true and persists
        try {
            $this->emailVerifier->handleEmailConfirmation($request, $this->getUser());
        } catch (VerifyEmailExceptionInterface $exception) {
            $this->addFlash('danger', $exception->getReason());

            return $this->redirectToRoute('app_register');
        }

        $this->addFlash('success', $translator->trans('email.registration.is_verified'));

        return $this->redirectToRoute('app_login');
    }
}
