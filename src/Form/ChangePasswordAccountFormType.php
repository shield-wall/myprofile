<?php

namespace App\Form;

use Symfony\Component\Form\Extension\Core\Type\PasswordType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\Security\Core\Validator\Constraints\UserPassword;
use Symfony\Component\Validator\Constraints\NotBlank;

class ChangePasswordAccountFormType extends ChangePasswordFormType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        parent::buildForm($builder, $options);

        $builder->add('current_password', PasswordType::class, [
            'label' => 'user.current_password',
            'mapped' => false,
            'constraints' => [
                new NotBlank(),
                new UserPassword(),
            ],
            'attr' => [
                'autocomplete' => 'current-password',
            ],
        ]);
    }
}