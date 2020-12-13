<?php

namespace App\Form;

use App\Entity\RegulInvClo;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\DateType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class RegulInvCloType extends ApplicationType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('numActeInval', TextType::class,
                $this->getConfiguration("Numéro de l'acte attribuant la pension d'invalidité",
                    'Ex: 14001247/AM/MINDEF/02214'))
            ->add('typeActe', ChoiceType::class, [
                'choices' => [
                    'Décret présidentiel' => 'Décret présidentiel',
                    'Arrêté ministériel' => 'Arrêté ministériel',
                    'Décision régionale' => 'Décision régionale',
                ],
            ])

            ->add('ministere', ChoiceType::class, [
                'choices' => [
                    'PRC' => 'PR',
                    'MINRA' => 'MINRA',
                    'SPM' => 'SPM',
                    'DGSN' => 'DGSN',
                    'MINREX' => 'MINREX',
                    'MINREST' => 'MINREST',
                    'MINATD' => 'MINATD',
                    'MINAT' => 'MINAT',
                    'MINJUSTICE' => 'MINJUSTICE',
                    'MINMAP' => 'MINMAP',
                    'MINDEF' => 'MINDEF',
                    'MINAC' => 'MINAC',
                    'MINEDUB' => 'MINEDUB',
                    'MINEDUC' => 'MINEDUC',
                    'MINSEP' => 'MINSEP',
                    'MINCOM' => 'MINCOM',
                    'MINESUP' => 'MINESUP',
                    'MINRESI' => 'MINRESI',
                    'MINFI' => 'MINFI',
                    'MINEFI' => 'MINEFI',
                    'MINCOMMERCE' => 'MINCOMMERCE',
                    'MINEPAT' => 'MINEPAT',
                    'MINTOUL' => 'MINTOUL',
                    'MINESEC' => 'MINESEC',
                    'MINJEC' => 'MINJEC',
                    'MINEPDED' => 'MINEPDED',
                    'MINEE' => 'MINEE',
                    'MINFOF' => 'MINFOF',
                    'MINEFOP' => 'MINEFOP',
                    'MINTP' => 'MINTP',
                    'MINHDU' => 'MINHDU',
                    'MINPMEESA' => 'MINPMEESA',
                    'MINSANTE' => 'MINSANTE',
                    'MSP' => 'MSP',
                    'MINTSS' => 'MINTSS',
                    'MINAS' => 'MINAS',
                    'MINPROFF' => 'MINPROFF',
                    'MINPOSTEL' => 'MINPOSTEL',
                    'MINT' => 'MINT',
                    'MINFOPRA' => 'MINFOPRA',
                    'MFPRA' => 'MFPRA',
                    'MFP' => 'MFP',
                    'PENSIONNES' => 'PENSIONNES',
                    'CONSUPE' => 'CONSUPE',
                    'COURSUP' => 'COURSUP',
                    'TAMPON' => 'TAMPON',
                ],
            ])

            ->add('dateSignature', DateType::class, [
                'widget' => 'single_text',
                'html5' => false,
                'format' => 'dd/MM/yyyy', ])
            ->add('nomInvActe',
                TextType::class,
                $this->getConfiguration(
                    "Noms et prénoms de l'agent invalide tel que portés sur l'acte",
                    'Ex: SAMSON MANUE'
                ))
            ->add('dateInvalidite', DateType::class, [
                'widget' => 'single_text',
                'html5' => false,
                'format' => 'dd/MM/yyyy', ])
            ->add('dateNaisDerOrph', DateType::class,
                [
                    'widget' => 'single_text',
                    'html5' => false,
                    'format' => 'dd/MM/yyyy',
                    'placeholder' => 'JJ/MM/AAAA'
                ])

            ->add('ptoPermanent_y_n', ChoiceType::class,
                [
                    'choices' => [
                        'Non' => 0,
                        'Oui' => 1,
                    ],
                    'label' => 'Pto permanente (Oui / Non) ?',
                    'expanded' => true,
                ])
        ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => RegulInvClo::class,
        ]);
    }
}
