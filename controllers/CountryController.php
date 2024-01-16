<?php

class CountryController {
    private $countryModel;

    public function __construct() {
        require_once(__DIR__ . '/../db_connection.php');

        $database = new Database();
        $conn = $database->getConnection();

        require_once('models/CountryModel.php');
        $this->countryModel = new CountryModel($conn);
    }

    public function getAllCountry() {
        return $this->countryModel->getAllCountries();
    }
}

?>
