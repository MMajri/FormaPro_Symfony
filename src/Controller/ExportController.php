<?php

namespace App\Controller;

use App\Entity\Tuto;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\StreamedResponse;
use Symfony\Component\Routing\Attribute\Route;

final class ExportController extends AbstractController {
    #[Route('/admin/export', name: 'app_export')]
    public function index(EntityManagerInterface $entityManager): Response {
		//
		// Todo: Import more than just tutos
		//

        $tutos = $entityManager->getRepository(Tuto::class)->findAll();

        $response = new StreamedResponse(function() use ($tutos) {
            $handle = fopen('php://output', 'w+');

            // Titres de colonnes
            fputcsv($handle, ['ID', 'Name', 'Slug', 'Subtitle', 'Description', 'Image', 'Video', 'Link'], ';');

            // Boucle sur les entités et export
            foreach ($tutos as $tuto) {
                fputcsv($handle, [
                    $tuto->getId(),
                    $tuto->getName(),
                    $tuto->getSlug(),
                    $tuto->getSubtitle(),
                    $tuto->getDescription(),
                    $tuto->getImage(),
                    $tuto->getVideo(),
                    $tuto->getLink()
                ], ';');
            }

            fclose($handle);
        });

        $response->headers->set('Content-Type', 'text/csv; charset=utf-8');
        $response->headers->set('Content-Disposition', 'attachment; filename="export-tutos.csv"');

        return $response;
    }
}