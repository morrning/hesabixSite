<?php

namespace App\Controller;

use App\Entity\Cat;
use App\Entity\Post;
use App\Entity\Tree;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;
use Symfony\Component\HttpFoundation\Request;


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

    #[Route('/blog/{page}', name: 'app_blog_home', defaults: ['page' => 1])]
    public function app_blog_home(EntityManagerInterface $entityManagerInterface, Request $request, $page = 1): Response
    {
        $perpage = 9;
        $search = $request->query->get('search', ''); // پارامتر جستجو از URL

        $postRepository = $entityManagerInterface->getRepository(Post::class);
        $catRepository = $entityManagerInterface->getRepository(Cat::class);

        // پیدا کردن دسته‌بندی "blog"
        $cat = $catRepository->findOneBy(['code' => 'blog']);

        // گرفتن پست‌ها با فیلتر جستجو
        $queryBuilder = $postRepository->createQueryBuilder('p')
            ->where('p.cat = :cat')
            ->setParameter('cat', $cat)
            ->orderBy('p.dateSubmit', 'DESC'); // مرتب‌سازی بر اساس جدیدترین

        if ($search) {
            $queryBuilder->andWhere('p.title LIKE :search OR p.intro LIKE :search')
                         ->setParameter('search', "%$search%");
        }

        $count = count($queryBuilder->getQuery()->getResult());
        $maxpages = ceil($count / $perpage); // محاسبه حداکثر صفحات

        $posts = $queryBuilder->setMaxResults($perpage)
                              ->setFirstResult(($page - 1) * $perpage)
                              ->getQuery()
                              ->getResult();

        // گرفتن همه دسته‌بندی‌ها برای سایدبار
        $categories = $catRepository->findAll();

        return $this->render('post/blog_home.html.twig', [
            'posts' => $posts,
            'page' => $page,
            'perpage' => $perpage,
            'count' => $count,
            'maxpages' => $maxpages,
            'categories' => $categories,
            'search' => $search,
        ]);
    }

    #[Route('/blog/post/{url}', name: 'app_blog_post')]
    public function app_blog_post(EntityManagerInterface $entityManagerInterface, string $url): Response
    {
        $item = $entityManagerInterface->getRepository(Post::class)->findByUrlFilterCat($url, 'blog');
        if (!$item)
            throw $this->createNotFoundException();
        if (!$item->getViews())
            $item->setViews(1);
        else
            $item->setViews($item->getViews() + 1);
        $entityManagerInterface->persist($item);

        return $this->render('post/blog_post.html.twig', [
            'item' => $item,
            'posts' => $entityManagerInterface->getRepository(Post::class)->findByCat('blog',3),
        ]);
    }

    #[Route('/api_docs/{url}', name: 'app_api_docs')]
    public function app_api_docs(EntityManagerInterface $entityManagerInterface, string $url='home'): Response
    {
        $item = $entityManagerInterface->getRepository(Post::class)->findByUrlFilterCat($url, 'api');
        if (!$item)
            throw $this->createNotFoundException();

        //get list of trees
        $tress = $entityManagerInterface->getRepository(Tree::class)->findAllByCat('api');
        return $this->render('post/api_docs.html.twig', [
            'item' => $item,
            'trees' => $tress,
        ]);
    }

    #[Route('/guide/{url}', name: 'app_guide')]
    public function app_guide(EntityManagerInterface $entityManagerInterface, string $url='home'): Response
    {
        $item = $entityManagerInterface->getRepository(Post::class)->findByUrlFilterCat($url, 'guide');
        if (!$item)
            throw $this->createNotFoundException();

        //get list of trees
        $tress = $entityManagerInterface->getRepository(Tree::class)->findAllByCat('guide');
        return $this->render('post/guide.html.twig', [
            'item' => $item,
            'trees' => $tress,
        ]);
    }

    #[Route('/changes', name: 'app_changes')]
    public function app_changes(EntityManagerInterface $entityManagerInterface): Response
    {
        $posts = $entityManagerInterface->getRepository(Post::class)->findAllByCat('changelog');
        return $this->render('post/versions.html.twig', [
            'items' => $posts,
        ]);
    }
}
