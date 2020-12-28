<?php

namespace App\Form;

use App\Entity\Recruiter;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\ChoiceList\ChoiceList;
use Symfony\Component\Form\Extension\Core\Type\CheckboxType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\EmailType;
use Symfony\Component\Form\Extension\Core\Type\PasswordType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class RecruiterType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('first_name', TextType::class, [
                'label' => 'form.first_name',

            ])
            ->add('last_name', TextType::class, [
                'label' => 'form.last_name',
            ])
            ->add('email', EmailType::class, [
                'label' => 'form.email',
            ])
            ->add('plainPassword', PasswordType::class, [
                'label' => 'form.password',
                'required' => false,
            ])
            ->add('is_verified', ChoiceType::class, [
                'label' => 'form.verified',
                'choices'  => [
                    'Yes' => true,
                    'No' => false,
                ],
            ])
        ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => Recruiter::class,
            'translation_domain' => 'MyProfile',
        ]);
    }
}
