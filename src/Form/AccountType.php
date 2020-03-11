<?php

namespace App\Form;

use App\Entity\Equipe;
use App\Entity\User;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\EmailType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\TextType;

class AccountType extends ApplicationType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('fullName', TextType::class, 
                $this->getConfiguration("Noms et prénoms", "Ex: GODLOVE MELCHISEDEC"))
            ->add('email', EmailType::class,
                $this->getConfiguration("Adresse email","Ex: godmelchisedec@minfi.cm"))
            ->add('equipe', EntityType::class, [
                'class' => Equipe::class,
                'choice_label' => 'libelle'
            ])
        ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => User::class,
        ]);
    }
}
