<?php

namespace App\DataFixtures;

use App\Entity\Post;
use App\Entity\User;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\Persistence\ObjectManager;

class AppFixtures extends Fixture
{
    public function load(ObjectManager $manager)
    {
        $user1 = new User();

        $user1
            ->setName('User 1')
            ->setAvatar('avatar_user1.jpg')
        ;

        $manager->persist($user1);

        $user2 = new User();

        $user2
            ->setName('User 2')
            ->setAvatar('avatar_user2.jpg')
        ;

        $manager->persist($user2);

        $post1 = new Post();
        $post1
            ->setTitle('Post 1')
            ->addLike($user1)
            ;
        $manager->persist($post1);

        $post2 = new Post();
        $post2
            ->setTitle('Post 2')
            ->addLike($user1)
            ->addLike($user2)
        ;
        $manager->persist($post2);

        $manager->flush();
    }
}
