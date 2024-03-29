<?php

/**
 * Plugin Name: Car List Plugin
 * Plugin URI: #
 * Description: Un plugin pour gérer une liste de voitures.
 * Version: 1.0
 * Author: Mohamed Djebali
 * Author URI: #
 */

require_once 'ShortCodeCar.php';
require_once 'CarSession.php';
require_once 'CarDatabase.php';
require_once 'CarAdmin.php';
require_once 'LoadFile.php';
require_once 'CarWidget.php';

class MyCar
{
    public function __construct()
    {

        /**
         * Lorsque Wordpress est prêt à charger les widgets (widget_init), nous lui demandons de recenser le notre en renseignant le nom de la classe du widget
         */
        add_action('widgets_init', function () {
            register_widget('CarWidget');
        });

        new CarAdmin();
        register_activation_hook(__FILE__, ['CarDatabase', 'createTable']);
        register_uninstall_hook(__FILE__, ['CarDatabase', 'dropTable']);
        new ShortCodeCar();
        // add_action('init', array('MyCar', 'loadFile'));
        add_action('init', function () {
            $param1 = 'MyCar';
            LoadFile::CSS($param1);
        });
        add_action('init', function () {
            $param1 = 'MyCar';
            $param2 = 'main.js';
            LoadFile::JS($param1, $param2);
        });

        add_action('wp_loaded', array('CarDatabase', 'saveForm'), 1);
        add_action('wp_loaded', array($this, 'displayFlashMessage'), 2);
    }



    public function displayFlashMessage()
    {
        $session = new CarSession();
        $flashMessage = $session->getMessage();

        if ($flashMessage !== false) {
            echo '<div>
                    <p class="flashMessage' . $flashMessage['type'] . '" >
                    ' . $flashMessage["message"] . '
                    </p>
                 </div';
        }

        $flashMessage = $session->destroyMySession();
    }

    // public static function loadFile()
    // {
    //     //prépare l'enregistrement d'un fichier de style
    //     wp_register_style('MyCar', plugins_url('style.css', __FILE__));
    //     //ajoute les fichiers CSS à la file d'attente de styles à charger par le thème dans le <head>
    //     wp_enqueue_style('MyCar');
    // }
}


new MyCar();
