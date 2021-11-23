<?php

namespace App\Controller;

use App\Entity\Cookie;
use App\Entity\Site;
use App\Repository\CookieRepository;
use App\Repository\ScraperRepository;
use App\Repository\SiteRepository;
use DateTimeImmutable;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class ScanRequestController extends AbstractController
{
    /**
     * @Route("/scan/request/", name="scan_request")
     */
    public function urlShow(ScraperRepository $scraperRepository, SiteRepository $siteRepository, EntityManagerInterface $em): Response
    {
        header("Access-Control-Allow-Origin: *");
        $status = $scraperRepository->findBy(['status' => 1]);


        if(array_key_exists(0, $status))
        {
            $getSite = $status[0]->getIdSite();
            $findSite = $siteRepository->findBy(['id' => $getSite]);
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
    public function changeStatus($token, ScraperRepository $scraperRepository, SiteRepository $siteRepository, EntityManagerInterface $em): Response
    {
        header("Access-Control-Allow-Origin: *");
        $findSite = $siteRepository->findBy(['token' => $token]);
        $findScrap = $scraperRepository->findBy(['id_site' => $findSite[0]->getId()]);
        $findScrap[0]->setStatus(2);
        $em->persist($findScrap[0]);
        $em->flush();
        return $this->json("Test");
    }

    /**
     * @Route("/scan/request/finish/{token}", name="scan_finish")
     */
    public function getJSON($token, Site $site, ScraperRepository $scraperRepository, SiteRepository $siteRepository, CookieRepository $cookieRepository, EntityManagerInterface $em): Response
    {
        header("Access-Control-Allow-Origin: *");

        $findSite = $siteRepository->findBy(['token' => $token]);
        $findScrap = $scraperRepository->findBy(['id_site' => $findSite[0]->getId()]);
        $findScrap[0]->setStatus(3);
        $em->persist($findScrap[0]);
        $em->flush();

        $json_raw = file_get_contents("https://cookiesscrap.codecolliders.dev/data.json");
        $json = json_decode($json_raw, true);

        for($i =0; $i<count($json);$i++)
        {
            $findSite[0]->setScanAt(new DateTimeImmutable());
            $cookie = new Cookie;
            $user = $this->getUser();
            $cookie->setName($json[$i]['name']);
            $cookie->setCategory('Inconnu');
            $cookie->setDuration('test');
            $cookie->setDomain($json[$i]['domain']);
            $cookie->setPath($json[$i]['path']);
            $cookie->setDescription('TEST');
            $cookie->setIdSite($site);
            $em->persist($cookie);
            $em->persist($findSite[0]);
            $em->flush();
        }

        $em->remove($findScrap[0]);
        $em->flush();

        return $this->json("Test");
    }
}
