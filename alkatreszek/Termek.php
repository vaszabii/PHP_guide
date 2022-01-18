<?php
class Termek{
    private $id;
    private $gyarto;
    private $modell;

    public function __construct(int $id=null, string $gyarto=null,string $modell=null)
    {   
        if($id!=null){
            $this->id=$id;
            $this->gyarto=$gyarto;
            $this->modell=$modell;
        }
            $this->id=(int)$this->id;
            $this->gyarto=$this->gyarto;      
        
    }
    
    public function getID() : int {
        return $this->id;
    }

    public function getGyarto() : string {
        return $this->gyarto;
    }
    public function getModell() : string {
        return $this->modell;
    }
  




}