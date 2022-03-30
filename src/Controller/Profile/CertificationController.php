<?php

namespace App\Controller\Profile;

use App\Entity\Certification;
use App\Form\CertificationType;
use App\Repository\CertificationRepository;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\IsGranted;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

#[Route(path: '/certification', name: 'certification_')]
class CertificationController extends AbstractCrudController
{
    protected const PREFIX = 'certification';

    #[Route(name: 'index', methods: ['GET'])]
    public function indexAction(CertificationRepository $certificationRepository): Response
    {
        return $this->index($certificationRepository);
    }

    #[Route(path: '/new', name: 'new', methods: ['GET', 'POST'])]
    public function newAction(Request $request): Response
    {
        $certification = new Certification();

        return $this->save($request, CertificationType::class, $certification);
    }

    /**
     * @IsGranted("ROLE_USER", subject="certification")
     */
    #[Route(path: '/{id}/edit', name: 'edit', methods: ['GET', 'POST'])]
    public function editAction(Request $request, Certification $certification): Response
    {
        return $this->save($request, CertificationType::class, $certification);
    }

    /**
     * Deletes a certification entity.
     *
     * @IsGranted("ROLE_USER", subject="certification")
     */
    #[Route(path: '/{id}', name: 'delete', methods: ['DELETE'])]
    public function deleteAction(Request $request, Certification $certification): Response
    {
        return $this->delete($request, $certification);
    }
}
