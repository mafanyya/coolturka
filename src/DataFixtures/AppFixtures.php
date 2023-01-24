<?php

namespace App\DataFixtures;

use App\Entity\News;
use App\Entity\User;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;
use Symfony\Component\PasswordHasher\Hasher\UserPasswordHasherInterface;

class AppFixtures extends Fixture
{
    private UserPasswordHasherInterface $passwordHasher;

    public function __construct(UserPasswordHasherInterface $passwordHasher)
    {
        $this->passwordHasher = $passwordHasher;
    }

    public function load(ObjectManager $manager): void
    {
        $admin = new User();
        $admin->setUsername('admin');
        $admin->setFirstName('Janusz');
        $admin->setLastName('Januszowicz');
        $admin->setAvatar('https://faces-img.xcdn.link/image-lorem-face-491.jpg');
        $admin->setRoles(['ROLE_ADMIN']);
        $admin->setPassword($this->passwordHasher->hashPassword($admin, 'admin'));
        $manager->persist($admin);

        $user1 = new User();
        $user1->setUsername('hero');
        $user1->setFirstName('Frank');
        $user1->setLastName('Kowalski');
        $user1->setAvatar('https://faces-img.xcdn.link/image-lorem-face-1420.jpg');
        $user1->setRoles(['ROLE_USER']);
        $user1->setPassword($this->passwordHasher->hashPassword($user1, 'hero'));
        $manager->persist($user1);


        $article1 = new News();
        $article1->setTitle('Kupiliśmy chlebek');
        $article1->setContent('Aliquam laoreet dignissim metus, quis fringilla est consequat non. In metus neque,
         volutpat auctor metus vitae, sollicitudin iaculis velit. Cras elementum mattis quam ut ultrices. ');
        $manager->persist($article1);
        $manager->flush();
    }
}
