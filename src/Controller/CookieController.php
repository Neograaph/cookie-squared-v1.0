<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class CookieController extends AbstractController
{
    /**
     * @Route("/dashboard/cookie", name="cookie")
     */
    public function cookieList(): Response
    {
        return $this->render('dashboard/cookielist.html.twig', [
            'controller_name' => 'CookieController',
        ]);
    }
}
