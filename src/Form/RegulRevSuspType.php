<?php

namespace App\Form;

use App\Entity\RegulRevSusp;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\DateType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class RegulRevSuspType extends ApplicationType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('qualiteAyantDroit', ChoiceType::class,
                [
                    'choices' => [
                        'VEUVE' => 'VEUVE',
                        'VEUF' => 'VEUF',
                        'ORPHELIN' => 'ORPHELIN',
                        'ASCENDANT' => 'ASCENDANT',
                        'TUTEUR' => 'TUTEUR',
                    ],
                ])

            ->add('dateNaisDerOrph', DateType::class,
                [
                    'widget' => 'single_text',
                    'html5' => false,
                    'format' => 'dd/MM/yyyy',
                ])

            ->add('matriculeAuteur', TextType::class,
                $this->getConfiguration("Matricule de l'auteur de droit", 'Ex: 674675T'))

            ->add('dateDeces', DateType::class,
                [
                    'widget' => 'single_text',
                    'html5' => false,
                    'format' => 'dd/MM/yyyy',
                ])

            ->add('nomsAdActe', TextType::class,
                $this->getConfiguration("Nom de l'ayant droit tel que porté sur l'acte",
                'Ex: DIPANDA BOKENGUE BERTHE'))

            ->add('numActeRevers', TextType::class,
                $this->getConfiguration("Numéro de l'acte de réversion", 'Ex: 1234/MFPRA/12/DGC'))

            ->add('typeActe', ChoiceType::class, [
                'choices' => [
                    'Décret présidentiel' => 'Décret présidentiel',
                    'Arrêté ministériel' => 'Arrêté ministériel',
                    'Décision régionale' => 'Décision régionale',
                ],
            ])

            ->add('dateSignatureRev', DateType::class,
                [
                    'widget' => 'single_text',
                    'html5' => false,
                    'format' => 'dd/MM/yyyy',
                ])
        ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => RegulRevSusp::class,
        ]);
    }
}
