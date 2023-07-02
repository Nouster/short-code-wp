<?php

class CarSession
{
    public function __construct()
    {
        if (session_status() == PHP_SESSION_NONE) {
            session_start();
        }
    }

    public function createMessage($type, $message)
    {
        $_SESSION['my-formulaire'] =
            [
                'type'    => $type,
                'message' => $message
            ];
    }

    public function getMessage()
    {
        return isset($_SESSION['my-formulaire']) && count($_SESSION['my-formulaire']) > 0 ? $_SESSION['my-formulaire'] : false;
    }

    public function destroyMySession()
    {
        $_SESSION['my-formulaire'] = array();
    }
}
