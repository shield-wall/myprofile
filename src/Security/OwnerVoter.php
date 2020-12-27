<?php

namespace App\Security;

use App\Entity\HasUserInterface;
use App\Entity\UserInterface;
use Symfony\Component\Security\Core\Authentication\Token\TokenInterface;
use Symfony\Component\Security\Core\Authorization\Voter\Voter;

class OwnerVoter extends Voter
{
    public const OWNER = 'owner';

    protected function supports(string $attribute, $subject): bool
    {
        if (self::OWNER !== $attribute) {
            return false;
        }

        return $subject instanceof HasUserInterface;
    }

    /**
     * @param string $attribute
     * @param HasUserInterface $subject
     * @param TokenInterface $token
     * @return bool
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
