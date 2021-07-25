<?php

declare(strict_types=1);

namespace App\Controller\Profile;

use App\Entity\Certification;
use App\Form\CertificationType;
use App\Repository\CertificationRepository;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\IsGranted;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

/**
 * @Route("/certification", name="certification_")
 */
class CertificationController extends AbstractCrudController
{
    protected const PREFIX = 'certification';

    /**
     * @Route(name="index", methods={"GET"})
     *
     * @param CertificationRepository $certificationRepository
     * @return Response
     */
    public function indexAction(CertificationRepository $certificationRepository): Response
    {
        return $this->index($certificationRepository);
    }

    /**
     * @Route("/new", name="new", methods={"GET", "POST"})
     *
     * @param Request $request
     * @return Response
     */
    public function newAction(Request $request): Response
    {
        $certification = new Certification();

        return $this->save($request, CertificationType::class, $certification);
    }

    /**
     * @Route("/{id}/edit", name="edit", methods={"GET", "POST"})
     * @IsGranted("ROLE_USER", subject="certification")
     *
     * @param Request $request
     * @param Certification $certification
     * @return Response
     */
    public function editAction(Request $request, Certification $certification): Response
    {
        return $this->save($request, CertificationType::class, $certification);
    }

    /**
     * Deletes a certification entity.
     *
     * @Route("/{id}", name="delete", methods={"DELETE"})
     * @IsGranted("ROLE_USER", subject="certification")
     *
     * @param Request $request
     * @param Certification $certification
     * @return Response
     */
    public function deleteAction(Request $request, Certification $certification): Response
    {
        return $this->delete($request, $certification);
    }
}
