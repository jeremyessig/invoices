<?php

namespace App\DataFixtures;

use App\Entity\User;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;
use Symfony\Component\PasswordHasher\Hasher\UserPasswordHasherInterface;

class AppFixtures extends Fixture
{

    public function __construct(
        private UserPasswordHasherInterface $passwordHasher
    ) {
    }

    public function load(ObjectManager $manager): void
    {
        // $product = new Product();
        // $manager->persist($product);

        $this->getAdmin($manager);

        $manager->flush();
    }

    public function getAdmin(ObjectManager $manager): void
    {
        $admin = new User;

        $admin->setEmail('admin@test.test');
        $admin->setPassword($this->passwordHasher->hashPassword($admin, '1234'));
        $admin->setRoles(["ROLE_USER", "ROLE_ADMIN"]);

        $manager->persist($admin);
    }
}
