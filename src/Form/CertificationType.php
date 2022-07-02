<?php

namespace App\Form;

use App\Entity\Certification;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\DateType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class CertificationType extends AbstractType
{
    /**
     * {@inheritdoc}
     */
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('title', TextType::class, [
                'label' => 'form.certification.title',
            ])
            ->add('institution', TextType::class, [
                'label' => 'form.certification.institution',
            ])
            ->add('periodStart', DateType::class, [
                'widget' => 'single_text',
                'format' => 'yyyy-MM-dd',
                'label' => 'form.certification.start_period',
            ])
            ->add('periodEnd', DateType::class, [
                'widget' => 'single_text',
                'format' => 'yyyy-MM-dd',
                'required' => false,
                'label' => 'form.certification.end_period',
            ])
            ->add('link', TextType::class, [
                'label' => 'form.certification.link',
                'required' => false,
            ])
            ->add('image', TextType::class, [
                'label' => 'form.certification.image_url',
                'required' => false,
            ])
        ;
    }

    /**
     * {@inheritdoc}
     */
    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Certification::class,
            'translation_domain' => 'MyProfile',
        ]);
    }
}
