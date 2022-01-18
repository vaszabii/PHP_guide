<?php
class Album{
    private $eloado;
    private $id;   
    private $cim;
    
    private $kiadas_eve;
    private $kis_borito;
    private $nagy_borito;

    public function __construct(Eloado $eloado=null, string $id=null, string $cim=null, int $kiadas_eve=null, string $kis_borito=NULL, string $nagy_borito=NULL )    
    {
        $this->eloado=$eloado;
        $this->id=$id;
        $this->cim=$cim;
        $this->kiadas_eve = $kiadas_eve; 
        $this->kis_borito=$kis_borito;
        $this->nagy_borito=$nagy_borito;
        
               
    }
    public function getID() : string {
        return $this->id;
    } 
    public function getCim() : string {
        return $this->cim;
    } 
    public function getEloado() : Eloado{
        return $this->eloado;
    }

    

    public function getKiadas_eve() : int {
        return $this->kiadas_eve;
    }
    public function getKis_borito()  {
        return $this->kis_borito;
    }

    public function getNagy_borito()  {
        return $this->nagy_borito;
    }





}