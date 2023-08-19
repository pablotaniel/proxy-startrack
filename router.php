<?php

class Router {
    private $controller;
    private $method;

    public function __construct(){
        $this -> matchRoute();
    }

    public function matchRoute(){
        $url = explode ('/', URL);
        $this-> controller = !empty($url[1])? $url[1]: "defaultController";
        $this-> controller = explode('?', $this->controller)[0];
        $this-> method =  !empty($url[2])? $url[2]: "default";
        $this-> method = explode('?', $this->method)[0];

        
        $this-> controller = $this-> controller .'Controller';

        $controllerFile = __DIR__ . '/controllers/' . $this-> controller. '.php';



        if (!file_exists( $controllerFile)){
            header("HTTP/1.0 400 Bad Request");
            require_once(__DIR__ . '/controllers/defaultController.php');
            $this-> controller = "defaultController";
            $this-> method = "unknow";
            return;
        };

        
        require_once($controllerFile);
        return;       
    }

    public function run (){
        $database = new database();
        $conn = $database->getConnection();
        $controller = new  $this-> controller($conn);
        $method= $this-> method;
        if (method_exists($controller , $method)){
            $controller->$method();
            return;
        }
        header("HTTP/1.0 400 Bad Request");
        echo "Ukwnown Method.";


        
    }

}