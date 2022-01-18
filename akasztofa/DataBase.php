<?php
class DataBase{
    private $dbh = NULL;
    const SERVER = "localhost";
    const USER = "root";
    const PASSWORD = "";
    const SCHEMA = "akasztofa";
    //const EXAMINEE = "H7NG5S";

    public function __construct(){
        try{
            $this->dbh = new PDO("mysql:host=".self::SERVER.";dbname=".self::SCHEMA, self::USER, self::PASSWORD);
            $this->dbh->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            
        } catch(PDOException $e) {
            die("Unable to connect to the database. Error code: {$e->getCode()}, error message: {$e->getMessage()}");
            
        }
    }
    public function __destruct()
    {
        $this->dbh = NULL;
    }
    protected function error($m, $e){
        echo "<p>$m<br /> PDO error code: {$e->getCode()}, error message: {$e->getMessage()} </p>\n";
    }
    //függvények
    




    public function leKer(){
        $feladvanyok =[];
        try{
            $sql = "SELECT id, feladvany FROM feladvany ";           
            
            $stmt = $this->dbh->query($sql);
    
            while($row = $stmt->fetch(PDO::FETCH_ASSOC)){
            $feladvanyok[]= new Feladvany((int)$row["id"], $row["feladvany"]);
            }
            
    
            return $feladvanyok;
        }
        catch(PDOException $e){
            $this->error("Nem lehetett az adatokat lekérdezni",$e);
        }
    }
}