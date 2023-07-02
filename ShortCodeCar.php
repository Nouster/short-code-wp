<?php


class ShortCodeCar
{
    public function __construct()
    {
        add_shortcode('my_car', array($this, 'shortCodeCar'));
    }


    public function shortCodeCar()
    {
        $html = '
        <h2>Renseignez votre véhicule</h2>
        <form id="car-form" method="post">
            <label for="full_name">Nom et prénom :</label>
            <input type="text" name="full_name" id="full_name" placeholder="Votre nom et prénom"><br>
            
            <label for="brand">Marque :</label>
            <input type="text" name="brand" id="brand" placeholder="Marque"><br>
            
            <label for="modele">Modèle :</label>
            <input type="text" name="modele" id="modele" placeholder="Modèle"><br>
            
            <label for="color">Couleur :</label>
            <input type="text" name="color" id="color" placeholder="Couleur"><br>
            
            <label for="year">Année de fabrication :</label>
            <input type="number" min="1900" placeholder="Année de fabrication"><br>
            
            <label for="licence_plate">Plaque d\'immatriculation :</label>
            <input type="text" name="licence_plate" id="licence_plate" placeholder="Plaque d\'immatriculation"><br>
            
            <input type="submit" name="submit_car" value="Ajouter">
        </form>';

        return $html;
    }
}
