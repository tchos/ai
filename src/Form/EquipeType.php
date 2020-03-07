<?php

namespace App\Form;

use App\Entity\Equipe;
use App\Form\ApplicationType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class EquipeType extends ApplicationType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('libelle', TextType::class, 
            $this->getConfiguration("Libellé de l'équipe", "Equipe 1"))
            ->add('responsable', TextType::class, $this->getConfiguration("Chef de l'équipe", "NDIADAI MARTIN"))
            ->add('mission', ChoiceType::class, [
                'choices' => [
                'ADAMAOUA' => 'REGION DE L\'ADAMAOUA',
                'CENTRE' => 'REGION DU CENTRE',
                'EST' => 'REGION DE L\'EST',
                'EXTREME-NORD' => 'REGION DE L\'EXTREME-NORD',
                'LITTORAL' => 'REGION DU LITTORAL',
                'NORD' => 'REGION DU NORD',
                'NORD-OUEST' => 'REGION DU NORD-OUEST',
                'OUEST' => 'REGION DE L\'OUEST',
                'SUD-OUEST' => 'REGION DU SUD-OUEST',
                'SUD' => 'REGION DU SUD',
                'COORDINATION TECHNIQUE' => 'COORDINATION TECHNIQUE',]
            ]);
        ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => Equipe::class,
        ]);
    }
}
