<?php
class Feladvany{
    private $id;
    private $feladvany;
    private $kitalal;
    private $jokarakterek=[",", " ", "."];
    private $osszkarakter=["ö","ü","ó","ő","ú","á","ű","é"];
    private $hiba;
    private $rossz;

    public function __construct(int $id=null, string $feladvany)
    {
        $this->id=$id;
        $feladvany=lcfirst($feladvany);
        
        
       $this->feladvany=$this->str_split_unicode($feladvany);
       $i=0;
       foreach($this->feladvany as $fbet){
        if( in_array($fbet,$this->jokarakterek)){
            $this->kitalal[]=$this->feladvany[$i];
        }else{
            $this->kitalal[]="_";

        }
        $i++;
       }

          
      
    
        for ($i=97; $i <123 ; $i++) { 
            $this->osszkarakter[]=chr($i);
        } 
        $this->hiba=0;
    }
    public function putKitalal(string $betu){
        $i=0;
        foreach($this->feladvany as $fb){
            if($fb==$betu){
                $this->kitalal[$i]=$betu;
            }
            $i++;
        }
    }
    public function nyertel():bool{
        $i=0;
        foreach($this->feladvany as $b){
            if($b!=$this->kitalal[$i]){
                return false;
            }

            $i++;
        }
        return true;
    }

    public function setHiba(int $hi){
        $this->hiba=$hi;
    }

    public function getID() : string {
        return $this->id;
    }
    public function getHiba() :string{
        return $this->hiba;
    }

 
     public function getRossz() : string {
        return $this->rossz;
    }
    public function setRossz(string $karakter)  {
       $this->rossz=$this->rossz.$karakter;
    }

    public function kiiras(){
        foreach($this->kitalal as $egy)
        {
            echo $egy;
        }
    }
    public function getOsszkarakter():array{
        return $this->osszkarakter;
    }public function getFeladvany():array{
        return $this->feladvany;
    }

    function str_split_unicode($str, $l = 0) {
        if ($l > 0) {
            $ret = array();
            $len = mb_strlen($str, "UTF-8");
            for ($i = 0; $i < $len; $i += $l) {
                $ret[] = mb_substr($str, $i, $l, "UTF-8");
            }
            return $ret;
        }
        return preg_split("//u", $str, -1, PREG_SPLIT_NO_EMPTY);
    }




}