<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Proxies\__CG__\App\Entity\Menu;

class NavigationController extends AbstractController
{

    public function showMenuAction()
    {

        $menu = $this->getDoctrine()->getRepository(Menu::class)->findAll();

        return $this->render('navigation/menu.html.twig', [
            'menu' => $menu
        ]);
    }
}
