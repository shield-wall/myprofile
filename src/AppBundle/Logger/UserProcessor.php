<?php

namespace AppBundle\Logger;


use AppBundle\Entity\User;
use Symfony\Component\Security\Core\Authentication\Token\Storage\TokenStorageInterface;

class UserProcessor
{
    private $tokenStorage;

    public function __construct(TokenStorageInterface $tokenStorage)
    {
        $this->tokenStorage = $tokenStorage;
    }

    public function __invoke(array $record): array
    {
        if(!$this->tokenStorage->getToken()) {
            return $record;
        }

        $user = $this->tokenStorage->getToken()->getUser();

        if (!$user instanceof User) {
            return $record;
        }

        $record['context']['user']['id'] = $user->getId();
        $record['context']['user']['username'] = $user->getUsername();
        $record['context']['user']['email'] = $user->getEmail();

        return $record;
    }
}