<?php

namespace App\Form;

use App\Entity\Client;
use App\Entity\JobOffer;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Component\Form\Extension\Core\Type\DateType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;


class JobOfferType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('reference')
            ->add('title')
            ->add('description', TextareaType::class, [
                'row_attr' => ['class' => 'text-editor', 'id' => '...'],
                'attr' => ['class' => 'tinymce'],])
            ->add('active')
            ->add('note')
            ->add('location')
            ->add('salary')
            ->add('createdAt', DateType::class, [
                'widget' => 'single_text',
                'required' => false,
            ])
            ->add('updatedAt', DateType::class, [
                'widget' => 'single_text',
                'required' => false,
            ])
            ->add('closedAt', DateType::class, [
                'widget' => 'single_text',
                'required' => false,
            ])
            ->add('jobCategory', ChoiceType::class,[
                'choices' => [
                    'Commercial' => 'Commercial',
                    'Retail sales' => 'Retail sales',
                    'Creative' => 'Creative',
                    'Technology' => 'Technology',
                    'Marketing & PR' => 'Marketing & PR',
                    'Fashion & luxury' => 'Fashion & luxury',
                    'Management & HR' => 'Management & HR'
                ],
            ])
            ->add('type', ChoiceType::class,[
                'choices' => [
                    'Fulltime' => 'Fulltime',
                    'Part time' => 'Part time',
                    'Temporary' => 'Temporary',
                    'Freelance' => 'Freelance',
                    'Seasonal' => 'Seasonal',
                ],
                ])
            ->add('client', EntityType::class,[
                'class' => Client::class,
                'choice_label' => 'company_name',
            ])
        ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => JobOffer::class,
        ]);
    }
}
