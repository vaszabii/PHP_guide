<?php
class Szallashely{
    private $id;
    private $nev;
    private $leiras;

    public function __construct(int $id=null, string $nev=null, string $leiras=null)
    {
        if($id!==NULL && $nev!==NULL && $leiras!==NULL){
        $this->id=$id;
        $this->nev=$nev;      
        $this->leiras=$leiras; 
        }     
    }
    
    public function getID() : string {
        return $this->id;
    }

    public function getNev() : string {
        return $this->nev;
    }
    public function getLeiras() : string {
        return $this->leiras;
    }



    




}