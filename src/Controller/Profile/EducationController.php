<?php

namespace App\Controller\Profile;

use App\Entity\Education;
use App\Form\EducationType;
use App\Repository\EducationRepository;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Security;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

/**
 * @Route("/education", name="education_")
 */
class EducationController extends AbstractCrudController
{
    public const PREFIX = 'education';

    /**
     * Lists all education entities.
     *
     * @Route(name="index", methods={"GET"})
     *
     * @param EducationRepository $educationRepository
     * @return Response
     */
    public function indexAction(EducationRepository $educationRepository): Response
    {
        return $this->index($educationRepository);
    }

    /**
     * @Route("/new", name="new", methods={"GET", "POST"})
     *
     * @param Request $request
     * @return Response
     */
    public function newAction(Request $request): Response
    {
        $education = new Education($this->getUser());
        return $this->save($request, EducationType::class, $education);
    }

    /**
     * @Route("/{id}/edit", name="edit", methods={"GET", "POST"})
     * @Security("user == education.getUser()")
     *
     * @param Request $request
     * @param Education $education
     * @return Response
     */
    public function editAction(Request $request, Education $education): Response
    {
        return $this->save($request, EducationType::class, $education);
    }

    /**
     * Deletes a education entity.
     *
     * @Route("/{id}", name="delete", methods={"DELETE"})
     * @Security("user == education.getUser()")
     *
     * @param Request $request
     * @param Education $education
     * @return Response
     */
    public function deleteAction(Request $request, Education $education): Response
    {
        return $this->delete($request, $education);
    }
}
