<?php

namespace App\Controller;

use App\Entity\Tuto;
use App\Repository\TutoRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class TutoController extends AbstractController
{
    #[Route('/tuto/{id}', name: 'app_tuto')]
    public function index(TutoRepository $tutoRepository, int $id): Response
    {
//$tuto = $entityManager->getRepository(Tuto::class)->find($id);
		$tuto = $tutoRepository->findOneBySomeField($id);

		if (!$tuto) {
			throw $this->createNotFoundException('No tuto found for id '.$id);
		}
        return $this->render('tuto/index.html.twig', [
            'controller_name' => 'TutoController',
			'name' => $tuto->getName(),
			'slug' => $tuto->getSlug(),
			'subtitle' => $tuto->getSubtitle(),
			'description' => $tuto->getDescription(),
			'video' => $tuto->getVideo(),
			'image' => $tuto->getImage(),
			'link' => $tuto->getLink(),
        ]);
    }

	#[Route('/add-tuto', name: 'create_tuto')]
	public function createTuto(EntityManagerInterface $entityManager): Response
    {
        $tuto = new Tuto();
        $tuto->setName('Unity');
        $tuto->setSlug('tuto unity');
		$tuto->setSubtitle('lorem ipsum');
		$tuto->setDescription('lorem ipsum');
		$tuto->setVideo('7ytPqdXPQhE');
		$tuto->setImage('unity.png');
		$tuto->setLink('https://www.youtube.com/watch?v=7ytPqdXPQhE');

        // tell Doctrine you want to (eventually) save the tuto (no queries yet)
        $entityManager->persist($tuto);

        // actually executes the queries (i.e. the INSERT query)
        $entityManager->flush();

        return new Response('Saved new tuto with id '.$tuto->getId());
    }
}
