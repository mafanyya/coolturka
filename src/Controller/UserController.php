<?php

namespace App\Controller;

use App\Repository\ChildRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class UserController extends AbstractController
{
    #[Route('/user', name: 'app_user')]
    public function index(ChildRepository $childRepository): Response
    {
        $user = $this->getUser();
        $id = $user->getId();
        $username = $user->getUsername();
        $lastname = $user->getLastName();
        $firstname = $user->getFirstName();
        $avatar = $user->getAvatar();

        $children = $childRepository->findChildrenByParent($id);


        return $this->render('user/index.html.twig', [
            'controller_name' => 'user',
            'username' => $username,
            'id' => $id,
            'avatar' => $avatar,
            'lastname' => $lastname,
            'firstname' => $firstname,
            'children'  => $children
        ]);
    }
}
