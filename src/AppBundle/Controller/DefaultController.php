<?php

namespace AppBundle\Controller;

use AppBundle\Entity\User;
use AppBundle\Form\ContactType;
use AppBundle\Repository\UserRepository;
use Knp\Snappy\Pdf;
use Psr\Log\LoggerInterface;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;

class DefaultController extends Controller
{
    /**
     * @Route("/{_locale}", name="app_homepage", defaults={"_locale": "pt_BR"}, requirements={"_locale": "en|pt_BR"})
     */
    public function indexAction(Request $request, UserRepository $userRepository)
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
    public function sendContactAction(Request $request, User $user, LoggerInterface $logger)
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
            $message = \Swift_Message::newInstance();
            $message
                ->setSubject($formContact->get('subject')->getData())
                ->setFrom($this->getParameter('mailer_from'))
                ->setTo($user->getEmail())
                ->setBody(
                    $this->renderView(
                        'templates/contacts/simple.html.twig',
                        $body), 'text/html');

            if (!$this->get('mailer')->send($message))
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
    public function curriculumAction(User $user, Pdf $pdf)
    {
        $html = $this->renderView('curriculum/theme_01/index.html.twig', [
            'user' => $user,
        ]);

        return new Response(
            $pdf->getOutputFromHtml($html),
            Response::HTTP_OK,
            array(
                'Content-Type' => 'application/pdf',
            )
        );
    }
}
