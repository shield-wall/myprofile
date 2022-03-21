<?php

namespace App\EventListener;

use App\Entity\User;
use App\Service\CurriculumService;
use Symfony\Component\Security\Core\Security;
use Symfony\Component\Security\Core\User\UserInterface;

class UpdateCurriculumListener
{
    private $user;

    public function __construct(Security $security, private readonly CurriculumService $curriculumService)
    {
        $this->user = $security->getUser();
    }

    public function postPersist($entity)
    {
        if ($entity instanceof User) {
            return;
        }

        if (!$this->user instanceof UserInterface) {
            return;
        }

        $this->curriculumService->makePdfOnTransloadit($this->user);
    }

    public function postUpdate($entity)
    {
        // TODO when the user is creating a new account this variable come null.
        if (!$this->user instanceof UserInterface) {
            return;
        }

        $this->curriculumService->makePdfOnTransloadit($this->user);
    }

    public function postRemove()
    {
        $this->curriculumService->makePdfOnTransloadit($this->user);
    }
}
