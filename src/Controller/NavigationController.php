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
        $onglets = array(
            array(
                'nom' => 'Qui sommes-nous ?',
                'route' => 'notre_société/'
            ),
            array(
                'nom' => 'Nos services',
                'route' => 'nos_services/'
            ),
            array(
                'nom' => 'Nos produits',
                'route' => 'nos_produits/'
            )
        );

        $menu = [];
        $menu = $onglets;
        foreach ($onglets as $key_onglet => $onglet) {
            $rubriques = $this->getDoctrine()->getRepository(Rubrique::class)->findBy(['onglet_parent' => $onglet]);
            if (count($rubriques) > 0) {
                foreach ($rubriques as $key_rubrique => $rubrique) {
                    $menu[$key_onglet][$key_rubrique] = [
                        'item' => [
                            'nom' => $rubrique->getNom(),
                            'route' => $rubrique->getUrl()
                        ]
                    ];
                    $categories = $this->getDoctrine()->getRepository(Categorie::class)->findBy(['rubrique_parente' => $rubrique]);
                    if (count($categories) > 0) {
                        foreach ($categories as $key_categorie => $categorie) {
                            $menu[$key_onglet][$key_rubrique][$key_categorie] = [
                                'item' => [
                                    'nom' => $categorie->getNom(),
                                    'route' => $categorie->getUrl()
                                ]
                            ];
                            $sous_categories = $this->getDoctrine()->getRepository(SousCategorie::class)->findBy(['categorie_parente' => $categorie]);
                            if (count($sous_categories) > 0) {
                                foreach ($sous_categories as $key_ss_categorie => $sous_categorie) {
                                    $menu[$key_onglet][$key_rubrique][$key_categorie][$key_ss_categorie] = [
                                        'item' => [
                                            'nom' => $sous_categorie->getNom(),
                                            'route' => $sous_categorie->getUrl()
                                        ]
                                    ];
                                }
                            }
                        }
                    }
                }
                
            }
        }
        return $this->render('navigation/menu.html.twig', [
            'menu' => $menu
        ]);
    }
}
