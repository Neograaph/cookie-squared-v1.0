<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class RequestController extends AbstractController
{
    /**
     * @Route("/request", name="request")
     */
    public function index(): Response
    {
        // return $this->render('request/cookiesList.json');
        header("Access-Control-Allow-Origin: *");
        return new JsonResponse([
            'cookie1' => "nuit",
            'cookie2' => "blabla",
            'cookie3' => "bonjour",
        ]);
    }
}