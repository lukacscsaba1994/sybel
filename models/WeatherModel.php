<?php

class WeatherModel {
    private $conn;
    private $nowDateTime;

    public function __construct($conn) {
        $this->conn = $conn;
        $this->nowDateTime = date('Y-m-d H:i:s');
    }

    public function insertWeather($data) {
        $sql = "INSERT INTO `weather`
            (`id`, `cityId`, `temperature`, `timestamp`) 
            VALUES 
            (NULL, :cityId, :temperature, :timestamp)";
        $stmt = $this->conn->prepare($sql);
        $stmt->execute([
            ':cityId' => $data['cityId'],
            ':temperature' => $data['temperature'],
            ':timestamp' => $this->nowDateTime,
        ]);

        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function selectWeatherData($cityId = null){
        $sql = "SELECT * FROM weather";
        $data = [];

        if($cityId !== null){
            $sql .= " WHERE cityId = :cityId";
            $data[':cityId'] = $cityId;
        }
        
        $stmt = $this->conn->prepare($sql);
        $stmt->execute($data);

        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }
}

?>
