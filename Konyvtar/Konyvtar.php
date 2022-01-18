<?php

class Konyvtar{
    private $konyvek;

    public function __construct() {
        $this->konyvek = [];        
    }

    public function addKonyvek(Konyv &$konyv) {
        $this->konyvek[] = $konyv;
    }
  

    public function getKonyvek() : array {
        return $this->konyvek;
    }
 
    public function Keres(string $keres) : array{
        $eredmeny = [];
        foreach($this->konyvek as $konyv) {
            if(str_contains($konyv->getCim(),$keres) ||str_contains($konyv->getSzerzo(),$keres)||$konyv->getISBN() == $keres) {
                $eredmeny[]= $konyv;                
            }
            
        } 
        return $eredmeny;
    }

    public function kulcsKeres(array $kulcsszavak) :array{
        
         $eredmeny =[];
         $sorszamok= [];
         
        foreach($this->konyvek as $konyv) {
            $db=$konyv->kulcsegyezes($kulcsszavak);
            
            if($db>0){
                $sorszamok[]=$db;
                $eredmeny[]=$konyv;
                
            }
        }
        print_r($sorszamok);
        arsort($sorszamok);
        print_r($sorszamok);
        $szamlalo=0;
        

        foreach($sorszamok as $id=>$db){
            if($szamlalo!==$id){
            $csere=$eredmeny[$id];
            $eredmeny[$id] = $eredmeny[$szamlalo];
            $eredmeny[$szamlalo] = $csere;
            }
            $szamlalo++;
        }
        return  $eredmeny;
    }










}
?>