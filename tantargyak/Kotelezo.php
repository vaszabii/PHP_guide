<?php
class Kotelezo{
    private $kod;
    private $megnevezes;
    private $af;

    public function __construct(string $kod=null, string $megnevezes=null, string $af=null)
    {   if($kod==null){
        $this->kod=$this->kod;
        $this->megnevezes=$this->megnevezes;      
        $this->af=(int)$this->af;
        }else{
            $this->kod=$kod;
        $this->megnevezes=$megnevezes;      
        $this->af=(int)$af;
        }      
    }
    
    public function getKod() : string {
        return $this->kod;
    }

    public function getMegnevezes() : string {
        return $this->megnevezes;
    }
    public function getAf() : int {
        return $this->af;
    }



  




}