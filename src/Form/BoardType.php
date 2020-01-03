<?php

namespace App\Form;

use App\Entity\Advisor;
use App\Entity\Board;
use App\Repository\AdvisorRepository;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class BoardType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $options = '?';
        $builder
            ->add('advisors', EntityType::class, [
                'class' => Advisor::class,
                'choice_label' => 'id',
                'multiple' => true,
                'expanded' => true,
                'by_reference' => false
                ])
        ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => Board::class,
        ]);
    }
}
