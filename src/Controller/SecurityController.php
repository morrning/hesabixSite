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

        return $this->render('@EasyAdmin/page/login.html.twig', [
            // parameters usually defined in Symfony login forms
            'error' => $error,
            'last_username' => $lastUsername,

            // OPTIONAL parameters to customize the login form:

            // the translation_domain to use (define this option only if you are
// rendering the login template in a regular Symfony controller; when
// rendering it from an EasyAdmin Dashboard this is automatically set to
// the same domain as the rest of the Dashboard)
            'translation_domain' => 'admin',

            // by default EasyAdmin displays a black square as its default favicon;
// use this method to display a custom favicon: the given path is passed
// "as is" to the Twig asset() function:
//

            // the title visible above the login form (define this option only if you are
// rendering the login template in a regular Symfony controller; when rendering
// it from an EasyAdmin Dashboard this is automatically set as the Dashboard title)
            'page_title' => 'ورود',

            // the string used to generate the CSRF token. If you don't define
// this parameter, the login form won't include a CSRF token
            'csrf_token_intention' => 'authenticate',

            // the URL users are redirected to after the login (default: '/admin')
            'target_path' => $this->generateUrl('admin'),

            // the label displayed for the username form field (the |trans filter is applied to it)
            'username_label' => 'پست الکترونیکی',

            // the label displayed for the password form field (the |trans filter is applied to it)
            'password_label' => 'کلمه عبور',

            // the label displayed for the Sign In form button (the |trans filter is applied to it)
            'sign_in_label' => 'ورود',

            // whether to enable or not the "forgot password?" link (default: false)
            'forgot_password_enabled' => false,

            // whether to enable or not the "remember me" checkbox (default: false)
            'remember_me_enabled' => true,

            // whether to check by default the "remember me" checkbox (default: false)
            'remember_me_checked' => true,

            // the label displayed for the remember me checkbox (the |trans filter is applied to it)
            'remember_me_label' => 'مرا به یاد داشته باش',
        ]);
    }

    #[Route('/logout', name: 'logout')]
    public function logout(AuthenticationUtils $authenticationUtils): Response
    {
        return $this->redirectToRoute('app_home');
    }
}