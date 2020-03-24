<?php
namespace App\Form;

use App\Entity\User;
use FOS\UserBundle\Form\Type\ProfileFormType;
use Symfony\Component\Form\Extension\Core\Type\{
    CollectionType, FileType, IntegerType, NumberType, TextareaType, TextType
};
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Validator\Constraints\File;

class ProfileType extends RegistrationType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        parent::buildForm($builder, $options);

        $builder
            ->add('profile_image', FileType::class, [
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
                    ])
                ],
            ])
            ->add('background_image', FileType::class, [
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
                    ])
                ],
            ])
            ->add('role', TextType::class, [
                'required' => false,
            ])
            ->add('headline', TextareaType::class, [
                'required' => false,
            ])
            ->add('country', TextType::class, [
                'required' => false,
            ])
            ->add('state', TextType::class, [
                'required' => false,
            ])
            ->add('city', TextType::class, [
                'required' => false,
            ])
            ->add('phone', IntegerType::class, [
                'required' => false,
            ])
            ->add('cell', IntegerType::class, [
                'required' => false,
            ])
            ->add('keyWords', TextType::class, [
                'required' => false,
            ])
            ->add('summary', TextareaType::class, [
                'required' => false,
                'attr' => [
                    'rows' => 5
                ],
            ])
            ->remove('current_password')
        ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => User::class,
        ]);
    }

    public function getParent()
    {
        return ProfileFormType::class;
    }

    public function getBlockPrefix()
    {
        return 'app_user_profile';
    }
}