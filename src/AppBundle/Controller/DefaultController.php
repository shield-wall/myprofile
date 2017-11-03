<?php

namespace AppBundle\Controller;

use AppBundle\Entity\User;
use AppBundle\Form\ContactType;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\{
    Route,
    Method
};
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;

class DefaultController extends Controller
{
    public function indexAction(Request $request)
    {
        // replace this example code with whatever you need
        $formContact = $this->createForm(ContactType::class, null, [
            'method' => 'POST',
            'action' => $this->generateUrl('app_send_contact', ['username' => 'lilian'])
        ]);

        return $this->render('default/index.html.twig', [
            'formContact' => $formContact->createView(),
        ]);
    }

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

    public function sendContactAction(Request $request)
    {
        try {
            $formContact = $this->createForm(ContactType::class, null);
            $formContact->handleRequest($request);

            if(!$formContact->isValid())
                throw new \Exception('Erro na validação dos campos');

            $message = \Swift_Message::newInstance();
            $message
                ->setSubject($formContact->get('subject')->getData())
                ->setFrom($this->getParameter('mailer_from'))
                ->setTo($this->getParameter('mailer_to'))
                ->setBody(
                    $this->renderView(
                        'templates/contacts/simple.html.twig',
                        [
                            'email' => $formContact->get('email')->getData(),
                            'subject' => $formContact->get('subject')->getData(),
                            'name' => $formContact->get('name')->getData(),
                            'message' => $formContact->get('message')->getData()
                        ]), 'text/html')
            ;

            if(!$this->get('mailer')->send($message))
                throw new \Exception('Erro ao enviar o e-mail');

            $this->addFlash('success', 'Email enviado com sucesso!');

        } catch (\Throwable $e) {
            $this->addFlash('danger', $e->getMessage());
        } finally {
            return $this->redirectToRoute('app_profile', ['username' => $request->get('username')]);
        }
    }
}
