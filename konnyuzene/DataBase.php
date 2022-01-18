<?php
class DataBase{
    private $dbh = NULL;
    const SERVER = "localhost";
    const USER = "root";
    const PASSWORD = "";
    const SCHEMA = "albumok";
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

    public function getAlbum(string $szures_eloado = NULL, string $szures_cim = NULL){
        $albumok =[];
    try{
        $sql = "SELECT e.nev, a.id, a.cim, a.eloado_id, a.kiadas_eve, a.kis_borito, a.nagy_borito ". 
        "FROM album a, eloado e ". 
        "WHERE a.eloado_id=e.id ";
        
        if($szures_eloado !==NULL){
            $sql .=  "AND e.nev LIKE '%".$szures_eloado."%'";
        }
        if($szures_cim !==NULL){
            $sql .=  "AND a.cim LIKE '%".$szures_cim."%'";
        }
        $stmt = $this->dbh->query($sql);

        while($row = $stmt->fetch(PDO::FETCH_ASSOC)){
            $albumok[]= new Album(new Eloado($row["eloado_id"],$row["nev"]), $row["id"], $row["cim"], (int)$row["kiadas_eve"], $row["kis_borito"],$row["nagy_borito"]);
        }

        return $albumok;
    }
    catch(PDOException $e){
        $this->error("Nem lehetett az adatpkat lekérdezni",$e);
    }
    }

    public function getDalok(string $albumid){
        $dalok=[];
        try{
            $stmt = $this->dbh->query("SELECT id, album_id, sorszam, cim, hossz, szoveg FROM dal WHERE album_id='".$albumid."'");
            while($row = $stmt->fetch(PDO::FETCH_ASSOC)){
                $dalok[]= new Dal( $row["id"], $row["album_id"], $row["sorszam"], $row["cim"],$row["hossz"],$row["szoveg"]);
            }
    
            return $dalok;
        }
        catch(PDOException $e){
            $this->error("Nem lehetett az adatpkat lekérdezni",$e);
        }
        }


    public function getBoritok(string $albumid){
        
        try{
            $sql = "SELECT a.id, a.kis_borito, a.nagy_borito ". 
            "FROM album a ". 
            "WHERE a.id='".$albumid."'";           
            
            $stmt = $this->dbh->query($sql);
    
            $row = $stmt->fetch(PDO::FETCH_ASSOC);
            $albumok= new Album(NULL, $row["id"], NULL, NULL, $row["kis_borito"],$row["nagy_borito"]);
            
    
            return $albumok;
        }
        catch(PDOException $e){
            $this->error("Nem lehetett az adatpkat lekérdezni",$e);
        }
    }
    public function getSzoveg($albumid,$sorszam){
        try{
            
            $stmt = $this->dbh->query("SELECT dal.id, dal.cim, dal.szoveg, dal.album_id, eloado.nev FROM eloado INNER JOIN album ON album.eloado_id=eloado.id INNER JOIN dal ON dal.album_id=album.id WHERE dal.album_id='".$albumid."' AND dal.sorszam='".$sorszam."'");
            $row = $stmt->fetch(PDO::FETCH_ASSOC);
                $dal= new Dal( $row["id"], $row["album_id"],0, $row["cim"],0,$row["szoveg"],new Eloado(0,$row["nev"]));
            
    
            return $dal;
        }
        catch(PDOException $e){
            $this->error("Nem lehetett az adatpkat lekérdezni",$e);
        }
    }    




}
    

?>