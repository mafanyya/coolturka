<?php

namespace App\Controller;

use App\Entity\Child;
use App\Entity\News;
use App\Entity\User;
use App\Form\AddNewsFormType;
use App\Repository\UserRepository;
use App\Repository\ChildRepository;
use Doctrine\ORM\EntityManagerInterface;
use Doctrine\Persistence\ManagerRegistry;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\RequestStack;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class HomePageController extends AbstractController
{
    #[Route('/', name: 'home')]
    public function index( Request $request, ManagerRegistry $doctrine, EntityManagerInterface $entityManager,
                           ChildRepository $childRepository):
    Response
    {
        $news = $doctrine->getRepository(News::class)->findAll();
        $children = $doctrine->getRepository(Child::class)->findAll();




        return $this->render('root/index.html.twig', [
            'news'=> $news,
            'children' => $children,


        ]);
    }
    #[Route('/contest', name: 'contest')]
    public function contest(): Response
    {
        return $this->render('root/contest.html.twig', [
            'controller_name' => 'Contest',
        ]);
    }
    #[Route('/about', name: 'about')]
    public function about(): Response
    {
        return $this->render('root/about.html.twig', [
            'controller_name' => 'About',
        ]);
    }
}
