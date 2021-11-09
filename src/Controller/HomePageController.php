<?php

namespace App\Controller;

use App\Entity\Site;
use App\Entity\Cookie;
use App\Entity\User;
use App\Repository\CookieRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class HomePageController extends AbstractController
{
    /**
     * @Route("/", name="home_page")
     */
    public function index(): Response
    {
        return $this->render('home_page/index.html.twig', [
            'controller_name' => 'HomePageController',
        ]);
    }

    /**
     * @Route("/test", name="test")
     */
    public function test(CookieRepository $repo, EntityManagerInterface $em): Response
    {
        $json_raw = file_get_contents("../tests/data.json");
        $json = json_decode($json_raw, true);
        

        dd($json);

        for($i =0; $i<count($json);$i++)
        {
            $cookie = new Cookie;
            $site = new Site;
            $user = new User;
            $user = $this->getUser();
            $cookie->setName($json[$i]['name']);
            $cookie->setCategory('Inconnu');
            $cookie->setDuration($json[$i]['expiry']);
            $cookie->setDomain($json[$i]['domain']);
            $cookie->setPath($json[$i]['path']);
            $cookie->setDescription('TEST');
            $site->setUrl('test');
            $site->setName('test');
            $site->setToken('test');
            $site->setIdOwner($user);
            $cookie->setIdSite($site);
            $em->persist($cookie);
            $em->flush();
            var_dump('test');
        }
        // dd($json[0]['name']);
        return $this->render('home_page/test.html.twig', [
            'controller_name' => 'TestController',
        ]);
    }
}
