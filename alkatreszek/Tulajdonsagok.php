<?php
class Tulajdonsagok{
    private $termek_id;   
    private $tulajdonsag;    
    private $ertek;
 

    public function __construct( int $termek_id=null, string $tulajdonsag=null, string $ertek=null )    
    {          
    }
    public function getTermek_id() : string {
        return $this->termek_id;
    } 
    public function getTulajdonsag() : string {
        return $this->tulajdonsag;
    }     

    public function getErtek() : string {
        return $this->ertek;
    }
 




}