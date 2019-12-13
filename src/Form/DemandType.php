<?php

namespace App\Form;

use App\Entity\Demand;
use App\Entity\Tag;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;

class DemandType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {

        $options = '?';
        $builder
            ->add('client')
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
                'choice_label' => 'category',
                'multiple' => true,
                'expanded' => false,
                'by_reference' => false
            ]);
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => Demand::class,
        ]);
    }
}
