<?php

namespace App\DataFixtures;

use App\Entity\Child;
use App\Entity\News;
use App\Entity\Presence;
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

        $child = new Child();
        $child->setLastname('Kowalski');
        $child->setFirstname('Mariusz');
        $child->setGrupa(1);
        $child->setParent($user1);
        $manager->persist($child);

        $child2 = new Child();
        $child2->setLastname('Kowalski');
        $child2->setFirstname('Janusz');
        $child2->setGrupa(1);
        $child2->setParent($user1);
        $manager->persist($child2);

        $child3 = new Child();
        $child3->setLastname('Kowalska');
        $child3->setFirstname('Zosia');
        $child3->setGrupa(1);
        $child3->setParent($user1);
        $manager->persist($child3);

        $child4 = new Child();
        $child4->setLastname('Kowalski');
        $child4->setFirstname('Marcin');
        $child4->setGrupa(1);
        $child4->setParent($user1);
        $manager->persist($child);



        $article1 = new News();
        $article1->setTitle('Ferie 2023-Warsztaty edukacyjne');
        $article1->setContent('Szanowni Państwo
Jak co roku przygotowujemy zimowe warsztaty edukacyjne a w czasie ich trwania ciekawostki techniczne dla dzieci i młodzieży w wieku od 7( pierwsza klasa SP) do 12lat.
W tym roku szykujemy mix nowoczesnych technologii i survivalu.');
        $manager->persist($article1);
        $manager->flush();
    }
}

////php bin/console doctrine:fixtures:load