<?php

namespace App\Controller;

use App\Entity\Post;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;

class PageController extends AbstractController
{
    #[Route('/page/{url}', name: 'app_page')]
    public function app_page(EntityManagerInterface $entityManagerInterface, string $url): Response
    {
        $item = $entityManagerInterface->getRepository(Post::class)->findByUrlFilterCat($url, 'plain');
        if (!$item)
            throw $this->createNotFoundException();
        return $this->render('post/page.html.twig', [
            'item' => $item,
        ]);
    }

    #[Route('/blog/{page}', name: 'app_blog_home')]
    public function app_blog_home($page = 1, EntityManagerInterface $entityManagerInterface, string $url): Response
    {
        $item = $entityManagerInterface->getRepository(Post::class)->findByUrlFilterCat($url, 'blog');
        if (!$item)
            throw $this->createNotFoundException();
        return $this->render('post/blog_home.html.twig', [
            'item' => $item,
        ]);
    }

    #[Route('/blog/post/{url}', name: 'app_blog_post')]
    public function app_blog_post(EntityManagerInterface $entityManagerInterface, string $url): Response
    {
        $item = $entityManagerInterface->getRepository(Post::class)->findByUrlFilterCat($url, 'blog');
        if (!$item)
            throw $this->createNotFoundException();
        return $this->render('post/page.html.twig', [
            'item' => $item,
        ]);
    }
}
