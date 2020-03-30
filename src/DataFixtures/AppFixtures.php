<?php

namespace App\DataFixtures;

use App\Entity\Equipe;
use Faker\Factory;
use App\Entity\Role;
use App\Entity\User;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\Persistence\ObjectManager;
use Symfony\Component\Security\Core\Encoder\UserPasswordEncoderInterface;

class AppFixtures extends Fixture
{
    /** Variable créée pour encoder le mot de passe du user */
    private $encoder;

    public function __construct(UserPasswordEncoderInterface $encoder)
    {
        $this->encoder = $encoder;
    }
    
    public function load(ObjectManager $manager)
    {
        // $product = new Product();
        // $manager->persist($product);
        $faker = Factory::create("Fr-fr");

        // création du rôle d'admin
        $adminRole = new Role();
        $adminRole->setTitle('ROLE_ADMIN');
        $manager->persist($adminRole);

        $equipe = new Equipe();
        $equipe->setLibelle("Equipe 11")
               ->setResponsable("NDIADAÏ MARTIN")
               ->setMission("COORDINATION TECHNIQUE")
        ;
        $manager->persist($equipe);

        // création d'un user qui aura, en plus du rôle par défaut ('ROLE_USER'), le role d'administrateur
        $adminUser = new User();
        $adminUser->setFullName('Kwette Noumsi')
            ->setEmail('kwette@minfi.cm')
            ->setHash($this->encoder->encodePassword($adminUser, 'minfi'))
            ->addUserRole($adminRole)
            ->setEquipe($equipe)
        ;
        $manager->persist($adminUser);

        $adminUser2 = new User();
        $adminUser2->setFullName('Azemafac Romaric')
            ->setEmail('azemafac@minfi.cm')
            ->setHash($this->encoder->encodePassword($adminUser2, 'minfi'))
            ->addUserRole($adminRole)
            ->setEquipe($equipe);
        $manager->persist($adminUser2);

        $manager->flush();
    }
}
