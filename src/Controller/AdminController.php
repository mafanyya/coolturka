<?php

namespace App\Controller;

use App\Entity\News;
use App\Form\AddNewsFormType;
use App\Repository\NewsRepository;
use Doctrine\ORM\EntityManagerInterface;
use Doctrine\Persistence\ManagerRegistry;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class AdminController extends AbstractController
{

    private $newsRepository;


    public function __construct(NewsRepository $newsRepository)
    {
        $this->newsRepository = $newsRepository;

    }

    #[Route('/admin', name: 'admin_panel')]
    public function index(): Response
    {
        return $this->render('admin/index.html.twig', [

        ]);
    }


    #[Route('/add-news', name: 'add_news')]
    public function add_news(Request $request, ManagerRegistry $doctrine, EntityManagerInterface $entityManager): Response
    {
        $newArticle = new News();
        $form = $this->createForm(AddNewsFormType::class, $newArticle);
        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()) {

            $newArticle = $form->getData();
            $entityManager->persist($newArticle);
            $entityManager->flush();

            return $this->redirectToRoute('add_news');
        }
        return $this->render('admin/addNews.html.twig', [
            'form' => $form->createView()

        ]);
    }

    #[Route('/remove-news', name: 'remove_news')]
    public function remove_news(NewsRepository $newsRepository): Response
    {
        $news = $newsRepository->findAll();

        return $this->render('admin/removeNews.html.twig', [
            'news' => $news

        ]);
    }

    #[Route('/remove-news/{id}', name: 'remove-news/{id}')]
    public function remove_news_id($id): Response
    {
        $news = $this->newsRepository->find($id);

        $this->newsRepository->remove($news);

        return $this->redirectToRoute('remove_news');
    }

}
