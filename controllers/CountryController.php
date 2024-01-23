<?php

class CountryController {
    private $countryModel;

    public function __construct() {
        require_once(__DIR__ . '/../db_connection.php');
        require_once('models/CountryModel.php');
        require_once('controllers/CommonHelperController.php');

        $database = new Database();
        $conn = $database->getConnection();

        $this->countryModel = new CountryModel($conn);
    }

    public function getAllCountry() {
        return $this->countryModel->getAllCountries();
    }
}

?>
