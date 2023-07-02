<?php

require_once 'ShortCodeCar.php';

class CarWidget extends WP_Widget
{
    public function __construct()
    {
        parent::__construct('CarWidget', 'CarWidget', ['description' => 'Formulaire d\ajout de véhicule']);
    }

    public function widget($args, $instance)
    {
        $form = new ShortCodeCar();
        echo $args['before_widget'];
        echo $args['before_title'];
        echo $args['after_title'];
        echo $form->shortCodeCar();
    }

    // public function form($instance)
    // {
    //     $title = isset($instance['title']) ? $instance['title'] : 'My car widget'; //vérifie s'il existait un paramètre title et le récupère dans la variable sinon attribue une chaîne de caractère vide

    //     echo ('<p>
    //         <label for="' . $this->get_field_id('title') . '">
    //             Titre :
    //         </label>
    //         <input class="widefat" id="' . $this->get_field_id('title') . '" name="' . $this->get_field_name('title') . '" type="text" value="' . $title . '" />
    //     </p>');
    // }
}
