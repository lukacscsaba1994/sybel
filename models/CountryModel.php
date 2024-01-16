<?php

class CountryModel {
    private $conn;

    public function __construct($conn) {
        $this->conn = $conn;
    }

    public function getAllCountries() {
        $sql = "SELECT * FROM countries";
        $stmt = $this->conn->prepare($sql);
        $stmt->execute();

        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }
}

?>
