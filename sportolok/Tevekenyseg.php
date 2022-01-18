<?php
class Tevekenyseg{
    private $felhasznalo;
    private $id;   
    private $tevekenyseg;    
    private $tavolsag;
    private $ev;
    private $honap;
    private $nap;

    public function __construct(Felhasznalo $felhasznalo=null, string $id=null, int $tevekenyseg=null, float $tavolsag=null, string $ev=NULL, string $honap=NULL,string $nap=NULL )    
    {
        $this->felhasznalo=$felhasznalo;
        $this->id=$id;
        if($tevekenyseg==0){$this->tevekenyseg="Futás";}
        else if($tevekenyseg==1){$this->tevekenyseg="Bringázás";}
        else if($tevekenyseg==2){$this->tevekenyseg="Görkorcsolyázás";};
        $this->tavolsag = $tavolsag; 
        $this->ev=$ev;
        $this->honap=$honap;
        $this->nap = $nap;
        
               
    }
    public function getID() : string {
        return $this->id;
    } 
    public function getTevekenyseg() : string {
        return $this->tevekenyseg;
    } 
    public function getFelhasznalo() : Felhasznalo{
        return $this->felhasznalo;
    }  

    public function getTavolsag() : float {
        return $this->tavolsag;
    }
    public function getEv() : string {
        return $this->ev;
    }

    public function getHonap() : string {
        return $this->honap;
    }
    public function getNap() : string {
        return $this->nap;
    }





}