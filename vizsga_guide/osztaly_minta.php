<?php
class Berendezes{
    
    private $id;   
    private $hutoTelj;    
    private $futoTelj;
    private $SEER;
    private $SCOP;
    private $eOsztalyHutes;
    private $eOsztalyFutes;
    private $zajBelteri;    
    private $zajKulteri;
    private $meret;
    private $kozeg;
    private $biztositek;
    private $aram;
    private $garancia;
    private $brutto;
    private $marka;
    private $tipus;


    public function __construct(/*int $id=null, float $hutoTelj=null, float $futoTelj=null, float $SEER=NULL, float $SCOP=NULL, string $eOsztalyHutes=NULL,
                               string $eOsztalyFutes=NULL,string $zajBelteri=NULL,string $zajKulteri=NULL,string $meret=NULL,string $kozeg=NULL,
                               int $biztositek=NULL,float $aram=NULL,string $garancia=NULL, int $brutto=NULL,string $marka=NULL,string $tipus=NULL */ )    
    {
       /* $this->id=$id;
        $this->hutoTelj=$hutoTelj;
        $this->futoTelj=$futoTelj;
        $this->SEER=$SEER;
        $this->SCOP=$SCOP;
        $this->eOsztalyHutes=$eOsztalyHutes;
        $this->eOsztalyFutes=$eOsztalyFutes;
        $this->zajBelteri=$zajBelteri;
        $this->zajKulteri=$zajKulteri;
        $this->meret=$meret;
        $this->kozeg=$kozeg;
        $this->biztositek=$biztositek;
        $this->aram=$aram;
        $this->garancia=$garancia;
        $this->brutto=$brutto;
        $this->marka=$marka;
        $this->tipus=$tipus;*/

        if(strlen($ISBN)!=13){
            throw new Exception("Nem megfelelő az ISBN szám hossza");
        }
     
        
               
    }
    public function getAr():int{
        return (int)$this->brutto;
    }
    public function getID():int{
        return (int)$this->id;
    }
    public function getSeer():float{
        return (int)$this->SEER;
    }
    public function getTipus():string{
        return $this->tipus;
    }
    //varázsget

    public function __get(string $prop) {
        return $this->$prop;
    }
    

    //tostring megoldás

    public function __toString() : string {
        return "<table>". 
        "<tr><th>{$this->marka}</th></tr>".
        "<tr><th>".$this->tipus."</th></tr>".
        "<tr><td>Hűtőteljesítmény</td><td>kW</td><td>".(($this->hutoTelj==null)?"Nincs érték":$this->hutoTelj)."</td></tr>".
        "<tr><td>Fűtőteljesítmény</td><td>kW</td><td>".(($this->futoTelj==null)?"Nincs érték":$this->futoTelj)."</td></tr>".
        "<tr><td>Hatékonyság(Hűtés)</td><td>SEER</td><td>".(($this->SEER==null)?"Nincs érték":$this->SEER)."</td></tr>".
        "<tr><td>Hatékonyság(Fűtés)</td><td>SCOP</td><td>".(($this->SCOP==null)?"Nincs érték":$this->SCOP)."</td></tr>".
        "<tr><td>Energiaosztály(Hűtés)</td><td>kW</td><td>".(($this->eOsztalyHutes==null)?"Nincs érték":$this->eOsztalyHutes)."</td></tr>".
        "<tr><td>Energiaosztály(Fűtés)</td><td>kW</td><td>".(($this->eOsztalyFutes==null)?"Nincs érték":$this->eOsztalyFutes)."</td></tr>".
        "<tr><td>Zajszint(beltéri)</td><td>dB(A)</td><td>".(($this->zajBelteri==null)?"Nincs érték":$this->zajBelteri)."</td></tr>".
        "<tr><td>Zajszint(Kültéri)</td><td>dB(A)</td><td>".(($this->zajKulteri==null)?"Nincs érték":$this->zajKulteri)."</td></tr>".
        "<tr><td>Beltéri mérete</td><td>mm</td><td>".(($this->meret==null)?"Nincs érték":$this->meret)."</td></tr>".
        "<tr><td>Hűtőközeg típusa</td><td>kW</td><td>".(($this->kozeg==null)?"Nincs érték":$this->kozeg)."</td></tr>".
        "<tr><td>Ajánlott biztosíték</td><td>A</td><td>".(($this->biztositek==null)?"Nincs érték":$this->biztositek)."</td></tr>".
        "<tr><td>Max. áram</td><td>A</td><td>".(($this->aram==null)?"Nincs érték":$this->aram) ."</td></tr>".
        "<tr><td>Garancia</td><td>év</td><td>".(($this->garancia==null)?"Nincs érték":$this->garancia)."</td></tr>".
        "<tr><td>Bruttó ár</td><td>Ft</td><td>".(($this->brutto==null)?"Nincs érték":$this->brutto)."</td></tr>"."</table>";
       
    }








}