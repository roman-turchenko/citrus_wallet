<?php

namespace App\DataFixtures;

use App\Entity\Wallet;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\DataFixtures\DependentFixtureInterface;
use Doctrine\Persistence\ObjectManager;

class WalletFixtures extends Fixture implements DependentFixtureInterface
{
    public function load(ObjectManager $manager)
    {
        foreach (UserFixtures::$users_references as $user_reference) {
            $wallet = new Wallet();
            $wallet->setIdUser($this->getReference($user_reference));
            $wallet->setBalance(mt_rand(100, 1000));
            $wallet->setCurrency('EUR');
            $manager->persist($wallet);
        }

        $manager->flush();
    }

    public function getDependencies()
    {
        return [
            UserFixtures::class,
        ];
    }
}
