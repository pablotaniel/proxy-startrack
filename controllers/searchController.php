<?php
require_once(__DIR__ .'/../models/searches.php');

class searchController
{
    private $searchesModel;
    public function __construct(PDO $conn){
        $this->searchesModel = new searches($conn);
    } 


    public function default(){
        $ch = curl_init();
        $filteredData = array();
        $finalData = array();
        
        
        $baseUrl = 'https://api.stackexchange.com/2.3/search';
        
        
        if(!isset($_GET['page']) ||!isset($_GET['size']) || !isset($_GET['query'])){
            header("HTTP/1.0 400 Bad Request");
            echo "Must be enter page, size y query";
        return;
        }
        
        $params = array(
            'page' =>  $_GET['page'],
            'pagesize' =>  $_GET['size'],
            'intitle' => $_GET['query'],
            'site'=>'stackoverflow'
        );
        
        $initTime = microtime(true);

        $cacheKey = md5($baseUrl . '_params_' . json_encode($params));
        $cacheDirectory = 'cache/';
        
        
        
        $cachedData = @file_get_contents($cacheDirectory . $cacheKey . '.json');
        
        if ($cachedData !== false) {
            $response = $cachedData;
        } 
        
        else{
        $apiUrl = $baseUrl . '?' . http_build_query($params);
        curl_setopt($ch, CURLOPT_URL, $apiUrl);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true); 
        curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false); 
        curl_setopt($ch, CURLOPT_ENCODING, ''); 
        $response = curl_exec($ch);
        }
        
        
        if ($response === false) {
            header("HTTP/1.0 500 internal error server");
            echo 'Error on  cUR requestL: ' . curl_error($ch);
            return;
        }
        
        curl_close($ch);
        
            header('Content-Type: application/json; charset=utf-8');
            
            $jsonData = json_decode($response);

            if ($jsonData === null) {
                header("HTTP/1.0 500 internal error server");
                echo 'Cannot covert json';
                return;

            }
        
            if ($jsonData !== null) {
                $i=0;
        
                foreach ($jsonData->items as $item) {
                $filteredData['title'] = isset($item->title)? $item->title : null;
                $filteredData['answer_count'] = isset($item->answer_count)? $item->answer_count : null;
                $filteredData['username'] = isset($item->owner->display_name)? $item->owner->display_name : null;
                $filteredData['profile_image'] = isset($item->owner->profile_image)? $item->owner->profile_image: null;
                $i++;
                $finalData[$i]= $filteredData;
            }
        
            $finTime = microtime(true);
             $timeResponse = ($finTime - $initTime)*1000;

                $in = $this->searchesModel->insert($_GET['page'], $_GET['size'],$_GET['query'],$timeResponse);
                if (!$in){
                    header("HTTP/1.0 500 internal error server");
                    echo 'Cannot insert statistic';
                    return;
                }
        
                
                echo json_encode($finalData);
                file_put_contents($cacheDirectory . $cacheKey . '.json', $response);
        
        
        
            } 
        



    }
}

?>