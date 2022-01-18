<?php
class Dal{
    private $id;
    private $album_id;
    private $sorszam;
    private $cim;
    private $hossz;
    private $szoveg;
    
    private $eloado;

    public function __construct(int $id=NULL, string $album_id=NULL, int $sorszam=NULL, string $cim=NULL, string $hossz=NULL, 
    string $szoveg=NULL, Eloado $eloado=NULL)
    {
         $this->id= $id;
         $this->album_id=$album_id;
         $this->sorszam= $sorszam; 
         $this->cim=$cim;
         $this->hossz=$hossz;
         $this->szoveg = $szoveg;  

         $this->eloado = $eloado;


    }
    public function getID() : int {
        return $this->id;
    }
    public function setSzoveg(string $szoveg){
        $this->szoveg = $szoveg; 
    }
    public function getEloado() : Eloado{
        return $this->eloado;
    }

    public function getAlbum_id() : string {
        return $this->album_id;
    } 
     public function getSorszam() : int {
        return $this->sorszam;
    }

    public function getCim() : string {
        return $this->cim;
    }
    public function getHossz() : string {
        return $this->hossz;
    }

    public function getSzoveg()  {
        return $this->szoveg;
    }

    

}
