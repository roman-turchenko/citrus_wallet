<?php

namespace App\DataFixtures;

use App\Entity\User;
use Symfony\Component\Security\Core\Encoder\UserPasswordEncoderInterface;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;

class UserFixtures extends Fixture
{
    private $passwordEncoder;

    public function __construct(UserPasswordEncoderInterface $passwordEncoder)
    {
        $this->passwordEncoder = $passwordEncoder;
    }

    public function load(ObjectManager $manager)
    {
        // $product = new Product();
        // $manager->persist($product);

        $user = new User();
        $user->setEmail('first@user.com');
        $user->setPassword($this->passwordEncoder->encodePassword(
            $user,
            'first_user'
        ));
        $manager->persist($user);

        $user = new User();
        $user->setEmail('second@user.com');
        $user->setPassword($this->passwordEncoder->encodePassword(
            $user,
            'second_user'
        ));

        $manager->persist($user);

        $manager->flush();
    }
}
