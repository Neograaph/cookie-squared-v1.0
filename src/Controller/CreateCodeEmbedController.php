<?php

namespace App\Controller;

use App\Entity\Site;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class CreateCodeEmbedController extends AbstractController
{
    /**
     * @Route("/codeembed", name="codeembed")
     */
    public function index(): Response
    {
        return $this->render('dashboard/codeembed.html.twig', [
            'controller_name' => 'CreateCodeEmbedController',
        ]);
    }

       /**
     * @Route("/dashboard/{id<[0-9]+>}/scan", name="scan")
     */
    public function showScan(Site $site, EntityManagerInterface $em): Response
    {

        return $this->render('dashboard/scan.html.twig', compact('site'));
    }
}
