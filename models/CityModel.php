<?php

class CityModel {
    private $conn;

    public function __construct($conn) {
        $this->conn = $conn;
    }

    public function getCitiesByCountry($countryId) {
        $sql = "SELECT * FROM cities WHERE country_id = :countryId";
        $stmt = $this->conn->prepare($sql);
        $stmt->execute([
            ':countryId' => $countryId,
        ]);

        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function getCities($cityId) {
        $sql = "SELECT * FROM cities";
        $data = [];

        if($cityId !== null){
            $sql .= " WHERE id = :id";
            $data[':id'] = $cityId;
        }
        
        $stmt = $this->conn->prepare($sql);
        $stmt->execute($data);

        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }
}

?>
