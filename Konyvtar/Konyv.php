<?php

class Konyv {
    private $cim;
    private $szerzo;
    private $ISBN;
    private $kulcsszavak;

    public function __construct(string $cim, string $szerzo, string $ISBN, array $kulcsszavak=[])
    {
        if(strlen($ISBN)!=13){
            throw new Exception("Nem megfelelő az ISBN szám hossza");
        }
        $this->cim = $cim;
        $this->szerzo = $szerzo;
        $this->ISBN = $ISBN;
        $this->kulcsszavak = $kulcsszavak;
        
    }
    public function getCim() : string {
        
        return $this->cim;
    }
    public function getSzerzo() : string {
        return $this->szerzo;
    }
    public function getISBN() : string {
        return $this->ISBN;
    }
    public function getKulcsszavak() : array {
        return $this->kulcsszavak;
    }

    public function setCim(string $cim){
        $jocim = filter_input($cim, FILTER_SANITIZE_STRING);       
        $this->cim = $jocim;
    }
    public function setSzerzo(string $szerzo){
        $this->szerzo = filter_input($szerzo, FILTER_SANITIZE_STRING);
    }
    public function setISBM(string $ISBN){
        if(strlen($ISBN)!=13){
            throw new Exception("Nem megfelelő az ISBN szám hossza");
        }
        $this->ISBN = $ISBN;
    }
    public function setKulcsszavak(array $kulcsszavak){
        
        foreach ($kulcsszavak as  $value) {
            $value = filter_input($value, FILTER_SANITIZE_STRING);
         }
        $this->kulcsszavak = $kulcsszavak;
    }

    public function __get(string $prop) {
        return $this->$prop;
    }

    public function __isset(string $prop) {
        return isset($this->$prop);
    }

    public function kulcsegyezes(array $adottKulcsok) :int{
        $db = 0;
        
        foreach ($adottKulcsok as  $value) {
            
           if(in_array($value,$this->kulcsszavak)){
            
            $db++;
            echo "<p>".$db."</p>";

           }
        }
        return $db;
    }

    public function __toString() : string {
        return "Cím:{$this->cim} Szerző:{$this->szerzo} ISBN szám: {$this->ISBN}";
    }


}


?>