<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use App\Repository\TutoRepository;
use Doctrine\ORM\EntityManagerInterface;
use App\Entity\Tuto;

class HomeController extends AbstractController {
	#[Route('/', name: 'app_home')]
	public function index(EntityManagerInterface $entityManager): Response {
		//
		// Insteand of using : $tutos = $entityManager->getRepository(Tuto::class)->findAll();
		// Gather the last 9 tutos
		$tutos = $entityManager->getRepository(Tuto::class)->findBy(
			[],
			['id' => 'ASC'],
			9
		);

		return $this->render('home/index.html.twig', [
			'tutos' => $tutos,
		]);
	}
}
