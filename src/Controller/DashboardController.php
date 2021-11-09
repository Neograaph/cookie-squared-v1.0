<?php

namespace App\Controller;

use App\Entity\Site;
use App\Entity\User;
use App\Entity\Custom;
use App\Form\SiteType;
use App\Form\CustomType;
use App\Repository\SiteRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

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
            return $this->render('dashboard/my_sites.html.twig', compact('mysites'));
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
        $form = $this->createForm(SiteType::class, $sites);
        $form->handleRequest($request);

        if($form->isSubmitted() && $form->isValid())
        {
            
            $em->persist($sites);
            $em->persist($user);
            $em->flush();
            return $this->redirectToRoute("my_sites");
        }

        return $this->render('dashboard/add_sites.html.twig', [
            'sites' => $form->createView()

        ]);
    }

    /**
     * @Route("/dashboard/{id<[0-9]+>}/scan", name="scan")
     */
    public function showScan(Site $site): Response
    {
        return $this->render('dashboard/scan.html.twig', compact('site'));
    }

    /**
     * @Route("/dashboard/{id<[0-9]+>}/custom", name="custom")
     */
    public function Customize(Request $request, EntityManagerInterface $em, Site $site): Response
    {
        $custom = new Custom;

        $form = $this->createForm(CustomType::class, $custom);
        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()) {
            $custom->setIdSite($site);
            $em->persist($custom);
            $em->flush();
        }

        return $this->render('dashboard/customize.html.twig', [
            'custom' => $form->createView(),
            'site' => $site,
            'mySettings' => $custom
        ]);
    }
}
