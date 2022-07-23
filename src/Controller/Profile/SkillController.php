<?php

namespace App\Controller\Profile;

use App\Entity\Skill;
use App\Entity\User;
use App\Form\SkillType;
use App\Repository\SkillRepository;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Security;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

#[Route(path: '/skill', name: 'skill_')]
class SkillController extends AbstractCrudController
{
    protected const PREFIX = 'skill';

    #[Route(name: 'index', methods: ['GET'])]
    public function indexAction(SkillRepository $skillRepository): Response
    {
        return $this->index($skillRepository);
    }

    #[Route(path: '/new', name: 'new', methods: ['GET', 'POST'])]
    public function newAction(Request $request): Response
    {
        $skill = new Skill();

        return $this->save($request, SkillType::class, $skill);
    }

    /**
     * @Security("user == skill.getUser()")
     */
    #[Route(path: '/{id}/edit', name: 'edit', methods: ['GET', 'POST'])]
    public function editAction(Request $request, Skill $skill): Response
    {
        return $this->save($request, SkillType::class, $skill);
    }

    /**
     * @Security("user == skill.getUser()")
     */
    #[Route(path: '/{id}/del', name: 'delete', methods: ['POST'])]
    public function deleteAction(Request $request, Skill $skill): Response
    {
        return $this->delete($request, $skill);
    }
}
