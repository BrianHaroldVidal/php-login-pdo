<?php
class ondatabase {
    private $hostdb = "localhost";
    private $userdb = "root";
    private $passdb = "";
    private $namedb = "realtysystem";
    public $pdo;
    public function __construct(){
        if(!isset($this->pdo)){
            try{
                 $link = new PDO('mysql:host='.$this->hostdb.';dbname='.$this->namedb,$this->userdb,$this->passdb);
                 $this->pdo = $link;
            }catch(PDOException $e){
               die("Failed To Connect With Database".$e->getMessage());
            }
        }
    }
}