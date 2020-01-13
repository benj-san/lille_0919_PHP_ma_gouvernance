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
                    'placeholder' => 'Répondez ici...'
                ]
            ])
            ->add('name', TextType::class, [
                'attr' => [
                    'placeholder' => 'Répondez ici...'
                ]
            ])
            ->add('phoneNumber', TextType::class, [
                'attr' => [
                    'placeholder' => 'Répondez ici...'
                ]
            ])
            ->add('email', TextType::class, [
                'attr' => [
                    'placeholder' => 'Répondez ici...'
                ]
            ])
            ->add('presentation', TextareaType::class, [
                'attr' => [
                    'placeholder' => 'Répondez ici...'
                ]
            ])
            ->add('gouvernanceExperience', ChoiceType::class, [
                'attr' => [
                    'class' => 'hideIt2'
                ],
                'choices' => [
                    'Oui' => 'true',
                    'Non' => 'false'
                ],
                'multiple' => 'false',
                'expanded' => 'true'
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
                    'by_reference' => false
                ])
            ->add('tags', EntityType::class, [
                'attr' => ['class' => 'selectpicker'],
                'class' => Tag::class,
                'query_builder' => function (EntityRepository $er) {
                    return $er->createQueryBuilder('t')
                        ->WHERE('t.category = 2');
                },
                'choice_label' => 'name',
                'multiple' => true,
                'expanded' => false,
                'by_reference' => false
            ])
            ->add('tags', EntityType::class, [
                'attr' => ['class' => 'selectpicker'],
                'class' => Tag::class,
                'query_builder' => function (EntityRepository $er) {
                    return $er->createQueryBuilder('t')
                        ->WHERE('t.category = 1');
                },
                'choice_label' => 'name',
                'multiple' => true,
                'expanded' => false,
                'by_reference' => false
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
            'by_reference' => false
            ])
            ->add('mandateState', ChoiceType::class, [
                'attr' => [
                    'class' => 'hideIt2'
                ],
                'choices' => [
                    'Oui' => 'true',
                    'Non' => 'false'
                ],
                'multiple' => 'false',
                'expanded' => 'true'
            ])
            ->add('mandateContribution', TextareaType::class, [
                'attr' => [
                    'placeholder' => 'Répondez ici...'
                ]
            ])
            ->add('method', TextareaType::class, [
                'attr' => [
                    'placeholder' => 'Répondez ici...'
                ]
            ])
            ->add('gain', TextareaType::class, [
                'attr' => [
                    'placeholder' => 'Répondez ici...'
                ]
            ])
            ->add('realisation', TextareaType::class, [
                'attr' => [
                    'placeholder' => 'Répondez ici...'
                ]
            ])
            ->add('topSkill', TextareaType::class, [
                'attr' => [
                    'placeholder' => 'Répondez ici...'
                ]
            ])
            ->add('progress', TextareaType::class, [
                'attr' => [
                    'placeholder' => 'Répondez ici...'
                ]
            ])
            ->add('otherSpec', TextareaType::class, [
                'attr' => [
                    'placeholder' => 'Répondez ici...'
                ]
            ])
            ->add('dailyRate', NumberType::class, [
                'attr' => [
                    'placeholder' => 'Répondez ici...'
                ]
            ])
            ->add('rgpd', ChoiceType::class, [
                'attr' => [
                    'class' => 'hideIt2'
                ],
                'choices' => [
                    'J\'accepte' => 'true',
                    'Je n\'accepte pas' => 'false'
                ],
                'multiple' => 'false',
                'expanded' => 'true'
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
