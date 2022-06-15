<?php

namespace App\Controller;

use App\Entity\User;
use App\Repository\UserRepository;
use App\ThirdCode\Contracts\AddressInterface;
use App\ThirdCode\Contracts\CertificationInterface;
use App\ThirdCode\Contracts\EducationInterface;
use App\ThirdCode\Contracts\ExperienceInterface;
use App\ThirdCode\Contracts\SkillInterface;
use App\ThirdCode\Contracts\SpeakLanguageInterface;
use App\ThirdCode\Contracts\UserInfoInterface;
use App\ThirdCode\Contracts\UserSocialNetworkInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

#[Route(name: 'app_', requirements: ['_locale' => 'en|pt_BR'])]
class SiteController extends AbstractController
{
    #[Route(path: '/{_locale}', defaults: ['_locale' => 'pt_BR'], name: 'homepage')]
    public function homepage(UserRepository $userRepository): Response
    {
        $users = $userRepository->findBy(['isVerified' => true], ['updatedAt' => 'desc'], 18);

        return $this->render('site/index.html.twig', [
            'users' => $users,
        ]);
    }

    #[Route(path: '/{slug}/{_locale}', defaults: ['_locale' => 'pt_BR'], name: 'user_profile')]
    public function userProfileAction(User $user): Response
    {
        return $this->render('default/profile.html.twig', [
            'user' => $user,
        ]);
    }

    /**
     * _locale need to be the last parameter because it'll be curriculum name.
     * I removed _locale default from Class because here it's required,
     *      but it can be resolved creating other controller.
     */
    #[Route(path: '/{slug}/curriculum/{_locale}', name: 'curriculum')]
    public function curriculumAction(User $user): Response
    {
        return $this->render('@!Curriculum/cv01/index.html.twig', [
            AddressInterface::INDEX => $user,
            CertificationInterface::INDEX => $user->getCertifications(),
            EducationInterface::INDEX => $user->getEducations(),
            ExperienceInterface::INDEX => $user->getExperiences(),
            SkillInterface::INDEX => $user->getSkills(),
            UserSocialNetworkInterface::INDEX => $user->getUserSocialNetworks(),
            SpeakLanguageInterface::INDEX => $user->getUserLanguages(),
            UserInfoInterface::INDEX => $user,
        ]);
    }
}
