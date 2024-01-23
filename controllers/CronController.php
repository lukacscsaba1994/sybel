<?php

class CronController {
    private $countryModel;

    public function __construct() {
        require_once(__DIR__ . '/../db_connection.php');
        require_once('models/CronModel.php');
        require_once('controllers/CommonHelperController.php');

        $database = new Database();
        $conn = $database->getConnection();

        $this->CronModel = new CronModel($conn);
        $this->helper = new CommonHelperController();
    }

    public function insertNewCron() {
        $data = [
            ':endpoint' => $this->generateEndpoint($_POST['city']),
            ':cronString' => $_POST['cronString'],
            ':isActive' => 1,
        ];

        $this->CronModel->insertNewCron($data);

        // Redirect back to the index
        header('Location: index.php?alert=success');
        exit();
    }

    private function generateEndpoint($cityId){
        return "index.php?controller=Weather&action=getWeather&param=" . urlencode($cityId);
    }

    public function getCron($cronId = null){
        return $this->CronModel->getCron($cronId);
    }

    public function deleteCron($cronId){
        $this->CronModel->deleteCron($cronId);
    }

    public function editCron($cronId){
        $cron = $this->getCron($cronId)[0];

        require_once('views/editCron.php');
    }

    public function updateCron(){
        $data = [
            ':id' => $_POST['cronId'],
            ':cronString' => $_POST['cronString'],
        ];

        $this->CronModel->updateCron($data);

        header('Location: index.php?alert=success');
        exit();
    }
}

?>
