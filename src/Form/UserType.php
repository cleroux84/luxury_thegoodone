<?php

namespace App\Form;

use App\Entity\User;
use App\Entity\JobCategory;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\DateType;
use Symfony\Component\Validator\Constraints\File;
use Symfony\Component\Form\Extension\Core\Type\FileType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;

class UserType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('email')
            ->add('password')
            ->add('gender', ChoiceType::class, [
                'choices' => [
                    'Male' => 'Male',
                    'Female' => 'Female',
                    'Transgender' => 'Transgender',
            ],        
            ])
            ->add('firstName')
            ->add('lastName')
            ->add('phoneNumber')
            ->add('profilePicture', FileType::class, [
                'label' => 'Picture (PDF file)',

                // unmapped means that this field is not associated to any entity property
                'mapped' => false,

                // make it optional so you don't have to re-upload the PDF file
                // every time you edit the Product details
                'required' => false,

                // unmapped fields can't define their validation using annotations
                // in the associated entity, so you can use the PHP constraint classes
                'constraints' => [
                    new File([
                        'maxSize' => '1024k',
                        'mimeTypes' => [
                            'application/pdf',
                            'application/x-pdf',
                        ],
                        'mimeTypesMessage' => 'Please upload a valid PDF document',
                    ])
                ],
            ])

            ->add('currentLocation')
            ->add('address')
            ->add('country')
            ->add('nationality')
            ->add('birthDate', DateType::class, [
                'widget' => 'single_text',
            ])
            ->add('birthPlace')
            ->add('passport', FileType::class, [
                'label' => 'Passport (PDF file)',

                // unmapped means that this field is not associated to any entity property
                'mapped' => false,

                // make it optional so you don't have to re-upload the PDF file
                // every time you edit the Product details
                'required' => false,

                // unmapped fields can't define their validation using annotations
                // in the associated entity, so you can use the PHP constraint classes
                'constraints' => [
                    new File([
                        'maxSize' => '1024k',
                        'mimeTypes' => [
                            'application/pdf',
                            'application/x-pdf',
                        ],
                        'mimeTypesMessage' => 'Please upload a valid PDF document',
                    ])
                ],
            ])
            ->add('resume', FileType::class, [
                'label' => 'CV (PDF file)',

                // unmapped means that this field is not associated to any entity property
                'mapped' => false,

                // make it optional so you don't have to re-upload the PDF file
                // every time you edit the Product details
                'required' => false,

                // unmapped fields can't define their validation using annotations
                // in the associated entity, so you can use the PHP constraint classes
                'constraints' => [
                    new File([
                        'maxSize' => '1024k',
                        'mimeTypes' => [
                            'application/pdf',
                            'application/x-pdf',
                        ],
                        'mimeTypesMessage' => 'Please upload a valid PDF document',
                    ])
                ],
            ])
            ->add('experience', ChoiceType::class, [
                'choices' => [
                    '0 - 6 months' => '0 - 6 months',
                    '6 months - 1 year' => '6 months - 1 year',
                    '1 - 2 years' => '1 - 2 years',
                    '2+ years' => '2+ years',
                    '5+ years' => '5+ years',
                    '10+ yeards' => '10+ yeards',
            ],        
            ])
            ->add('description', TextareaType::class, [
                'row_attr' => ['class' => 'text-editor', 'id' => '...'],
                'attr' => ['class' => 'tinymce'],])
            ->add('note')
            ->add('createdAt', DateType::class, [
                'widget' => 'single_text',
                'required' => false,
            ])
            ->add('updatedAt', DateType::class, [
                'widget' => 'single_text',
                'required' => false,
            ])
            ->add('isAdmin')
            ->add('availability')
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
        ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => User::class,
        ]);
    }
}