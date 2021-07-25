<?php

declare(strict_types=1);

namespace App\Security;

use App\Entity\HasUserInterface;
use App\Entity\UserInterface;
use Symfony\Component\Security\Core\Authentication\Token\TokenInterface;
use Symfony\Component\Security\Core\Authorization\Voter\Voter;

/**
 * @phpcs:disable SlevomatCodingStandard.TypeHints
 * Reason: I'm overwriting the class and it has not typehint and I need to declare the same way.
 */
class OwnerVoter extends Voter
{
    protected function supports(string $attribute, $subject): bool
    {
        return $subject instanceof HasUserInterface;
    }

    protected function voteOnAttribute(string $attribute, $subject, TokenInterface $token): bool
    {
        $user = $token->getUser();

        if (!$user instanceof UserInterface) {
            return false;
        }

        return $subject->getUser() === $user;
    }
}
