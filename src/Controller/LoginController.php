<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;
use Symfony\Component\Security\Http\Authentication\AuthenticationUtils;

final class LoginController extends AbstractController
{
	#[Route('/login', name: 'app_login')]
 	public function index(AuthenticationUtils $authenticationUtils): Response
    {
		// Get login error if there is one
        $error = $authenticationUtils->getLastAuthenticationError();

		// Last username entered by the user (email in that case)
        $lastUsername = $authenticationUtils->getLastUsername();

		return $this->render('login/index.html.twig', [
			'last_username' => $lastUsername,
			'error' => $error,
		]);
    }
	#[Route('/logout', name: 'app_logout')]
	public function logout()
	{
		$lastUsername = '';
		$error = '';
		// Redirecting to the login page for the moment
		return $this->render('login/index.html.twig', [
			'last_username' => $lastUsername,
			'error' => $error,
		]);
	}
}
