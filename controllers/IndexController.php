<?php

class IndexController {
    private $countriesController;
    private $cronController;
    private $helper;
    private $cityController;

    public function __construct() {
        require_once('controllers/CountryController.php');
        require_once('controllers/CronController.php');
        require_once('controllers/CommonHelperController.php');
        require_once('controllers/CityController.php');

        $this->helper = new CommonHelperController();
        $this->countriesController = new CountryController();
        $this->cronController = new CronController();
        $this->cityController = new CityController();
    }

    public function index($name) {
        $countries = $this->countriesController->getAllCountry();
        $cronList = $this->getCityNameFromEndpoint($this->cronController->getCron());

        require_once('views/index.php');
    }

    public function getCityNameFromEndpoint($cronList){
        foreach($cronList as &$cron){
            $tmp = explode("param=", $cron['endpoint']);
            $cron['cityName'] = $this->cityController->cityIdToName($tmp[1]);
            $cron['cityId'] = $tmp[1];
        }
        return $cronList;
    }
}

?>
