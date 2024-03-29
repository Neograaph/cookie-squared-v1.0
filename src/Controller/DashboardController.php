<?php

namespace App\Controller;

use App\Entity\Site;
use App\Entity\User;
use App\Entity\Cookie;
use App\Entity\Custom;
use App\Entity\Scraper;
use App\Form\SiteType;
use App\Form\CustomType;
use App\Repository\CookieRepository;
use App\Repository\CustomRepository;
use App\Repository\SiteRepository;
use DateTimeImmutable;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Validator\Constraints\Date;

class DashboardController extends AbstractController
{
    /**
     * @Route("/dashboard", name="my_sites", methods="GET")
     */
    public function mySites(SiteRepository $siterepo): Response
    {
        $user = new User();
        $user = $this->getUser();
        if($this->getUser())
        {
            $mysites = $siterepo->findBy(['id_owner' => $user]);
            return $this->render('dashboard/my_sites.html.twig', [
                'mysites' => $mysites
            ]);
        }
        return $this->redirectToRoute('home_page');
    }

    /**
     * @Route("/dashboard/add", name="add_site")
     */
    public function addSites(Request $request, EntityManagerInterface $em): Response
    {
        $sites = new Site();
        $user = new User();
        $user = $this->getUser();
        $sites->setIdOwner($user);
        $custom = new Custom();
        $custom->setIdSite($sites);
        $custom->setTitle('Titre de votre bannière');
        $custom->setMessage('Nous utilisons des cookies pour personnaliser la navigation de l\'utilisateur ainsi que les publicités affichées sur le site. Si vous cliquez sur “accepter”, vous autorisez la collecte d’information concernant votre navigation.');
        $custom->setColor('light');
        $custom->setLayout(1);
        $form = $this->createForm(SiteType::class, $sites);
        $form->handleRequest($request);

        if($form->isSubmitted() && $form->isValid())
        {
            
            $em->persist($sites);
            $em->persist($user);
            
            $em->persist($custom);
            $em->flush();
            return $this->redirectToRoute("my_sites");
        }

        return $this->render('dashboard/add_sites.html.twig', [
            'sites' => $form->createView()

        ]);
    }

    /**
     * @Route("/dashboard/del/{siteId<[0-9]+>}", name="del_site")
     */
    public function DelSite(SiteRepository $siterepo, EntityManagerInterface $em, int $siteId): Response
    {
        $em = $this->getDoctrine()->getManager();

        $site = $siterepo->findOneBy(['id' => $siteId]);

        $em->remove($site);

        $em->flush();
        return $this->redirectToRoute('my_sites', []);
    }

    /**
     * @Route("/dashboard/{id<[0-9]+>}/scan", name="scan")
     */
    public function showScan(Site $site, EntityManagerInterface $em): Response
    {

        return $this->render('dashboard/scan.html.twig', compact('site'));
    }

    /**
     * @Route("/dashboard/{id<[0-9]+>}/currentscan", name="currentscan")
     */
    public function currentScan(Site $site, EntityManagerInterface $em): Response
    {
        $scanAt = $site->getScanAt();
        if(!is_null($scanAt))
        {
            if($scanAt->modify("+24 hours") < new DateTimeImmutable())
            {
                $item = $site->getUrl();
                $scrap = new Scraper;
                $scrap->setIdSite($site);
                $scrap->setUrl($item);
                $scrap->setStatus(1);
                $em->persist($scrap);
                $em->flush();
            }
            else
            {
                dd('test');
            }
        }
        else
        {
            $item = $site->getUrl();
            $scrap = new Scraper;
            $scrap->setIdSite($site);
            $scrap->setUrl($item);
            $scrap->setStatus(1);
            $em->persist($scrap);
            $em->flush();
        }
        return $this->render('dashboard/scan.html.twig', compact('site'));
    }

    /**
     * @Route("/dashboard/{id<[0-9]+>}/custom", name="custom")
     */
    public function Customize(Request $request, EntityManagerInterface $em, Site $site, CustomRepository $customrepo): Response
    {
        $findcustom = $customrepo->findOneBy(['id_site' => $site]);
        
        $custom = new Custom;
        $form = $this->createForm(CustomType::class, $custom);

        if (!$findcustom) {
            $form->handleRequest($request);
            if ($form->isSubmitted() && $form->isValid()) {
                $custom->setIdSite($site);
                $em->persist($custom);
                $em->flush();
            }
        } else {
            $form->handleRequest($request);
            if ($form->isSubmitted() && $form->isValid()) {
                $em->remove($findcustom);
                $custom->setIdSite($site);
                $em->persist($custom);
                $em->flush();
            }
        }

        return $this->render('dashboard/customize.html.twig', [
            'custom' => $form->createView(),
            'site' => $site,
            'mySettings' => $custom
        ]);
    }

    /**
     * @Route("/dashboard/{id<[0-9]+>}/banniere", name="view_banner")
     */
    public function ViewBanner(CustomRepository $customrepo, Site $site): Response
    {
        $mycustom = $customrepo->findOneBy(['id_site' => $site]);
        
        return $this->render('dashboard/viewbanner.html.twig', [
            'custom' => $mycustom,
        ]);
    }

    /**
     * @Route("/dashboard/{id<[0-9]+>}/preferences", name="view_preferences")
     */
    public function ViewPreferences(CustomRepository $customrepo, CookieRepository $cookierepo, Site $site): Response
    {
        $mycustom = $customrepo->findOneBy(['id_site' => $site]);
        $mycookies = $cookierepo->findBy(['id_site' => $site]);

        
        return $this->render('dashboard/viewpreferences.html.twig', [
            'custom' => $mycustom,
            'mycookies' => $mycookies
        ]);
    }

    /**
     * @Route("/dashboard/{id<[0-9]+>}/embed", name="embed")
     */
    public function embed(Site $site): Response
    {
        return $this->render('dashboard/embed.html.twig', compact('site'));
    }

    /**
     * @Route("/dashboard/{id<[0-9]+>}/templateforembed", name="templateforembed")
     */
 
    public function TemplateForEmbed(CustomRepository $customrepo, CookieRepository $cookierepo, Site $site): Response
    {
        

        $mycustom = $customrepo->findOneBy(['id_site' => $site]);
        $mycookies = $cookierepo->findBy(['id_site' => $site]);

        
        return $this->render('dashboard/templateforembed.html.twig', [
            'custom' => $mycustom,
            'mycookies' => $mycookies
        ]);
    }
}
