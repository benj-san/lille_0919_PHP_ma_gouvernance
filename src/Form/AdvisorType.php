<?php

namespace App\Form;

use App\Entity\Advisor;
use App\Entity\Tag;
use Doctrine\ORM\EntityRepository;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\CheckboxType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\NumberType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class AdvisorType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('firstname', TextType::class, [
                'attr' => [
                    'placeholder' => 'Répondez ici...',
                ],
                'required'   => false,
            ])
            ->add('name', TextType::class, [
                'attr' => [
                    'placeholder' => 'Répondez ici...',
                ],
                'required'   => false,
            ])
            ->add('place', TextType::class, [
                'attr' => [
                    'placeholder' => 'Répondez ici...',
                ],
                'required'   => false,
            ])
            ->add('phoneNumber', TextType::class, [
                'attr' => [
                    'placeholder' => 'Répondez ici...',
                ],
                'required'   => false,
            ])
            ->add('email', TextType::class, [
                'attr' => [
                    'placeholder' => 'Répondez ici...',
                ],
                'required'   => false,
            ])
            ->add('presentation', TextareaType::class, [
                'attr' => [
                    'placeholder' => 'Répondez ici...'
                ],
                'required'   => false,
            ])
            ->add('gouvernanceExperience', CheckboxType::class, [
                'attr' => [
                    'class' => 'hideIt2'
                ],
                'required'   => false,
                ])
            ->add('tags', EntityType::class, [
                    'attr' => ['class' => 'selectpicker'],
                    'class' => Tag::class,
                    'query_builder' => function (EntityRepository $er) {
                        return $er->createQueryBuilder('t')
                            ->WHERE('t.category = 6');
                    },
                    'choice_label' => 'name',
                    'multiple' => true,
                    'expanded' => false,
                    'by_reference' => false,
                    'required'   => false,
                ])
            ->add('tagsStatut', EntityType::class, [
                'attr' => ['class' => 'selectpicker'],
                'class' => Tag::class,
                'query_builder' => function (EntityRepository $er) {
                    return $er->createQueryBuilder('t')
                        ->WHERE('t.category = 2');
                },
                'choice_label' => 'name',
                'multiple' => true,
                'expanded' => false,
                'by_reference' => false,
                'required'   => false,
            ])
            ->add('tagsCertificate', EntityType::class, [
                'attr' => ['class' => 'selectpicker'],
                'class' => Tag::class,
                'query_builder' => function (EntityRepository $er) {
                    return $er->createQueryBuilder('t')
                        ->WHERE('t.category = 5');
                },
                'choice_label' => 'name',
                'multiple' => true,
                'expanded' => false,
                'by_reference' => false,
                'required'   => false,
            ])
            ->add('tagsActualFunction', EntityType::class, [
            'attr' => ['class' => 'selectpicker'],
            'class' => Tag::class,
            'query_builder' => function (EntityRepository $er) {
                return $er->createQueryBuilder('t')
                    ->WHERE('t.category = 4');
            },
            'choice_label' => 'name',
            'multiple' => true,
            'expanded' => false,
            'by_reference' => false,
            'required'   => false,
            ])
            ->add('tagsCompetences', EntityType::class, [
                'attr' => ['class' => 'selectpicker'],
                'class' => Tag::class,
                'query_builder' => function (EntityRepository $er) {
                    return $er->createQueryBuilder('t')
                        ->WHERE('t.category = 2');
                },
                'choice_label' => 'name',
                'multiple' => true,
                'expanded' => false,
                'by_reference' => false,
                'required'   => false,
            ])
            ->add('tagsExpertises', EntityType::class, [
                'attr' => ['class' => 'selectpicker'],
                'class' => Tag::class,
                'query_builder' => function (EntityRepository $er) {
                    return $er->createQueryBuilder('t')
                        ->WHERE('t.category = 1');
                },
                'choice_label' => 'name',
                'multiple' => true,
                'expanded' => false,
                'by_reference' => false,
                'required'   => false,
            ])
            ->add('tagsContexts', EntityType::class, [
                'attr' => ['class' => 'selectpicker'],
                'class' => Tag::class,
                'query_builder' => function (EntityRepository $er) {
                    return $er->createQueryBuilder('t')
                        ->WHERE('t.category = 3');
                },
                'choice_label' => 'name',
                'multiple' => true,
                'expanded' => false,
                'by_reference' => false,
                'required'   => false,
            ])
            ->add('mandateState', CheckboxType::class, [
                'attr' => [
                    'class' => 'hideIt2'
                ],
                'required'   => false,
            ])
            ->add('mandateContribution', TextareaType::class, [
                'attr' => [
                    'placeholder' => 'Répondez ici...'
                ],
                'required'   => false,
            ])
            ->add('method', TextareaType::class, [
                'attr' => [
                    'placeholder' => 'Répondez ici...'
                ],
                'required'   => false,
            ])
            ->add('gain', TextareaType::class, [
                'attr' => [
                    'placeholder' => 'Répondez ici...'
                ],
                'required'   => false,
            ])
            ->add('realisation', TextareaType::class, [
                'attr' => [
                    'placeholder' => 'Répondez ici...'
                ],
                'required'   => false,
            ])
            ->add('topSkill', TextareaType::class, [
                'attr' => [
                    'placeholder' => 'Répondez ici...'
                ],
                'required'   => false,
            ])
            ->add('progress', TextareaType::class, [
                'attr' => [
                    'placeholder' => 'Répondez ici...'
                ],
                'required'   => false,
            ])
            ->add('otherSpec', TextareaType::class, [
                'attr' => [
                    'placeholder' => 'Répondez ici...'
                ],
                'required'   => false,
            ])
            ->add('dailyRate', NumberType::class, [
                'attr' => [
                    'placeholder' => 'Répondez ici...'
                ],
                'required'   => false,
            ])
            ->add('rgpd', CheckboxType::class, [
                'attr' => [
                    'class' => 'hideIt2'
                ],
                'required'   => false,
            ])
            ->add('linkedin', TextType::class, [
                'attr' => [
                    'placeholder' => 'Répondez ici...',
                ],
                'required'   => false,
                    ])
            ->add('idealMission', TextareaType::class, [
                'attr' => [
                    'placeholder' => 'Répondez ici...'
                ],
                'required'   => false,
            ])
            ->add('avaibility', TextareaType::class, [
                'attr' => [
                    'placeholder' => 'Répondez ici...'
                ],
                'required'   => false,
            ])
                ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => Advisor::class,
        ]);
    }
}
