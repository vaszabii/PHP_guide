<?php
class Nyilaszaro{
    private $szelesseg;
    private $magassag;

    public function __construct(float $szelesseg, float $magassag)
    {
        $this->szelesseg=$szelesseg;
        $this->magassag=$magassag;      
    }
    
    public function getSzelesseg() : float {
        return $this->szelesseg;
    }

    public function getMagassag() : float {
        return $this->magassag;
    }
  




}