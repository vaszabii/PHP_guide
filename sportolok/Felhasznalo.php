<?php
class Felhasznalo{
    private $id;
    private $nev;

    public function __construct(int $eloado_id=null, string $nev)
    {
        $this->id=$eloado_id;
        $this->nev=$nev;      
    }
    
    public function getID() : string {
        return $this->id;
    }

    public function getNev() : string {
        return $this->nev;
    }



    




}