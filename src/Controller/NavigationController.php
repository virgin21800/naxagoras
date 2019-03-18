<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use App\Entity\Menu;

class NavigationController extends AbstractController
{

    /**
     * @Route("/navigation", name="navigation")
     */
    public function index()
    {
        $this->denyAccessUnlessGranted('ROLE_ADMIN');

        $menu = $this->getDoctrine()->getRepository(Menu::class)->findAll();
        return $this->render('navigation/index.html.twig', array('menu' => $menu));
    }
    
    public function afficher()
    {

        $menu = $this->getDoctrine()->getRepository(Menu::class)->findAll();

        return $this->render('navigation/menu.html.twig', [
            'menu' => $menu
        ]);
    }
}
