<?php


namespace App\EventListener;

use App\Entity\User;
use App\Service\CurriculumService;
use Symfony\Component\Security\Core\Security;

class UpdateCurriculumListener
{
    private $user;
    private $curriculumService;

    public function __construct(Security $security, CurriculumService $curriculumService)
    {
        $this->user = $security->getUser();
        $this->curriculumService = $curriculumService;
    }

    public function postPersist($entity)
    {
        if ($entity instanceof User)
            return;

        $this->curriculumService->makePdfOnTransloadit($this->user);
    }

    public function postUpdate($entity)
    {
        # TODO when the user is creating a new account this variable come null.
        if (null === $this->user)
            return;

        $this->curriculumService->makePdfOnTransloadit($this->user);
    }

    public function postRemove()
    {
        $this->curriculumService->makePdfOnTransloadit($this->user);
    }
}