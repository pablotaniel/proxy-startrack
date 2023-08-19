<?php

class orm {
    protected $id;
    protected $table;    
    protected $db;

    public function __construct($id, $table, PDO $connection){
        $this -> id = $id;
        $this -> table = $table;
        $this -> db = $connection;
    }

    public function getAll(){
        $stm = $this-> db -> prepare("SELECT * FROM {$this->table}");
        $stm-> execute();
        return $stm-> fetchAll();

    }


}