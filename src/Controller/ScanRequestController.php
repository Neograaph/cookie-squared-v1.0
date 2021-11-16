<?php

namespace App\Controller;

use App\Entity\Site;
use App\Repository\ScraperRepository;
use App\Repository\SiteRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class ScanRequestController extends AbstractController
{
    /**
     * @Route("/scan/request", name="scan_request")
     */
    public function urlShow(ScraperRepository $scraperRepository, SiteRepository $siteRepository, EntityManagerInterface $em): Response
    {
        $list = $scraperRepository->findBy(['status' => 1]);
        if(array_key_exists(0, $list))
        {
            $first = $list[0]->getUrl();
            $change = $list[0]->setStatus(2);
            $em->persist($change);
            $em->flush();
            // ENVOYER TOKEN POUR PROCHAINE REQUETE POUR LUTILISER DANS LES ROUTES
            return $this->json($first);
        }
        else
        {
            dd('existe pas');
        }

    }
}
