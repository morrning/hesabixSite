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
    public function app_page(EntityManagerInterface $entityManagerInterface,string $url): Response
    {
        $item = $entityManagerInterface->getRepository(Post::class)->findPageByUrl(['url'=> $url]);
        if(!$item) throw $this->createNotFoundException();
        return $this->render('post/page.html.twig', [
            'item' => $item,
        ]);
    }
}
