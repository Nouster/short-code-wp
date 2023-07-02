<?php
require_once 'CarDatabase.php';

class CarAdmin
{
    public function __construct()
    {
        add_action('admin_menu', array($this, 'addAdminMenu'));
        add_shortcode('car_list', array($this, 'shortCodeCarList'));
    }

    public function addAdminMenu()
    {
        /**
         * Ajout d'un onglet dans le menu d'admin
         */
        add_menu_page(
            'My car list - votre liste de véhicule enregistré',
            'My car list',
            'manage_options',
            'MyCarList',
            array($this, 'generateHtml'),
            plugin_dir_url(__FILE__) . 'icon.png'
        );

        add_submenu_page(
            'MyCarList',
            'Aperçu',
            'Liste des véhicules',
            'manage_options',
            'MyCarList',
            array($this, 'generateCarsHtml')
        );

        add_submenu_page(
            'MyCarList',
            'Véhicule le plus récent',
            'Véhicule le plus récent',
            'manage_options',
            'NewestCar',
            array($this, 'generateNewestCarHtml')
        );
    }

    public function generateHtml()
    {
        echo '<h1>' . get_admin_page_title() . '</h1>';
        echo '<p>Bienvenue sur la page d\'accueil du plugin</p>';
        echo '<p>Pour afficher la liste des véhicules inscrits dans un article, utilisez le shortcode <br><code>[my_car_list][/my_car_list]</code></p>';
    }

    public function generateCarsHtml()
    {
        echo '<h1>' . get_admin_page_title() . '</h1>';
        echo $this->genHtmlList();
    }

    public function shortCodeCarList($attr)
    {
        $html = "<h2>Liste des véhicules inscrits</h2>";
        if (isset($attr['subtitle'])) {
            $html .= "<h3>{$attr['subtitle']}</h3>";
        }
        $html .= $this->genHtmlList();

        return $html;
    }

    public function genHtmlList()
    {
        // appelle la méthode qui effectue la requête SQL et stocke le tableau d'inscrits dans la variable $cars
        $cars = CarDatabase::getAllCars();
        $html = "";
        if (count($cars) > 0) {
            /**
             * s'il y a des inscrits, génération du tableau
             */
            $html .= '<table class="my-formulaire-liste" style="border-collapse:collapse">
            <thead>
                <tr>
                    <th style="border:1px solid black;">Nom et prénom</th>
                    <th style="border:1px solid black;">Marque</th>
                    <th style="border:1px solid black;">Modèle</th>
                    <th style="border:1px solid black;">Couleur</th>
                    <th style="border:1px solid black;">Année de fabrication</th>
                    <th style="border:1px solid black;">Plaque d\'immatriculation</th>
                </tr>
            </thead>
            <tbody>';

            foreach ($cars as $car) {
                $html .= "<tr>
                    <td style='border:1px solid black;'>{$car->fullname}</td>
                    <td style='border:1px solid black;'>{$car->car_brand}</td>
                    <td style='border:1px solid black;'>{$car->car_model}</td>
                    <td style='border:1px solid black;'>{$car->color}</td>
                    <td style='border:1px solid black;'>{$car->manufacturing_year}</td>
                    <td style='border:1px solid black;'>{$car->licence_plate}</td>
                </tr>";
            }
            $html .= '</tbody></table>';
        } else {
            /**
             * s'il n'y a pas d'inscrits dans la base, on affiche un message
             */
            $html .= "<p>Il n'y a pas encore de véhicules enregistrés 😥</p>";
        }
        return $html;
    }

    public function generateNewestCarHtml()
    {
        echo '<h1>' . get_admin_page_title() . '</h1>';
        echo $this->generateNewestCarList();
    }

    public function generateNewestCarList()
    {
        $newestCar = CarDatabase::getNewestCar();
        $html = "";
        if ($newestCar) {
            $html .= "
            <div>
                <h3>Marque : {$newestCar->car_brand}</h3>
                <ul>
                    <li>Modèle : {$newestCar->car_model}</li>
                    <li>Couleur : {$newestCar->color}</li>
                    <li>Année de fabrication : {$newestCar->manufacturing_year}</li>
                    <li>Plaque d'immatriculation : {$newestCar->licence_plate}</li>
                    <li>Propriétaire : {$newestCar->fullname}</li>
                </ul>
            </div>
            ";
        } else {
            $html .= "<p>Pas de véhicule enregistré 🙊</p>";
        }
        return $html;
    }
}
