<?php
class DataBase{
    private $dbh = NULL;
    const SERVER = "localhost";
    const USER = "root";
    const PASSWORD = "";
    const SCHEMA = "alkatreszek";
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
    

    public function getTermekek(string $id=null){
        $termekek = [];
        try{
            $sql="SELECT * FROM termek";            
            if($id !==NULL){
                $sql .=  " WHERE id='".$id."'";
            }
            $stmt = $this->dbh->query($sql);
            while($s = $stmt->fetchObject("Termek")) {
                $termekek[] = $s;
            }
            return $termekek;
        }catch(PDOException $e){
            $this->error("Unable to query  data",$e);
        } 
    }

    
    public function getTulajdonsag(string $id=null){
        $tulajdonsagok = [];
        try{
            $sql="SELECT * FROM tulajdonsagok";            
            if($id !==null){
                $sql .=  " WHERE termek_id='".$id."'";
            }
            $stmt = $this->dbh->query($sql);
            while($s = $stmt->fetchObject("Tulajdonsagok")) {
                $tulajdonsagok[] = $s;
            }
            return $tulajdonsagok;
        }catch(PDOException $e){
            $this->error("Unable to query  data",$e);
        } 
    }

    

    public function getTulajdonsagGroup(){
        $tulajdonsagok = [];
        try{
            $sql="SELECT * FROM tulajdonsagok GROUP BY tulajdonsag";            
           
            $stmt = $this->dbh->query($sql);
            while($s = $stmt->fetchObject("Tulajdonsagok")) {
                $tulajdonsagok[] = $s;
            }
            return $tulajdonsagok;
        }catch(PDOException $e){
            $this->error("Unable to query  data",$e);
        } 
    }

    

    public function getErtekek(string $tulajdonsag){
        $ertekek = [];
        try{
            $sql="SELECT * FROM tulajdonsagok";            
            if($tulajdonsag !==null){
                $sql .=  " WHERE tulajdonsag='".$tulajdonsag."' GROUP BY ertek";
            }
            $stmt = $this->dbh->query($sql);
            while($s = $stmt->fetchObject("Tulajdonsagok")) {
                $tulajdonsagok[] = $s;
            }
            return $tulajdonsagok;
        }catch(PDOException $e){
            $this->error("Unable to query  data",$e);
        } 
    }

    public function geTermekSzurt(array $tulajdonsagok=null){
        $termekek = [];
        try{
            $sql="SELECT termek.id, termek.gyarto, termek.modell FROM termek, tulajdonsagok WHERE termek.id=tulajdonsagok.termek_id ";            
           foreach($tulajdonsagok as $kulcs=>$ertek){
            $sql .=  " AND tulajdonsagok.tulajdonsag='".$kulcs."' AND tulajdonsagok.ertek='".$ertek."'";
           }
            $stmt = $this->dbh->query($sql);
            while($s = $stmt->fetchObject("Termek")) {
                $termekek[] = $s;
            }
            return $termekek;
        }catch(PDOException $e){
            $this->error("Unable to query  data",$e);
        } 
    }

}