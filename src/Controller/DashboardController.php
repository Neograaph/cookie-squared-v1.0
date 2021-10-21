<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class DashboardController extends AbstractController
{
    /**
     * @Route("/dashboard", name="my_sites")
     */
    public function MySites(): Response
    {
        if($this->getUser())
        {
            
            return $this->render('dashboard/my_sites.html.twig');
        }
        return $this->redirectToRoute('home_page');
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
