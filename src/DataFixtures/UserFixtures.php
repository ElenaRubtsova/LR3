<?php

namespace App\DataFixtures;

use App\Entity\User;
use Symfony\Component\Security\Core\Encoder\UserPasswordEncoderInterface;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;

class UserFixtures extends Fixture
{
    private $encoder;

    public function __construct(UserPasswordEncoderInterface $encoder)
    {
        $this->encoder = $encoder;
    }

    public function load(ObjectManager $manager)
    {
        // $product = new Product();
        // $manager->persist($product);

        $admin = new User();
        $admin->setEmail('admin@mail');
        $admin->setRoles(array('ROLE_ADMIN'));
        $password = $this->encoder->encodePassword($admin, 'admin');
        $admin->setPassword($password);
        $manager->persist($admin);

        $user = new User();
        $user->setEmail('user@mail');
        $password = $this->encoder->encodePassword($user, 'user');
        $user->setPassword($password);
        $manager->persist($user);

        $manager->flush();
    }
}
