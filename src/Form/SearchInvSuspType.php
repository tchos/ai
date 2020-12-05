<?php

namespace App\Form;

use App\Entity\RegulInvSusp;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class SearchInvSuspType extends ApplicationType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('nomAgentInvalide',
            TextType::class,
            $this->getConfiguration("Noms de l'agent invalide qui été suspendu", 'Ex: SALWADA ANDRE'))
        ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => RegulInvSusp::class,
        ]);
    }
}
