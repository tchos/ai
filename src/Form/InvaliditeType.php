<?php

namespace App\Form;

use App\Entity\Invalidite;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\DateType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;

class InvaliditeType extends ApplicationType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('numActeInval', TextType::class,
                $this->getConfiguration("Numéro de l'acte attribuant la pension d'invalidité",
                "Ex: 14001247/AM/MINDEF/02214"))
            ->add('typeActeInv', ChoiceType::class, [
                    'choices' => [
                        'Décret présidentiel' => 'Décret présidentiel',
                        'Arrêté ministériel' => 'Arrêté ministériel',
                        'Décision régionale' => 'Décision régionale'
                    ]
                ])
            ->add('dateSignatureInv', DateType::class, ['widget' => 'single_text'])
            ->add('nomsInvActe',
                TextType::class,
                $this->getConfiguration(
                    "Noms et prénoms de l'agent invalide tel que portés sur l'acte",
                    "Ex: SAMSON MANUE"
                ))
            ->add('dateInvalidite', DateType::class, ['widget' => 'single_text'])
        ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => Invalidite::class,
        ]);
    }
}
