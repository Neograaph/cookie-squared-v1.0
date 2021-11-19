<?php

namespace App\Controller;

use App\Entity\Site;
use App\Repository\SiteRepository;
use App\Repository\CookieRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\HttpFoundation\Cookie;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class WordpressRequestController extends AbstractController
{
    /**
     * @Route("/request/cookies", name="request")
     */
    public function cookieShow(CookieRepository $cookieRepository): Response
    {
        $cookieslist = $cookieRepository->findAll();
        header("Access-Control-Allow-Origin: *");
        return $this->render('request/cookiesList.html.twig', compact('cookieslist'));
    }
    /**
     * @Route("/request/cookies/json", name="request-json")
     */
    public function cookiesJsonShow(CookieRepository $cookieRepository): Response
    {
        $cookieslist = $cookieRepository->findAll();
        header("Access-Control-Allow-Origin: *");
        return $this->json(
            $cookieslist,200,[],["groups"=>'displayCookie']
        );
    }
    /**
     * @Route("/request/cookies/{token}", name="request-token")
     */
    public function cookiesTokenJsonShow($token, CookieRepository $cookieRepository, SiteRepository $siterepo): Response
    {
        $target = $siterepo->findBy(['token' => $token]);
        $cookieslist = $cookieRepository->findBy(['id_site' => $target]);
        header("Access-Control-Allow-Origin: *");
        return $this->json(
            $cookieslist,200,[],["groups"=>'displayCookie']
        );
    }
}