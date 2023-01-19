<?php

namespace App\Controller;

use App\Entity\News;
use Doctrine\Persistence\ManagerRegistry;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class NewsController extends AbstractController
{
    #[Route('/create-news', name: 'create-news')]
    public function index(ManagerRegistry $doctrine): Response
    {
        $entityManager = $doctrine->getManager();

        $news = new News();
        $news->setTitle('Coś ważnego się wydarzyło');
        $news->setContent('To bardzo ważne wydarzenie, ');
        $entityManager->persist($news);

        $news2 = new News();
        $news2->setTitle('Coś ważnego się wydarzyło');
        $news2->setContent('To bardzo ważne wydarzenie, ');
        $entityManager->persist($news2);



        $entityManager->flush();

        return new Response('Saved new news');
    }
}
