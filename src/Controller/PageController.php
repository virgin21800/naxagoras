<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;
use App\Entity\Page;
use App\Entity\Menu;

class PageController extends AbstractController{

/**
 * @Route("/produits/secteurs/nanomateriaux")
    */
    public function showPage($menu){
    // $route='produits/secteurs/nanomateriaux/';

    // $menu = $this->getDoctrine()->getRepository(Menu::class)->findBy(['route' => $route ]);
    // $page = $this->getDoctrine()->getRepository(Page::class)->findBy(['menu' => $menu ]);

        $menu_parent = $this->getDoctrine()->getRepository(Page::class)->findBy(['menu' => $menu->getMenu()]);
        $chemin = $menu_parent->getDoctrine()->getRepository(Menu::class)->findBy(['route'=> $route]);
        // $menu = $this->getDoctrine()->getRepository(Menu::class)->findBy(['route' => $route ]);
        

        //$page = $this->getDoctrine()->getRepository(Page::class)->findAll();
        var_dump($chemin);

        // return $this->render('page/page.html.twig', [
        //     'page' => $page
        // ]);
    }

/**
 * @Route("/societe")
 */

public function showSociete(){

    return $this->render('societe/societe.html.twig');
}

}