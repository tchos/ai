<?php

namespace App\Form;

use App\Entity\RegulRevSusp;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class SearchReversionRegulSuspType extends ApplicationType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('nomsAyantDroit', TextType::class, $this->getConfiguration("Noms de l'ayant droit", 'Ex: KENFACK PAULINE'))
        ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => RegulRevSusp::class,
        ]);
    }
}
