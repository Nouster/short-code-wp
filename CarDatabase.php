<?php

require_once 'CarSession.php';
class CarDatabase
{
    public function __construct()
    {
    }


    public static function createTable(): void
    {

        global $wpdb;
        $wpdb->query("CREATE TABLE IF NOT EXISTS {$wpdb->prefix}car (
            id INT AUTO_INCREMENT PRIMARY KEY,
            fullname VARCHAR(191) NOT NULL,
            car_brand VARCHAR(191) NOT NULL,
            car_model VARCHAR(191) NOT NULL,
            color VARCHAR(191) NOT NULL,
            manufacturing_year VARCHAR(191) NOT NULL,
            licence_plate VARCHAR(191) NOT NULL,
            registration_year Date NOT NULL
        )");
    }

    public static function dropTable(): void
    {
        global $wpdb;
        $wpdb->query("DROP TABLE IF EXISTS {$wpdb->prefix}car;");
    }

    public static function saveForm(): void
    {
        $session = new CarSession();
        global $wpdb;

        if (isset($_POST['submit_car'])) {
            $requiredFields = ['full_name', 'brand', 'modele', 'color', 'year', 'licence_plate'];
            $missingFields = [];

            foreach ($requiredFields as $field) {
                if (!isset($_POST[$field]) || empty($_POST[$field])) {
                    $missingFields[] = $field;
                }
            }

            if (empty($missingFields)) {

                $fullname = $_POST['full_name'];
                $brand = $_POST['brand'];
                $modele = $_POST['modele'];
                $color = $_POST['color'];
                $year = $_POST['year'];
                $plate = $_POST['licence_plate'];

                $data = [
                    'fullname' => $fullname,
                    'car_brand' => $brand,
                    'car_model' => $modele,
                    'color' => $color,
                    'manufacturing_year' => $year,
                    'licence_plate' => $plate,
                    'registration_year' => date('Y-m-d')
                ];


                $result = $wpdb->insert("{$wpdb->prefix}car", $data);
                if ($result === false) {
                    $session->createMessage('error', 'Une erreur est survenue : ' . $wpdb->last_error);
                } else {
                    $session->createMessage('success', 'Enregistrement effectué avec succès');
                }
            } else {
                $session->createMessage('partialError', 'Veuillez renseigner tous les champs : ' . implode(', ', $missingFields));
            }
        }
    }


    public static function getAllCars(): array
    {
        global $wpdb;

        /**
         * get_results retourne les lignes sélectionnées par la requête
         */
        $cars = $wpdb->get_results("SELECT * FROM {$wpdb->prefix}car");

        return $cars;
    }

    public static function getNewestCar(): object
    {
        global $wpdb;
        $newestCar = $wpdb->get_row("SELECT * FROM {$wpdb->prefix}car ORDER BY {$wpdb->prefix}car.manufacturing_year DESC, registration_year DESC LIMIT 1;");

        return $newestCar;
    }
}
