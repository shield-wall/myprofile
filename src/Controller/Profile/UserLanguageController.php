<?php

namespace App\Controller\Profile;

use App\Entity\UserLanguage;
use App\Form\UserLanguageType;
use App\Repository\UserLanguageRepository;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\IsGranted;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

#[Route(path: '/user-language', name: 'user_language_')]
class UserLanguageController extends AbstractCrudController
{
    protected const PREFIX = 'user_language';

    #[Route(name: 'index', methods: ['GET'])]
    public function indexAction(UserLanguageRepository $userLanguageRepository): Response
    {
        return $this->index($userLanguageRepository);
    }

    #[Route(path: '/new', name: 'new', methods: ['GET', 'POST'])]
    public function new(Request $request): Response
    {
        $userLanguage = new UserLanguage();

        return $this->save($request, UserLanguageType::class, $userLanguage);
    }

    #[Route(path: '/{id}/edit', name: 'edit', methods: ['GET', 'POST'])]
    #[IsGranted('ROLE_USER', subject: 'userLanguage')]
    public function edit(Request $request, UserLanguage $userLanguage): Response
    {
        return $this->save($request, UserLanguageType::class, $userLanguage);
    }

    #[Route(path: '/{id}/del', name: 'delete', methods: ['POST'])]
    #[IsGranted('ROLE_USER', subject: 'userLanguage')]
    public function deleteAction(Request $request, UserLanguage $userLanguage): Response
    {
        return $this->delete($request, $userLanguage);
    }
}
