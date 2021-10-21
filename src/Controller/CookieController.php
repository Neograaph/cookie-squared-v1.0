<?php

namespace App\Controller;

use App\Entity\Cookie;
use App\Form\CookieType;
use App\Repository\CookieRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class CookieController extends AbstractController
{
    /**
     * @Route("/dashboard/cookie", name="cookie", methods="GET|POST")
     */
    public function cookieList(CookieRepository $cookieRepository, Request $request, EntityManagerInterface $em): Response
    {
        $cookies = $cookieRepository->findAll();

        $cookie = new Cookie;

        $form = $this->createForm(CookieType::class, $cookie);
        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()) {
            $em->persist($cookie);
            $em->flush();
        }


        return $this->render('dashboard/cookielist.html.twig', [
            'controller_name' => 'CookieController',
            'cookies' => $cookies,
            'cookieForm' => $form->createView()
        ]);
    }

    /**
     * @Route("/dashboard/delcookie", name="del_cookie")
     */
    function delCookie(CookieRepository $cookieRepository, EntityManagerInterface $em)
    {
        $em = $this->getDoctrine()->getManager();

        $cookie = $cookieRepository->find(2);

        $em->remove($cookie);

        $em->flush();

        return $this->redirectToRoute('cookie');
    }
}
