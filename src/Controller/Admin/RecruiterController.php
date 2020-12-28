<?php

namespace App\Controller\Admin;

use App\Entity\Recruiter;
use App\Form\RecruiterType;
use App\Repository\RecruiterRepository;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Security\Core\Encoder\UserPasswordEncoderInterface;

/**
 * Class RecruiterController
 * @package App\Controller\Admin
 *
 * @Route("/recruiter", name="recruiter_")
 */
class RecruiterController extends AbstractCrudController
{
    private UserPasswordEncoderInterface $passwordEncoder;

    public function __construct(UserPasswordEncoderInterface $passwordEncoder)
    {
        $this->passwordEncoder = $passwordEncoder;
    }

    public const PREFIX = 'recruiter';

    /**
     * @Route(name="index", methods={"GET"})
     *
     * @param Request $request
     * @param RecruiterRepository $repository
     * @return Response
     */
    public function indexAction(Request $request, RecruiterRepository $repository): Response
    {
        return $this->index($repository);
    }

    /**
     * @Route("/new", name="new", methods={"GET", "POST"})
     *
     * @param Request $request
     * @return Response
     */
    public function newAction(Request $request): Response
    {
        $recruiter = new Recruiter();
        $this->encodePassword($request, RecruiterType::class, $recruiter);

        return $this->save($request, RecruiterType::class, $recruiter);
    }

    /**
     * @Route("/{id}/edit", name="edit", methods={"GET", "POST"})
     *
     * @param Request $request
     * @param Recruiter $recruiter
     * @return Response
     */
    public function editAction(Request $request, Recruiter $recruiter): Response
    {
        $this->encodePassword($request, RecruiterType::class, $recruiter);

        return $this->save($request, RecruiterType::class, $recruiter);
    }

    private function encodePassword(Request $request, string $formTypeClass, Recruiter $recruiter): void
    {
        $form = $this->createForm($formTypeClass, $recruiter);
        $form->handleRequest($request);

        if (!$form->isSubmitted()) {
            return;
        }

        if (null === $form->get('plainPassword')->getData()) {
            return;
        }

        $recruiter->setPassword(
            $this->passwordEncoder->encodePassword(
                $recruiter,
                $form->get('plainPassword')->getData()
            )
        );
    }
}
