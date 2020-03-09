<?php

namespace App\Form;

use App\Entity\Invalidite;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\TextType;

class SearchInvaliditeType extends ApplicationType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('nomAgentInvalide',
            TextType::class,
            $this->getConfiguration("Noms de l'ayant droit", "Ex: ABANDA OLIVIER SYLVESTRE"))
        ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => Invalidite::class,
        ]);
    }
}
