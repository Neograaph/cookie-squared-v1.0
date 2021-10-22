<?php

namespace App\Controller;

use App\Entity\User;
use App\Entity\Sites;
use App\Form\SitesType;
use App\Repository\UserRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class DashboardController extends AbstractController
{
    /**
     * @Route("/dashboard", name="my_sites")
     */
    public function mySites(): Response
    {
        if($this->getUser())
        {

            return $this->render('dashboard/my_sites.html.twig');
        }
        return $this->redirectToRoute('home_page');
    }

    /**
     * @Route("/dashboard/add", name="add_site")
     */
    public function addSites(Request $request, EntityManagerInterface $em): Response
    {
        $sites = new Sites();
        $user = new User();
        $user = $this->getUser();
        $sites->setIdOwner($user);
        $form = $this->createForm(SitesType::class, $sites);
        $form->handleRequest($request);

        if($form->isSubmitted() && $form->isValid())
        {
            
            $em->persist($sites);
            $em->persist($user);
            $em->flush();
        }

        return $this->render('dashboard/add_sites.html.twig', [
            'sites' => $form->createView()

        ]);
    }

    /**
     * @Route("/dashboard/scan", name="scan")
     */
    public function showScan(): Response
    {
        return $this->render('dashboard/scan.html.twig', [
            'controller_name' => 'DashboardController',
        ]);
    }
}
