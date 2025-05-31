<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;
use App\Entity\User;
use App\Form\SignupForm;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\PasswordHasher\Hasher\UserPasswordHasherInterface;

#[Route('/signup')]
final class SignupController extends AbstractController
{
    public function __construct(
        private readonly EntityManagerInterface $entityManager,
        private readonly UserPasswordHasherInterface $passwordHasher
    ) {
    }

    #[Route('', name: 'app_signup')]
    public function index(Request $request): Response
    {
        $user = new User();
        $form = $this->createForm(SignupForm::class, $user);
        $form->handleRequest($request);

        if ($form->isSubmitted()) {
            if (!$form->isValid()) {
                $errors = [];
                foreach ($form->getErrors(true) as $error) {
                    $errors[] = $error->getMessage();
                }
                $this->addFlash('error', 'Erreurs de validation : ' . implode(', ', $errors));
            } else {
                $hashedPassword = $this->passwordHasher->hashPassword(
                    $user,
                    $form->get('password')->getData()
                );
                $user->setPassword($hashedPassword);
                $user->setRoles(['ROLE_USER']);

                $this->entityManager->persist($user);
                $this->entityManager->flush();

                $this->addFlash('success', 'Votre compte a été créé avec succès !');
                return $this->redirectToRoute('app_login');
            }
        }

        return $this->render('signup/index.html.twig', [
            'form' => $form->createView(),
        ]);
    }
}
