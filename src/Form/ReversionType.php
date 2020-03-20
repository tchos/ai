<?php

namespace App\Form;

use App\Entity\Reversion;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\DateType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class ReversionType extends ApplicationType
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
                        'ASCENDANT' => 'ASCENDANT'
                    ]
                ])
            ->add('dateNaisDerOrph', DateType::class, [
                'widget' => 'single_text',
                'html5' => false,
                'format' => 'dd/MM/yyyy'])
            ->add('nomsAuteur', TextType::class,
                $this->getConfiguration("Nom de l'auteur de droit",
                    "Ex: DIPANDA BOKENGUE BERTHE"))
            ->add('matriculeAuteur', TextType::class, 
                $this->getConfiguration("Matricule de l'auteur de droit", "Ex: 674675T"))
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
                    'TAMPON' => 'TAMPON'
                ]
            ])
            ->add('dateDeces', DateType::class, [
                'widget' => 'single_text',
                'html5' => false,
                'format' => 'dd/MM/yyyy'])
            ->add('nomsAdActe', TextType::class,
                $this->getConfiguration( "Nom de l'ayant droit tel que porté sur l'acte",
                "Ex: DIPANDA BOKENGUE BERTHE"))
            ->add('numActeRevers', TextType::class,
                $this->getConfiguration("Numéro de l'acte de réversion","Ex: 1234/MFPRA/12/DGC"))
            ->add('typeActe', ChoiceType::class, [
                'choices' => [
                    'Décret présidentiel' => 'Décret présidentiel',
                    'Arrêté ministériel' => 'Arrêté ministériel',
                    'Décision régionale' => 'Décision régionale'
                ]
            ])
            ->add('dateSignatureRev', DateType::class, [
                'widget' => 'single_text',
                'html5' => false,
                'format' => 'dd/MM/yyyy'])
        ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => Reversion::class,
        ]);
    }
}
