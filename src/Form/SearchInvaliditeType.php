<?php

namespace App\Form;

use App\Entity\Invalidite;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class SearchInvaliditeType extends ApplicationType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('nomAgentInvalide',
            TextType::class,
            $this->getConfiguration("Noms de l'agent invalide", 'Ex: ABANDA OLIVIER SYLVESTRE'))
        ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => Invalidite::class,
        ]);
    }
}
