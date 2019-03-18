<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use App\Entity\Menu;

class MenuController extends AbstractController
{

    public function showMenu()
    {
        $menu = $this->getDoctrine()->getRepository(Menu::class)->findAll();
        return $this->render('navigation/menu.html.twig', [
            'menu' => $menu
        ]);
    }
}
