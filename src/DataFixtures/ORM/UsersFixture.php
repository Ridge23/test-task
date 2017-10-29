<?php

namespace App\DataFixtures\ORM;

use App\Entity\User;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\Persistence\ObjectManager;

/**
 * Class UsersFixture
 *
 * @package App\DataFixtures\ORM
 */
class UsersFixture extends Fixture
{
    /**
     * @param ObjectManager $manager
     */
    public function load(ObjectManager $manager)
    {
        $user = new User();
        $user->setUsername('test_1');
        $user->setEmail('test_1@test.com');

        $encoder = $this->container->get('security.password_encoder');
        $password = $encoder->encodePassword($user, 'pass_1234');
        $user->setPassword($password);
        $this->addReference('test-user-1', $user);

        $manager->persist($user);

        $user = new User();
        $user->setUsername('test_2');
        $user->setEmail('test_2@test.com');

        $encoder = $this->container->get('security.password_encoder');
        $password = $encoder->encodePassword($user, 'pass_1234');
        $user->setPassword($password);

        $this->addReference('test-user-2', $user);
        $manager->persist($user);

        $manager->flush();
    }
}