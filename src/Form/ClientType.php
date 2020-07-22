<?php

namespace App\Form;

use App\Entity\Client;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Component\Form\Extension\Core\Type\DateType;

class ClientType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('companyName')
            ->add('companyType')
            ->add('contactName')
            ->add('contactJob')
            ->add('contactEmail')
            ->add('contactPhoneNumber')
            ->add('note', TextareaType::class, [
                'row_attr' => ['class' => 'text-editor', 'id' => '...'],
                'attr' => ['class' => 'tinymce'],])
            ->add('createdAt', DateType::class, [
                'widget' => 'single_text',
                'required' => false,
            ])
            ->add('updatedAt', DateType::class, [
                'widget' => 'single_text',
                'required' => false,
            ])
        ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => Client::class,
        ]);
    }
}
