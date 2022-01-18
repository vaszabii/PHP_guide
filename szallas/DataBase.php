<?php
class DataBase{
    private $dbh = NULL;
    const SERVER = "localhost";
    const USER = "root";
    const PASSWORD = "";
    const SCHEMA = "szallas";
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


    public function  getSzallas(int $szallasid=null){
        $szallasok = [];
        try{
            $sql="SELECT id, nev, leiras FROM szallashely ";
            if($szallasid !==NULL){
                $sql .=  "WHERE id ='".$szallasid."'";
            }

            $stmt = $this->dbh->query($sql);
            while($s = $stmt->fetchObject("Szallashely")) {
                $szallasok[] = $s;
            }
            return $szallasok;
        }catch(PDOException $e){
            $this->error("Unable to query   data",$e);
        } 
    }




    public function getSzobak( int $szallas_id, string $mettol, string $meddig){
        $szobak = [];
        try{
            $sql="SELECT foglalasok.id, foglalasok.mettol, foglalasok.meddig, szoba.id, szallashely_id, ferohely, szezon, kivul ". 
            "FROM szoba LEFT JOIN foglalasok ON szoba.id=foglalasok.szoba_id WHERE szallashely_id='".$szallas_id."' AND ((f.mettol>='".$meddig."' OR f.meddig<='".$mettol."') OR (f.meddig IS NULL AND f.mettol IS NULL))";           

            $stmt = $this->dbh->query($sql);
            while($row = $stmt->fetch(PDO::FETCH_ASSOC)){                  
                $szobak[] = new Szoba(new Foglalas($row["id"], null,$row["mettol"],$row["meddig"]), $row["id"], $row["szallashely_id"], $row["ferohely"],
                $row["szezon"], $row["kivul"]);
            }
            return $szobak;
        }catch(PDOException $e){
            $this->error("Unable to query   data",$e);
        } 
    }

    public function  getSzoba(int $szallasid=null){
        $szobak = [];
        try{
            $sql= "SELECT id, szallashely_id, ferohely, szezon, kivul FROM szoba WHERE szallashely_id=".$szallasid."";
          

            $stmt = $this->dbh->query($sql);
            while($row = $stmt->fetch(PDO::FETCH_ASSOC)){                  
                $szobak[] = new Szoba(null, $row["id"], $row["szallashely_id"], $row["ferohely"],
                $row["szezon"], $row["kivul"]);
            }
            return $szobak;
        }catch(PDOException $e){
            $this->error("Unable to query   data",$e);
        } 
    }

    public function getFoglalt(int $szallas_id){
        $foglalas = [];
        try{
            $sql="SELECT foglalasok.id, szoba_id, mettol, meddig FROM foglalasok, szoba WHERE foglalasok.szoba_id=szoba.id AND szoba.szallashely_id=".$szallas_id."";
            

            $stmt = $this->dbh->query($sql);
            while($s = $stmt->fetchObject("Foglalas")) {
                $foglalas[] = $s;
            }
            return $foglalas;
        }catch(PDOException $e){
            $this->error("Unable to query  data",$e);
        } 
    }

    

    public function ujFoglalas(int $szobaid, string $mettol, string $meddig):bool{
        try{
            $ar = $this->dbh->exec("INSERT INTO foglalasok(id, szoba_id, mettol, meddig) VALUES (DEFAULT, '".$szobaid."', \"".$mettol."\", \"".$meddig."\")"); 
            return $ar===1;  
        }catch(PDOException $e){
            $this->error("Unable to upload.",$e);
        }
    }



   





}