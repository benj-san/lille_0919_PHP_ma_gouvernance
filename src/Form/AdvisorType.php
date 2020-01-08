<?php

namespace App\Form;

use App\Entity\Advisor;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\EmailType;
use Symfony\Component\Form\Extension\Core\Type\IntegerType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\Form\FormTypeInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class AdvisorType extends AbstractType implements FormTypeInterface
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add(
                'q1',
                ChoiceType::class,
                ['label' => 'Avant de démarrer, nous vous remercions de certifier sur l\'honneur que vous avez votre pleine capacité juridique.*']
            )
            ->add(
                'firstname',
                TextType::class,
                ['label' => 'Nous allons prendre votre prénom *',
                'attr' => ['placeholder' =>'Afin de mieux vous accompagner nous avons besoin d\'en savoir un peu plus sur vous']]
            )

            ->add(
                'name',
                TextType::class,
                ['label' =>'Et votre nom de famille *']
            )
            ->add(
                'q4',
                IntegerType::class,
                ['label' =>'Sur quel numéro pouvons nous vous joindre ? * ',
                'attr' => ['placeholder' =>'Merci de préciser votre indicatif : +33 6 07 09 ...']]
            )
            ->add(
                'q5',
                EmailType::class,
                ['label' =>'Quel est votre email ? * ',
                'attr' =>['placeholder' =>'La sécurité de vos données est une priorité pour nous. Elles ne sont pas communiquées à un tiers.']]
            )
            ->add(
                'q6',
                TextareaType::class,
                ['label' =>'Merci! Pour commencer, quel est votre "pitch" en une vingtaine de mots ? *',
                'attr' =>['placeholder' =>'Racontez nous les raisons profondes qui vous amènent à cette "mission", ce que vous avez à proposer.']]
            )
            ->add(
                'q7',
                ChoiceType::class,
                ['label' =>'Avez-vous déjà eu une expérience dans un advisory board ou conseil d\'administration/de surveillance ? *']
            )

            // j'ai pris comme rep non

            ->add(
                'q8',  // ds cette question il ya plusieur choix (les tags)
                ChoiceType::class,
                ['label' =>'Quelle fonction principale occupez-vous actuellement ? *']
            )
            ->add(
                'q9',
                ChoiceType::class,
                ['label' =>'pouvez déployer rapidement ? *']
            )
            ->add(
                'q10',
                ChoiceType::class,
                ['label' =>'Choisissez-en autant que vous voulez']
            )
            ->add(
                'q11',
                ChoiceType::class,
                ['label' =>'Quels contextes avez-vous expérimenté en entreprise ? *
                           Choisissez-en autant que vous voulez']
            )
            ->add(
                'q12',
                TextareaType::class,
                ['label' =>'Pour chacun des contextes expérimentés en entreprise, pourriez-vous expliquer ce qu\'ont été vos apports, vos réalisations.']
            )
            ->add(
                'q13',
                TextareaType::class,
                ['label' =>'Quels sont vos points forts ?',
                'attr' =>['placeholder' =>'Pour vous aider à compléter cette rubrique, pensez à vos plus grandes fiertés/victoires.']]
            )
            ->add(
                'q14',
                TextareaType::class,
                ['label' =>'Quels sont vos axes de progrès ?',
                'attr' =>['placeholder' =>'Pour vous aider à compléter cette rubrique, pensez à vos plus grands flops.']]
            )
            ->add(
                'q15',
                TextareaType::class,
                ['label' =>'Quelles autres particularités souhaitez-vous mentionner ?',
                'attr' =>['placeholder' =>'Vous pouvez faire état de réalisations personnelles, de ce qui fait votre différence, de votre façon de fonctionner, ou tout autre sujet qui vous concerne et vous semble important.']]
            )
            ->add(
                'q16',
                ChoiceType::class,
                ['label' =>' Quelles sont vos disponibilités pour vous consacrer à une mission d\'administrateur ?']
            )

            //un choix a faire pr dispo

            ->add(
                'q17',
                IntegerType::class,
                ['label' =>'Quel est votre taux journalier moyen ? *']
            )
            ->add(
                'q18',
                TextareaType::class,
                ['label' =>'Avez-vous avez entendu parler de la RGPD, la nouvelle loi sur les données ? Les informations recueillies via ce formulaire sont enregistrées dans notre base de données et ne seront pas revendues à des tiers. Elles nous permettent de communiquer avec vous et vous informer sur nos activités. Elles peuvent également être utilisées en interne afin de conduire des travaux de Recherche et Développement. Ces analyses sont non nominatives et leurs résultats pourront être communiqués. Elles sont conservées pendant trois ans dans nos bases de données Mailchimp, Google et Typeform. Conformément à la loi «informatique et libertés», vous pouvez exercer votre droit d’accès aux données vous concernant et les faire rectifier en contactant : contact@magouvernance.fr *']
            )

            // la c la rep de quest è oui deja advisor
            ->add(
                'q19',
                ChoiceType::class,
                ['label' =>'Dans quel type de structure exercez-vous ou avez-vous exercé un mandat ou plusieurs mandats ? *']
            )
            ->add(
                'q20',
                ChoiceType::class,
                ['label' =>'Quel(s) statut(s) avez-vous occupé ? *',
                'attr' =>['placeholder' =>'Choisissez-en autant que vous voulez']]
            )
            ->add(
                'q21',
                ChoiceType::class,
                ['label' =>'Votre ou vos mandats sont ils toujours en cours ? *']
            )

            // 2 choix j'ai choisis oui
            ->add(
                'q22',
                TextareaType::class,
                ['label' =>'Pourriez-vous préciser les organisations dans lesquelles vous avez ou vous exercez ce(s) mandat(s) et nous dire quelles contributions majeures vous avez apporté.']
            )
            ->add(
                'q23',
                TextareaType::class,
                ['label' =>'Méthode : comment avez-vous l\'habitude de fonctionner en Conseil ou en advisory board ?']
            )
            ->add(
                'q24',
                TextareaType::class,
                ['label' =>'Que retirez-vous personnellement de l\'expérience d\'administrateur / advisor ?']
            )

            // plusieur rep
            ->add(
                'q25',
                ChoiceType::class,
                ['label' =>'Etes-vous titulaire d\'un certificat administrateur ou en cours de certification ?']
            )
            ->add(
                'q26',
                TextareaType::class,
                ['label' =>'Autre']
            )

            ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => Advisor::class,
        ]);
    }
}
