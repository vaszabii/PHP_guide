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
    //egy függvényben több lekérdezés(where-ben eltérés)
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
            $this->error("Nem lehetett az adatokat lekérdezni",$e);
        }
    }

    //fetch(pdo::assoc)
        
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

    //fetchobject

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

    //execute, insert into
    
    public function ujFoglalas(int $szobaid, string $mettol, string $meddig):bool{
        try{
            $ar = $this->dbh->exec("INSERT INTO foglalasok(id, szoba_id, mettol, meddig) VALUES (DEFAULT, '".$szobaid."', \"".$mettol."\", \"".$meddig."\")"); 
            return $ar===1;  
        }catch(PDOException $e){
            $this->error("Unable to upload.",$e);
        }
    }
    //execute, delete
    public function clearApplication(string $neptun) : bool{
        try{
            $ar = $this->dbh->exec(
                "DELETE FROM jelentkezesek WHERE neptun='$neptun' AND vizsgazo='".self::EXAMINEE."'" ); 
            return $ar===1;  
        }catch(PDOException $e){
            $this->error("Unable to delete.",$e);
        }
    }

    //keresés bool, rowcount
    public function getElotanulmanyok(string $targykod=null){
        $targyak = [];
        try{
            $sql="SELECT elotanulmany.kod, kotelezo.kod, kotelezo.megnevezes, kotelezo.af FROM elotanulmany, kotelezo WHERE elotanulmany.kod=\"".$targykod."\" AND kotelezo.kod=elotanulmany.elotanulmany";

            $stmt = $this->dbh->query($sql);
            if($stmt->rowCount()==0){
                return false;
            }else{
             while($row = $stmt->fetch(PDO::FETCH_ASSOC)){
                $targyak[]= new Elotanulmanyok( $row["kod"],new Kotelezo($row["kod"],$row["megnevezes"],$row["af"]));
            }
        }
            return $targyak;
        }catch(PDOException $e){
            $this->error("Unable to query  data",$e);
        } 
    }

    //egész POST tömb átadásával adatfeltöltés
    public function add($adat):bool{
        try{
            $ar = $this->dbh->exec(
                "INSERT INTO tevekenysegek(id, felhasznalo_id, tevekenyseg, tavolsag, ev, honap, nap) VALUES( DEFAULT,". (int)$adat["felhasznalo"].",". $adat["tevekenyseg"].
                ",".$adat["tavolsag"].",".$adat["ev"].",".$adat["honap"].",".$adat["nap"]." )"); 
            return $ar===1;  
        }catch(PDOException $e){
            $this->error("Hiba.",$e);
        }
    }



    









}

