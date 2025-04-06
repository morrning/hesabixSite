<?php
namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;
use Symfony\Component\Security\Http\Authentication\AuthenticationUtils;

class SecurityController extends AbstractController
{
    #[Route('/hs/login', name: 'login')]
    public function login(AuthenticationUtils $authenticationUtils): Response
    {
        $error = $authenticationUtils->getLastAuthenticationError();
        $lastUsername = $authenticationUtils->getLastUsername();

        return $this->render('/admin/login.html.twig', [
            'error' => $error,
            'last_username' => $lastUsername,
            'translation_domain' => 'admin',
            'page_title' => 'ورود',
            'csrf_token_intention' => 'authenticate',
            'target_path' => $this->generateUrl('admin', ['_locale' => 'fa']),
            'username_label' => 'پست الکترونیکی',
            'password_label' => 'کلمه عبور',
            'sign_in_label' => 'ورود',
            'forgot_password_enabled' => false,
            'remember_me_enabled' => true,
            'remember_me_checked' => true,
            'remember_me_label' => 'مرا به یاد داشته باش',
        ]);
    }

    #[Route('/logout', name: 'logout')]
    public function logout(AuthenticationUtils $authenticationUtils): Response
    {
        return $this->redirectToRoute('app_home');
    }
}