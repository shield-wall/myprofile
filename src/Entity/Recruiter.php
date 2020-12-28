<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Class Recruiter
 * @package App\Entity
 *
 * @ORM\Entity(repositoryClass="App\Repository\RecruiterRepository")
 */
class Recruiter extends User
{
    public function getRoles(): array
    {
        $this->roles[] = 'ROLE_RECRUITER';

        return parent::getRoles();
    }
}
