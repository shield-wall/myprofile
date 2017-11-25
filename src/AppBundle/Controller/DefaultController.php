<?php

namespace AppBundle\Controller;

use AppBundle\Entity\User;
use AppBundle\Form\ContactType;
use AppBundle\Utils\Gravatar;
use Doctrine\ORM\EntityManager;
use FOS\UserBundle\Doctrine\UserManager;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\{
    Route,
    Method
};
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Knp\Bundle\SnappyBundle\Snappy\Response\PdfResponse;
use Symfony\Component\HttpFoundation\Response;

class DefaultController extends Controller
{
    public function indexAction(Request $request, EntityManager $entityManager)
    {
        $users = $entityManager->getRepository('AppBundle:User')->findBy(['enabled' => true], ['id' => 'desc'], 40);

        return $this->render('site/index.html.twig', [
            'users' => $users,
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

    public function sendContactAction(Request $request, User $user)
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
                ->setTo($user->getEmail())
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

    public function curriculumAction(User $user, $generate)
    {
        $html = $this->renderView('curriculum/theme_01/index.html.twig', [
            'user' => $user,
        ]);

        if($generate == 'html')
            return new Response($html);

        return new Response(
            $this->get('knp_snappy.pdf')->getOutputFromHtml($html),
            200,
            array(
                'Content-Type' => 'application/pdf',
                'Content-Disposition' => 'attachment; filename="my_profile.pdf"'
            )
        );
    }
}
