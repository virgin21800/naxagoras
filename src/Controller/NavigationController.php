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
        $onglets = array('Qui sommes-nous ?', 'Nos services', 'Nos produits');
        
        $categories = $this->getDoctrine()->getRepository(Categorie::class)->findAll();
        $sous_categories = $this->getDoctrine()->getRepository(SousCategorie::class)->findAll();

        $menu = [];
        $menu = $onglets;
        $rubriques = [];
        $dump = "";

        foreach ($onglets as $key_onglet => $onglet) {
            $menu[$key_onglet] = [$onglet => []];
            $rubriques = $this->getDoctrine()->getRepository(Rubrique::class)->findItems($onglet);
            foreach ($rubriques as $key_rubrique => $rubrique) {
                $menu[$key_onglet][$key_rubrique] = [$rubrique->getNom() => []];
                //$menu[$key_onglet] = [$onglet => [1 => 'toto']];
                //$menu[$key_onglet] = [$onglet => [2 =>'kiki']];
                $dump = $menu[0];
                //$menu = [$menu[$key_onglet] => [$rubrique => $rubrique->getNom()]];
            }
                // foreach ($rubriques as $key_rubrique => $rubrique) {
                //     if ($rubrique->getOngletParent() === $onglet) {
                //         $menu[$key_onglet][$key_rubrique] = "Toto";//$rubriques[$key_rubrique]->getNom();
                //         if (!empty($categories)) {
                //             foreach ($categories as $key_categorie => $categorie) {
                //                 if ($categorie->getRubriqueParente() === $rubrique) {
                //                     $menu[$key_onglet][$key_rubrique]=$categories[$key_categorie]->getNom();
                //         //             if (!empty($sous_categories)) {
                //         //                 foreach ($sous_categories as $key_sous_categorie => $sous_categorie) {
                //         //                     if ($sous_categorie->getCategorieParente()->getId() === $categorie->getId()) {
                //         //                         $menu[$onglet][$rubrique][$categorie] = [
                //         //                             $key_sous_categorie => $sous_categorie->getNom()
                //         //                         ];
                //         //                     }
                //         //                 }
                //         //             }
                //                 }
                //             }
                //         }
                //     }
                // }
        }
        return $this->render('navigation/menu.html.twig', [
            'onglets' => $onglets,
            'rubriques' => $rubriques,
            'categories' => $categories,
            'sous_categories' => $sous_categories,
            'menu' => $menu,
            'dump' => $dump
        ]);
    }
}
