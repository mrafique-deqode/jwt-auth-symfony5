<?php

namespace App\Controller;

use App\Entity\Post;
use App\Repository\PostRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Doctrine\ORM\EntityManagerInterface;
use Knp\Component\Pager\PaginatorInterface;

class ListController extends AbstractController
{
    /**
     * @Route("/list", name="list")
     */

    public function index(Request $request, PostRepository $postRepository, PaginatorInterface $paginator): Response
    {
        $records = $postRepository->findAll();
        $records = $paginator->paginate(
            $records,
            $request->query->getInt('page', 1),
            5
        );
        return $this->render('list/index.html.twig', [
            'records' => $records
        ]);
    }

    /**
     * @Route("/list/detail/{id}", name="app_list_show", methods={"GET"})
     */
    public function show(Post $records): Response
    {
        return $this->render('list/detail.html.twig', [
            'records' => $records,
        ]);
    }
}