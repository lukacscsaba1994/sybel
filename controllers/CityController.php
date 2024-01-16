<?php

class CityController {
    private $cityModel;
    private $helper;

    public function __construct() {
        require_once(__DIR__ . '/../db_connection.php');
        require_once('models/CityModel.php');
        require_once('controllers/CommonHelperController.php');

        $database = new Database();
        $conn = $database->getConnection();

        $this->cityModel = new CityModel($conn);
        $this->helper = new CommonHelperController();
    }

    public function getCitiesByCountry($countryId) {
        $countries = $this->cityModel->getCitiesByCountry($countryId);
        
        echo json_encode($countries, JSON_FORCE_OBJECT);    
    }
}

?>
