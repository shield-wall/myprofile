<?php

namespace App\Form;

use App\Entity\UserLanguage;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class UserLanguageType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('name', TextType::class, [
                'label' => 'form.language.name',
            ])
            ->add('level', ChoiceType::class, [
                'choices' => array_flip(UserLanguage::LEVELS),
                'label' => 'form.language.level',
            ])
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => UserLanguage::class,
            'translation_domain' => 'MyProfile',
        ]);
    }
}
