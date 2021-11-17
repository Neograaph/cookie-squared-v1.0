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
        header("Access-Control-Allow-Origin: *");
        $status = $scraperRepository->findBy(['status' => 1]);


        if(array_key_exists(0, $status))
        {
            $getSite = $status[0]->getIdSite();
            $findSite = $siteRepository->findBy(['id_owner' => $getSite]);
            $token = $findSite[0]->getToken();

            $first = $status[0]->getUrl();

            $test[0] = $first;
            $test[1] = $token;

            // ENVOYER TOKEN POUR PROCHAINE REQUETE POUR LUTILISER DANS LES ROUTES
            return $this->json($test);
        }
        else
        {
            dd('existe pas');
        }

    }

    /**
     * @Route("/scan/request/{token}", name="scan_token")
     */
    public function changeStatus($token, ScraperRepository $scraperRepository, SiteRepository $siteRepository): Response
    {
        return $this->json("");
    }
}
