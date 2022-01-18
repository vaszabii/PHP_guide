<?php
class DataBase{
    private $dbh = NULL;
    const SERVER = "localhost";
    const USER = "root";
    const PASSWORD = "";
    const SCHEMA = "tantargyak";
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
    
    public function getTargyak(string $targykod=null){
        $targyak = [];
        try{
            $sql="SELECT * FROM kotelezo ";
            if($targykod!==null){
                $sql.="WHERE kod='".$targykod."'";
            }

            $stmt = $this->dbh->query($sql);
            while($s = $stmt->fetchObject("Kotelezo")) {
                $targyak[] = $s;
            }
            return $targyak;
        }catch(PDOException $e){
            $this->error("Unable to query  data",$e);
        } 
    }

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


    

}