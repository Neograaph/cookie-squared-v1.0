<?php

namespace App\Controller;

use App\Entity\Site;
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
     * @Route("/dashboard/{id<[0-9]+>}/cookie", name="cookie", methods="GET|POST")
     */
    public function cookieList(CookieRepository $cookieRepository, Request $request, EntityManagerInterface $em, Site $site): Response
    {
        $cookie = new Cookie;

        $form = $this->createForm(CookieType::class, $cookie);
        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()) {
            $cookie->setIdSite($site);
            $em->persist($cookie);
            $em->flush();
        }

        $cookies = $cookieRepository->findBy(['id_site'=>$site->getId()]);

        return $this->render('dashboard/cookielist.html.twig', [
            'controller_name' => 'CookieController',
            'cookies' => $cookies,
            'site' => $site,
            'cookieForm' => $form->createView(),
            
        ]);
    }

    /**
     * @Route("/dashboard/{id<[0-9]+>}/delcookie/{cookieId<[0-9]+>}", name="del_cookie")
     */
    function delCookie(CookieRepository $cookieRepository, EntityManagerInterface $em, int $cookieId, Site $site)
    {
        $em = $this->getDoctrine()->getManager();

        $cookie = $cookieRepository->findOneBy(['id' => $cookieId]);

        $em->remove($cookie);

        $em->flush();

        return $this->redirectToRoute('cookie', [
            'id' => $site->getId(),
        ]);

    }
}
