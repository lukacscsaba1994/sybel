<?php

class WeatherController {
    private $weatherModel;
    private $helper;
    private $cityController;

    public function __construct() {
        require_once(__DIR__ . '/../db_connection.php');
        require_once('models/WeatherModel.php');
        require_once('controllers/CommonHelperController.php');
        require_once('controllers/CityController.php');

        $database = new Database();
        $conn = $database->getConnection();

        $this->weatherModel = new WeatherModel($conn);
        $this->helper = new CommonHelperController();
        $this->cityController = new CityController();
    }

    public function getWeather($cityId){
        $city = $this->cityController->getCityById($cityId);

        if(count($city) != 1){
            return "There is no valid city with id: " . $cityId;
        }

        $lat = $city[0]['lat'];
        $long = $city[0]['long'];

        $url = "https://api.open-meteo.com/v1/forecast?latitude={$lat}&longitude={$long}&current=temperature";
        $response = json_decode(file_get_contents($url));

        $data = [
            'cityId' => $cityId,
            'temperature' => $response->current->temperature,
        ];

        $this->weatherModel->insertWeather($data);

        die("Data successfully collected!");
    }

    public function ajaxGetCollectedDataForCity($cityId){
        $data = $this->weatherModel->selectWeatherData($cityId);

        if(empty($data)){
            echo json_encode(['error' => 1, 'msg' => "There is no data collected for this city"]);
            exit();
        } else {
            echo json_encode($data);
            exit();
        }
    }
}



?>
