<?php

namespace App\Form;

use App\Entity\Demand;
use App\Entity\Tag;
use DateTime;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\DateType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;

class DemandType extends AbstractType
{



    public function buildForm(FormBuilderInterface $builder, array $options)
    {

        $builder
            ->add('client', TextType::class)
            ->add(
                'clientRequest',
                TextareaType::class,
                ['label' => 'Besoins']
            )
            ->add('tags', EntityType::class, [
                'attr' => ['class' => 'selectpicker',
                    'data-live-search' => 'true'
                    ],
                'class' => Tag::class,
                'choice_label' => 'name',
                'multiple' => true,
                'expanded' => false,
                'by_reference' => false
            ])
            ->add(
                'deadline',
                DateType::class,
                [
                    'data' => new DateTime()
                ]
            );
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => Demand::class,
        ]);
    }
}
