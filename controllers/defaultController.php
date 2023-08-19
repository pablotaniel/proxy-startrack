<?php

class defaultController
{
    public function unknow(){
        header("HTTP/1.0 400 Bad Request");
        echo "Unkown Controller";
    }
}


?>