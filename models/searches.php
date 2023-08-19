<?php
class searches extends orm{
    public function __construct(PDO $connection){
        parent:: __construct("id", "searches", $connection);
    }



    public function getbyDateTime($initDateTime, $finDateTime){
        $stm = $this-> db -> prepare("SELECT * FROM {$this->table} WHERE date_time BETWEEN '{$initDateTime}' AND '{$finDateTime}'");
        $stm-> execute();
        return $stm-> fetchAll();

    }

    public function combinations(){
        if(!isset($_GET['page']) && !isset($_GET['size']) && !isset($_GET['query'])){
            $stm = $this-> db -> prepare("SELECT page, size, query, count(query) AS Total, AVG(time_of_request) AS PROM FROM searches GROUP BY page, size, query;");
        }
        
        if(isset($_GET['page']) && isset($_GET['size']) && isset($_GET['query'])){
            $stm = $this-> db -> prepare("SELECT page, size, query, count(query) AS Total, AVG(time_of_request) AS PROM 
            FROM searches  WHERE page= {$_GET['page']} AND size= {$_GET['size']} AND query='{$_GET['query']}' GROUP BY page, size, query;");
        }
        

        $stm-> execute();
        return $stm-> fetchAll();

    }

    public function insert($page, $size, $query, $timeRequest){
        $stm = $this-> db -> prepare("INSERT INTO searches (page, size, query, time_of_request) VALUES ({$page}, {$size}, '{$query}', {$timeRequest})");
        $stm-> execute();
        return true;
    }
}
?>