<?php

namespace App\Form;

use App\Entity\Reversion;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Routing\RouterInterface;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use PUGX\AutocompleterBundle\Form\Type\AutocompleteType;
use Symfony\Component\Form\Extension\Core\Type\TextType;

class SearchReversionType extends ApplicationType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('nomsAyantDroit', TextType::class,
                $this->getConfiguration("Noms de l'ayant droit", "Ex: NGOMSI NEE MAYOUNGANG MARIE MADELEINE"))
        ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => Reversion::class,
        ]);
    }
}
