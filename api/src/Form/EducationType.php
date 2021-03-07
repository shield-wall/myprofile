<?php

namespace App\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\DateType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class EducationType extends AbstractType
{
    /**
     * {@inheritdoc}
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('title', TextType::class, [
                'label' => 'form.education.title',
            ])
            ->add('institution', TextType::class, [
                'label' => 'form.education.institution',
            ])
            ->add('description', TextareaType::class, [
                'label' => 'form.education.description',
            ])
            ->add('period_start', DateType::class, [
                'widget' => 'single_text',
                'format' => 'yyyy-MM-dd',
                'label' => 'form.education.start_period',
            ])
            ->add('period_end', DateType::class, [
                'widget' => 'single_text',
                'format' => 'yyyy-MM-dd',
                'label' => 'form.education.end_period',
                'required' => false,
            ])
        ;
    }

    /**
     * {@inheritdoc}
     */
    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'App\Entity\Education',
            'translation_domain' => 'MyProfile',
        ));
    }

    /**
     * {@inheritdoc}
     */
    public function getBlockPrefix()
    {
        return 'App_education';
    }
}
