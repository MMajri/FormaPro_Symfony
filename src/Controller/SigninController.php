<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Attribute\Route;
use App\Entity\User;
use App\Form\SigninForm;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\PasswordHasher\Hasher\UserPasswordHasherInterface;

final class SigninController extends AbstractController
{
    #[Route('/signin', name: 'app_signin')]
    public function index(Request $request, EntityManagerInterface $em, UserPasswordHasherInterface $passwordHasher): Response
    {
		$user = new User();
		$form = $this->createForm(SigninForm::class, $user);

		// Handling the request
		$form->handleRequest($request);

		// Checking if the form is submitted and valid
		if ($form->isSubmitted() && $form->isValid()){
			// Retrieving data
			$user = $form->getData();
			$user->setRoles(['ROLE_USER']);

			// hashing the password
			$user->setPassword($passwordHasher->hashPassword($user, $user->getPassword()));

			// Persisting data
			$em->persist($user);
			$em->flush();

			// Redirecting to the login page if registration is successful
			return $this->redirectToRoute('app_login');
		}

		return $this->render('signin/index.html.twig', [
			'form' => $form->createView(),
        ]);
    }
}
