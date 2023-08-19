<?php


require_once(__DIR__ .'/../models/searches.php');

class statisticsController
{
    private $searchesModel;
    public function __construct(PDO $conn){
        $this->searchesModel = new searches($conn);
    } 
    public function default(){
        echo "estoy en estadisticas";
    }


    public function list(){
        if(!isset($_GET['initDateTime']) && !isset($_GET['finDateTime'])){
             $data = $this->searchesModel->getAll();
            echo json_encode($data);
        }

        $data = $this->searchesModel->getByDateTime($_GET['initDateTime'], $_GET['finDateTime']);
        echo json_encode($data);
    }
    public function combinations(){
        $data = $this->searchesModel->combinations();
        echo json_encode($data);
    }
}

?>