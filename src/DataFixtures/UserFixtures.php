<?php

namespace App\DataFixtures;

use App\Entity\User;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;
use Symfony\Component\Security\Core\Encoder\UserPasswordEncoderInterface;

class UserFixtures extends Fixture
{
    /**
     * @var UserPasswordEncoderInterface
     */
    private $passwordEncoder;

    /**
     * @var User[]
     */
    public static $users_references;

    public function __construct(UserPasswordEncoderInterface $passwordEncoder)
    {
        $this->passwordEncoder = $passwordEncoder;
        self::$users_references = [];
    }

    public function load(ObjectManager $manager)
    {
        $users_data = [
            [
                'email' => 'first@user.com',
                'password' => 'first_user'
            ],
            [
                'email' => 'second@user.com',
                'password' => 'second_user'
            ]
        ];
        foreach ($users_data as $_user) {
            $user = new User();
            $user->setEmail($_user['email']);
            $user->setPassword($this->passwordEncoder->encodePassword(
                $user,
                $_user['password']
            ));
            $manager->persist($user);

            $ref_name = md5($_user['email']);
            $this->addReference($ref_name, $user);
            self::$users_references[] = $ref_name;
        }

        $manager->flush();
    }
}
