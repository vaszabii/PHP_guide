<?php
class DataBase{
    private $dbh = NULL;
    const SERVER = "localhost";
    const USER = "root";
    const PASSWORD = "";
    const SCHEMA = "varosok";
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
    public function getVarosok(){
        $varosok = [];
        try{
            $sql="SELECT * FROM varosok";            

            $stmt = $this->dbh->query($sql);
            while($s = $stmt->fetchObject("Varosok")) {
                $varosok[] = $s;
            }
            return $varosok;
        }catch(PDOException $e){
            $this->error("Unable to query  data",$e);
        } 
    }

    public function getTavolsag(int $id1, int $id2){
        $tavolsagok = [];
        try{
            $sql="SELECT * FROM tavolsagok WHERE (v1='".$id1."' AND v2='".$id2."') OR (v2='".$id1."' AND v1='".$id2."')";            

            $stmt = $this->dbh->query($sql);
            while($s = $stmt->fetchObject("Tavolsagok")) {
                $tavolsagok[] = $s;
            }            
            return $tavolsagok;
        }catch(PDOException $e){
            $this->error("Unable to query  data",$e);
        } 
    }




}