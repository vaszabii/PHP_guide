<?php
class Szoba{
    private $nyilaszaro;
    private $szelesseg;   
    private $hossz;    
    private $magassag;
   

    public function __construct(Nyilaszaro $nyilaszaro=null, float $szelesseg=null, float $hossz=null, float $magassag=null )    
    {
        if($nyilaszaro!=null){$this->nyilaszaro[]=$nyilaszaro;}
        
        $this->szelesseg=$szelesseg;
        $this->hossz=$hossz; 
        $this->magassag = $magassag; 
       
        
               
    }
    public function getSzelesseg() : float {
        return $this->szelesseg;
    } 
    public function getHossz() : float {
        return $this->hossz;
    } 
    public function getNyilaszaro() {
        return $this->nyilaszaro;
    }  
    public function setNyilaszaro(Nyilaszaro $nyilaszaro){
        $this->nyilaszaro[]=$nyilaszaro;

    }
    public function getFelulet(){
    $szobafelulet=($this->szelesseg*$this->magassag+$this->magassag*$this->hossz)*2+$this->szelesseg*$this->hossz;
        return $szobafelulet;
    }
    public function getNyilasfelulet(){
        $nyilasfeluletek=0.0;
        if($this->nyilaszaro!=null){
        foreach($this->nyilaszaro as $ny){
            $nyilasfeluletek=$nyilasfeluletek+($ny->getSzelesseg()*$ny->getMagassag());
        }
        }
        return $nyilasfeluletek;
    }

    public function getMagassag() : float {
        return $this->magassag;
    }
  




}