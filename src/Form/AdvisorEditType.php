<?php

namespace App\Form;

use App\Entity\Advisor;
use App\Entity\Tag;
use Doctrine\ORM\EntityRepository;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class AdvisorEditType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('name', TextType::class, [
                'label' => 'Nom'
            ])
            ->add('firstname', TextType::class, [
                'label' => 'Prénom'
            ])
            ->add('email', TextType::class, [
                'label' => 'Adresse mail'
            ])
            ->add('place', TextType::class, [
                'label' => 'Ville'
            ])
            ->add('presentation', TextareaType::class, [
                'label' => 'Présentation'
            ])
            ->add('phoneNumber', TextType::class, [
                'label' => 'Numéro de téléphone'
            ])
            ->add('avaibility', TextType::class, [
                'label' => 'Disponibilité'
            ])
            ->add('linkedin', TextType::class, [
                'label' => 'Profil Linkedin'
            ])
            ->add('status', ChoiceType::class, [
                'choices' =>
                    ['En cours d\'inscription' => 0, 'En cours de validation' => 1, 'Validé' => 2, 'Suspendu' => 3]
            ])
            ->add('tags', EntityType::class, [
                'attr' => [
                    'class' => 'selectpicker',
                    'data-live-search' => 'true'
                ],
                'class' => Tag::class,
                'label' => 'Tags',
                'choice_label' => 'name',
                'multiple' => true,
                'expanded' => false,
                'by_reference' => false,
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
