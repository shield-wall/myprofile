<?php
namespace AppBundle\Form;

use Symfony\Component\Form\{
    AbstractType,
    FormBuilderInterface
};
use Symfony\Component\Form\Extension\Core\Type\{
    EmailType,
    TextareaType,
    TextType
};
use Symfony\Component\OptionsResolver\OptionsResolver;

class ContactType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('name', TextType::class, ['required' => true])
            ->add('email', EmailType::class, ['required' => true])
            ->add('subject', TextType::class, ['required' => true])
            ->add('message', TextareaType::class, ['required' => true])
        ;
    }

    public function setDefaultOptions(OptionsResolver $optionsResolver)
    {
        $optionsResolver->setDefaults([
            'error_bubbling' => true
        ]);
    }

    public function getName()
    {
        return 'contact_form';
    }
}