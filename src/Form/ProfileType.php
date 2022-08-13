<?php

namespace App\Form;

use App\Entity\User;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\BirthdayType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\FileType;
use Symfony\Component\Form\Extension\Core\Type\IntegerType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Validator\Constraints\File;

class ProfileType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        parent::buildForm($builder, $options);

        $builder
            ->add('first_name', TextType::class, [
                'label' => 'form.main.first_name',
            ])
            ->add('last_name', TextType::class, [
                'label' => 'form.main.last_name',
            ])
            ->add('profile_image', FileType::class, [
                'label' => 'form.main.profile_image',
                'mapped' => false,
                'required' => false,
                'constraints' => [
                    new File([
                        'maxSize' => '10M',
                        'mimeTypes' => [
                            'image/jpeg',
                            'image/jpg',
                            'image/png',
                        ],
                    ]),
                ],
            ])
            ->add('background_image', FileType::class, [
                'label' => 'form.main.background_image',
                'mapped' => false,
                'required' => false,
                'constraints' => [
                    new File([
                        'maxSize' => '10M',
                        'mimeTypes' => [
                            'image/jpeg',
                            'image/jpg',
                            'image/png',
                        ],
                    ]),
                ],
            ])
            ->add('slug', TextType::class, [
                'label' => 'form.main.slug',
            ])
            ->add('gender', ChoiceType::class, [
                'choices' => [
                    'form.main.male' => 'male',
                    'form.main.female' => 'female',
                ],
                'label' => 'form.main.gender',
                'required' => false,
                'expanded' => true,
                'placeholder' => false,
            ])
            ->add('birthday', BirthdayType::class, [
                'widget' => 'single_text',
                'format' => 'yyyy-MM-dd',
                'label' => 'form.main.birthday',
                'required' => false,
            ])
            ->add('role', TextType::class, [
                'label' => 'form.main.role',
                'required' => false,
            ])
            ->add('country', TextType::class, [
                'label' => 'form.main.country',
                'required' => false,
            ])
            ->add('state', TextType::class, [
                'label' => 'form.main.state',
                'required' => false,
            ])
            ->add('city', TextType::class, [
                'label' => 'form.main.city',
                'required' => false,
            ])
            ->add('phone', IntegerType::class, [
                'label' => 'form.main.phone',
                'required' => false,
            ])
            ->add('cell', IntegerType::class, [
                'label' => 'form.main.cell',
                'required' => false,
            ])
            ->add('keyWords', TextType::class, [
                'label' => 'form.main.key_words',
                'required' => false,
            ])
            ->add('headline', TextareaType::class, [
                'label' => 'form.main.headline',
                'required' => false,
            ])
            ->add('summary', TextareaType::class, [
                'label' => 'form.main.summary',
                'required' => false,
            ])
            ->remove('current_password');
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => User::class,
        ]);
    }
}
