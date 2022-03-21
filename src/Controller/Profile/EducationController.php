<?php

namespace App\Controller\Profile;

use App\Entity\Education;
use App\Form\EducationType;
use App\Repository\EducationRepository;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Security;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

#[Route(path: '/education', name: 'education_')]
class EducationController extends AbstractCrudController
{
    protected const PREFIX = 'education';
    /**
     * Lists all education entities.
     *
     *
     */
    #[Route(name: 'index', methods: ['GET'])]
    public function indexAction(EducationRepository $educationRepository) : Response
    {
        return $this->index($educationRepository);
    }
    #[Route(path: '/new', name: 'new', methods: ['GET', 'POST'])]
    public function newAction(Request $request) : Response
    {
        $education = new Education();
        return $this->save($request, EducationType::class, $education);
    }
    /**
     * @Security("user == education.getUser()")
     *
     */
    #[Route(path: '/{id}/edit', name: 'edit', methods: ['GET', 'POST'])]
    public function editAction(Request $request, Education $education) : Response
    {
        return $this->save($request, EducationType::class, $education);
    }
    /**
     * Deletes a education entity.
     *
     * @Security("user == education.getUser()")
     *
     */
    #[Route(path: '/{id}', name: 'delete', methods: ['DELETE'])]
    public function deleteAction(Request $request, Education $education) : Response
    {
        return $this->delete($request, $education);
    }
}
