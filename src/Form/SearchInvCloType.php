<?php

namespace App\Form;

use App\Entity\RegulInvClo;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class SearchInvCloType extends ApplicationType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
        ->add('nomAgentInvalide',
            TextType::class,
            $this->getConfiguration("Noms de l'agent invalide dont un élément de salaire a été clôturé", 'Ex: KEULEU GABRIEL'))
        ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => RegulInvClo::class,
        ]);
    }
}
