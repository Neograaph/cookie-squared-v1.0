<?php

namespace App\Controller;

use App\Entity\Site;
use App\Entity\WordpressSite;
use Doctrine\ORM\EntityManager;
use App\Repository\SiteRepository;
use App\Repository\CookieRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\HttpFoundation\Response;
use App\Repository\WordpressSiteRepository;
use Symfony\Component\HttpFoundation\Cookie;
use Symfony\Component\HttpFoundation\Request;
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
        // header("Access-Control-Allow-Origin: *");
        return $this->render('request/cookiesList.html.twig', compact('cookieslist'));
    }
    /**
     * @Route("/request/cookies/json", name="request-allcookies")
     */
    public function cookiesJsonShow(CookieRepository $cookieRepository): Response
    {
        $cookieslist = $cookieRepository->findAll();
        // header("Access-Control-Allow-Origin: *");
        return $this->json(
            $cookieslist,200,[],["groups"=>'displayCookie']
        );
    }
    /**
     * @Route("/request/cookies/{token}", name="request-tokencookies")
     */
    public function cookiesTokenJsonShow($token, CookieRepository $cookieRepository, SiteRepository $siterepo): Response
    {
        $target = $siterepo->findBy(['token' => $token]);
        $cookieslist = $cookieRepository->findBy(['id_site' => $target]);
        // header("Access-Control-Allow-Origin: *");
        return $this->json(
            $cookieslist,200,[],["groups"=>'displayCookie']
        );
    }
    /**
     * @Route("/request/push/banner/{key}", name="request-push-banner")
     */
    public function bannerKeyPush($key, WordpressSiteRepository $WordpressSiteRepository, EntityManagerInterface $em): Response
    {
        // header("Access-Control-Allow-Origin: *");

        $requestPayload = file_get_contents("php://input");
        $dataPlugin = json_decode($requestPayload, true);

        $site = new WordpressSite;
        $site->setUrl($key);
        $site->setToken('');
        $site->setTitle($dataPlugin[0]['title']);
        $site->setDescription($dataPlugin[0]['txt']);
        $site->setColor($dataPlugin[0]['color']);
        $em->persist($site);
        $em->flush();
        
        return $this->json('Save');
        // return $_POST["data"];
    }
    /**
     * @Route("/request/pull/banner/{key}", name="request-pull-banner")
     */
    public function bannerKeyPull($key, WordpressSiteRepository $WordpressSiteRepository, EntityManagerInterface $em): Response
    {
        // header("Access-Control-Allow-Origin: *");
        $paramsBanner = $WordpressSiteRepository->findBy(['url' => $key]);
        return $this->json($paramsBanner);
    }
}