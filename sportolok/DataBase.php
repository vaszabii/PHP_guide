<?php
class DataBase{
    private $dbh = NULL;
    const SERVER = "localhost";
    const USER = "root";
    const PASSWORD = "";
    const SCHEMA = "sportolok";
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

    public function getSportolo(){
        $sportolok =[];
        try{
            $sql = "SELECT id, nev FROM felhasznalok ";           
            
            $stmt = $this->dbh->query($sql);
    
            while($row = $stmt->fetch(PDO::FETCH_ASSOC)){
            $sportolok[]= new Felhasznalo((int)$row["id"], $row["nev"]);
            }
            
    
            return $sportolok;
        }
        catch(PDOException $e){
            $this->error("Nem lehetett az adatokat lekérdezni",$e);
        }
    }


    public function tevekenysegFelhasznalo(int $felhasznalo, int $ev, int $honap){
        $tevekenysegek =[];
        try{
            $sql = "SELECT f.id, f.nev, t.id, t.tevekenyseg, t.tavolsag, t.ev, t.honap, t.nap FROM tevekenysegek t, felhasznalok f WHERE t.felhasznalo_id=".$felhasznalo." AND f.id=t.felhasznalo_id AND t.ev=".$ev." AND t.honap=".$honap;           
            
            $stmt = $this->dbh->query($sql);
            if($stmt->rowCount()==0){
                return false;
            }else{
                while($row = $stmt->fetch(PDO::FETCH_ASSOC)){
                $tevekenysegek[]= new Tevekenyseg(new Felhasznalo((int)$row["id"], $row["nev"]), $row["id"], (int)$row["tevekenyseg"], (float)$row["tavolsag"], $row["ev"],$row["honap"],$row["nap"]);
            }
        }   
            
    
            return $tevekenysegek;
        }
        catch(PDOException $e){
            $this->error("Nem lehetett az adatokat lekérdezni",$e);
        }
    }

    public function tevekenysegSportok(){
        $tevekenysegek =[];
        try{
            $sql = "SELECT t.id, t.tevekenyseg, t.tavolsag FROM tevekenysegek t" ;           
            
            $stmt = $this->dbh->query($sql);
            
            while($row = $stmt->fetch(PDO::FETCH_ASSOC)){
            $tevekenysegek[]= new Tevekenyseg(null, $row["id"], (int)$row["tevekenyseg"], (float)$row["tavolsag"]);
            }
          
            
    
            return $tevekenysegek;
        }
        catch(PDOException $e){
            $this->error("Nem lehetett az adatokat lekérdezni",$e);
        }
    }

    public function add($adat):bool{
        try{
            $ar = $this->dbh->exec(
                "INSERT INTO tevekenysegek(id, felhasznalo_id, tevekenyseg, tavolsag, ev, honap, nap) VALUES( DEFAULT,". (int)$adat["felhasznalo"].",". $adat["tevekenyseg"].
                ",".$adat["tavolsag"].",".$adat["ev"].",".$adat["honap"].",".$adat["nap"]." )"); 
            return $ar===1;  
        }catch(PDOException $e){
            $this->error("Unable to apply for the test.",$e);
        }
    }
    












}
    

?>