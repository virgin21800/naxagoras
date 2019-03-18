<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;
use App\Entity\Page;
use App\Entity\Menu;

class PageController extends AbstractController{

    /**
    * @Route("/{menu}/{sous_menu}/{route}")
    */
    public function showPageSousMenu($menu, $sous_menu, $route){

        $chemin = $menu.$sous_menu.$route;
        $itemMenu = $this->getDoctrine()->getRepository(Menu::class)->findBy(['route' => $chemin]);
        $page = $this->getDoctrine()->getRepository(Page::class)->findBy(['menu' => $itemMenu]);

        return $this->render('page/page.html.twig', [
            'page' => $page
        ]);
    }

    /**
    * @Route("/{menu}/{route}")
    */
    public function showPageMenu($menu, $route){

        $chemin = $menu.$route;
        $itemMenu = $this->getDoctrine()->getRepository(Menu::class)->findBy(['route' => $chemin]);
        $page = $this->getDoctrine()->getRepository(Page::class)->findBy(['menu' => $itemMenu]);

        return $this->render('page/page.html.twig', [
            'page' => $page
        ]);
    }

    /**
    * @Route("/produits/secteurs/{route}")
    */
    public function showProduitsSecteurs($route){

        $menu = $this->getDoctrine()->getRepository(Menu::class)->findBy(['route' => $route]);
        $page = $this->getDoctrine()->getRepository(Page::class)->findBy(['menu' => $menu]);

        return $this->render('page/page.html.twig', [
            'page' => $page
        ]);
    }

/**
 * @Route("/societe")
 */

public function showSociete(){

    return $this->render('societe/societe.html.twig');
}

}