<?php
class Idopont{
    private $napok;
    private $nev;

    public function __construct(string $nev, array $ertekb)
    {
        
        $this->nev=$nev; 
        $this->napok=$ertekb;

    }
    
    public function getNapok() : array {
        return $this->napok;
    }

    public function getNev() : string {
        return $this->nev;
    }
    public function setNapok(int $id){
        $this->napok[$id]=true;
    }
  




}