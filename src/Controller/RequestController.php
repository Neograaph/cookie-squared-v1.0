<?php

namespace App\Controller;

use App\Entity\Site;
use App\Repository\CookieRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\HttpFoundation\Cookie;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class RequestController extends AbstractController
{
    /**
     * @Route("/request", name="request")
     */
    public function cookieShow(CookieRepository $cookieRepository): Response
    {
        $cookieslist = $cookieRepository->findAll();
        header("Access-Control-Allow-Origin: *");
        return $this->render('request/cookiesList.html.twig', compact('cookieslist'));
    }
    /**
     * @Route("/request/json", name="request-json")
     */
    public function jsonShow(CookieRepository $cookieRepository): Response
    {
        $cookieslist = $cookieRepository->findAll();
        header("Access-Control-Allow-Origin: *");
        return new JsonResponse([
            'cookie1' => [
                "name"=> "Toto",
                "category"=> "1",
                "duration"=> "Dan",
                "domain"=> "yo",                
                "path"=> "/",                
                "description"=> "desc"              
                ],
            'cookie2' => [
                "name"=> "Tata",
                "category"=> "2",
                "duration"=> "Dan",
                "domain"=> "yo",                
                "path"=> "/",                
                "description"=> "descdescdescdesc"              
                ],
            'cookie3' => [
                "name"=> "Tonton",
                "category"=> "1",
                "duration"=> "Dan",
                "domain"=> "yo",                
                "path"=> "/",                
                "description"=> "5555555"              
                ]
            
        ]);
    }
}