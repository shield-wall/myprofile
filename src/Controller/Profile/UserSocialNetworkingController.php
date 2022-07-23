<?php

namespace App\Controller\Profile;

use App\Entity\User;
use App\Entity\UserSocialNetworking;
use App\Form\UserSocialNetworkingType;
use App\Repository\UserSocialNetworkingRepository;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Security;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

#[Route(path: '/user-social-network', name: 'user-social-network_')]
class UserSocialNetworkingController extends AbstractCrudController
{
    protected const PREFIX = 'user-social-network';

    #[Route(name: 'index', methods: ['GET'])]
    public function indexAction(UserSocialNetworkingRepository $userSocialNetworkingRepository): Response
    {
        return $this->index($userSocialNetworkingRepository);
    }

    #[Route(path: '/new', name: 'new', methods: ['GET', 'POST'])]
    public function newAction(Request $request): Response
    {
        $userSocialNetworking = new UserSocialNetworking();

        return $this->save($request, UserSocialNetworkingType::class, $userSocialNetworking);
    }

    /**
     * @Security("user == userSocialNetworking.getUser()")
     */
    #[Route(path: '/{id}/edit', name: 'edit', methods: ['GET', 'POST'])]
    public function editAction(Request $request, UserSocialNetworking $userSocialNetworking): Response
    {
        return $this->save($request, UserSocialNetworkingType::class, $userSocialNetworking);
    }

    /**
     * @Security("user == userSocialNetworking.getUser()")
     */
    #[Route(path: '/{id}/del', name: 'delete', methods: ['POST'])]
    public function deleteAction(Request $request, UserSocialNetworking $userSocialNetworking): Response
    {
        return $this->delete($request, $userSocialNetworking);
    }
}
