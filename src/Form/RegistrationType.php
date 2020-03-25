<?php
namespace App\Form;

use FOS\UserBundle\Form\Type\RegistrationFormType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\{
    BirthdayType,
    ChoiceType,
    TextType
};
use Symfony\Component\Form\FormBuilderInterface;

class RegistrationType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('first_name', TextType::class)
            ->add('last_name', TextType::class)
        ;
    }

    public function getParent()
    {
        return RegistrationFormType::class;
    }

    public function getBlockPrefix()
    {
        return 'app_user_registration';
    }
}