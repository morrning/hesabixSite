<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;

class RedirectController extends AbstractController
{
    #[Route('/front/{url}', name: 'app_redirect_front')]
    public function app_redirect_front($url): Response
    {
        return $this->redirectToRoute('app_page', ['url' => $url]);
    }

    #[Route('/login', name: 'app_redirect_login')]
    public function app_redirect_login(): Response
    {
        return $this->redirect("https://app.hesabix.ir");
    }

    #[Route('/st/{params}', name: 'app_redirect_store', requirements: ['params' => '.+'])]
    public function app_redirect_store($params): Response
    {
        return $this->redirect("https://api.hesabix.ir/st/" . $params);
    }

    #[Route('/sl/{params}', name: 'app_redirect_sell', requirements: ['params' => '.+'])]
    public function app_redirect_sell($params): Response
    {
        return $this->redirect("https://api.hesabix.ir/sl/" . $params);
    }

    #[Route('/p/rep/{params}', name: 'app_redirect_repservice', requirements: ['params' => '.+'])]
    public function app_redirect_repservice($params): Response
    {
        return $this->redirect("https://api.hesabix.ir/p/rep/" . $params);
    }
}
