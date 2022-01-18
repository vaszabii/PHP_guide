<?php
class Szoba{
    private $foglalas;

    private $id;   
    private $szallashely_id;    
    private $ferohely;
    private $szezon;
    private $kivul;
    

    public function __construct( Foglalas $foglalas=null ,int $id=null, int $szallashely_id=null, int $ferohely=null, int $szezon=NULL, int $kivul=null )    
    {
        $this->foglalas=$foglalas;
        $this->id=$id;
        $this->szallashely_id=$szallashely_id;        
        $this->ferohely = $ferohely; 
        $this->szezon=$szezon;
        $this->kivul=$kivul;
       
        
               
    }
    public function getID() : int {
        return $this->id;
    } 
    public function getSzallashely_id() : int {
        return $this->szallashely_id;
    } 
    
    public function getFoglalas() : Foglalas {
        return $this->foglalas;
    } 
  

    public function getFerohely() : string {
        return $this->ferohely;
    }
    public function getSzezon() : string {
        return $this->szezon;
    }
    public function getKivul() : string {
        return $this->kivul;
    }
    public function setFerohely(int $db) {
        $this->ferohely=$db;
    }






}