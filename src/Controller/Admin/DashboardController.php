<?php

namespace App\Controller\Admin;

use App\Entity\Post;
use App\Entity\Tree;
use App\Entity\User;
use EasyCorp\Bundle\EasyAdminBundle\Config\Dashboard;
use EasyCorp\Bundle\EasyAdminBundle\Config\Locale;
use EasyCorp\Bundle\EasyAdminBundle\Config\MenuItem;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractDashboardController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;

class DashboardController extends AbstractDashboardController
{
    #[Route('/admin/{_locale}', name: 'admin')]
    public function index($_locale = 'fa'): Response
    {
        //return parent::index();

        // Option 1. You can make your dashboard redirect to some common page of your backend
        //
        // $adminUrlGenerator = $this->container->get(AdminUrlGenerator::class);
        // return $this->redirect($adminUrlGenerator->setController(OneOfYourCrudController::class)->generateUrl());

        // Option 2. You can make your dashboard redirect to different pages depending on the user
        //
        // if ('jane' === $this->getUser()->getUsername()) {
        //     return $this->redirect('...');
        // }

        // Option 3. You can render some custom template to display a proper dashboard with widgets, etc.
        // (tip: it's easier if your template extends from @EasyAdmin/page/content.html.twig)
        //
        return $this->render('admin/dashboard.html.twig');
    }

    public function configureDashboard(): Dashboard
    {
        return Dashboard::new()
            ->setTitle('پیشخوان')
            ->setFaviconPath('favicon/favicon.ico')
            ->setTranslationDomain('admin')
            ->renderContentMaximized()
            ->setDefaultColorScheme('dark')
            ->generateRelativeUrls()
            ->setLocales([
                'fa' => Locale::new('fa', 'فارسی', 'fa_IR'), // زبان پیش‌فرض
                'en' => Locale::new('en', 'English', 'en_US'),
            ]);
    }

    public function configureMenuItems(): iterable
    {
        return [
            MenuItem::linkToDashboard('پیشخوان', 'fa fa-home'),

            MenuItem::section('پست بلاگ'),
            MenuItem::linkToCrud('دسته بندی', 'fa fa-tags', Tree::class),
            MenuItem::linkToCrud('محتوا', 'fa fa-file-text', Post::class),

            MenuItem::section('کاربران'),
            MenuItem::linkToCrud('کاربران', 'fa fa-user', User::class),
        ];
    }

}
