<?php

namespace App\Security;

use App\Entity\HasUserInterface;
use App\Entity\UserInterface;
use Symfony\Component\Security\Core\Authentication\Token\TokenInterface;
use Symfony\Component\Security\Core\Authorization\Voter\Voter;

class OwnerVoter extends Voter
{
    protected function supports(string $attribute, $subject): bool
    {
        return $subject instanceof HasUserInterface;
    }

    /**
     * @param HasUserInterface $subject
     */
    protected function voteOnAttribute(string $attribute, $subject, TokenInterface $token): bool
    {
        $user = $token->getUser();

        if (!$user instanceof UserInterface) {
            return false;
        }

        return $subject->getUser() === $user;
    }
}
