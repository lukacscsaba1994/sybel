<?php

class CronModel {
    private $conn;
    private $nowDateTime;

    public function __construct($conn) {
        $this->conn = $conn;
        $this->nowDateTime = date('Y-m-d H:i:s');
    }

    public function insertNewCron($data) {
        $sql = "INSERT INTO `cron`
            (`id`, `endpoint`, `cronString`, `isActive`, `createdAt`, `lastModifiedAt`) 
            VALUES 
            (NULL, :endpoint, :cronString, :isActive, :createdAt, :lastModifiedAt)";

        $data[':createdAt'] = $this->nowDateTime;
        $data[':lastModifiedAt'] = $this->nowDateTime;

        $stmt = $this->conn->prepare($sql);
        $stmt->execute($data);

        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function getCron($cronId = null){
        $sql = "SELECT * FROM cron";
        $data = [];

        if($cronId !== null){
            $sql .= " WHERE id = :id";
            $data[':id'] = $cronId;
        }
        
        $stmt = $this->conn->prepare($sql);
        $stmt->execute($data);

        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function deleteCron($cronId){
        $sql = "DELETE FROM cron WHERE id = :id";
   
        
        $stmt = $this->conn->prepare($sql);
        $stmt->execute([
            ':id' => $cronId
        ]);

        return true;
    }

    public function updateCron($data){
        $data[':lastModifiedAt'] = $this->nowDateTime;

        $sql = "UPDATE cron SET cronString = :cronString, lastModifiedAt = :lastModifiedAt WHERE id = :id";
        
        $stmt = $this->conn->prepare($sql);
        $stmt->execute($data);
    }
}

?>
