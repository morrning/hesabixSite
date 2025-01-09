<?php

namespace App\Controller;

use App\Entity\Post;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;

class GeneralController extends AbstractController
{
    #[Route('/', name: 'app_home')]
    public function app_home(EntityManagerInterface $em): Response
    {
        return $this->render('general/home.html.twig', [
            'posts' => $em->getRepository(Post::class)->findBycat('blog', 3)
        ]);
    }

    #[Route('/sitemap.xml', name: 'app_sitemap')]
    public function app_sitemap(EntityManagerInterface $em): Response
    {
        $response = new Response();
        $response->headers->set('Content-Type', 'text/xml');
        $posts = $em->getRepository(Post::class)->findAll();
        return $this->render('general/sitemap.html.twig', [
            'posts' => $posts
        ], $response);
    }
}
