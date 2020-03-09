<?php

namespace App\Form;

use App\Entity\Reversion;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class SearchReversionType extends ApplicationType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('nomsAyantDroit', TextType::class, 
            $this->getConfiguration("Noms de l'ayant droit", "Ex: NGOMSI NEE MAYOUNGANG MARIE MARIE"))
        ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => Reversion::class,
        ]);
    }
}
