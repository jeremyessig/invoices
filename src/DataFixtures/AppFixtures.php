<?php

namespace App\DataFixtures;

use App\Entity\AccountingCategory;
use App\Entity\AccountingTag;
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
        $this->getAccountingCategories($manager);
        $this->getAccountingTags($manager);

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

    public function getAccountingCategories(ObjectManager $manager): void
    {
        $categories = ['Assurances', 'Alimentation', 'Electricité', 'Divers'];

        foreach ($categories as $category) {
            $accountingCategory = new AccountingCategory;
            $accountingCategory->setLabel($category);
            $manager->persist($accountingCategory);
        }
    }

    public function getAccountingTags(ObjectManager $manager): void
    {
        $tags = ['LCL', 'HSBC', 'Liquide', 'Crédit Mutuel', 'Divers'];

        foreach ($tags as $tag) {
            $accountingTag = new AccountingTag;
            $accountingTag->setLabel($tag);
            $manager->persist($accountingTag);
        }
    }
}
