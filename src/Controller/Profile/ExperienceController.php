<?php

namespace App\Controller\Profile;

use App\Entity\Experience;
use App\Entity\User;
use App\Form\ExperienceType;
use App\Repository\ExperienceRepository;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Security;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

#[Route(path: '/experience', name: 'experience_')]
class ExperienceController extends AbstractCrudController
{
    protected const PREFIX = 'experience';

    #[Route(name: 'index', methods: ['GET'])]
    public function indexAction(ExperienceRepository $experienceRepository): Response
    {
        return $this->index($experienceRepository);
    }

    #[Route(path: '/new', name: 'new', methods: ['GET', 'POST'])]
    public function newAction(Request $request): Response
    {
        $experience = new Experience();

        return $this->save($request, ExperienceType::class, $experience);
    }

    /**
     * @Security("user == experience.getUser()")
     */
    #[Route(path: '/{id}/edit', name: 'edit', methods: ['GET', 'POST'])]
    public function editAction(Request $request, Experience $experience): Response
    {
        return $this->save($request, ExperienceType::class, $experience);
    }

    /**
     * @Security("user == experience.getUser()")
     */
    #[Route(path: '/{id}/del', name: 'delete', methods: ['POST'])]
    public function deleteAction(Request $request, Experience $experience): Response
    {
        return $this->delete($request, $experience);
    }
}
