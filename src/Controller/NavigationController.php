<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use App\Entity\SousCategorie;
use App\Entity\Categorie;
use App\Entity\Rubrique;

class NavigationController extends AbstractController
{

    public function showMenuAction()
    {
        $onglets = [
            1 => 'Qui sommes-nous ?',
            2 => 'Nos services',
            3 => 'Nos produits'
        ];
        $rubriques = $this->getDoctrine()->getRepository(Rubrique::class)->findAll();
        $categories = $this->getDoctrine()->getRepository(Categorie::class)->findAll();
        $sous_categories = $this->getDoctrine()->getRepository(SousCategorie::class)->findAll();
        
        return $this->render('navigation/menu.html.twig', [
            'onglets' => $onglets,
            'rubriques' => $rubriques,
            'categories' => $categories,
            'sous_categories' => $sous_categories
        ]);
    }
}
