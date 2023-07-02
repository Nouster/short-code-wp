<?php

class LoadFile
{
    public function __construct()
    {
    }

    public static function CSS(string $handle)
    {
        //prépare l'enregistrement d'un fichier de style
        wp_register_style($handle, plugins_url('style.css', __FILE__));
        //ajoute les fichiers CSS à la file d'attente de styles à charger par le thème dans le <head>
        wp_enqueue_style($handle);
    }

    public static function JS(string $handle, string $filename)
    {
        wp_register_script($handle, plugins_url($filename, __FILE__));
        wp_enqueue_script($handle);
    }
}
