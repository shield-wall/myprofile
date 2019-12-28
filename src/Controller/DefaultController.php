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

class DefaultController extends AbstractController
{
    /**
     * @Route("/{_locale}", name="app_homepage", defaults={"_locale": "pt_BR"}, requirements={"_locale": "en|pt_BR"})
     */
    public function indexAction(Request $request, UserRepository $userRepository, LoggerInterface $logger)
    {
        $users = $userRepository->findBy(['enabled' => true], ['id' => 'desc'], 20);

        return $this->render('site/index.html.twig', [
            'users' => $users,
        ]);
    }

    /**
     * @Route("/{username}/{_locale}", name="app_profile", defaults={"_locale": "pt_BR"}, requirements={"_locale": "en|pt_BR"})
     */
    public function profileAction(Request $request, User $user)
    {
        $formContact = $this->createForm(ContactType::class, null, [
            'method' => 'POST',
            'action' => $this->generateUrl('app_send_contact', ['username' => $request->get('username')])
        ]);

        return $this->render('default/profile.html.twig', [
            'user' => $user,
            'formContact' => $formContact->createView(),
        ]);
    }

    /**
     * @Route("/{username}/send_contact/{_locale}", name="app_send_contact", defaults={"_locale": "pt_BR"}, requirements={"_locale": "en|pt_BR"})
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
            return $this->redirectToRoute('app_profile', ['username' => $request->get('username')]);
        }
    }

    /**
     * @Route(
     *     "/{username}/curriculum/{_locale}",
     *     name="app_curriculum",
     *     defaults={"_locale": "pt_BR"},
     *     requirements={"_locale": "en|pt_BR"}
     *     )
     */
    public function curriculumAction(User $user)
    {
        $html = $this->renderView('curriculum/theme_01/index.html.twig', [
            'user' => $user,
        ]);

        return new Response($html);
    }
}
