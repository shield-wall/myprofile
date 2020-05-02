<?php

namespace App\Controller;

use App\Entity\User;
use App\Form\ContactType;
use App\Repository\UserRepository;
use Psr\Log\LoggerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

/**
 * @Route(name="app_", defaults={"_locale": "pt_BR"}, requirements={"_locale": "en|pt_BR"})
 */
class DefaultController extends AbstractController
{
    /**
     * @Route("/{_locale}", name="homepage")
     */
    public function indexAction(Request $request, UserRepository $userRepository, LoggerInterface $logger)
    {
        $users = $userRepository->findBy(['enabled' => true], ['id' => 'desc'], 20);

        return $this->render('site/index.html.twig', [
            'users' => $users,
        ]);
    }

    /**
     * @Route("/{slug}/{_locale}", name="profile")
     */
    public function profileAction(Request $request, User $user)
    {
        $formContact = $this->createForm(ContactType::class, null, [
            'method' => 'POST',
            'action' => $this->generateUrl('app_send_contact', ['slug' => $request->get('slug')])
        ]);

        return $this->render('default/profile.html.twig', [
            'user' => $user,
            'formContact' => $formContact->createView(),
        ]);
    }

    /**
     * @Route("/{_locale}/{slug}/send_contact", name="send_contact")
     */
    public function sendContactAction(Request $request, User $user, LoggerInterface $logger, \Swift_Mailer $mailer)
    {
        try {
            $formContact = $this->createForm(ContactType::class, null);
            $formContact->handleRequest($request);

            if (!$formContact->isValid())
                throw new \Exception('Erro na validação dos campos');

            $body = [
                'email' => $formContact->get('email')->getData(),
                'subject' => $formContact->get('subject')->getData(),
                'name' => $formContact->get('name')->getData(),
                'message' => $formContact->get('message')->getData()
            ];
            $message = new \Swift_Message();
            $message
                ->setSubject($formContact->get('subject')->getData())
                ->setFrom($this->getParameter('mailer_from'))
                ->setTo($user->getEmail())
                ->setBody(
                    $this->renderView(
                        'templates/contacts/simple.html.twig',
                        $body), 'text/html');

            if (!$mailer->send($message))
                throw new \Exception('Erro ao enviar o e-mail');

            $logger->debug('Email sending.', [
                'email_body' => $body,
            ]);
            $this->addFlash('success', 'Email enviado com sucesso!');

        } catch (\Throwable $e) {
            $this->addFlash('danger', $e->getMessage());
        } finally {
            return $this->redirectToRoute('app_profile', ['slug' => $request->get('slug')]);
        }
    }

    /**
     * _locale need to be the last parameter because it'll be curriculum name.
     *
     * @Route("/{slug}/curriculum/{_locale}", name="curriculum")
     */
    public function curriculumAction(User $user)
    {
        $html = $this->renderView('curriculum/theme_01/index.html.twig', [
            'user' => $user,
        ]);

        return new Response($html);
    }
}
