<?php

class IndexController {
    public function index($name) {
        require_once('controllers/CountryController.php');
        require_once('controllers/CommonHelperController.php');

        $helper = new CommonHelperController();

        $countriesController = new CountryController();
        $countries = $countriesController->getAllCountry();

        require_once('views/index.php');
    }
}

?>
